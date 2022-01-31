<?php
/* @var $this StudentController */
/* @var $model Student */

$this->breadcrumbs=array(
	'registry'=>array('site/registry'),
    'School'=>array('school/index'),
        'Department'=>array('Department/index', 'id'=> Yii::app()->session['schoolID']),
	'Programme'=>array('Programme/index', 'id'=>Yii::app()->session['departmentID']),
	
     'Batch'=>array('Batch/index', 'id'=>Yii::app()->session['programmeCode']),
    'Sections'=>array('Section/index','id'=>Yii::app()->session['batchName']),
    'Student'=>array('index','id'=>Yii::app()->session['sectionName']),
	'Create',
);

$this->menu=array(
	array('label'=>'List Student', 'url'=>array('index')),
	array('label'=>'Manage Student', 'url'=>array('admin')),
);
?>

<h1>Create Student</h1>

 <?php echo $this->renderPartial('_form', array('person'=>$person, 'student'=>$student, 'admission'=>$admission)); ?>
