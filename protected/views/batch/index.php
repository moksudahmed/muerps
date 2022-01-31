<?php
/* @var $this ProgrammeController */
/* @var $model Programme */
//echo $model->departmentID;
$this->breadcrumbs=array(
    'Registry'=>array('site/registry'),
    
	'Batch'=>array('index'),
	
);

$this->menu=array(
	array('label'=>'List Batches', 'url'=>array('index'),'active'=>true),
	array('label'=>'Create Batches', 'url'=>array('create')),
);





?>

    
<div class="title">
    <h3>List Batch</h3>    
    <h4><strong>Programme: </strong> <span  class="label label-success" > <?php  echo  yii::app()->session['programme']; ?></span></h4>
    <h4><strong>Department: </strong> <span  class="label label-important" > <?php  echo  yii::app()->session['department']; ?></span></h4>
    
  
</div>
<hr/>

 <?php if (Yii::app()->user->hasFlash('success')):?>
			<div class="alert in alert-block fade alert-success">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  <?php echo Yii::app()->user->getFlash('success')?>
			</div>
		<?php endif;?>
    
                <?php if (Yii::app()->user->hasFlash('warning')):?>
			<div class="alert in alert-block fade alert-danger">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  <?php echo Yii::app()->user->getFlash('warning')?>
			</div>
		<?php endif;?>


<?php
    $term='FormUtil::getTerm($data->bat_term)';
    $name='$data->batchName';
    $nameSufix='FormUtil::getBatchNameSufix($data->batchName)';
    
$batchNameColumn = array(
'name' => 'batchName',
'value' => "{$name}.{$nameSufix}",
        
'htmlOptions' =>array('style'=>'text-align:left')

);    

$batchTermColumn = array(
'name' => 'bat_term',
'value' => "{$term}",
        
'htmlOptions' =>array('style'=>'text-align:left')

);

$editableColumn =  array(
'name' => 'syllabusCode',
'header' => 'syllabus Code',
'class' => 'bootstrap.widgets.TbEditableColumn',
'headerHtmlOptions' => array('style' => 'width:10px'),
'editable' => array(
    'type' => 'text',
    //'url' => Yii::app()->createUrl("batch/editable", array("id"=>$data->batchName,"pid"=>$data->programmeCode))
    
    )
);
?>
<?php $this->widget('bootstrap.widgets.TbGroupGridView', array(
	'id'=>'school-grid',
        'type' => 'striped',
        'enablePagination' => true,
        'responsiveTable' => true,
	'dataProvider'=>$model->search($id),
	'filter'=>$model,
	'columns'=>array(
		
                $batchNameColumn,
                $batchTermColumn,
                
		
		'bat_year',
                'syllabusCode',
		//$editableColumn,
		
		
		 array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{view} {section} ',
            'buttons'=>array
            (
               
                'view' => array
                (
                    'label'=>'View Details',
                    'icon'=>'search white',
                    'url'=>'Yii::app()->createUrl("batch/view", array("id"=>$data->batchName,"pid"=>$data->programmeCode))',
                    'options'=>array(
                        'class'=>'btn btn-mini btn-success',
                        'data-toggle'=>'tooltip',
                        
                    ),
                ),
                'section' => array
                (
                    'label'=>'Section List',
                    'icon'=>'list white',
                    'url'=>'Yii::app()->createUrl("section/index", array("id"=>$data->batchName,"pid"=>$data->programmeCode))',
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


