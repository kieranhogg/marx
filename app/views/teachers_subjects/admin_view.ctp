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
