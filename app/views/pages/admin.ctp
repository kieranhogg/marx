<h2><?php echo __('Admin Tools');?></h2>
<div class="actions">
    <h3><?php __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('Groups', true), array('controller' => 'groups', 'action' => 'index', 'admin' => TRUE)); ?> </li>
        <li><?php echo $this->Html->link(__('Marks', true), array('controller' => 'marks', 'action' => 'index', 'admin' => TRUE)); ?> </li>
        <li><?php echo $this->Html->link(__('Statuses', true), array('controller' => 'statuses', 'action' => 'index', 'admin' => TRUE)); ?> </li>
        <li><?php echo $this->Html->link(__('Subjects', true), array('controller' => 'subjects', 'action' => 'index', 'admin' => TRUE)); ?> </li>
        <li><?php echo $this->Html->link(__('Submissions', true), array('controller' => 'submissions', 'action' => 'index', 'admin' => TRUE)); ?> </li>
        <li><?php echo $this->Html->link(__('Tasks', true), array('controller' => 'tasks', 'action' => 'index', 'admin' => TRUE)); ?> </li>
        <li><?php echo $this->Html->link(__('Teachers', true), array('controller' => 'teachers', 'action' => 'index', 'admin' => TRUE)); ?> </li>
        <li><?php echo $this->Html->link(__('Units', true), array('controller' => 'units', 'action' => 'index', 'admin' => TRUE)); ?> </li>
        <li><?php echo $this->Html->link(__('Users', true), array('controller' => 'users', 'action' => 'index', 'admin' => TRUE)); ?> </li>
    </ul>
</div>

