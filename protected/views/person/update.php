<?php
/* @var $this PersonController */
/* @var $model Person */

$this->breadcrumbs=array(
	'people'=>array('index'),
	$model->personID=>array('view','id'=>$model->personID),
	'Update',
);

$this->menu=array(
	array('label'=>'List Person', 'url'=>array('index')),
	array('label'=>'Create Person', 'url'=>array('create')),
	array('label'=>'View Person', 'url'=>array('view', 'id'=>$model->personID)),
	array('label'=>'Manage Person', 'url'=>array('admin')),
);
?>

<h1>Update Person <?php echo $model->personID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>