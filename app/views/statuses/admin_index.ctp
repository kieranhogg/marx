<div class="statuses index">
    <h2><?php __('Statuses');?></h2>
    <table cellpadding="0" cellspacing="0">
    <tr>
            <th><?php echo $this->Paginator->sort('status');?></th>
            <th><?php echo $this->Paginator->sort('description');?></th>
            <th><?php echo $this->Paginator->sort('pass');?></th>
            <th class="actions"><?php __('Actions');?></th>
    </tr>
    <?php
    $i = 0;
    foreach ($statuses as $status):
        $class = null;
        if ($i++ % 2 == 0) {
            $class = ' class="altrow"';
        }
    ?>
    <tr<?php echo $class;?>>
        <td><?php echo $status['Status']['status']; ?>&nbsp;</td>
        <td><?php echo $status['Status']['description']; ?>&nbsp;</td>
        <td><?php echo ($status['Status']['pass']) ? __('Yes') : __('No'); ?>&nbsp;</td>
        <td class="actions">
            <?php echo $this->Html->link(__('View', true), array('action' => 'view', $status['Status']['id'])); ?>
            <?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $status['Status']['id'])); ?>
            <?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $status['Status']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $status['Status']['id'])); ?>
        </td>
    </tr>
<?php endforeach; ?>
    </table>
    <p>
    <?php
    echo $this->Paginator->counter(array(
    'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
    ));
    ?>	</p>

    <div class="paging">
        <?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
    | 	<?php echo $this->Paginator->numbers();?>
|
        <?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
    </div>
</div>