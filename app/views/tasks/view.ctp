<div class="tasks view">
<h2><?php __('Task');?></h2>
    <dl><?php $i = 0; $class = ' class="altrow"';?>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Code'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $task['Task']['code']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $task['Task']['description']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Subject'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $subject['Subject']['name']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Unit'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $this->Html->link($task['Unit']['description'].' - '.$task['Unit']['code'], array('controller' => 'units', 'action' => 'view', $task['Unit']['id'])); ?>
            &nbsp;
        </dd>
    </dl>
</div>
<div class="related">
    <h3><?php __('Related Submissions');?></h3>
    <?php if (!empty($task['Submission'])):?>
    <table cellpadding = "0" cellspacing = "0">
    <tr>
        <th><?php __('User'); ?></th>
        <th><?php __('Filename'); ?></th>
        <th><?php __('Size'); ?></th>
        <th><?php __('Unit'); ?></th>
        <th><?php __('Task'); ?></th>
        <th><?php __('Mark'); ?></th>
        <th><?php __('Status'); ?></th>
        <th><?php __('Uploaded'); ?></th>
        <th class="actions"><?php __('Actions');?></th>
    </tr>
    <?php
        $i = 0;
        foreach ($task['Submission'] as $submission):
            $class = null;
            if ($i++ % 2 == 0) {
                $class = ' class="altrow"';
            }
        ?>
        <tr<?php echo $class;?>>
            <td><?php echo $submission['User']['forename'].' '.$submission['User']['surname'];?></td>
            <td><?php echo $submission['filename'];?></td>
            <td><?php echo $submission['size'];?></td>
            <td><?php echo $submission['Unit']['code'];?></td>
            <td><?php echo $submission['Task']['code'];?></td>
            <td><?php echo $submission['Mark']['status'];?></td>
            <td><?php echo $submission['Status']['status'];?></td>
            <td><?php echo $submission['created'];?></td>
            <td class="actions">
                <?php echo $this->Html->link(__('View', true), array('controller' => 'submissions', 'action' => 'view', $submission['id'])); ?>
                <?php echo $this->Html->link(__('Mark', true), array('controller' => 'submissions', 'action' => 'mark', $submission['id'])); ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </table>
<?php endif; ?>
</div>
