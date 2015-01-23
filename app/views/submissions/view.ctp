<div class="submissions view">
<h2><?php  __('Submission');?></h2>
    <dl><?php $i = 0; $class = ' class="altrow"';?>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Filename'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $this->Html->link($submission['Submission']['filename'], array('action' => 'download', $submission['Submission']['id'])); ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Unit'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $submission['Unit']['code']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Task'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $submission['Task']['code']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Status'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $submission['Status']['status']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Mark'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <span class='<?php echo ($submission['Mark']['pass']) ? 'pass' : 'fail';?>'>
            <?php echo $submission['Mark']['status']; ?>
            &nbsp;
            </span>
        </dd>
        <?php if ($submission['Submission']['teacher_id'] != 0): ?>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Marked by'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $submission['Teacher']['salutation'].' '.$submission['Teacher']['surname']; ?>
            &nbsp;
        </dd>
        <?php endif; ?>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Comment'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $submission['Submission']['comment']; ?>
            &nbsp;
        </dd>
        <?php if ($submission['Submission']['response_filename'] != null): ?>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Reponse file'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $this->Html->link($submission['Submission']['response_filename'], array('action' => 'download_response', $submission['Submission']['id'])); ?>
            &nbsp;
        </dd>
        <?php endif; ?>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $submission['Submission']['created']; ?>
            &nbsp;
        </dd>
    </dl>
</div>
