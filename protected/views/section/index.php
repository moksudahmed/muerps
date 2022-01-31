<?php
/* @var $this ProgrammeController */
/* @var $model Programme */
//echo $model->departmentID;
$this->breadcrumbs=array(
    'Registry'=>array('site/registry'),
	
    
     'Batch'=>array('Batch/index'),
    'Sections'
	
);

$this->menu=array(
	array('label'=>'List Section', 'url'=>array('index'),'active'=>true),
	array('label'=>'Create Section', 'url'=>array('create')),
);


?>
<?php



?>

<div class="title ">
         <h3>List Section </h3>
         <h4><strong>Batch:</strong> <span  class="label label-warning" ><?php  echo yii::app()->session['batch']; ?></span></h4>
         <h4><strong>Academic Year:</strong> <span  class="label label-info" ><?php echo yii::app()->session['academicYear'];  ?></span></h4>
        <h4><strong>Programme: </strong> <span  class="label label-success" > <?php  echo  yii::app()->session['programme']; ?></span></h4>
        <h4><strong>Department: </strong> <span  class="label label-important" > <?php  echo  yii::app()->session['department']; ?></span></h4>
</div>
<hr/>

    <?php $this->widget('bootstrap.widgets.TbGroupGridView', array(
	'id'=>'school-grid',
        'type' => 'striped',
        'enablePagination' => true,
        'responsiveTable' => true,
	'dataProvider'=>$model->search($id,$pid),
	'filter'=>$model,
	'columns'=>array(
                
		
		'sectionName',
                'sec_startDate',
		'sec_startId',
                'sec_endId',

		
		
		 array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{view} {update} {offeredModule} {student} {termAdmission}',
            'buttons'=>array
            (
               
                'view' => array
                (
                    'label'=>'View Details',
                    'icon'=>'search white',
                    'url'=>'Yii::app()->createUrl("section/view", array("id"=>$data->sectionName,"bid"=>$data->batchName,"pid"=>$data->programmeCode))',
                    'options'=>array(
                        'class'=>'btn btn-mini btn-success',
                        'data-toggle'=>'tooltip',
                        
                    ),
                ),
                'update' => array
                (
                    'label'=>'Edit Info',
                    'icon'=>'pencil white',
                    'url'=>'Yii::app()->createUrl("section/update", array("id"=>$data->sectionName,"bid"=>$data->batchName,"pid"=>$data->programmeCode))',
                    'options'=>array(
                        'class'=>'btn btn-mini btn-danger',
                        'data-toggle'=>'tooltip',
                        
                        
                        
                    ),
                ),
                'offeredModule' => array
                (
                    'label'=>'Offered Modules List',
                    'icon'=>'list white',
                    'url'=>'Yii::app()->createUrl("offeredModule/AllOffered", array("sid"=>$data->sectionName,"bid"=>$data->batchName,"pid"=>$data->programmeCode))',
                    'options'=>array(
                        'class'=>'btn btn-mini btn-warning',
                        'data-toggle'=>'tooltip',
                        
                        
                        
                    ),
                ),
                'student' => array
                (
                    'label'=>'All Admitted Students',
                    'icon'=>'user white',
                    'url'=>'Yii::app()->createUrl("admission/index", array("sid"=>$data->sectionName,"bid"=>$data->batchName,"pid"=>$data->programmeCode))',
                    'options'=>array(
                        'class'=>'btn btn-mini btn-success',
                        'data-toggle'=>'tooltip',
                        
                        
                        
                    ),
                ),
                
                'termAdmission' => array
                (
                    'label'=>'Admitted Terms',
                    'icon'=>'th white',
                    'url'=>'Yii::app()->createUrl("termAdmission/termsBySection", array("sid"=>$data->sectionName,"bid"=>$data->batchName,"pid"=>$data->programmeCode))',
                    'options'=>array(
                        'class'=>'btn btn-mini btn-info',
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
