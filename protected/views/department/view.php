<?php
/* @var $this DepartmentController */
/* @var $model Department */

$this->breadcrumbs=array(
    'Registry'=>array('site/registry'),
        
	'Departments'=>array('index'),
	'Detailed View',
);

$this->menu=array(
	array('label'=>'List Department', 'url'=>array('index')),
	array('label'=>'Create Department', 'url'=>array('create')),
        array('label'=>'Detailed View', 'url'=>array('view', 'id'=>$model->departmentID),'active'=>true),
	array('label'=>'Edit Department', 'url'=>array('update', 'id'=>$model->departmentID)),
	array('label'=>'Delete Department', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->departmentID),'confirm'=>'Are you sure you want to delete this item?')),
	
);
?>

<div class="title">
    <h3>Detailed View</h3>
   <h4><strong>School:</strong> <span  class="label label-info" > <?php  echo yii::app()->session['school']; ?></span></h4>
    
</div>
<hr/>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
	'attributes'=>array(
                'departmentID',
		'dpt_code',
		'dpt_name',
		'dpt_location',
		'dpt_contactNo',
		'dpt_email',
		'dpt_remarks',
		
	),
)); ?>
