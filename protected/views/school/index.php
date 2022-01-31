<?php
/* @var $this SchoolController */
/* @var $model School */

$this->breadcrumbs=array(
    'Registry'=>array('site/registry'),
	'Schools'=>array('index')
	
);

$this->menu=array(
	array('label'=>'List School', 'url'=>array('index'),'active'=>true),
        array('label'=>'Create School', 'url'=>array('create')),
	
);


?>

<div class="title">
    <h3>List School  </h3>
    
    
            
        
</div>
<hr/>

<?php $this->widget('bootstrap.widgets.TbGroupGridView', array(
	'id'=>'school-grid',
        'type' => 'striped',
        'enablePagination' => false,
        'responsiveTable' => true,
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'sch_code',
		'sch_name',
		'sch_remarks',
		
		
		
		 array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{view} {update} ',
            'buttons'=>array
            (
               
                'view' => array
                (
                    'label'=>'View Details',
                    'icon'=>'search white',
                    'url'=>'Yii::app()->createUrl("school/view", array("id"=>$data->schoolID))',
                    'options'=>array(
                        'class'=>'btn btn-mini btn-success',
                        'data-toggle'=>'tooltip',
                        
                    ),
                ),
                'update' => array
                (
                    'label'=>'Edit Info',
                    'icon'=>'pencil white',
                    'url'=>'Yii::app()->createUrl("school/update", array("id"=>$data->schoolID))',
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
