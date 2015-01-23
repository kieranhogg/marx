<div class="tasks form">
<?php echo $this->Form->create('Task');?>
	<fieldset>
 		<legend><?php __('Admin Add Task'); ?></legend>
	<?php
		echo $this->Form->input('code');
		echo $this->Form->input('description');
        if (!empty($this->params['named']['unit'])) {
            echo $form->hidden('unit_id', array('value' => $this->params['named']['unit']));
        }
        else {
            echo $this->Form->input('unit_id');
        }
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>