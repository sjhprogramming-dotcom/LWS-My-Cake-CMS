<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Comments Controller
 *
 * @property \App\Model\Table\CommentsTable $Comments
 * @property \Authorization\Controller\Component\AuthorizationComponent $Authorization
 */
class CommentsController extends AppController
{
    /**
     * Initialize controller
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('Authorization.Authorization');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Comments->find()
            ->contain(['Articles', 'Users', 'ParentComments', 'ChildComments']);
        $query = $this->Authorization->applyScope($query);
        $comments = $this->paginate($query);

        $this->set(compact('comments'));
    }

    /**
     * View method
     *
     * @param string|null $id Comment id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->Authorization->skipAuthorization();
        $comment = $this->Comments->get($id, contain: ['Articles', 'Users', 'ParentComments', 'ChildComments']);
       // $this->Authorization->authorize($comment);
        $this->set(compact('comment'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $comment = $this->Comments->newEmptyEntity();
        $this->Authorization->authorize($comment);
        if ($this->request->is('post')) {
            $comment = $this->Comments->patchEntity($comment, $this->request->getData());
            if ($this->Comments->save($comment)) {
                $this->Flash->success(__('The comment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The comment could not be saved. Please, try again.'));
        }
        $articles = $this->Comments->Articles->find('list', limit: 200)->all();
        $users = $this->Comments->Users->find('list', limit: 200)->all();
        $parentComments = $this->Comments->ParentComments->find('list', limit: 200)->all();
        $this->set(compact('comment', 'articles', 'users', 'parentComments'));
    }

    /**
     * Add new thread method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function addNewThread($articleId = null)
    {


        $comment = $this->Comments->newEmptyEntity();
        $this->Authorization->authorize($comment);
        if ($this->request->is('post')) {
            $comment = $this->Comments->patchEntity($comment, $this->request->getData());

            //Get User Signed in Data
            $comment->user_id = $this->request
                ->getAttribute('identity')
                ->getIdentifier();

            //Get the ID of the article being commented on.
            $comment->article_id = $articleId;



            if ($this->Comments->save($comment)) {
                $this->Flash->success(__('The comment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The comment could not be saved. Please, try again.'));
        }
        $articles = $this->Comments->Articles->find('list', limit: 200)->all();
        $users = $this->Comments->Users->find('list', limit: 200)->all();
        $parentComments = $this->Comments->ParentComments->find('list', limit: 200)->all();
        $this->set(compact('comment', 'articles', 'users', 'parentComments'));
    }

    public function reply()
    {
        $comment = $this->Comments->newEmptyEntity();
        $this->Authorization->authorize($comment);
        if ($this->request->is('post')) {
            $comment = $this->Comments->patchEntity($comment, $this->request->getData());
            //Get User Signed in Data
            $comment->user_id = $this->request
                ->getAttribute('identity')
                ->getIdentifier();


            if ($this->Comments->save($comment)) {
                $this->Flash->success('Reply posted.');
            } else {
                $this->Flash->error('Could not save reply.');
            }
        }

        return $this->redirect($this->referer());
    }

    /**
     * Edit method
     *
     * @param string|null $id Comment id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $comment = $this->Comments->get($id, contain: []);
        $this->Authorization->authorize($comment);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $comment = $this->Comments->patchEntity($comment, $this->request->getData());
            if ($this->Comments->save($comment)) {
                $this->Flash->success(__('The comment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The comment could not be saved. Please, try again.'));
        }
        $articles = $this->Comments->Articles->find('list', limit: 200)->all();
        $users = $this->Comments->Users->find('list', limit: 200)->all();
        $parentComments = $this->Comments->ParentComments->find('list', limit: 200)->all();
        $this->set(compact('comment', 'articles', 'users', 'parentComments'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Comment id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $comment = $this->Comments->get($id);
        $this->Authorization->authorize($comment);
        if ($this->Comments->delete($comment)) {
            $this->Flash->success(__('The comment has been deleted.'));
        } else {
            $this->Flash->error(__('The comment could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
