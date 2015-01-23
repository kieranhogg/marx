<div class="groupsTasks index">
	<h2><?php __('Groups Tasks');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('group_id');?></th>
			<th><?php echo $this->Paginator->sort('task_id');?></th>
			<th><?php echo $this->Paginator->sort('due_date');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($groupsTasks as $groupsTask):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $groupsTask['GroupsTask']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($groupsTask['Group']['code'], array('controller' => 'groups', 'action' => 'view', $groupsTask['Group']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($groupsTask['Task']['code'], array('controller' => 'tasks', 'action' => 'view', $groupsTask['Task']['id'])); ?>
		</td>
		<td><?php echo $groupsTask['GroupsTask']['due_date']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $groupsTask['GroupsTask']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $groupsTask['GroupsTask']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $groupsTask['GroupsTask']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $groupsTask['GroupsTask']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Groups Task', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Groups', true), array('controller' => 'groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group', true), array('controller' => 'groups', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tasks', true), array('controller' => 'tasks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Task', true), array('controller' => 'tasks', 'action' => 'add')); ?> </li>
	</ul>
</div>