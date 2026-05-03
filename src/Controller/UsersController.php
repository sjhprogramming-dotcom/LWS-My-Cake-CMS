<?php
declare(strict_types=1);

namespace App\Controller;


use App\Mailer\UsersMailer;
use cake\Routing\Router;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{

    public function beforeFilter(\Cake\Event\EventInterface $event): void
    {
        parent::beforeFilter($event);

        // Allow users to register and logout.
        // You should not add the "login" action to allow list. Doing so would
        // cause problems with normal functioning of AuthComponent.
        $this->Authentication->allowUnauthenticated(['add', 'login', 'userActivation', 'requestNewActivationToken']);
    }


    /*     * Login method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful login, renders view otherwise.
     */
    public function login()
    {

        $this->Authorization->skipAuthorization();
        $result = $this->Authentication->getResult();

        /* if (!$this->Authentication->getResult()->isValid() && $this->request->getQuery('redirect')) 
            {
         
                $this->Flash->warning(__('You were logged out due to inactivity. Please log in again to continue.'));
            } */


        if ($this->request->getQuery('redirect')) {
            $this->Flash->error(__('You are not authorised to access that page.'));
        }


        //Check the Session
        $session = $this->request->getSession();
        if ($session->check('Auth.User')) {
            $this->Flash->warning(__('You are already logged in.'));
            return $this->redirect(['controller' => 'Articles', 'action' => 'index']);
        }   

        
        if ($session->read('Auth.timeout')) {
            $this->Flash->warning(
                __('You were logged out due to inactivity. Please log in again to continue.')
            );
            $session->delete('Auth.timeout');
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }

        
        // If the user is logged in send them away.
        if ($result && $result->isValid()) {

            if(!$this->request->getAttribute('identity')->isActive) {
                $this->Authentication->logout();
                $this->Flash->set(__('Your account is not active.'), ['element' => 'inactiveaccount']);
                return $this->redirect(['action' => 'login']);
            }
            $target = $this->Authentication->getLoginRedirect() ?? [
                'controller' => 'Articles',
                'action' => 'index',
            ];
            return $this->redirect($target);
        }
        if ($this->request->is('post')) {
            $this->Flash->error(__('Invalid username or password'));
        }
    }

    public function logout()
    {
        $this->Authorization->skipAuthorization();
        $this->Authentication->logout();
        $this->Flash->info(__('You are now logged out.'));
        return $this->redirect(['controller' => 'Users', 'action' => 'login']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Users->find();
        $users = $this->paginate($query);

        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->Authorization->skipAuthorization();
        $user = $this->Users->get($id, contain: ['Articles']);
        $this->set(compact('user'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->Authorization->skipAuthorization();
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());

            $user->activationToken = bin2hex(random_bytes(32)); // Generate a random activation token
            $user->activationTokenExpiry = (new \DateTime())->modify('+2 mins');

            //Make user a "user" by default
            $user->role_id = 3; // Assuming the "User" role has an ID of 3


            if ($this->Users->save($user)) {
                    $this->_sendActivationEmail($user);
                $this->Flash->success(__('Your account has been created. Please check your email to activate your account.'));

                return $this->redirect(['action' => 'login']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, contain: []);
        $this->Authorization->authorize($user);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        $this->Authorization->authorize($user);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


    /**
     * Activate user account using the provided token.
     *
     * @param string|null $token The activation token from the email.
     * @return \Cake\Http\Response|null|void Redirects to login after processing.
     */
    public function userActivation($token = null)
    {
        $this->Authorization->skipAuthorization();

        if (!$token) {
            $this->Flash->error(__('Invalid activation token.'));
            return $this->redirect(['action' => 'login']);
        }

        $user = $this->Users->find()
            ->where(['activationToken' => $token])
            ->first();

        if (!$user) {
            $this->Flash->error(__('Invalid activation token.'));
            return $this->redirect(['action' => 'login']);
        }

        if ($user->activationTokenExpiry < new \DateTime()) {
            
            $user->isActive = false;
            $user->activationToken = null;
            $user->activationTokenExpiry = null;

            if ($this->Users->save($user)) {
                $this->Flash->success(__('Your account has been activated. You can now log in.'));
                return $this->redirect(['action' => 'login']);
            }
            $this->Flash->error(__('Activation token has expired.' . $this->Html->link('Please request a new one.', ['action' => 'requestNewActivationToken'])));
            return $this->redirect(['action' => 'login']);
        }

        $user->isActive = true;
        $user->activationToken = null;
        $user->activationTokenExpiry = null;

        if ($this->Users->save($user)) {
            $this->Flash->success(__('Your account has been activated. You can now log in.'));
            return $this->redirect(['action' => 'login']);
        } else {
            $this->Flash->error(__('There was an error activating your account. Please try again.'));
            return $this->redirect(['action' => 'login']);
        }
    }


    /**
     * Request a new activation token for the user.
     *
     * @return \Cake\Http\Response|null|void Redirects to login after processing.
     */
    public function requestNewActivationToken()
    {
        $this->Authorization->skipAuthorization();

        if ($this->request->is('post')) {
            $email = $this->request->getData('email');
            $user = $this->Users->find()
                ->where(['email' => $email])
                ->first();

            if($user && $user->isActive) {
                
                $user->activationToken = null;
                $user->activationTokenExpiry = null;

                if ($this->Users->save($user)) {
                    $this->Flash->info(__('Your account is already active. Please log in.'));
                    return $this->redirect(['action' => 'login']);
                }
              
            }
            if ($user) {
                $user->activationToken = bin2hex(random_bytes(32));
                $user->activationTokenExpiry = (new \DateTime())->modify('+15 mins');

                if ($this->Users->save($user)) {
                    // Send activation email
                    $this->_sendActivationEmail($user);
                    $this->Flash->success(__('A new activation token has been sent to your email address.'));
                } else {
                    $this->Flash->error(__('There was an error generating a new activation token. Please try again.'));
                }
            } else {
                $this->Flash->success(__('A new activation token has been sent to your email address.'));
            }

            return $this->redirect(['action' => 'login']);
        }
    }

    /**
     * Sends an activation email to the user.
     *
     * @param \App\Model\Entity\User $user The user entity.
     * @return void
     */
    private function _sendActivationEmail($user)
    {

        //Genearate activation token and set expiration time

        // create an activation url
        $activationLink = Router::url([
            'controller' => 'Users',
            'action' => 'userActivation',
            $user->activationToken
        ], true);

        $userMailer = new UsersMailer();
        $userMailer->sendActivationEmail($user->toArray(), $activationLink);
    }
}
