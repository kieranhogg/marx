<div class="groups view">
<h2><?php echo $group['Group']['code'];;?></h2>
    <dl><?php $i = 0; $class = ' class="altrow"';?>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Teacher'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $this->Html->link($group['Teacher']['salutation']. ' '.$group['Teacher']['surname'], array('controller' => 'teachers', 'action' => 'view', $group['Teacher']['id'])); ?>
            &nbsp;
        </dd>
    </dl>
<br />
<div class="related">
    <h3><?php __('Units');?></h3>
    <?php if (!empty($group['Unit'])):?>
    <table cellpadding = "0" cellspacing = "0">
    <tr>
        <th><?php __('Unit Code'); ?></th>
        <th><?php __('Unit Description'); ?></th>
        <th class="actions"><?php __('Actions');?></th>
    </tr>
    <?php
        $i = 0;
        foreach ($group['Unit'] as $unit):
            $class = null;
            if ($i++ % 2 == 0) {
                $class = ' class="altrow"';
            }
        ?>
        <tr<?php echo $class;?>>
            <td><?php echo $unit['code'];?></td>
            <td><?php echo $unit['description'];?></td>
            <td class="actions">
                <?php 
                        echo $this->Html->link(__('View', true), 
                        array('controller' => 'units', 'action' => 'view', $unit['id'],
                            'group' => $group['Group']['id']
                            ));

                        echo $this->Html->link(__('Edit', true), 
                        array('controller' => 'units', 'action' => 'edit', $unit['id'],
                            'group' => $group['Group']['id']
                            ));

                        echo $this->Html->link(__('Delete', true), 
                        array('controller' => 'units', 'action' => 'delete', $unit['id'],
                            'group' => $group['Group']['id']
                            ));

                        echo $this->Html->link(__('Marks', true), 
                        array('controller' => 'units', 'action' => 'marks', $unit['id'],
                            'group' => $group['Group']['id']
                            ));   
                ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </table>
<?php endif; ?>
</div>
<div class="related">
    <h3><?php __('Users');?></h3>
    <?php if (!empty($group['User'])):?>
    <table cellpadding = "0" cellspacing = "0">
    <tr>
        <th><?php __('Forename'); ?></th>
        <th><?php __('Surname'); ?></th>
        <th class="actions"><?php __('Actions');?></th>
    </tr>
    <?php
        $i = 0;
        foreach ($group['User'] as $user):
            $class = null;
            if ($i++ % 2 == 0) {
                $class = ' class="altrow"';
            }
        ?>
        <tr<?php echo $class;?>>
            <td><?php echo $user['forename'];?></td>
            <td><?php echo $user['surname'];?></td>
            <td class="actions">
                <?php echo $this->Html->link(__('View', true), array('controller' => 'users', 'action' => 'view', $user['id'])); ?>
                <?php echo $this->Html->link(__('Edit', true), array('controller' => 'users', 'action' => 'edit', $user['id'])); ?>
                <?php echo $this->Html->link(__('Delete', true), array('controller' => 'users', 'action' => 'delete', $user['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $user['id'])); ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </table>
<?php endif; ?>
</div>
</div>

