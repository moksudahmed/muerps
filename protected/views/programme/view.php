<?php
/* @var $this ProgrammeController */
/* @var $model Programme */

$this->breadcrumbs=array(
    'Registry'=>array('site/registry'),

	'Programme'=>array('Programme/index'),
	'Detailed View',
);

$this->menu=array(
	array('label'=>'List Programme', 'url'=>array('index')),
	array('label'=>'Create Programme', 'url'=>array('create')),
        array('label'=>'Detailed View', 'url'=>'#','active'=>true),
	array('label'=>'Edit Programme', 'url'=>array('update', 'id'=>$model->programmeCode)),
	array('label'=>'Delete Programme', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->programmeCode),'confirm'=>'Are you sure you want to delete this item?')),
	
);
?>

<div class="title">
    <h3>Detailed View</h3>    
    <h4><strong>Department: </strong> <span  class="label label-success" > <?php  echo yii::app()->session['department'] ; ?></span></h4>
  
</div>
<hr/>
<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'programmeCode',
		'pro_name',
                'pro_shortName',
		'pro_totalTerms',
		'pro_startTerm',
                'pro_startYear',
		'pro_type',
		'pro_medium',
		
                'pro_remarks',
	),
)); ?>
