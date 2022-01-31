<?php
/* @var $this ModuleRegistrationController */
/* @var $model ModuleRegistration */

$this->breadcrumbs=array(
	'Module Registrations'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ModuleRegistration', 'url'=>array('index')),
	array('label'=>'Manage ModuleRegistration', 'url'=>array('admin')),
);
?>

<h1>Create ModuleRegistration</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>