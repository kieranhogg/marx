<?php echo $this->Form->create('Group');?>
    <fieldset>
        <legend><?php __('Edit Group'); ?></legend>
    <?php
        echo $this->Form->input('id');
        echo $this->Form->input('code');
        echo $this->Form->input('teacher_id');
        echo $this->Form->input('description');
    ?>
<?php echo $this->Form->end(__('Submit', true));?>