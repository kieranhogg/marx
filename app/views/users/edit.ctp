<div class="users form">
<?php echo $this->Form->create('User');?>
    <fieldset>
        <legend><?php __('Edit User'); ?></legend>
    <?php
        echo $this->Form->input('id');
        echo $this->Form->input('forename');
        echo $this->Form->input('surname');
        echo $this->Form->input('username');
        echo $this->Form->input('email');
        echo $this->Form->input('password');
        echo $this->Form->input('group_id');
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>