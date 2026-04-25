<?php
declare(strict_types=1);

use Migrations\BaseSeed;

/**
 * Roles seed.
 */
class RolesSeed extends BaseSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * https://book.cakephp.org/migrations/5/en/seeding.html
     *
     * @return void
     */
    public function run(): void
    {
        $this->table('roles')->truncate();
        $data = [
            [
                'name' => 'Admin',
                'description' => 'Administrator with full access to all features.',
                'isAdmin' => true,
                'isModerator' => false,
                'isUser' => false,
            ],
            [
                'name' => 'Moderator',
                'description' => 'Moderator with limited access to manage content.',
                'isAdmin' => false,
                'isModerator' => true,
                'isUser' => false,
            ],
            [
                'name' => 'User',
                'description' => 'Regular user with access to basic features.',
                'isAdmin' => false,
                'isModerator' => false,
                'isUser' => true,
            ],
        ];

        $table = $this->table('roles');
        $table->insert($data)->save();
    }
}
