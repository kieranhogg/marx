<div class="submissions form">
<?php echo $this->Form->create('Submission');?>
    <fieldset>
        <legend><?php __('Admin Edit Submission'); ?></legend>
    <?php
        echo $this->Form->input('user_id');
        echo $this->Form->input('filename');
        echo $this->Form->input('unit_id');
        echo $this->Form->input('task_id');
        echo $this->Form->input('marked');
        echo $this->Form->input('teacher_id');
        echo $this->Form->input('comment');
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>