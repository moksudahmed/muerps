<?php
/* @var $this AdministrationController */
/* @var $model Administration */

$this->breadcrumbs=array(
	'Registry'=>array('site/registry'),
	
	'Administrative Departments'=>array('index'),
	'Detailed View',
);

$this->menu=array(
	array('label'=>'List Department', 'url'=>array('index')),
	array('label'=>'Create Administration', 'url'=>array('create')),
        array('label'=>'Detailed View', 'url'=>'#',active=>true),
	array('label'=>'Edit Department', 'url'=>array('update', 'id'=>$model->administrationCode)),
	array('label'=>'Delete Department', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->administrationCode),'confirm'=>'Are you sure you want to delete this item?')),
	
);
?>

<div class="title">
    <h4>Detailed View:</h4>
    <h4><strong>Department:</strong> <span  class="label label-info" > <?php  echo $model->adm_name ; ?></span></h4>
  
</div>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'administrationCode',
		'adm_name',
		'adm_location',
		
		'adm_contactNo',
		'adm_email',
            'adm_remarks',
	),
)); ?>
