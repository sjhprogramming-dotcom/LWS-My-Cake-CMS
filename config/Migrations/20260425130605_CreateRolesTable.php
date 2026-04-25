<?php
declare(strict_types=1);

use Migrations\BaseMigration;

class CreateRolesTable extends BaseMigration
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
        $table = $this->table('roles');

        
        $table->addColumn('name', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);

        $table->addColumn('description', 'text', [
            'default' => null,
            'null' => true,
        ]);
      
        $table->addColumn('isAdmin', 'boolean', [
            'default' => false,
            'null' => false,
        ]);

        $table->addColumn('isModerator', 'boolean', [
            'default' => false,
            'null' => false,
        ]);

        $table->addColumn('isUser', 'boolean', [
            'default' => true,
            'null' => false,
        ]);

        $table->create();
    }
}
