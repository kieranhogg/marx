<div class="units view">
<?php pr($unit[0]); ?>
<h2><?php echo $unit['Unit']['code']; 
    if (!empty($group['Group'])) {
        echo ' '.__('for', true).' '.$group['Group']['code'];
    }
?></h2>
    <dl><?php $i = 0; $class = ' class="altrow"';?>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Subject'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $this->Html->link($unit['Subject']['name'], array('controller' => 'subjects', 'action' => 'view', $unit['Subject']['id'])); ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $unit['Unit']['description']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $unit['Unit']['created']; ?>
            &nbsp;
        </dd>
    </dl>
</div>

<div class="related">
    <h3><?php __('Unit Tasks');?></h3>
    <?php if (!empty($unit['Task'])):?>
    <table cellpadding = "0" cellspacing = "0">
    <tr>
        <th><?php __('Code'); ?></th>
        <th><?php __('Description'); ?></th>
        <?php if (!empty($this->params['named']['group'])): ?>
        <th><?php __('Due Date'); ?></th>
<!--         <th><?php __('Enabled'); ?></th> -->
        <?php endif; ?>
        <th class="actions"><?php __('Actions');?></th>
    </tr>
    <?php
        $i = 0;
        foreach ($unit['Task'] as $task):
            $class = null;
            if ($i++ % 2 == 0) {
                $class = ' class="altrow"';
            }
        ?>
        <tr<?php echo $class;?>>
            <td><?php echo $task['code'];?></td>
            <td><?php echo $task['description'];?></td>
            <?php if (!empty($this->params['named']['group']) AND !empty($task['GroupsTask'])): ?>
            <td><?php echo $task['GroupsTask']['due_date'];?></td>
<!--             <td><?php echo ($task['GroupsTask']['enabled']) ? __('Yes') : __('No'); ?></td> -->
            <?php elseif (isset($this->params['named']['group'])): ?>
           <td>&nbsp;</td>
            <?php endif; ?>
            <td class="actions">
                <?php
                //do some bodgery depending on if this is a general unit or a groups's unit
                if (!empty($this->params['named']['group'])):
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

                else:
                ?>
                <?php echo $this->Html->link(__('View', true), array('controller' => 'tasks', 'action' => 'view', $task['id'])); ?>
                <?php echo $this->Html->link(__('Edit', true), array('controller' => 'tasks', 'action' => 'edit', $task['id'])); ?>
                <?php echo $this->Html->link(__('Delete', true), array('controller' => 'tasks', 'action' => 'delete', $task['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $task['id'])); ?>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </table>
<?php endif; ?>

    <div class="actions">
        <ul>
            <li><?php echo $this->Html->link(__('New Task', true), array('controller' => 'tasks', 'action' => 'add', 'unit' => $unit['Unit']['id']));?> </li>
        </ul>
    </div>
</div>
<div class="related">
    <h3><?php __('Related Groups');?></h3>
    <?php if (!empty($unit['Group'])):?>
    <table cellpadding = "0" cellspacing = "0">
    <tr>
        <th><?php __('Code'); ?></th>
        <th><?php __('Teacher Id'); ?></th>
        <th><?php __('Subject Id'); ?></th>
        <th><?php __('Description'); ?></th>
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
            <td><?php echo $group['code'];?></td>
            <td><?php echo $group['teacher_id'];?></td>
            <td><?php echo $group['subject_id'];?></td>
            <td><?php echo $group['description'];?></td>
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
</div>
<div class="related">
    <h3><?php __('Related Submissions');?></h3>
    <?php if (!empty($unit['Submission'])):?>
    <table cellpadding = "0" cellspacing = "0">
    <tr>
        <th><?php __('Filename'); ?></th>
        <th><?php __('Type'); ?></th>
        <th><?php __('Size'); ?></th>
        <th><?php __('Unit Id'); ?></th>
        <th><?php __('Task Id'); ?></th>
        <th><?php __('Status'); ?></th>
        <th><?php __('Mark'); ?></th>
        <th><?php __('Teacher'); ?></th>
        <th><?php __('Created'); ?></th>
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
            <td><?php echo $submission['filename'];?></td>
            <td><?php echo $submission['type'];?></td>
            <td><?php echo $submission['size'];?></td>
            <td><?php echo $submission['Unit']['code'];?></td>
            <td><?php echo $submission['Task']['code'];?></td>
            <td><?php echo $submission['Status']['status'];?></td>
            <td><?php echo $submission['Mark']['status'];?></td>
            <td><?php echo $submission['Teacher']['salutation'].' '.$submission['Teacher']['surname'];?></td>
            <td><?php echo $submission['created'];?></td>
            <td class="actions">
                <?php echo $this->Html->link(__('View', true), array('controller' => 'submissions', 'action' => 'view', $submission['id'])); ?>
                <?php echo $this->Html->link(__('Edit', true), array('controller' => 'submissions', 'action' => 'edit', $submission['id'])); ?>
                <?php echo $this->Html->link(__('Delete', true), array('controller' => 'submissions', 'action' => 'delete', $submission['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $submission['id'])); ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </table>
    <?php else: __('No Submissions'); ?>
<?php endif; ?>
</div>
