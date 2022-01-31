<?php
/* @var $this RoomController */
/* @var $model Room */

$this->breadcrumbs=array(
    'Registry'=>array('site/registry'),
	'Rooms'=>array('index'),
	$model->roomCode=>array('view','id'=>$model->roomCode),
	'Update',
);

$this->menu=array(
	array('label'=>'List Room', 'url'=>array('index')),
	array('label'=>'Create Room', 'url'=>array('create')),
	array('label'=>'View Details', 'url'=>array('view', 'id'=>$model->roomCode)),
	array('label'=>'Edit Room', 'url'=>'#','active'=>true),
);
?>

<div class="title">
    
    <h3>Edit Room </h3>
    <h4><strong>Room Code: </strong> <span  class="label label-info" > <?php  echo $model->roomCode ; ?></span></h4>
</div>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>