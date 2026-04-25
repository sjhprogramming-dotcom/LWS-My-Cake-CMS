<?php
declare(strict_types=1);

use Migrations\BaseMigration;

class AddRolesToUsers extends BaseMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/migrations/5/en/migrations.html#the-change-method
     *
     * @return void
     */
    public function change(): void
    {
        $table = $this->table('users');
        $table->addColumn('role_id', 'integer', [
            'default' => null,
            'null' => true,
            'after' => 'modified', // Adjust the position of the new column as needed
        ]);

        $table->update();
    }
}
