<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php echo $this->Html->charset();?>
    <title>
        <?php __('Marx'); ?>
        <?php //echo ' :: '.$title_for_layout;
        if ($this->Session->read('Unread') > 0) {
            echo ' ('.$this->Session->read('Unread').')';
        }
        ?>
    </title>

    <link rel="icon" href="<?php echo $this->webroot;?>favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="<?php echo $this->webroot;?>favicon.ico" type="image/x-icon" />
    <?php echo $javascript->link('jquery-1.4.2.min');?>
    <?php echo $this->Html->css('cake.generic');?>
    <?php echo $scripts_for_layout;?>
</head>
<body>
    <div id="container">
        <div id="header">
            <div id='logo'>
                <?php echo $html->link( 
                            $html->image('logo_s.png'), 
                            Router::url("/", true), 
                            array('escape' => false)); 
                ?>
            <h1>
                <?php echo $html->link(__('Marx', true), Router::url("/", true)); 
                ?>
            </h1>
            </div>
            <div id='login'>
            <?php
                if ($this->Session->read('Auth.User.role') == 'Student') {
                    echo 'Welcome '.$this->Session->read('Auth.User.forename');
                    echo ' | ';
                    echo $this->Html->link(__('Logout', true), array(
                        'controller' => 'users', 'action' => 'logout'));
                }
                elseif ($this->Session->check('Auth.User')) {
                    echo 'Welcome '.
                        $this->Html->link($this->Session->read('Auth.User.salutation').' '.
                            $this->Session->read('Auth.User.surname'),
                            array('controller' => 'teachers', 'action' => 'dashboard'));
                    echo ' | ';
                    echo $this->Html->link(__('Logout', true), array(
                        'controller' => 'users', 'action' => 'logout', 'admin' => false));
                }
           
            ?>
            <p>
            </div>
            <div id='search'>

            </div>
        </div>
        <div id="menu">
            <ul>
            <?php if ($this->Session->read('Auth.User.role') != 'Student' AND $this->Session->check('Auth.User')): ?>
                <li><?php echo $html->link(__('Dashboard', true), '/teachers/dashboard'); ?></li>
                <li><?php echo $html->link(__('My Groups', true), '/groups/mine'); ?></li>
                <li><?php echo $html->link(__('Settings', true), '/teachers/settings/'); ?></li>
                    <?php if ($this->Session->read('Auth.User.role') == 'Admin'): ?>
                        <li><?php echo $this->Html->link('[+] '.__('Admin Tools', true), '/pages/admin'); ?>
                        <ul>
                            <li><?php echo $this->Html->link(__('Groups', true), '/admin/groups/', array('class' => 'admin_button')); ?></li>
                            <li><?php echo $this->Html->link(__('Subjects', true), '/admin/subjects', array('class' => 'admin_button')); ?></li>
                            <li><?php echo $this->Html->link(__('Submissions', true), '/admin/submissions', array('class' => 'admin_button')); ?></li>
                            <li><?php echo $this->Html->link(__('Teachers', true), '/admin/teachers', array('class' => 'admin_button')); ?></li>
                            <li><?php echo $this->Html->link(__('Units', true), '/admin/units', array('class' => 'admin_button')); ?></li>
                            <li><?php echo $this->Html->link(__('Users', true), '/admin/users', array('class' => 'admin_button')); ?></li>
                            <li><?php echo $this->Html->link(__('More...', true), '/pages/admin', array('class' => 'admin_button')); ?></li>

                        </li></ul>
                    <?php elseif ($this->Session->read('Auth.User.role') == 'Manager' OR
                            $this->Session->read('Auth.User.role') == 'Admin'): ?>
                        <li><?php echo $this->Html->link(__('Manager Tools', true), '/pages/manager'); ?></li>
                    <?php endif; ?>
                <?php elseif ($this->Session->read('Auth.User.role') == 'Student'): ?>
                    <li><?php echo $this->Html->link(__('My Groups', true), '/groups/mine'); ?></li>
                    <li><?php echo $this->Html->link(__('My Submissions', true), '/submissions/mine'); ?></li>
                    <li><?php echo $this->Html->link(__('Settings', true), '/users/settings/'); ?></li>
                <?php else: ?>
                    <li><?php echo $this->Html->link('Login', '/users/login'); ?></li>
            <?php endif; ?>
            </ul>
            <ul>
            <div id='unread'>
                <?php
                    $unread = $this->Session->read('Unread');
                    if ($unread > 0):
                        if ($this->Session->read('Auth.User.role') != 'Student' AND $this->Session->check('Auth.User')):                            
                                echo 
                                $html->link( 
                                    //$this->Html->image('unmarked_off.png', array('class' => 'unread_icon')),
                                    '&nbsp;',
                                    array('action' => 'dashboard', 'controller' => 'teachers', 'admin' => false), 
                                    array('escape' => false, 'title' => __('Unmarked Submissions', true))); ?>

                            <?php
                        else:
                            echo 
                                $html->link( 
                                    '&nbsp;',
                                    array('action' => 'mine', 'controller' => 'submissions', 'admin' => false), 
                                    array('escape' => false, 'title' => __('Unviewed Submissions', true)));
                        endif; ?>
                    <span id='marking_unread'>
                    <?php echo $unread; ?>
                    </span>                        
                    <?php endif; ?>
            </div>
        </div>
        <div id="content">
            <?php echo $session->flash();?>
            <?php echo $content_for_layout;?>

        </div>
        <div id="footer">
            <?php echo $this->element('sql_dump'); ?>
        </div>
    </div>
</body>
<!-- Revision: $Revision-Id$ -->
</html>
