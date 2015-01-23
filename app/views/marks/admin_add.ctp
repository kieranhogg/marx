<div class="marks form">
<?php echo $this->Form->create('Mark');?>
	<fieldset>
 		<legend><?php __('Admin Add Mark'); ?></legend>
	<?php
		echo $this->Form->input('status');
		echo $this->Form->input('description');
		echo $this->Form->input('pass');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
