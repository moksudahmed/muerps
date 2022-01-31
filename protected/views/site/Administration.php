<?php
/* @var $this RegistryController */

$this->breadcrumbs=array(
    'Registry'=>array('site/registry'),
	'Administration',
);
?>
<!--h1><?php echo $this->id . '/' . $this->action->id; ?></h1-->


<h1>
    Welcome to the Administrative Information Page.
    
</h1>
<ol class="list-view">
    <li>
        For accessing the <strong>Human Resource Management</strong> information please <?php echo CHtml::link('Click Here', array('site/HRM')); ?>.
    </li>
    
    <li>
        To viewing the <strong>Administrative Department's</strong> please <?php echo CHtml::link('Click Here', array('Administration/index')); ?>.
    </li>
    
</ol>
<p>
	
</p>
