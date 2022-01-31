<?php
/* @var $this RoomController */
/* @var $model Room */

$this->breadcrumbs=array(
    'Registry'=>array('site/registry'),
	'Rooms'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Room', 'url'=>array('index'),'active'=>true),
    array('label'=>'Create Room', 'url'=>array('create')),
);

?>

<div class="title">
    
    <h3>List Modules </h3>



</div><!-- search-form -->
<hr/>
<?php $this->widget('bootstrap.widgets.TbGroupGridView', array(
	'id'=>'room-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'roomCode',
		'rom_type',
		'rom_capacity',
		'rom_floor',
		
            array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{view} {update} ',
            'buttons'=>array
            (
               
                'view' => array
                (
                    'label'=>'View Details',
                    'icon'=>'search white',
                    'url'=>'Yii::app()->createUrl("room/view", array("id"=>$data->roomCode))',
                    'options'=>array(
                        'class'=>'btn btn-mini btn-success',
                        'data-toggle'=>'tooltip',
                        
                    ),
                ),
                'update' => array
                (
                    'label'=>'Edit Info',
                    'icon'=>'pencil white',
                    'url'=>'Yii::app()->createUrl("room/update", array("id"=>$data->roomCode))',
                    'options'=>array(
                        'class'=>'btn btn-mini btn-warning',
                        'data-toggle'=>'tooltip',
                        
                        
                        
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
