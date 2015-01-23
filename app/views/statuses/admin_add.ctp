<div class="statuses form">
<?php echo $this->Form->create('Status');?>
	<fieldset>
 		<legend><?php __('Admin Add Status'); ?></legend>
	<?php
		echo $this->Form->input('status');
		echo $this->Form->input('description');
		echo $this->Form->input('pass');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>