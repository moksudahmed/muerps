<?php
/* @var $this AdministrationController */
/* @var $model Administration */

$this->breadcrumbs=array(
	'Student Administration'=>array('StudentAdministration'),
	'Student List'=>array('index'),
        'Edit Student',
	
	
);


	$this->menu=array(
        array('label'=>'Student Administration', 'url'=>array('studentAdministration')),
	array('label'=>'List Student', 'url'=>array('index')),
        array('label'=>'New Admission', 'url'=>array('create','flag'=>true)),
        array('label'=>'Detailed View', 'url'=>array('view','id'=>$student->studentID),),
        array('label'=>'Edit Student', 'url'=>'#','active'=>true),
	
);
	

?>


<div class="title span-12">
    
        <h3>Edit Student</h3>
        <h3 style="padding-right: 5px;"><strong>Student ID: </strong><span class="label label-success "> <?php echo $admission->studentID;  ?></span></h3>
        <h4 style="padding-right: 10px;"><strong>Batch: </strong><span class="label label-warning"> <?php echo yii::app()->session['batch']; ?>  </span><strong>Section: </strong><span class="label label-important"> <?php echo yii::app()->session['section']; ?></span></h4>
        <h4><strong>Student Academic Year: </strong><span class="label label-info"><?php  echo FormUtil::getTerm($student->stu_academicTerm)." ".$student->stu_academicYear ;  ?></span></h4>
    </div>
    <div class="span-4"> 
        <h6 style="padding-top: 20px;"><strong>Programme: </strong> <?php  echo yii::app()->session['programme']; ?></h6>
        
</div>



<?php echo $this->renderPartial('_update', array('admission'=>$admission,'student'=>$student,'person'=>$person)); ?>