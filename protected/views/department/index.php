<?php
/* @var $this DepartmentController */
/* @var $model Department */

$this->breadcrumbs=array(
    'Registry'=>array('site/registry'),
	
	'Departments'=>array('index')
	
);

$this->menu=array(
	array('label'=>'List Department', 'url'=>array('index'),'active'=>true),
	array('label'=>'Create Department', 'url'=>array('create')),
);

?>

<div class="title">
    <h3>List Department</h3>
    <h4><strong>School:</strong> <span  class="label label-info" > <?php  echo yii::app()->session['school']; ?></span></h4>
    
</div>
<hr/>

<?php $this->widget('bootstrap.widgets.TbGroupGridView', array(
	'id'=>'school-grid',
        'type' => 'striped',
        'enablePagination' => false,
        'responsiveTable' => true,
	'dataProvider'=>$model->search($id),
	'filter'=>$model,
	'columns'=>array(
		'dpt_code',
		'dpt_name',
		'dpt_location',
		'dpt_contactNo',
		'dpt_email',
		
		
		
		 array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{view} {update} ',
            'buttons'=>array
            (
               
                'view' => array
                (
                    'label'=>'View Details',
                    'icon'=>'search white',
                    'url'=>'Yii::app()->createUrl("department/view", array("id"=>$data->departmentID))',
                    'options'=>array(
                        'class'=>'btn btn-mini btn-success',
                        'data-toggle'=>'tooltip',
                        
                    ),
                ),
                'update' => array
                (
                    'label'=>'Edit Info',
                    'icon'=>'pencil white',
                    'url'=>'Yii::app()->createUrl("department/update", array("id"=>$data->departmentID))',
                    'options'=>array(
                        'class'=>'btn btn-mini btn-warning',
                        'data-toggle'=>'tooltip',
                        
                        
                        
                    ),
                ),
               /* 'delete' => array
                (
                    'label'=>'delete',
                    'icon'=>'remove white',
                    'url'=>'Yii::app()->createUrl("department/delete", array("id"=>$data->departmentID))',
                    'options'=>array(
                        'class'=>'btn btn-mini btn-danger',
                        'data-toggle'=>'tooltip',
                        'data-placement'=>'right'
                    ),
                ),*/
            ),
            'htmlOptions'=>array(
                'style'=>'width: 220px; ',
                'class'=>'moreButtons',
                
            ),
     ),
	),
)); ?>
