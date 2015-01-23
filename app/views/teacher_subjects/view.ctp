<div class="teacherSubjects view">
<h2><?php  __('Teacher Subject');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $teacherSubject['TeacherSubject']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Teacher'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($teacherSubject['Teacher']['surname'], array('controller' => 'teachers', 'action' => 'view', $teacherSubject['Teacher']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Subject'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($teacherSubject['Subject']['name'], array('controller' => 'subjects', 'action' => 'view', $teacherSubject['Subject']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Teacher Subject', true), array('action' => 'edit', $teacherSubject['TeacherSubject']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Teacher Subject', true), array('action' => 'delete', $teacherSubject['TeacherSubject']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $teacherSubject['TeacherSubject']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Teacher Subjects', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Teacher Subject', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Teachers', true), array('controller' => 'teachers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Teacher', true), array('controller' => 'teachers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Subjects', true), array('controller' => 'subjects', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Subject', true), array('controller' => 'subjects', 'action' => 'add')); ?> </li>
	</ul>
</div>
