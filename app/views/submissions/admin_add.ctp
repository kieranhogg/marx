<div class="submissions form">
<?php echo $this->Form->create('Submission');?>
	<fieldset>
 		<legend><?php __('Admin Add Submission'); ?></legend>
	<?php
		echo $this->Form->input('student_id');
		echo $this->Form->input('name');
		echo $this->Form->input('path');
		echo $this->Form->input('type');
		echo $this->Form->input('size');
		echo $this->Form->input('unit_id');
		echo $this->Form->input('task_id');
		echo $this->Form->input('marked');
		echo $this->Form->input('teacher_id');
		echo $this->Form->input('comment');
		echo $this->Form->input('response');
		echo $this->Form->input('response_to');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>