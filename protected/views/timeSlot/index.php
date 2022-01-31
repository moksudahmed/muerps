<?php
/* @var $this TimeSlotController */
/* @var $model TimeSlot */

$this->breadcrumbs=array(
    'Registry'=>array('site/registry'),
	'Time Slots'=>array('index'),
	
);

$this->menu=array(
	array('label'=>'List TimeSlot', 'url'=>array('index')),
	array('label'=>'Create TimeSlot', 'url'=>array('create')),
);

?>

<div class="title">
    <h3>List Time Slot  </h3>
    
    
            
        
</div>


<?php $this->widget('bootstrap.widgets.TbGroupGridView', array(
	'id'=>'time-slot-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'timeSlotCode',
		'tst_start',
		'tst_end',
			 array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{view} {update} ',
            'buttons'=>array
            (
               
                'view' => array
                (
                    'label'=>'View Details',
                    'icon'=>'search white',
                    'url'=>'Yii::app()->createUrl("timeSlot/view", array("id"=>$data->timeSlotCode))',
                    'options'=>array(
                        'class'=>'btn btn-mini btn-success',
                        'data-toggle'=>'tooltip',
                        
                    ),
                ),
                'update' => array
                (
                    'label'=>'Edit Info',
                    'icon'=>'pencil white',
                    'url'=>'Yii::app()->createUrl("timeSlot/update", array("id"=>$data->timeSlotCode))',
                    'options'=>array(
                        'class'=>'btn btn-mini btn-warning',
                        'data-toggle'=>'tooltip',
                        
                        
                        
                    ),
                ),
                'delete' => array
                (
                    'label'=>'delete',
                    'icon'=>'remove white',
                    'url'=>'Yii::app()->createUrl("school/delete", array("id"=>$data->schoolID))',
                    'options'=>array(
                        'class'=>'btn btn-mini btn-danger',
                        'data-toggle'=>'tooltip',
                        'data-placement'=>'right'
                    ),
                ),
            ),
            'htmlOptions'=>array(
                'style'=>'width: 220px; ',
                'class'=>'moreButtons',
                
            ),
     ),
	),
)); ?>
