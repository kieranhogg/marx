<div class="subjects view">
<h2><?php echo $subject['Subject']['name'];?></h2>
<div class="related">
    <h3><?php __('Related Groups');?></h3>
    <?php if (!empty($subject['Group'])):?>
    <table cellpadding = "0" cellspacing = "0">
    <tr>
        <th><?php __('Group'); ?></th>
        <th><?php __('Teacher'); ?></th>
        <th class="actions"><?php __('Actions');?></th>
    </tr>
    <?php
        $i = 0;
        foreach ($subject['Group'] as $group):
            $class = null;
            if ($i++ % 2 == 0) {
                $class = ' class="altrow"';
            }
        ?>
        <tr<?php echo $class;?>>
            <td><?php echo $group['code'];?></td>
            <td><?php echo $group['Teacher']['salutation'].' '.$group['Teacher']['surname'];?></td>
            <td class="actions">
                <?php echo $this->Html->link(__('View', true), array('controller' => 'groups', 'action' => 'view', $group['id'])); ?> 
            </td>
        </tr>
    <?php endforeach; ?>
    </table>
<?php endif; ?>
</div>
<div class="related">
    <h3><?php __('Units');?></h3>
    <?php if (!empty($subject['Unit'])):?>
    <table cellpadding = "0" cellspacing = "0">
    <tr>
        <th><?php __('Code'); ?></th>
        <th><?php __('Description'); ?></th>
        <th class="actions"><?php __('Actions');?></th>
    </tr>
    <?php
        $i = 0;
        foreach ($subject['Unit'] as $unit):
            $class = null;
            if ($i++ % 2 == 0) {
                $class = ' class="altrow"';
            }
        ?>
        <tr<?php echo $class;?>>
            <td><?php echo $unit['code'];?></td>
            <td><?php echo $unit['description'];?></td>
            <td class="actions">
                <?php echo $this->Html->link(__('View', true), array('controller' => 'units', 'action' => 'view', $unit['id'])); ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </table>
<?php endif; ?>
</div>
<!--<div class="related">
    <h3><?php __('Teachers');?></h3>
    <?php if (!empty($subject['Teacher'])):?>
    <table cellpadding = "0" cellspacing = "0">
    <tr>
        <th><?php __('Name'); ?></th>
        <th class="actions"><?php __('Actions');?></th>
    </tr>
    <?php
        $i = 0;
        foreach ($subject['Teacher'] as $teacher):
            $class = null;
            if ($i++ % 2 == 0) {
                $class = ' class="altrow"';
            }
        ?>
        <tr<?php echo $class;?>>
            <td><?php echo $teacher['name'];?></td>

            <td class="actions">
                <?php echo $this->Html->link(__('View', true), array('controller' => 'teachers', 'action' => 'view', $teacher['id'])); ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </table>
<?php endif; ?>
</div>-->

</div>
