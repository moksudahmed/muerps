<?php
/* @var $this ProgrammeController */
/* @var $model Programme */
//echo $model->departmentID;
$this->breadcrumbs=array(
    'Registry'=>array('site/registry'),
	
	'Programme'=>array('Programme/index'),
	
);

$this->menu=array(
	array('label'=>'List Programme', 'url'=>array('index'),'active'=>true),
	array('label'=>'Create Programme', 'url'=>array('create')),
);


?>


<div class="title">
    <h3>List Programme</h3>    
    <h4><strong>Department: </strong> <span  class="label label-success" > <?php  echo yii::app()->session['department'] ; ?></span></h4>
  
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
		'programmeCode',
                'pro_shortName',
                'pro_name',
                
		
		'pro_startTerm',
                'pro_startYear',
		'pro_type',
                'pro_totalTerms',
		
		
		
		 array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{view} {update} ',
            'buttons'=>array
            (
               
                'view' => array
                (
                    'label'=>'View Details',
                    'icon'=>'search white',
                    'url'=>'Yii::app()->createUrl("programme/view", array("id"=>$data->programmeCode))',
                    'options'=>array(
                        'class'=>'btn btn-mini btn-success',
                        'data-toggle'=>'tooltip',
                        
                    ),
                ),
                'update' => array
                (
                    'label'=>'Edit Info',
                    'icon'=>'pencil white',
                    'url'=>'Yii::app()->createUrl("programme/update", array("id"=>$data->programmeCode))',
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
