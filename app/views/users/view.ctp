<h2><?php echo $name; ?></h2>
    <dl><?php $i = 0; $class = ' class="altrow"';?>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Gender'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php ($user['User']['gender'] == 'M') ? __('Male') : __('Female'); ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Year'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $user['User']['year']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Form'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $user['User']['form']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Email'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo (!empty($user['User']['email'])) ? $user['User']['email'] : __('Not set'); ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Username'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo (!empty($user['User']['username'])) ? $user['User']['username'] : __('Not set'); ?>
            &nbsp;
        </dd>
    </dl>
<br />
<div class="related">
    <h3><?php __('Groups');?></h3>
    <?php if (!empty($user['Group'])):?>
    <dl><?php $i = 0; $class = ' class="altrow"';?> 
    <?php
        $i = 0;
        foreach ($user['Group'] as $group): ?>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php echo $this->Html->link($group['code'], array('controller' => 'groups', 'action' => 'view', $group['id'])); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $group['Subject']['name']; ?> - 
            <?php echo  $group['Teacher']['salutation'].' '.$group['Teacher']['surname'];?>
            &nbsp;
        </dd>
    <?php endforeach; ?>
    </table>
    <?php else:
        echo $this->Html->para(null, __('No submissions')); ?>
<?php endif; ?>
</div>
<div class="related">
    <h3><?php __('Submissions');?></h3>
    <?php if (!empty($user['Submission'])):?>
    <table cellpadding = "0" cellspacing = "0">
    <tr>
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
        foreach ($user['Submission'] as $submission):
            $class = null;
            if ($i++ % 2 == 0) {
                $class = ' class="altrow"';
            }
        ?>
        <tr<?php echo $class;?>>
            <td><?php echo $submission['filename'];?></td>
            <td><?php echo $this->Number->toReadableSize($submission['size']);?></td>
            <td><?php echo $submission['Unit']['code'];?></td>
            <td><?php echo $submission['Task']['code'];?></td>
            <td><?php echo $submission['Status']['status'];?></td>
            <td><?php echo $submission['Mark']['status'];?></td>
            <td><?php echo $submission['created'];?></td>
            <td class="actions">
                <?php echo $this->Html->link(__('View', true), array('controller' => 'submissions', 'action' => 'view', $submission['id'])); ?>
                <!--<?php echo $this->Html->link(__('Edit', true), array('controller' => 'submissions', 'action' => 'edit', $submission['id'])); ?>
                <?php echo $this->Html->link(__('Delete', true), array('controller' => 'submissions', 'action' => 'delete', $submission['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $submission['id'])); ?>-->
            </td>
        </tr>
    <?php endforeach; ?>
    </table>
    <?php else:
        echo $this->Html->para(null, __('No submissions')); ?>
<?php endif; ?>
</div>