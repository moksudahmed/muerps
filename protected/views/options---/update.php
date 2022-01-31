<?php
/* @var $this OptionsController */
/* @var $model Options */

$this->breadcrumbs=array(
	'Options'=>array('index'),
	$model->option_id=>array('view','id'=>$model->option_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Options', 'url'=>array('index')),
	array('label'=>'Create Options', 'url'=>array('create')),
	array('label'=>'View Options', 'url'=>array('view', 'id'=>$model->option_id)),
	array('label'=>'Manage Options', 'url'=>array('admin')),
);
?>

<h1>Update Options <?php echo $model->option_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>