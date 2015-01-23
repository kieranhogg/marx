<div class="subjects form">
<?php echo $this->Form->create('Subject');?>
    <fieldset>
        <legend><?php __('Edit Subject'); ?></legend>
    <?php
        echo $this->Form->input('id');
        echo $this->Form->input('name');
        echo $this->Form->input('Teacher');
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
