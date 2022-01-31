<?php
/* @var $this AdministrationController */
/* @var $model Administration */

$this->breadcrumbs=array(
    'Registry'=>array('site/registry'),
	
	'Administrative Departments'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Department', 'url'=>array('index')),
	array('label'=>'Create Department', 'url'=>array('create'),'active'=>true),
);
?>

<div class="title">
    <h4>Create Administration</h4>
    
  
</div>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>