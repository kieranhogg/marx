<?php echo $this->Form->create('Group');?>
	<fieldset>
 		<legend><?php __('Admin Edit Group'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('code');
		echo $this->Form->input('teacher_id');
        echo $this->Form->input('subject_id');
		echo $this->Form->input('description');
	?>
    <legend><?php __('Users'); ?></legend>
    <a href='javascript:;'  onclick='javascript:$("#users_add").toggle();'>Show/Hide Users</a>
    <div id='users_add' class='habtm_form' style='display:none'>
    <?php
        echo $form->input('User',array(
            'label' => __('Users', true),
            'type' => 'select',
            'multiple' => 'checkbox',
            'options' => $users,
            'selected' => $html->value('User.id'),
        )); ?>
    </div>
    <legend><?php __('Units'); ?></legend>
    <a href='javascript:;'  onclick='javascript:$("#units_add").toggle();'>Show/Hide Units</a>
    <div id='units_add' class='habtm_form' style='display:none'>
    <?php
        echo $form->input('Unit',array(
            'label' => __('Units', true),
            'type' => 'select',
            'multiple' => 'checkbox',
            'options' => $units,
            'selected' => $html->value('Unit.id'),
        )); ?>
    </div>
    <legend><?php __('Tasks'); ?></legend>
    <a href='javascript:;'  onclick='javascript:$("#tasks_add").toggle();'>Show/Hide Tasks</a>
    <div id='tasks_add' class='habtm_form' style='display:none'>
    <?php
        echo $form->input('Task',array(
            'label' => __('Tasks', true),
            'type' => 'select',
            'multiple' => 'checkbox',
            'options' => $tasks,
            'selected' => $html->value('Task.id'),
        )); ?>
    </div>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
