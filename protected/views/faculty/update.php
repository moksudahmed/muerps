<?php
/* @var $this EmployeeController */
/* @var $model Employee */

$this->breadcrumbs=array(
        'Registry'=>array('site/registry'),
	'Faculty'=>array('index'),
	
	'Edit',
);

$this->menu=array(
	
	array('label'=>'List Faculty', 'url'=>array('index','id'=>yii::app()->session['dptID'])),
    array('label'=>'Create Faculty', 'url'=>array('create','flag'=>1)),
    array('label'=>'Detailed View',  'url'=>array('update', 'id'=>$faculty->facultyID)),
	
    array('label'=>'Edit Faculty', 'url'=>'#','active'=>true),
);
?>

<div class="title">
        

        <h3>Edit Faculty</h3>
        
        <h4><strong>Faculty Name: </strong> <span  class="label label-success" > <?php echo $person->per_title." ".$person->per_firstName." ".$person->per_lastName; ?></span></h4>
        <h4><strong>Department: </strong> <span  class="label label-info" > <?php  echo yii::app()->session['department']; ?></span></h4>


</div>
<hr/>
<?php echo $this->renderPartial('_update', array('faculty'=>$faculty,'person'=>$person)); ?>
