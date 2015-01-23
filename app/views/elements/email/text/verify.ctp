Hi <?php echo $user['User']['forename']; ?>,

Your password has been reset, please use the following
details to login:


Username: <?php echo $user['User']['username']; ?>
Password: <?php echo $password; ?>


Please change your password to something more memorable.
You can log in to change your password at this address:


<?php echo Router::url(array('controller' => 'users', 'action' => 'login'), true); ?>


Regards,
Marx