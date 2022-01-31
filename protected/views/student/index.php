<?php
/* @var $this StudentController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
    'registry'=>array('site/registry'),
    'School'=>array('school/index'),
        'Department'=>array('Department/index', 'id'=> Yii::app()->session['schoolID']),
	'Programme'=>array('Programme/index', 'id'=>Yii::app()->session['departmentID']),
    'Batch'=>array('Batch/index', 'id'=>Yii::app()->session['programmeCode']),
    'Section'=>array('Section/index','id'=>Yii::app()->session['batchName']),
	'Students',
);

$this->menu=array(
	array('label'=>'Create Student', 'url'=>array('create')),
	array('label'=>'Manage Student', 'url'=>array('admin')),
);
?>

<h1>Students</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
