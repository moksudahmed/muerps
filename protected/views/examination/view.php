<?php
/* @var $this ExaminationController */
/* @var $model Examination */

$this->breadcrumbs=array(
    'Exam'=>array('site/exam'),
	'Examinations'=>array('index'),
	'Detailed View'
);

$this->menu=array(
	array('label'=>'List Examination', 'url'=>array('index')),
	array('label'=>'Create Examination', 'url'=>array('create')),
        array('label'=>'Detailed View', 'url'=>'#','active'=>true),
	array('label'=>'Edit Examination', 'url'=>array('update', 'id'=>$model->examinationID)),
	array('label'=>'Delete Examination', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->examinationID),'confirm'=>'Are you sure you want to delete this item?')),
	
);
?>

<div class="title">
    <h3>Detailed View</h3>    
    <h4><strong >Examination Type: </strong> <?php echo yii::app()->session['examName']; ?></h4>
</div>
<hr/>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		/*'examinationID',
		'exm_type',*/
		'exm_examTerm',
		'exm_examYear',
		'exm_startDate',
		'exm_endDate',
		'exm_resultDate',
	),
)); ?>
