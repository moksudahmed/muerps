<?php
/* @var $this UniversityController */
/* @var $model University */

$this->breadcrumbs=array(
	'Universities'=>array('index'),
	$model->universityCode,
);

$this->menu=array(
	array('label'=>'List University', 'url'=>array('index')),
	array('label'=>'Create University', 'url'=>array('create')),
	array('label'=>'Update University', 'url'=>array('update', 'id'=>$model->universityCode)),
	array('label'=>'Delete University', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->universityCode),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage University', 'url'=>array('admin')),
);
?>

<h1>View University #<?php echo $model->universityCode; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'universityCode',
		'uni_name',
		'uni_address',
		'uni_email',
		'uni_webAddress',
		'uni_currentTerm',
		'uni_currentYear',
	),
)); ?>
