<?php
class UsersController extends AppController {

    var $name = 'Users';

    function index() {
        $this->User->recursive = 0;
        $this->set('users', $this->paginate());
    }

    function view($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid user', true));
            $this->redirect(array('action' => 'index'));
        }
        $this->User->recursive = 2;
        $this->set('user', $this->User->read(null, $id));
        $this->set('name', $this->User->getName());
    }

    function add() {
        if (!empty($this->data)) {
            die(pr($this->data));
            $this->User->create();
            if ($this->User->save($this->data)) {
                $this->Session->setFlash(__('The user has been saved', true));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
            }
        }
        $groups = $this->User->Group->find('list');
        $this->set(compact('groups'));
    }

    function edit($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Invalid user', true));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->data)) {
            if ($this->User->save($this->data)) {
                $this->Session->setFlash(__('The user has been saved', true));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->User->read(null, $id);
        }
        $groups = $this->User->Group->find('list');
        $this->set(compact('groups'));
    }

    function delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for user', true));
            $this->redirect(array('action'=>'index'));
        }
        if ($this->User->delete($id)) {
            $this->Session->setFlash(__('User deleted', true));
            $this->redirect(array('action'=>'index'));
        }
        $this->Session->setFlash(__('User was not deleted', true));
        $this->redirect(array('action' => 'index'));
    }
    
    function admin_index() {
        $this->User->recursive = 0;
        $this->set('users', $this->paginate());
    }

    function admin_view($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid user', true));
            $this->redirect(array('action' => 'index'));
        }
        $this->User->recursive = 2;
        $this->set('user', $this->User->read(null, $id));
    }

    function admin_add() {
        if (!empty($this->data)) {
            $this->User->create();
            if ($this->User->save($this->data)) {
                $this->Session->setFlash(__('The user has been saved', true));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
            }
        }
        $groups = $this->User->Group->find('list');
        $this->set(compact('groups'));
    }

    function admin_edit($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Invalid user', true));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->data)) {
//             if (!empty($this->data['User']['password'])) {
//                 $this->data['User']['password'] = sha1($this->data['User']['password']);
//             }
            if ($this->User->save($this->data)) {
                $this->Session->setFlash(__('The user has been saved', true));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->User->read(null, $id);
        }
        $groups = $this->User->Group->find('list');
        $this->set(compact('groups'));
    }

    function admin_delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for user', true));
            $this->redirect(array('action'=>'index'));
        }
        if ($this->User->delete($id)) {
            $this->Session->setFlash(__('User deleted', true));
            $this->redirect(array('action'=>'index'));
        }
        $this->Session->setFlash(__('User was not deleted', true));
        $this->redirect(array('action' => 'index'));
    }

    function beforeFilter() {
        $this->Auth->userModel = 'User';
        $this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
        $this->Auth->loginRedirect = array('controller' => 'groups', 'action' => 'mine');
        $this->Auth->allow('login', 'recover', 'verify');   
        $this->Auth->autoRedirect = false;
    }

    function login() {
        if (!empty($this->data)) {
            if ($this->Auth->login($this->data)) 
            {
                $auth_user = $this->Auth->user();
                $auth_user['User']['role'] = 'Student';
                $this->Session->write('Auth.User.role', 'Student');
                $this->set('auth_user',$auth_user);
                if ($auth_user['User']['email'] == null) {
                    $this->Session->SetFlash(__('Please set an emai address to enable password reset and email notification', true));
                }
                else {
                    $this->Session->SetFlash(__('Successfully logged in as '. 
                        $auth_user['User']['full_name'],true));
                }
                $this->User->id = $this->Session->read('Auth.User.id');
                $this->User->saveField('last_login', date(DATE_ATOM));
                $this->redirect($this->Auth->redirect()); 
            }
            else {
                //check if we can find a teacher
                $this->Session->write('AuthData', $this->Auth->data['User']);
                if ($this->requestAction('/teachers/login')) {
                    $this->redirect('/teachers/dashboard'); 
                }
                else {
                    $this->redirect(array('controller' => 'users', 'action' => 'login')); 
                }
            }
        }
//         $this->set('referer', $this->Session->read('Auth.redirect'));
    }


    function logout() {
        $this->Session->delete('User');
        $this->Session->delete('Auth.User');
        $this->Session->delete('Unread');
//         $this->Session->setFlash('You have been successfully logged out.');
        $this->Auth->logout();
        $this->redirect('/');
    }

    function settings($user_id = null) {
        if ($user_id == null) {
            $user_id = $this->Session->read('Auth.User.id');
        }

        if (!$user_id && empty($this->data)) {
            $this->Session->setFlash(__('Invalid user', true));
            $this->redirect('/');
        }
        if (!empty($this->data)) {
            $this->data['User']['id'] = $user_id;
            if (!empty($this->data['User']['new_password'])) {
                if ($this->data['User']['new_password'] == $this->data['User']['new_password_repeat']) {
                    $this->data['User']['password'] = $this->Auth->password($this->data['User']['new_password']);
                }
                else {
                    $this->Session->setFlash(__('Your passwords do not match', true));
                    $this->redirect('/users/settings/');
                }
            }
            
            if ($this->User->save($this->data)) {
                $this->Session->setFlash(__('Your settings have been saved', true));
                $this->redirect('/users/settings/');
            } else {
                $this->Session->setFlash(__('Your settings could not be saved. Please, try again.', true));
            }
        }

        if (empty($this->data)) {
            $this->User->recursive = -1;
            $this->data = $this->User->read(null, $user_id);
        }
        $this->set('id', $user_id);
    }
    
    /**
    * Allows the user to email themselves a password redemption token
    */
    function recover()
    {
        $this->loadModel('Teacher');
        if ($this->Auth->user()) {
            $this->redirect('/');
        }
        $this->User->recursive = -1;
        if (!empty($this->data['User']['email'])) {
            $Token = ClassRegistry::init('Token');
            $user = $this->User->findByEmail($this->data['User']['email']);
            
            // see if we can find a teacher
            if ($user === false) {
                $user = $this->Teacher->findByEmail($this->data['User']['email']);
                if ($user === false) {
                    $this->Session->setFlash('No matching user found');
                    return false;
                }
                else {
                    $user['User'] = $user['Teacher'];
                    $user['User']['forename'] = $user['Teacher']['salutation'].' '.$user['Teacher']['surname'];
                }
            }

            $token = $Token->generate(array('User' => $user['User']));
            $this->Session->setFlash('An email has been sent to your account, please follow the instructions in this email.');
            $template_vars['email'] = $user['User']['email'];
            $template_vars['user'] = $user;
            $template_vars['token'] = $token;
            $this->requestAction(array('controller' => 'Mailer', 'action' => 'sendRecoveryEmail', 'pass' => array($template_vars))); 
        }
    }
    

    function generatePassword($length = 10) {
        srand((double) microtime()*1000000);

        $vowels = array('a', 'e', 'i', 'o', 'u');
        $cons = array('b', 'c', 'd', 'g', 'h', 'j', 'k', 'l', 'm', 'n',
        'p', 'r', 's', 't', 'u', 'v', 'w', 'tr',
        'cr', 'br', 'fr', 'th', 'dr', 'ch', 'ph',
        'wr', 'st', 'sp', 'sw', 'pr', 'sl', 'cl');

        $num_vowels = count($vowels);
        $num_cons = count($cons);

        $password = '';
        for ($i = 0; $i < $length; $i++) {
            $password .= $cons[rand(0, $num_cons - 1)] . $vowels[rand(0, $num_vowels - 1)];
        }

        return substr($password, 0, $length);
    }
    
    function verify($token_str = null)
    {
        if ($this->Auth->user()) {
            $this->redirect('/');
        }

        $Token = ClassRegistry::init('Token');

        $res = $Token->get($token_str);
        if ($res) {
            $password = $this->generatePassword();
            $this->loadModel('Teacher');
            $this->Teacher->id = $res['User']['id'];
            $this->Teacher->saveField('password', $this->Auth->password($password));
            $this->set('success', true);
            // Send email with new password
            $template_vars['email'] = $res['User']['email'];
            $template_vars['user'] = $res;
            $template_vars['password'] = $password;
            $this->requestAction(array('controller' => 'Mailer', 'action' => 'sendVerifyEmail', 'pass' => array($template_vars))); 
        }
    }
}
?>