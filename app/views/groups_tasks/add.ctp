<div class="groupsTasks form">
<?php echo $this->Form->create('GroupsTask');?>
    <fieldset>
        <legend><?php __('Customise Task'); ?></legend>
    <?php
        echo $this->Form->hidden('group_id', array('value' => $this->params['named']['group']));
        echo $this->Form->hidden('task_id', array('value' => $this->params['named']['task']));
        echo $this->Form->input('enabled');
        echo $this->Form->input('due_date');
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>