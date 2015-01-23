<div class="groupUnits index">
	<h2><?php __('Group Units');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('group_id');?></th>
			<th><?php echo $this->Paginator->sort('unit_id');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($groupUnits as $groupUnit):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $groupUnit['GroupUnit']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($groupUnit['Group']['code'], array('controller' => 'groups', 'action' => 'view', $groupUnit['Group']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($groupUnit['Unit']['code'], array('controller' => 'units', 'action' => 'view', $groupUnit['Unit']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $groupUnit['GroupUnit']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $groupUnit['GroupUnit']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $groupUnit['GroupUnit']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $groupUnit['GroupUnit']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Group Unit', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Groups', true), array('controller' => 'groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group', true), array('controller' => 'groups', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Units', true), array('controller' => 'units', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Unit', true), array('controller' => 'units', 'action' => 'add')); ?> </li>
	</ul>
</div>