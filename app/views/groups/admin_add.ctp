<div class="groups form">
<?php echo $this->Form->create('Group');?>
    <fieldset>
        <legend><?php __('Admin Add Group'); ?></legend>
    <?php
        echo $this->Form->input('code');
        echo $this->Form->input('teacher_id');
        echo $this->Form->input('subject_id');
        echo $this->Form->input('description');
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>