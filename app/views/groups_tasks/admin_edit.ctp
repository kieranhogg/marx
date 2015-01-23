<div class="groupsTasks form">
<?php echo $this->Form->create('GroupsTask');?>
	<fieldset>
 		<legend><?php __('Admin Edit Groups Task'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('group_id');
		echo $this->Form->input('task_id');
		echo $this->Form->input('due_date');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>