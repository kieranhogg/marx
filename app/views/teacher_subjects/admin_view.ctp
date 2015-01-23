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
