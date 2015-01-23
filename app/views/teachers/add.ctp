<div class="teachers form">
<?php echo $this->Form->create('Teacher');?>
	<fieldset>
 		<legend><?php __('Add Teacher'); ?></legend>
	<?php
		echo $this->Form->input('salutation');
		echo $this->Form->input('surname');
		echo $this->Form->input('email');
		echo $this->Form->input('username');
		echo $this->Form->input('password');
		echo $this->Form->input('role');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>