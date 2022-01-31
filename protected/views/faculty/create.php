<?php
/* @var $this EmployeeController */
/* @var $model Employee */

$this->breadcrumbs=array(
    'Registry'=>array('site/registry'),
	
	'Faculty'=>array('index','id'=>yii::app()->session['dptID']),
	'Create',
);

$this->menu=array(
	array('label'=>'List Faculty', 'url'=>array('index','id'=>yii::app()->session['dptID'])),
	array('label'=>'Create Faculty', 'url'=>'#','active'=>true),
);
?>

<div class="title">
    <h3>Create Faculty </h3>
    <h4><strong>Department: </strong> <span  class="label label-info" > <?php  echo yii::app()->session['department']; ?></span></h4>
</div>
<hr/>

<?php 

        
        if ($form=="_form_1")
        {
            echo $this->renderPartial($form, array('faculty'=>$faculty,'person'=>$person,'acHistory'=>$acHistory,'jobExp'=>$jobExp),false,FALSE); 
        }
        elseif ($form=="_form_2")
        {
            echo $this->renderPartial($form, array('faculty'=>$faculty,'person'=>$person,'acHistory'=>$acHistory,'jobExp'=>$jobExp)); 
        }
?>
