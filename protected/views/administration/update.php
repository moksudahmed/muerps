<?php
/* @var $this AdministrationController */
/* @var $model Administration */

$this->breadcrumbs=array(
'Registry'=>array('site/registry'),
	
	'Administrative Departments'=>array('index'),
    
	'Edit',
);

$this->menu=array(
	array('label'=>'List Administration', 'url'=>array('index')),
	array('label'=>'Create Administration', 'url'=>array('create')),
	array('label'=>'Detailed View', 'url'=>array('view', 'id'=>$model->administrationCode)),
        array('label'=>'Edit Administration', 'url'=>'#','active'=>true),
	
);
?>


<div class="title">
    <h4>Edit Administration:</h4>
    <h4><strong>Department:</strong> <span  class="label label-info" > <?php  echo $model->adm_name ; ?></span></h4>
  
</div>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>