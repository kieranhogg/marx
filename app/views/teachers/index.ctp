<h2><?php __('Teachers');?></h2>

<dl>
    <?php
    $i = 0;
    foreach ($teachers as $teacher):
        $class = null;
        if ($i++ % 2 == 0) {
            $class = ' class="altrow"';
        }
    ?>
        <dt<?php if ($i % 2 == 0) echo $class;?>>
        <?php echo $this->Html->link($teacher['Teacher']['salutation'].' '.$teacher['Teacher']['surname'],
                array('controller' => 'teachers', 'action' => 'view', $teacher['Teacher']['id'])) ?></dt>
    <?php endforeach; ?>
</dl>
