<div class="teachers form">
<?php echo $this->Form->create('Teacher');?>
    <fieldset>
        <legend><?php __('Admin Edit Teacher'); ?></legend>
    <?php
        echo $this->Form->input('id');
        echo $this->Form->input('salutation');
        echo $this->Form->input('surname');
        echo $this->Form->input('email');
        echo $this->Form->input('username');
        echo $this->Form->input('role');
        echo $this->Form->input('Subject',array(
            'label' => __('Subjects', true),
            'type' => 'select',
            'multiple' => 'checkbox',
            'options' => $subjects,
            'selected' => $html->value('Subject.id'),
        ));
        echo $this->Form->input('Group',array(
            'label' => __('Groups', true),
            'type' => 'select',
            'multiple' => 'checkbox',
            'options' => $groups,
            'selected' => $html->value('Group.id'),
        ));
    ?>
    <h3><?php __('Settings'); ?></h3>
    <?php
        echo $this->Form->input('email_notification');
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
