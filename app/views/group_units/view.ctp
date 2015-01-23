<div class="groupUnits view">
<h2><?php  __('Group Unit');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $groupUnit['GroupUnit']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Group'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($groupUnit['Group']['code'], array('controller' => 'groups', 'action' => 'view', $groupUnit['Group']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Unit'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($groupUnit['Unit']['code'], array('controller' => 'units', 'action' => 'view', $groupUnit['Unit']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Group Unit', true), array('action' => 'edit', $groupUnit['GroupUnit']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Group Unit', true), array('action' => 'delete', $groupUnit['GroupUnit']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $groupUnit['GroupUnit']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Group Units', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group Unit', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Groups', true), array('controller' => 'groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group', true), array('controller' => 'groups', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Units', true), array('controller' => 'units', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Unit', true), array('controller' => 'units', 'action' => 'add')); ?> </li>
	</ul>
</div>
