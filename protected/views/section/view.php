<?php
/* @var $this ProgrammeController */
/* @var $model Programme */

$this->breadcrumbs=array(
    'Registry'=>array('site/registry'),
    
	'Batch'=>array('index'),
        'Section'=>array('index'),	
        'Detailed View',
);

$this->menu=array(
	array('label'=>'List Sections', 'url'=>array('index')),
	array('label'=>'Create Section', 'url'=>array('create')),
	array('label'=>'Detailed View', 'url'=>'#','active'=>true),
        array('label'=>'Update Section', 'url'=>array('update', 'id'=>$model->sectionName,'bid'=>$model->batchName,'pid'=>$model->programmeCode)),
	array('label'=>'Delete Section', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete', 'id'=>$model->sectionName,'bid'=>$model->batchName,'pid'=>$model->programmeCode),'confirm'=>'Are you sure you want to delete this item?')),
	
);
?>

<div class="title">
        <h3>Detailed View</h3>
        <h4><strong>Section:</strong> <span  class="label label-success" ><?php  echo $model->sectionName; ?></span>
        <strong>Batch:</strong> <span  class="label label-warning" ><?php  echo yii::app()->session['batch']; ?></span></h4>
         <h4><strong>Academic Year:</strong> <span  class="label label-info" ><?php echo yii::app()->session['academicYear'];  ?></span></h4>
          <h4><strong>Programme: </strong> <span  class="label label-success" > <?php  echo  yii::app()->session['programme']; ?></span></h4>
        <h4><strong>Department: </strong> <span  class="label label-important" > <?php  echo  yii::app()->session['department']; ?></span></h4>
</div>
<hr/>
    <?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
	'attributes'=>array(
                
                'sec_startDate',
		'sec_startId',
		'sec_endId',
                'sec_remarks'
            
	),
)); ?>
