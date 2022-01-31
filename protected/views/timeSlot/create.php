<?php
/* @var $this TimeSlotController */
/* @var $model TimeSlot */

$this->breadcrumbs=array(
    'Registry'=>array('site/registry'),
	'Time Slots'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TimeSlot', 'url'=>array('index')),
	array('label'=>'Create TimeSlot', 'url'=>'#','active'=>'true'),
);
?>

<div class="title">
    <h3>Create Time Slot</h3>
    
            
        
</div>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>