<?php
/* @var $this TimeSlotController */
/* @var $model TimeSlot */

$this->breadcrumbs=array(
    'Registry'=>array('site/registry'),
	'Time Slots'=>array('index'),
	
	'Edit',
);

$this->menu=array(
	array('label'=>'List Time Slot', 'url'=>array('index')),
	array('label'=>'Create Time Slot', 'url'=>array('create')),
        array('label'=>'Detailed View ', 'url'=>array('view', 'id'=>$model->timeSlotCode),),
	array('label'=>'Edit Time Slot', 'url'=>array('update', 'id'=>$model->timeSlotCode),'active'=>TRUE),
);
?>

<div class="title">
    <h3>Edit Time Slot</h3>
    <h4><strong>Time Slot: </strong> <span  class="label label-info" > <?php  echo $model->timeSlotCode ; ?></span></h4>
    
            
        
</div>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>