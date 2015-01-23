<div class="users form">
<?php echo $this->Form->create('User');?>
    <fieldset>
        <legend><?php __('Admin Edit User'); ?></legend>
    <?php
        echo $this->Form->hidden('id');
        echo $this->Form->input('forename');
        echo $this->Form->input('surname');
        echo $this->Form->input('username');
        echo $this->Form->input('email');
        echo $this->Form->input('password', array('label' => 'New password', 'value' => ''));
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>