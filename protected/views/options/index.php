<?php
/* @var $this OptionsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Options',
);

$this->menu=array(
	array('label'=>'Create Options', 'url'=>array('create')),
	array('label'=>'Manage Options', 'url'=>array('admin')),
        array('label'=>'Settings', 'url'=>array('inputSettings')),
		array('label'=>'User Settings', 'url'=>array('inputUserSettings')),
		array('label'=>'Exam Settings', 'url'=>array('examSettings')),
);
?>

<h1>Options</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
