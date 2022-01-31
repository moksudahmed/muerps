<?php
/* @var $this UniversityController */
/* @var $model University */

$this->breadcrumbs=array(
	'Universities'=>array('index'),
	$model->universityCode=>array('view','id'=>$model->universityCode),
	'Update',
);

$this->menu=array(
	array('label'=>'List University', 'url'=>array('index')),
	array('label'=>'Create University', 'url'=>array('create')),
	array('label'=>'View University', 'url'=>array('view', 'id'=>$model->universityCode)),
	array('label'=>'Manage University', 'url'=>array('admin')),
);
?>

<h1>Update University <?php echo $model->universityCode; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>