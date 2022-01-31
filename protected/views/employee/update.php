<?php
/* @var $this EmployeeController */
/* @var $model Employee */

$this->breadcrumbs=array(
        'Registry'=>array('site/registry'),
    'Employees'=>array('index'),
	
	'Edit',
);

$this->menu=array(
	array('label'=>'List Employee', 'url'=>array('index','id'=>yii::app()->session['adminCode'])),
        array('label'=>'Create Employee', 'url'=>array('create','flag'=>1)),
        array('label'=>'Detailed View', 'url'=>array('view', 'id'=>$employee->employeeID)),
	array('label'=>'Edit Employee', 'url'=>'#','active'=>true),
);
?>

<div class="title">
        
    
        <h3>Edit Employee</h3>
        <h4><strong>Employee Name: </strong> <span  class="label label-success" > <?php echo $person->per_title." ".$person->per_firstName." ".$person->per_lastName; ?></span></h4>
       <h4><strong>Department: </strong> <span  class="label label-info" > <?php  echo yii::app()->session['adminDepartment']; ?></span></h4>
        
       
</div>
    <hr/>
<?php echo $this->renderPartial('_update', array('employee'=>$employee,'person'=>$person)); ?>
