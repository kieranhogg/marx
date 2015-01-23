<?php echo $this->Form->create('Submission', array('type' => 'file'));?>
    <fieldset>
        <legend><?php __('Add Submission'); ?></legend>
    <?php
        echo $form->input('Upload', array('type' => 'file'));
        echo $form->input('Submission.group_id', array('value' => $this->params['named']['group'], 'type' => 'hidden'));
        echo $form->input('Submission.unit_id', array('value' => $this->params['named']['unit'], 'type' => 'hidden'));
        echo $form->input('Submission.task_id', array('value' => $this->params['named']['task'], 'type' => 'hidden') ); 
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
