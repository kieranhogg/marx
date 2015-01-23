<div class="groupUnits form">
<?php echo $this->Form->create('GroupUnit');?>
	<fieldset>
 		<legend><?php __('Admin Edit Group Unit'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('group_id');
		echo $this->Form->input('unit_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>