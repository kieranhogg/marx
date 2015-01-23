<div class="teachersSubjects form">
<?php echo $this->Form->create('TeachersSubject');?>
	<fieldset>
 		<legend><?php __('Admin Add Teachers Subject'); ?></legend>
	<?php
		echo $this->Form->input('teacher_id');
		echo $this->Form->input('subject_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>