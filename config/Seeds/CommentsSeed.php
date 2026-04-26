<?php
declare(strict_types=1);

use Migrations\BaseSeed;
use Cake\Datasource\FactoryLocator;
use Cake\ORM\TableRegistry;
use Cake\ORM\Table;




/**
 * Comments seed.
 */
class CommentsSeed extends BaseSeed
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
        $this->table('comments')->truncate();

        // Use the ORM so TreeBehavior can maintain lft/rght automatically.
        /** @var \Cake\ORM\Table $comments */
        $comments = FactoryLocator::get('Table')->get('Comments');

        // Root comment #1
        $c1 = $comments->newEntity([
            'article_id' => 1,
            'user_id'    => 1,
            'parent_id'  => null,
            'title'      => 'First!',
            'body'       => 'Great article — thanks for posting.',
            'created'    => date('Y-m-d H:i:s'),
            'modified'   => date('Y-m-d H:i:s'),
        
        ]);
        $comments->save($c1);

        // Reply to root #1
        $c1_1 = $comments->newEntity([
            'article_id' => 1,
            'user_id'    => 2,
            'parent_id'  => $c1->id,
            'title'      => null,
            'body'       => 'Agreed — the TreeBehaviour approach is neat.',
            'created'    => date('Y-m-d H:i:s'),
            'modified'   => date('Y-m-d H:i:s'),
        ]);
        $comments->saveOrFail($c1_1);

        // Reply to reply (nested)
        $c1_1_1 = $comments->newEntity([
            'article_id' => 1,
            'user_id'    => 1,
            'parent_id'  => $c1_1->id,
            'title'      => null,
            'body'       => 'Yep — just remember to keep parent_id nullable.',
            'created'    => date('Y-m-d H:i:s'),
            'modified'   => date('Y-m-d H:i:s'),
        ]);
        $comments->saveOrFail($c1_1_1);

        // Root comment #2
        $c2 = $comments->newEntity([
            'article_id' => 1,
            'user_id'    => 2,
            'parent_id'  => null,
            'title'      => 'Question',
            'body'       => 'How are you planning to handle moderation?',
            'created'    => date('Y-m-d H:i:s'),
            'modified'   => date('Y-m-d H:i:s'),
        ]);
        $comments->saveOrFail($c2);

        // Reply to root #2
        $c2_1 = $comments->newEntity([
            'article_id' => 1,
            'user_id'    => 1,
            'parent_id'  => $c2->id,
            'title'      => null,
            'body'       => 'I usually add an is_approved flag and an admin queue.',
            'created'    => date('Y-m-d H:i:s'),
            'modified'   => date('Y-m-d H:i:s'),
        ]);
    
    
    

        $table = $this->table('comments');


        $comments->saveOrFail($c2_1);
    }
}
