<h2><?php __('My Groups');?></h2>
    <?php
    //group by subject
    $subject_array = array();
    $i = 0;
    foreach ($groups as $a_group):
        $subject_array[$a_group['Subject']['name']][$i] = 
            array('id' => $a_group['Group']['id'], 
                  'code' => $a_group['Group']['code'],
                  'Teacher' => $a_group['Teacher']
            );
        $i++;
     endforeach; 

    foreach($subject_array as $subject_name => $groups): ?>
        <h3><?php echo $subject_name; ?></h3>
        <?php foreach ($groups as $group): ?>
        <p>
        <?php echo $this->Html->link($group['code'], 
                array('controller' => 'groups', 'action' => 'view', $group['id'])); 
            if ($this->Session->read('Auth.User.role') == 'Student') {
                echo ' '.__('with', true).' '.$group['Teacher']['salutation']. ' '.$group['Teacher']['surname']; 
            } ?>
        </p>
        <?php endforeach; ?>
    <?php endforeach; 


?>

