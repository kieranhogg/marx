<h2><?php /* pr($submissions)*/; echo __('Dashboard'); ?></h2>
<div class="related">

<div class="related">
    <h3><?php __('Recent Submissions');?></h3>
    <?php if (!empty($submissions)):?>
    <table cellpadding = "0" cellspacing = "0">
    <tr>
        <th><?php __('User'); ?></th>
        <th><?php __('Group'); ?></th>
        <th><?php __('Filename'); ?></th>
        <th><?php __('Unit'); ?></th>
        <th><?php __('Task'); ?></th>
        <th><?php __('Status'); ?></th>
        <th><?php __('Mark'); ?></th>
        <th><?php __('Uploaded'); ?></th>

        <th class="actions"><?php __('Actions');?></th>
    </tr>
    <?php
        $i = 0;
        foreach ($submissions as $submission):
            $class = null;
            if ($i++ % 2 == 0) {
                $class = ' class="altrow"';
            }
            ?>
            <tr<?php echo $class;?>>
                <td><?php echo $submission['users']['forename'].' '.$submission['users']['surname'];?></td>
                <td><?php echo $this->Html->link($submission['groups']['code'], 
                    array('controller' => 'groups', 'action' => 'view', $submission['groups']['id']));?></td>
                <td><?php echo $submission['submissions']['filename'];?></td>
                <td><?php echo $submission['units']['code'];?></td>
                <td><?php echo $submission['tasks']['code'];?></td>
                <td><?php echo $submission['statuses']['status'];?></td>
                <td><?php echo $submission['marks']['status'];?></td>
                <td><?php echo $submission['submissions']['created'];?></td>

                <td class="actions">
                    <?php echo $this->Html->link(__('Mark', true), 
                        array('controller' => 'submissions', 'action' => 'mark', $submission['submissions']['id'])); ?>
                    <?php echo $this->Html->link(__('Delete', true), 
                                                 array('controller' => 'submissions', 
                                                       'action' => 'delete', 
                                                       $submission['submissions']['id']
                                                 ),
                                                 null, 
                                                 sprintf(__('Are you sure you want to delete # %s?', true), 
                                                         $submission['submissions']['id']
                                                 )
                                ); 
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else: __('No submissions yet, work them harder!'); ?>
<?php endif; ?>

