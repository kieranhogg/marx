<div class="units view">
<h2><?php echo $unit['Subject']['name'].' '.$unit['Unit']['description'].' - '.$unit['Unit']['code'];?></h2>
<div class="related">
    <h3><?php __('Tasks');?></h3>
    <?php if (!empty($unit['Task'])):?>
    <table cellpadding = "0" cellspacing = "0">
    <tr>
        <th><?php __('Code'); ?></th>
        <th><?php __('Description'); ?></th>
        <?php if (isset($this->params['named']['group'])): ?>
        <th><?php __('Enabled'); ?></th>
        <th><?php __('Deadline'); ?></th>
        <?php endif; ?>
        <th class="actions"><?php __('Actions');?></th>
    </tr>
    <?php
        $i = 0;
        foreach ($unit['Task'] as $task):
            if (!empty($this->params['named']['group'])) {
                $i = 0;
                // FIXME this will be a resource whore
                foreach ($task['GroupsTask'] as $groups_task) {
                    if ($groups_task['group_id'] == $this->params['named']['group'] AND $groups_task['task_id'] == $this->params['named']['group']) {
                        $task['GroupsTask'] = $groups_task;
                        pr($groups_task);
                    }
                    $i++;
                }
            }
            $class = null;
            if ($i++ % 2 == 0) {
                $class = ' class="altrow"';
            }
        ?>
        <tr<?php echo $class;?>>
            <td><?php echo $task['code'];?></td>
            <td><?php echo $task['description'];?></td>
            <?php if (!empty($this->params['named']['group']) AND !empty($task['GroupsTask'])): ?>
            <td><?php echo ($task['GroupsTask']['enabled']) ? __('Yes') : __('No'); ?></td>
            <td><?php echo $task['GroupsTask']['due_date'];?></td>
            <?php elseif (isset($this->params['named']['group'])): ?>
            <td><?php __('Yes'); ?></td>
            <td>&nbsp;</td>
            <?php endif; ?>
            <td class="actions">
                <?php
                //do some bodgery depending on if this is a general unit or a groups's unit
                if (!empty($this->params['named']['group']) AND $this->Session->read('Auth.User.role') != 'Student'):
                    if (!empty($task['GroupsTask'])) {
                        $id = $task['GroupsTask']['id'];
                        $customise_action = array('controller' => 'groups_tasks', 'action' => 'edit', $id);
                        $delete_action = array('controller' => 'groups_tasks', 'action' => 'delete', $id);
                        echo $this->Html->link(__('Customise', true), $customise_action);
                        echo $this->Html->link(__('Remove Customisation', true), $delete_action, null,__('Are you sure you want to delete?', true), $id);
                    }
                    else {
                        $id = $task['id'];
                        $customise_action = array('controller' => 'groups_tasks', 'action' => 'add', 'group' => $this->params['named']['group'], 'task' => $id);
                        echo $this->Html->link(__('Customise', true), $customise_action);
                    }

                else: ?>
                    <?php if ($this->Session->read('Auth.User.role') == 'Student'): ?>
                        <?php if (!(!empty($task['GroupsTask']) AND $task['GroupsTask']['enabled'] == 0)): ?>
                        <?php echo $this->Html->link(__('Submit work', true), 
                        array('controller' => 'submissions', 'action' => 'add', 
                            'group' => $this->params['named']['group'],
                            'unit' => $unit['Unit']['id'], 'task' => $task['id'])
                            ); ?>
                        <?php endif; ?>
                    <?php else: ?>
                        <?php if (isset($this->params['named']['group'])): ?>
                        <?php $conditions = array('controller' => 'tasks', 'action' => 'view', 
                                                'group' => $this->params['named']['group'],
                                                $task['id']); ?>
                        <?php else: ?>
                        <?php $conditions = array('controller' => 'tasks', 'action' => 'view', 
                                                $task['id']); ?>
                        <?php endif; ?>
                        <?php echo $this->Html->link(__('View', true), $conditions
                            ); ?>
                <?php endif; ?>
                <?php endif; ?>

            </td>
        </tr>
    <?php endforeach; ?>
    </table>
<?php endif; ?>
</div>
</div>
<!--<div class="related">
	<h3><?php __('Related Submissions');?></h3>
	<?php if (!empty($unit['Submission'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Student Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Path'); ?></th>
		<th><?php __('Type'); ?></th>
		<th><?php __('Size'); ?></th>
		<th><?php __('Unit Id'); ?></th>
		<th><?php __('Task Id'); ?></th>
		<th><?php __('Marked'); ?></th>
		<th><?php __('Teacher Id'); ?></th>
		<th><?php __('Comment'); ?></th>
		<th><?php __('Response'); ?></th>
		<th><?php __('Response To'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($unit['Submission'] as $submission):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $submission['id'];?></td>
			<td><?php echo $submission['user_id'];?></td>
			<td><?php echo $submission['name'];?></td>
			<td><?php echo $submission['path'];?></td>
			<td><?php echo $submission['type'];?></td>
			<td><?php echo $submission['size'];?></td>
			<td><?php echo $submission['unit_id'];?></td>
			<td><?php echo $submission['task_id'];?></td>
			<td><?php echo $submission['marked'];?></td>
			<td><?php echo $submission['teacher_id'];?></td>
			<td><?php echo $submission['comment'];?></td>
			<td><?php echo $submission['response'];?></td>
			<td><?php echo $submission['response_to'];?></td>
			<td><?php echo $submission['created'];?></td>
			<td><?php echo $submission['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'submissions', 'action' => 'view', $submission['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'submissions', 'action' => 'edit', $submission['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'submissions', 'action' => 'delete', $submission['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $submission['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Submission', true), array('controller' => 'submissions', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>-->
<!--<div class="related">
	<h3><?php __('Related Groups');?></h3>
	<?php if (!empty($unit['Group'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Code'); ?></th>
		<th><?php __('Teacher Id'); ?></th>
		<th><?php __('Subject Id'); ?></th>
		<th><?php __('Description'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($unit['Group'] as $group):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $group['id'];?></td>
			<td><?php echo $group['code'];?></td>
			<td><?php echo $group['teacher_id'];?></td>
			<td><?php echo $group['subject_id'];?></td>
			<td><?php echo $group['description'];?></td>
			<td><?php echo $group['created'];?></td>
			<td><?php echo $group['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'groups', 'action' => 'view', $group['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'groups', 'action' => 'edit', $group['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'groups', 'action' => 'delete', $group['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $group['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Group', true), array('controller' => 'groups', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>-->
