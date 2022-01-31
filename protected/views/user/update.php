<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->userID=>array('view','id'=>$model->userID),
	'Update',
);

$this->menu=array(
	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Create User', 'url'=>array('create')),
	array('label'=>'View User', 'url'=>array('view', 'id'=>$model->userID)),
	
        array('label'=>'Create User', 'url'=>array('create'),'active'=>true),
);
?>


<div class="title">
    
    <h3>Edit User: <?php echo $model->per_email; ?> </h3>
    
</div>
<?php $this->renderPartial('_update', array('model'=>$model)); ?>