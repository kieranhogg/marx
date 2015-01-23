<?php
class AppController extends Controller {
    var $helpers = array('Form', 'Html', 'Javascript', 'Time', 'Number', 'Session', 'Ajax', 'Javascript');
    var $components = array('Session', 'Auth');
    var $uses = array('Submission');

    function beforeRender() {
        foreach($this->modelNames as $model) {
            foreach($this->$model->_schema as $var => $field) {
                if(strpos($field['type'], 'enum') === FALSE) {
                    continue;
                }

                preg_match_all("/\'([^\']+)\'/", $field['type'], $strEnum);

                if (is_array($strEnum[1])) {
                    $varName = Inflector::camelize(Inflector::pluralize($var));
                    $varName[0] = strtolower($varName[0]);
                    $this->set($varName, array_combine($strEnum[1], $strEnum[1]));
                }
            }
        }
    }

    function beforeFilter() {
        $this->Auth->userModel = 'User';
        $this->Auth->allow('display');

//         // check the appropriate role level
//         if(isset($this->params['admin'])) {
//             $this->checkAdminSession();
//         }
//         elseif (isset($this->params['manager'])) {
//             $this->checkManagerSession();
//         }
//         elseif (isset($this->params['teacher'])) {
//             $this->checkTeacherSession();
//         }
//         $this->loadModel('Submission');
// 
//         if ($this->Session->read('Auth.User.role') == 'Student') {
//             $this->Session->write('Unread', $this->Submission->checkUnread($this->Session->read('Auth.User.id')));
//         }   
//         elseif ($this->Session->check('Auth.User')) {
//             $this->Session->write('Unread', $this->Submission->checkUnmarked($this->Session->read('Auth.User.id')));
//         }
    }


    function checkAdminSession() {
        // if the admin session hasn't been set
        if (!$this->Session->check('Auth.User')) {
            // set flash message and redirect
            $this->Session->setFlash('You need to be logged in to access this area');
            $this->redirect('/users/login/');
            exit();
        }
        elseif ($this->Session->read('Auth.User.role') != 'Admin') {
            $this->Session->setFlash('You do not have permission to access this area');
            $this->redirect('/');
            exit();
        }
    }

    function checkManagerSession() {
        // if the admin session hasn't been set
        if (!$this->Session->check('Auth.User')) {
            // set flash message and redirect
            $this->Session->setFlash('You need to be logged in to access this area');
            $this->redirect('/users/login/');
            exit();
        }
        elseif ($this->Session->read('Auth.User.role') != 'Manager') {
            $this->Session->setFlash('You do not have permission to access this area');
            $this->redirect('/');
            exit();
        }
    }

    function checkTeacherSession() {
        // if the admin session hasn't been set
        if (!$this->Session->check('Auth.User')) {
            // set flash message and redirect
            $this->Session->setFlash('You need to be logged in to access this area');
            $this->redirect('/users/login/');
            exit();
        }
        elseif ($this->Session->read('Auth.User.role') != 'Teacher') {
            $this->Session->setFlash('You do not have permission to access this area');
            $this->redirect('/');
            exit();
        }
    }
}
?>
