<?php
/* @var $this AdministrationController */
/* @var $model Administration */

$this->breadcrumbs=array(
	'Registry'=>array('site/registry'),

	'Administrative Departments',

);

$this->menu=array(
	array('label'=>'List Administration', 'url'=>array('index'),'active'=>true),
	array('label'=>'Create Administration', 'url'=>array('create')),
);

?>

<div class="title">
    <h4>Administration List:</h4>
    
  
</div>
<?php $this->widget('bootstrap.widgets.TbGroupGridView', array(
	'id'=>'school-grid',
        'type' => 'striped',
        'enablePagination' => false,
        'responsiveTable' => true,
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
                'administrationCode',
		'adm_name',
		'adm_location',
		'adm_contactNo',
		'adm_email',
		
            array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{view} {update}',
            'buttons'=>array
            (
               
                'view' => array
                (
                    'label'=>'View Details',
                    'icon'=>'search white',
                    'url'=>'Yii::app()->createUrl("administration/view", array("id"=>$data->administrationCode))',
                    'options'=>array(
                        'class'=>'btn btn-mini btn-success',
                        'data-toggle'=>'tooltip',
                        
                    ),
                ),
                'update' => array
                (
                    'label'=>'Edit Info',
                    'icon'=>'pencil white',
                    'url'=>'Yii::app()->createUrl("administration/update", array("id"=>$data->administrationCode))',
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
