<div class="units form">
<?php echo $this->Form->create('Unit');?>
    <fieldset>
        <legend><?php __('Admin Edit Unit'); ?></legend>
    <?php
        echo $this->Form->input('id');
        echo $this->Form->input('code');
        echo $this->Form->input('subject_id');
        echo $this->Form->input('description');
        echo $this->Form->input('Group',array(
            'label' => __('Groups', true),
            'type' => 'select',
            'multiple' => 'checkbox',
            'options' => $groups,
            'selected' => $html->value('Group.id'),
        ));
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>