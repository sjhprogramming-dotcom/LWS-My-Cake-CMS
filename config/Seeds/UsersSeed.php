<?php
declare(strict_types=1);

use Migrations\BaseSeed;

/**
 * Users seed.
 */
class UsersSeed extends BaseSeed
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
        $table = $this->table('users');
        $this->table('users')->truncate();
        $data = [
            [
                'email' => 'cakephp@example.com',
                'password' => '$2y$12$PH2tEtbEV0lPQNWgcdkYsOmGaAkk5xtfTq78WD.H0Bl00s.4lzlIe',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
                'role_id' => 1, // Assuming the Admin role has an ID of 1
                'isActive' => true,
            ],

            [
                'email' => 'cakephp1@example.com',
                'password' => '$2y$12$PH2tEtbEV0lPQNWgcdkYsOmGaAkk5xtfTq78WD.H0Bl00s.4lzlIe',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
        ];

       
        $table->insert($data)->save();
    }
}
