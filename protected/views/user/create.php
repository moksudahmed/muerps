<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Create User', 'url'=>'#','active'=>true),
);
?>

<div class="title">
    
    <h3>Create Module </h3>
    
</div>


<?php $this->renderPartial('_form', array('model'=>$model)); ?>