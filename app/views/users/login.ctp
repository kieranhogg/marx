<?php
    echo $session->flash('auth'); ?>
    <h2>Login</h2>
    </p><br />
    <?php echo $form->create('User', array('action' => 'login'));
    echo $form->input('username');
    echo $form->input('password');
//     echo $form->hidden('referer', array('value' => $referer));
//     echo $form->checkbox('auto_login', array('label' => __('Stay signed in')));
    echo $form->end('Login');
    echo $html->link('Forgotten your password?', array('action' => 'recover'));
?>