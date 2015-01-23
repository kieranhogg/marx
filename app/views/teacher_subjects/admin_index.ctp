<div class="teacherSubjects index">
	<h2><?php __('Teacher Subjects');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('teacher_id');?></th>
			<th><?php echo $this->Paginator->sort('subject_id');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($teacherSubjects as $teacherSubject):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $teacherSubject['TeacherSubject']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($teacherSubject['Teacher']['surname'], array('controller' => 'teachers', 'action' => 'view', $teacherSubject['Teacher']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($teacherSubject['Subject']['name'], array('controller' => 'subjects', 'action' => 'view', $teacherSubject['Subject']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $teacherSubject['TeacherSubject']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $teacherSubject['TeacherSubject']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $teacherSubject['TeacherSubject']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $teacherSubject['TeacherSubject']['id'])); ?>
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