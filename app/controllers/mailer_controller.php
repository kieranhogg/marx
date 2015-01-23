<?php  
class MailerController extends AppController { 

    var $name = 'Mailer'; 
    //Not using a model 
    var $uses = '';
    //The built in Cake Mailer 
    var $components = array('Email'); 

    function sendTeacherMail($template_vars) {
        $this->Email->to = $template_vars['email']; 
        $this->Email->subject = 'New submission for '.$template_vars['group']; 
        $this->Email->replyTo = Configure::read('Email.reply_to'); 
        $this->Email->from = Configure::read('Email.from_email'); 
        $this->Email->template = 'teacher'; 
        //Set view variables as normal 
        $this->set('full_name', $template_vars['full_name']);
        $this->set('unit', $template_vars['unit']);
        $this->set('group', $template_vars['group']);
        $this->set('student_name', $template_vars['student_name']);
        $this->set('filename', $template_vars['filename']);
        $this->set('task', $template_vars['task']);
        $this->set('mark_url', $template_vars['mark_url']);
        $this->Email->send(); 
    }   

    function sendUserMail($template_vars) {
        $this->Email->to = $template_vars['email']; 
        $this->Email->subject = 'Submission marked for '.$template_vars['group']; 
        $this->Email->replyTo = Configure::read('Email.reply_to'); 
        $this->Email->from = Configure::read('Email.from_email'); 
        $this->Email->template = 'user'; 

        $this->set('forename', $template_vars['forename']);
        $this->set('teacher_name', $template_vars['teacher_name']);
        $this->set('unit', $template_vars['unit']);
        $this->set('task', $template_vars['task']);
        $this->set('mark', $template_vars['mark']);
        $this->set('status', $template_vars['status']);
        $this->set('submission_url', $template_vars['submission_url']);
        $this->set('comments', $template_vars['comments']);

        $this->Email->send(); 
    }
    
    function sendVerifyEmail($template_vars) {
        $this->Email->to = $template_vars['email']; 
        $this->Email->subject = 'Marx password changed'; 
        $this->Email->replyTo = Configure::read('Email.reply_to'); 
        $this->Email->from = Configure::read('Email.from_email'); 
        $this->Email->template = 'verify'; 
        $this->set('password', $template_vars['password']);
        $this->set('user', $template_vars['user']);
        $this->set('token', $template_vars['token']);

        $this->Email->send(); 
    }
    
    function sendRecoveryEmail($template_vars) {
        $this->Email->to = $template_vars['email']; 
        $this->Email->subject = 'Marx password recovery'; 
        $this->Email->replyTo = Configure::read('Email.reply_to'); 
        $this->Email->from = Configure::read('Email.from_email'); 
        $this->Email->template = 'recover'; 
        
        $this->set('user', $template_vars['user']);
        $this->set('token', $template_vars['token']);

        $this->Email->send(); 
    }
    
    function beforeFilter() {
        $this->Auth->allow('*');
    }
} 
?>
