<?php
/* @var $this ProgrammeController */
/* @var $model Programme */

$this->breadcrumbs=array(
    'Registry'=>array('site/registry'),
    
	'Batch'=>array('index'),
	'View Detailed',
);

$this->menu=array(
	array('label'=>'List Batches', 'url'=>array('index')),
	
    array('label'=>'Create Batches', 'url'=>array('create')),
    array('label'=>'Detailed View', 'url'=>'#','active'=>true),
    array('label'=>'Edit Batch', 'url'=>array('update', 'id'=>$model->batchName,'pid'=>$model->programmeCode,)),
	array('label'=>'Delete Batch', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete', 'id'=>$model->batchName,'pid'=>$model->programmeCode),'confirm'=>'Are you sure you want to delete this item?')),
	
);
?>

<div class="title">
    <h3>Detailed View</h3>    
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

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'batchName',
		'programmeCode',
                'bat_term',
		'bat_year',
                'syllabusCode',
                'feesName',
		'bat_advisor'
	),
)); ?>
