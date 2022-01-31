<?php
/* @var $this OptionsController */
/* @var $model Options */

$this->breadcrumbs=array(
	'Options'=>array('index'),
	$model->option_id,
);

$this->menu=array(
	array('label'=>'List Options', 'url'=>array('index')),
	array('label'=>'Create Options', 'url'=>array('create')),
	array('label'=>'Update Options', 'url'=>array('update', 'id'=>$model->option_id)),
	array('label'=>'Delete Options', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->option_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Options', 'url'=>array('admin')),
);
?>

<h1>View Options #<?php echo $model->option_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'option_id',
		'option_name',
		'option_value',
		'auto_load',
	),
)); ?>
 