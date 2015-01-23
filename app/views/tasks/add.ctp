<div class="tasks form">
<?php echo $this->Form->create('Task');?>
	<fieldset>
 		<legend><?php __('Add Task'); ?></legend>
	<?php
		echo $this->Form->input('code');
		echo $this->Form->input('description');
		echo $this->Form->input('unit_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>