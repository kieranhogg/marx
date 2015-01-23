<div class="users view">
<h2><?php  __('User');?></h2>
    <dl><?php $i = 0; $class = ' class="altrow"';?>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Forename'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $user['User']['forename']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Surname'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $user['User']['surname']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Username'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $user['User']['username']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Email'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $user['User']['email']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $user['User']['created']; ?>
            &nbsp;
        </dd>
    </dl>
</div>
<div class="related">
    <h3><?php __('User Submissions');?></h3>
    <?php if (!empty($user['Submission'])):?>
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
        foreach ($user['Submission'] as $submission):
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
                <?php echo $this->Html->link(__('Mark/View', true), array('controller' => 'submissions', 'action' => 'mark', $submission['id'], 'admin' => false)); ?>
                <?php echo $this->Html->link(__('Edit', true), array('controller' => 'submissions', 'action' => 'edit', $submission['id'])); ?>
                <?php echo $this->Html->link(__('Delete', true), array('controller' => 'submissions', 'action' => 'delete', $submission['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $submission['id'])); ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </table>
<?php endif; ?>
</div>
