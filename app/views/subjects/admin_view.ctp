<div class="subjects view">
<h2><?php echo $subject['Subject']['name']?></h2>
</div>
<div class="related">
    <h3><?php __('Subject Groups');?></h3>
    <?php if (!empty($subject['Group'])):?>
    <table cellpadding = "0" cellspacing = "0">
    <tr>
        <th><?php __('Code'); ?></th>
        <th><?php __('Teacher'); ?></th>
        <th><?php __('Description'); ?></th>
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
    <h3><?php __('Subject Units');?></h3>
    <?php if (!empty($subject['Unit'])):?>
    <table cellpadding = "0" cellspacing = "0">
    <tr>
        <th><?php __('Code'); ?></th>
        <th><?php __('Subject'); ?></th>
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
            <td><?php echo $unit['Subject']['name'];?></td>
            <td><?php echo $unit['description'];?></td>
            <td class="actions">
                <?php echo $this->Html->link(__('View', true), array('controller' => 'units', 'action' => 'view', $unit['id'])); ?>
                <?php echo $this->Html->link(__('Edit', true), array('controller' => 'units', 'action' => 'edit', $unit['id'])); ?>
                <?php echo $this->Html->link(__('Delete', true), array('controller' => 'units', 'action' => 'delete', $unit['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $unit['id'])); ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </table>
<?php endif; ?>

    <div class="actions">
        <ul>
            <li><?php echo $this->Html->link(__('New Unit', true), array('controller' => 'units', 'action' => 'add'));?> </li>
        </ul>
    </div>
</div>
<div class="related">
    <h3><?php __('Subject Teachers');?></h3>
    <?php if (!empty($subject['Teacher'])):?>
    <table cellpadding = "0" cellspacing = "0">
    <tr>
        <th><?php __('Name'); ?></th>
        <th><?php __('Email'); ?></th>
        <th><?php __('Username'); ?></th>
        <th><?php __('Role'); ?></th>
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
            <td><?php echo $teacher['salutation'].' '.$teacher['surname'];?></td>
            <td><?php echo $teacher['email'];?></td>
            <td><?php echo $teacher['username'];?></td>
            <td><?php echo $teacher['role'];?></td>
            <td class="actions">
                <?php echo $this->Html->link(__('View', true), array('controller' => 'teachers', 'action' => 'view', $teacher['id'])); ?>
                <?php echo $this->Html->link(__('Edit', true), array('controller' => 'teachers', 'action' => 'edit', $teacher['id'])); ?>
                <?php echo $this->Html->link(__('Delete', true), array('controller' => 'teachers', 'action' => 'delete', $teacher['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $teacher['id'])); ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </table>
   <div class="actions">
        <ul>
            <li><?php echo $this->Html->link(__('New Teacher', true), array('controller' => 'teachers', 'action' => 'add'));?> </li>
        </ul>
    </div>
<?php endif; ?>
</div>
