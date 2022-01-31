<?php
/* @var $this ModuleRegistrationController */
/* @var $model ModuleRegistration */

$this->breadcrumbs=array(
	'Module Registrations'=>array('index'),
	$model->moduleRegistrationID,
);

$this->menu=array(
	array('label'=>'List ModuleRegistration', 'url'=>array('index')),
	array('label'=>'Create ModuleRegistration', 'url'=>array('create')),
	array('label'=>'Update ModuleRegistration', 'url'=>array('update', 'id'=>$model->moduleRegistrationID)),
	array('label'=>'Delete ModuleRegistration', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->moduleRegistrationID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ModuleRegistration', 'url'=>array('admin')),
);
?>

<h1>View ModuleRegistration #<?php echo $model->moduleRegistrationID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'moduleRegistrationID',
		'termAdmissionID',
		'offeredModuleID',
		'reg_date',
		'reg_type',
		'reg_attendence',
		'reg_classTest',
		'reg_midterm',
		'markingSchemeID',
	),
)); ?>
