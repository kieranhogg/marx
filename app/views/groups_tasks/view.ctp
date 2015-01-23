<div class="groupsTasks view">
<h2><?php  __('Groups Task');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $groupsTask['GroupsTask']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Group'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($groupsTask['Group']['code'], array('controller' => 'groups', 'action' => 'view', $groupsTask['Group']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Task'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($groupsTask['Task']['code'], array('controller' => 'tasks', 'action' => 'view', $groupsTask['Task']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Due Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $groupsTask['GroupsTask']['due_date']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Groups Task', true), array('action' => 'edit', $groupsTask['GroupsTask']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Groups Task', true), array('action' => 'delete', $groupsTask['GroupsTask']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $groupsTask['GroupsTask']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Groups Tasks', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Groups Task', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Groups', true), array('controller' => 'groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group', true), array('controller' => 'groups', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tasks', true), array('controller' => 'tasks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Task', true), array('controller' => 'tasks', 'action' => 'add')); ?> </li>
	</ul>
</div>
