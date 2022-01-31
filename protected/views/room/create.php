<?php
/* @var $this RoomController */
/* @var $model Room */

$this->breadcrumbs=array(
    'Registry'=>array('site/registry'),
	'Rooms'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Room', 'url'=>array('index')),
        array('label'=>'Create Room', 'url'=>array('create'),'active'=>true),
);
?>

<div class="title">
    
    <h3>Create Module </h3>
    
    
    
  
</div>


<?php $this->renderPartial('_form', array('model'=>$model)); ?>