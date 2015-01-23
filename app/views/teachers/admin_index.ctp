<div class="teachers index">
	<h2><?php __('Teachers');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('email');?></th>
			<th><?php echo $this->Paginator->sort('username');?></th>
			<th><?php echo $this->Paginator->sort('role');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($teachers as $teacher):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $teacher['Teacher']['full_name']; ?>&nbsp;</td>
		<td><?php echo $teacher['Teacher']['email']; ?>&nbsp;</td>
		<td><?php echo $teacher['Teacher']['username']; ?>&nbsp;</td>
		<td><?php echo $teacher['Teacher']['role']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $teacher['Teacher']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $teacher['Teacher']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $teacher['Teacher']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $teacher['Teacher']['id'])); ?>
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