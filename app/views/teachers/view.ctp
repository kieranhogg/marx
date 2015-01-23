<div class="teachers view">
<h2><?php echo $teacher['Teacher']['salutation'].' '.$teacher['Teacher']['surname'] ;?></h2>
<div class="related">
    <h3><?php __('Teaching Groups');?></h3>
    <?php if (!empty($teacher['Group'])):?>
    <table cellpadding = "0" cellspacing = "0">
    <tr>
        <th><?php __('Code'); ?></th>
        <th><?php __('Description'); ?></th>
        <th class="actions"><?php __('Actions');?></th>
    </tr>
    <?php
        $i = 0;
        foreach ($teacher['Group'] as $group):
            $class = null;
            if ($i++ % 2 == 0) {
                $class = ' class="altrow"';
            }
        ?>
        <tr<?php echo $class;?>>
            <td><?php echo $group['code'];?></td>
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

</div>
</div>

