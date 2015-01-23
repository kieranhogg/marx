<div class="teachersSubjects view">
<h2><?php  __('Teachers Subject');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $teachersSubject['TeachersSubject']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Teacher'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($teachersSubject['Teacher']['full_name'], array('controller' => 'teachers', 'action' => 'view', $teachersSubject['Teacher']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Subject'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($teachersSubject['Subject']['name'], array('controller' => 'subjects', 'action' => 'view', $teachersSubject['Subject']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Teachers Subject', true), array('action' => 'edit', $teachersSubject['TeachersSubject']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Teachers Subject', true), array('action' => 'delete', $teachersSubject['TeachersSubject']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $teachersSubject['TeachersSubject']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Teachers Subjects', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Teachers Subject', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Teachers', true), array('controller' => 'teachers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Teacher', true), array('controller' => 'teachers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Subjects', true), array('controller' => 'subjects', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Subject', true), array('controller' => 'subjects', 'action' => 'add')); ?> </li>
	</ul>
</div>
