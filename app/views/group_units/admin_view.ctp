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