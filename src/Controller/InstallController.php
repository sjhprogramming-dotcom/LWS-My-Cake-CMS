<?php

declare(strict_types=1);

namespace App\Controller;



use Cake\Event\EventInterface;

use Cake\Http\Exception\ForbiddenException;
use Cake\Utility\Security;

final class InstallController extends AppController
{
    private string $lockFile;

    public function initialize(): void
    {
        parent::initialize();
       // $this->loadComponent('FormProtection'); // optional
        $this->lockFile = CONFIG . 'installed.lock';

        $this->viewBuilder()->setLayout('install');
    }


    public function beforeFilter(EventInterface $event) :void
    {
        parent::beforeFilter($event);

        // ✅ Ensure installer actions never require login
        $this->Authentication->setConfig('requireIdentity', false); // overrides enforcement [1](https://stackoverflow.com/questions/42051557/how-can-i-run-all-migrations-for-all-plugins-in-cakephp-3)
        $this->Authentication->allowUnauthenticated(['index', 'run']);

        // ✅ Ensure installer actions never require authorization
        $this->Authorization->skipAuthorization();
    }


    public function index()
    {
        // If already installed, block installer
        if (file_exists($this->lockFile)) {
            throw new ForbiddenException('Application is already installed.');
        }

        $this->set('requirements', $this->checkRequirements());
    }

    public function run()
    {
        // Block re-install
        if (file_exists($this->lockFile)) {
            throw new ForbiddenException('Application is already installed.');
        }

        // Only allow POST
        if (!$this->request->is('post')) {
            return $this->redirect(['action' => 'index']);
        }

        $data = $this->request->getData();

        // Basic validation
        foreach (['host', 'username', 'database'] as $field) {
            if (empty($data[$field])) {
                $this->Flash->error('Missing required field: ' . $field);
                return $this->redirect(['action' => 'index']);
            }
        }

        // 1️⃣ Test database connection
        try {
            $dsn = sprintf(
                'mysql:host=%s;dbname=%s;charset=utf8mb4',
                $data['host'],
                $data['database']
            );

            new \PDO(
                $dsn,
                $data['username'],
                $data['password'] ?? '',
                [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]
            );
        } catch (\Throwable $e) {
            $this->Flash->error('Database connection failed: ' . $e->getMessage());
            return $this->redirect(['action' => 'index']);
        }

        // 2️⃣ Write config/app_local.php
        try {
            $config = $this->buildAppLocalPhp(
                $data,
                Security::randomString(64)
            );

            file_put_contents(
                CONFIG . 'app_local.php',
                $config,
                LOCK_EX
            );
        } catch (\Throwable $e) {
            $this->Flash->error('Failed to write app_local.php');
            return $this->redirect(['action' => 'index']);
        }

        // 3️⃣ Run migrations
        if (!$this->runMigrationsCli()) {
            $this->Flash->error(
                'Database migrations failed. Check CLI permissions or logs.'
            );
            return $this->redirect(['action' => 'index']);
        }

        // 4️⃣ Create admin user (if provided)
        if (!empty($data['email']) && !empty($data['password'])) {
            try {
                $this->createAdminUser(
                    $data['email'],
                    $data['password']
                );
            } catch (\Throwable $e) {
                $this->Flash->error(
                    'Installation completed, but admin user could not be created: ' .
                        $e->getMessage()
                );
                return $this->redirect(['action' => 'index']);
            }
        }

        // 5️⃣ Lock installer
        file_put_contents(
            $this->lockFile,
            'installed_at=' . date('c') . PHP_EOL,
            LOCK_EX
        );

        $this->Flash->success('Installation completed successfully.');
        return $this->redirect('/');
    }


    private function checkRequirements(): array
    {
        return [
            'phpVersion' => PHP_VERSION,
            'configWritable' => is_writable(CONFIG),
            'tmpWritable' => is_writable(TMP),
            'logsWritable' => is_writable(LOGS),
            'extensions' => [
                'pdo' => extension_loaded('pdo'),
                'intl' => extension_loaded('intl'),
                'mbstring' => extension_loaded('mbstring'),
            ],
        ];
    }

    private function buildAppLocalPhp(array $data, string $salt): string
    {
        // NOTE: For other DB drivers, adjust DSN/driver accordingly.
        // Keep secrets out of VCS; app_local.php is typically gitignored.
        $host = addslashes((string)$data['host']);
        $user = addslashes((string)$data['username']);
        $pass = addslashes((string)$data['password']);
        $db   = addslashes((string)$data['database']);

        return <<<PHP
<?php
declare(strict_types=1);

return [
    'debug' => false,
    'Security' => [
        'salt' => '{$salt}',
    ],
    'Datasources' => [
        'default' => [
            'host' => '{$host}',
            'username' => '{$user}',
            'password' => '{$pass}',
            'database' => '{$db}',
            'encoding' => 'utf8mb4',
            'timezone' => 'UTC',
            'cacheMetadata' => true,
        ],
    ],
];
PHP;
    }

    private function runMigrationsCli(): bool
    {
        // Run: bin/cake migrations migrate
        $root = dirname(__DIR__, 2); // project root from src/Controller
        $binCake = $root . DIRECTORY_SEPARATOR . 'bin' . DIRECTORY_SEPARATOR . 'cake';

        // Some hosts require explicit php binary path; "PHP_BINARY" is usually OK.
        $cmd = escapeshellcmd(PHP_BINARY) . ' ' . escapeshellarg($binCake) . ' migrations migrate';

        $output = [];
        $code = 0;
        @exec($cmd . ' 2>&1', $output, $code);

        // Optionally log output for debugging:
        // file_put_contents(LOGS . 'install.log', implode(PHP_EOL, $output) . PHP_EOL, FILE_APPEND);

        return $code === 0;
    }

    private function createAdminUser(string $email, string $password): void
    {
        // Example assumes you have Users table/entity and password hashing configured.
        $this->fetchTable('Users');
        $users = $this->Users;

        $entity = $users->newEntity([
            'email' => $email,
            'password' => $password,
            'role_id' => '1',
            'is_active' => true,
        ]);

        if ($entity->hasErrors()) {
            throw new \RuntimeException('Admin user validation failed: ' . json_encode($entity->getErrors()));
        }

        if (!$users->save($entity)) {
            throw new \RuntimeException('Failed to save admin user.');
        }
    }
}
