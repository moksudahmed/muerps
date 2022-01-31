<?php
/* @var $this EmployeeController */
/* @var $model Employee */

$this->breadcrumbs=array(
    'Registry'=>array('site/registry'),
	'Employee'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Employee', 'url'=>array('index','id'=>yii::app()->session['adminCode'])),
	array('label'=>'Create Employee', 'url'=>'#','active'=>true),
);
?>

<div class="title">
        
        
        <h3>Create Employee</h3>
        
        <h4><strong>Department: </strong> <span  class="label label-info" > <?php  echo yii::app()->session['adminDepartment']; ?></span></h4>
        
</div>
        
<hr/>
    
<?php 

        
        if ($form=="_form_1")
        {
            echo $this->renderPartial($form, array('employee'=>$employee,'person'=>$person,'acHistory'=>$acHistory,'jobExp'=>$jobExp),false,FALSE); 
        }
        elseif ($form=="_form_2")
        {
            echo $this->renderPartial($form, array('employee'=>$employee,'person'=>$person,'acHistory'=>$acHistory,'jobExp'=>$jobExp)); 
        }
?>
