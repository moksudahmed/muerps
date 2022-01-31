<?php
/* @var $this StudentController */
/* @var $model Student */

$this->breadcrumbs=array(
	'Students'=>array('index'),
	$model->studentID=>array('view','id'=>$model->studentID),
	'Update',
);

$this->menu=array(
	array('label'=>'List Student', 'url'=>array('index')),
	array('label'=>'Create Student', 'url'=>array('create')),
	array('label'=>'View Student', 'url'=>array('view', 'id'=>$model->studentID)),
	array('label'=>'Manage Student', 'url'=>array('admin')),
);
?>

<h1>Update Student <?php echo $model->studentID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>