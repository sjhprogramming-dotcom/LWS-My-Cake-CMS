<?php
declare(strict_types=1);

use Migrations\BaseMigration;

class CreateComments extends BaseMigration
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
        $table = $this->table('comments');

        //Create the table columns
        $table
            ->addColumn('article_id', 'integer', [
                'null' => false,
                
            ])
            ->addColumn('user_id', 'integer', [
                'null' => false,
                
            ])
            ->addColumn('parent_id', 'integer', [
                'null' => true,
                'default' => null,
            ])
            ->addColumn('lft', 'integer', [
                'null' => true,
                'default' => null,
            ])
            ->addColumn('rght', 'integer', [
                'null' => true,
                'default' => null,
            ])
            ->addColumn('title', 'string', [
                'null' => true,
                'default' => null,
            ])
            ->addColumn('body', 'text', [
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'null' => false,
            ])
            ->addColumn('modified', 'datetime', [
                'null' => false,
            ]);

        //Create the table indexes
        $table
            ->addIndex(['article_id'], ['name' => 'idx_comments_article_id'])
            ->addIndex(['user_id'], ['name' => 'idx_comments_user_id'])
            ->addIndex(['parent_id'], ['name' => 'idx_comments_parent_id'])
            ->addIndex(['lft'], ['name' => 'idx_comments_lft'])
            ->addIndex(['rght'], ['name' => 'idx_comments_rght'])
            ->addIndex(['article_id', 'lft'], ['name' => 'idx_comments_article_lft']);


        // Table Foreign Keys
        $table
            ->addForeignKey('article_id', 'articles', 'id', [
                'delete' => 'CASCADE',
                'update' => 'CASCADE',
                'constraint' => 'fk_comments_articles',
            ])
            ->addForeignKey('user_id', 'users', 'id', [
                'delete' => 'CASCADE',
                'update' => 'CASCADE',
                'constraint' => 'fk_comments_users',
            ])
            ->addForeignKey('parent_id', 'comments', 'id', [
                'delete' => 'SET_NULL',
                'update' => 'CASCADE',
                'constraint' => 'fk_comments_parent_comments',
            ]);


        //Create the table
        $table->create();
    }
}
