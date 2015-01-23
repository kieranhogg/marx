<div class="groupsTasks form">
<?php echo $this->Form->create('GroupsTask');?>
    <fieldset>
        <legend><?php __('Customise Task'); ?></legend>
    <?php
        echo $this->Form->hidden('id');
        echo $this->Form->input('enabled', array('type' => 'checkbox'));
        echo $this->Form->input('due_date');
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>