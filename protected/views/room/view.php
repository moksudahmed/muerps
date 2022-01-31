<?php
/* @var $this RoomController */
/* @var $model Room */

$this->breadcrumbs=array(
    'Registry'=>array('site/registry'),
	'Rooms'=>array('index'),
	$model->roomCode,
);

$this->menu=array(
	array('label'=>'List Room', 'url'=>array('index')),
	array('label'=>'Create Room', 'url'=>array('create')),
        array('label'=>'View Room', 'url'=>'#','active'=>true),	
        array('label'=>'Edit Room', 'url'=>array('update', 'id'=>$model->roomCode)),
	array('label'=>'Delete Room', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->roomCode),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<div class="title">
    
    <h3>Detailed View </h3>
    <h4><strong>Room Code: </strong> <span  class="label label-info" > <?php  echo $model->roomCode ; ?></span></h4>
</div>


<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'roomCode',
		'rom_type',
		'rom_capacity',
		'rom_floor',
	),
)); ?>
