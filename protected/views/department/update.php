<?php
/* @var $this DepartmentController */
/* @var $model Department */

$this->breadcrumbs=array(
    'Registry'=>array('site/registry'),
	
	'Departments'=>array('index'),
	'Edit',
);

$this->menu=array(
	array('label'=>'List Department', 'url'=>array('index')),
        array('label'=>'Create Department', 'url'=>array('create')),
        array('label'=>'Detailed View', 'url'=>array('view', 'id'=>$model->departmentID)),
	array('label'=>'Edit Department', 'url'=>'#','active'=>true),
    
	
	
);
?>

<div class="title">
    <h3>Edit Department</h3>
    <h4><strong>School:</strong> <span  class="label label-info" > <?php  echo yii::app()->session['school']; ?></span></h4>
        
</div>
<hr/>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>