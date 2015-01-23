<h2>Recover Password</h2>

<?php if (isset($success)): ?>
<p>Your new password has been emailed to you.</p>
<p>A new password has been generated for your account and mailed to you. After you've logged in, you should change your password to something memorable on the Settings page.</p>
<?php else: ?>
<?php $this->Session->setFlash('Invalid link'); ?>
<p>This page has expired, or the link was not copied from your email client correctly.</p>
<p>Make sure you're copying the link correctly, or <?php $html->link(__('request another password reset'), 'recover'); ?>.</a>
<?php endif; ?>