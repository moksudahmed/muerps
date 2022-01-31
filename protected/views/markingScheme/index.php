<?php
/* @var $this MarkingSchemeController */
/* @var $model MarkingScheme */

$this->breadcrumbs=array(
    	'Examination'=>array('site/exam'),
	'Marking Schemes'=>array('index'),
	
);

$this->menu=array(
    
	array('label'=>'List MarkingScheme', 'url'=>array('index'),'active'=>true),
	array('label'=>'Create MarkingScheme', 'url'=>array('create')),
);


?>
<div class="title">
    <h3>Marking Schemes</h3>
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
		
		'mrs_versionNo',
		
		
		'mrs_startTerm',
		'mrs_startYear',
                'FirstHalfMarks',
                'FirstHalfPassMarks',    
                'mrs_final',
		
                'mrs_finalPass',
            
		'ex_mrs_default',
            
		
		
		
		
		 array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{view} ',
            'buttons'=>array
            (
               
                'view' => array
                (
                    'label'=>'View Details',
                    'icon'=>'search white',
                    'url'=>'Yii::app()->createUrl("markingScheme/view", array("id"=>$data->markingSchemeID))',
                    'options'=>array(
                        'class'=>'btn btn-mini btn-success',
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

