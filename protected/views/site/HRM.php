<?php
/* @var $this RegistryController */

$this->breadcrumbs=array(
        'Registry'=>array('site/registry'),
	'Administration'=>array('site/administration'),
	'HRM',
);
?>
<!--h1><?php echo $this->id . '/' . $this->action->id; ?></h1-->


<h1>
    Welcome to the Human Resource Management.
    
</h1>
<ol class="list-view">
    <li>
        For accessing the <strong>Faculty</strong> information please <?php echo CHtml::link('Click Here', array('Department/list')); ?>.
    </li>
    <li>
        For accessing the <strong>Employee</strong> information please <?php echo CHtml::link('Click Here', array('Administration/list')); ?>.
    </li>
    
    
</ol>
<p>
	
</p>
