<div class="groupsTasks form">
<?php echo $this->Form->create('GroupsTask');?>
    <fieldset>
        <legend><?php __('Admin Add Groups Task'); ?></legend>
    <?php
        if (empty($this->params['named']['group'])) {
            echo $this->Form->input('group_id');
        }
        else {
            echo $this->Form->hidden('group_id', array('value' => $this->params['named']['group']));
        }

        if (empty($this->params['named']['task'])) {
            echo $this->Form->input('task_id');
        }
        else {
            echo $this->Form->hidden('task_id', array('value' => $this->params['named']['task']));
        }
        echo $this->Form->input('due_date');
        echo $this->Form->input('enabled', array('checked' => 'checked'));

    ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>