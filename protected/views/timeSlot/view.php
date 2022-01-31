<?php
/* @var $this TimeSlotController */
/* @var $model TimeSlot */

$this->breadcrumbs=array(
    'Registry'=>array('site/registry'),
	'Time Slots'=>array('index'),
	$model->timeSlotCode,
);

$this->menu=array(
	array('label'=>'List Time Slot', 'url'=>array('index')),
	array('label'=>'Create Time Slot', 'url'=>array('create')),
        array('label'=>'Detailed View ', 'url'=>array('view', 'id'=>$model->timeSlotCode),'active'=>TRUE),
	array('label'=>'Edit Time Slot', 'url'=>array('update', 'id'=>$model->timeSlotCode)),
	array('label'=>'Delete Time Slot', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->timeSlotCode),'confirm'=>'Are you sure you want to delete this item?')),
);
?>


<div class="title">
    <h3>Detailed View</h3>
   <h4><strong>Time Slot: </strong> <span  class="label label-info" > <?php  echo $model->timeSlotCode ; ?></span></h4>
    
            
       
</div>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'timeSlotCode',
		'tst_start',
		'tst_end',
	),
)); ?>
