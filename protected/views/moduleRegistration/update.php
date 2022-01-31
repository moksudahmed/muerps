<?php
/* @var $this ModuleRegistrationController */
/* @var $model ModuleRegistration */

$this->breadcrumbs=array(
	'Module Registrations'=>array('index'),
	$model->moduleRegistrationID=>array('view','id'=>$model->moduleRegistrationID),
	'Update',
);

$this->menu=array(
	array('label'=>'List ModuleRegistration', 'url'=>array('index')),
	array('label'=>'Create ModuleRegistration', 'url'=>array('create')),
	array('label'=>'View ModuleRegistration', 'url'=>array('view', 'id'=>$model->moduleRegistrationID)),
	array('label'=>'Manage ModuleRegistration', 'url'=>array('admin')),
);
?>

<h1>Update ModuleRegistration <?php echo $model->moduleRegistrationID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>