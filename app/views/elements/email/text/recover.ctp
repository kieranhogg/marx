Hi <?php echo $user['User']['forename']; ?>,

You (or someone annoying) is attempting to reset your password.

Your username for this account is: <?php echo $user['User']['username']; ?>


If you wish to continue, you may reset your password by following this link:

<?php echo Router::url(array('controller' => 'users', 'action' => 'verify', $token), true); ?>


If you did not request this email, sorry! Your password will not be reset if you do not take any action.


You can log in to change your email or password by following this link:
<?php echo Router::url(array('controller' => 'users', 'action' => 'login'), true); ?>


Regards,
Marx
