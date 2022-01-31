<?php
/* @var $this SyllabusController */
/* @var $model Syllabus */

$this->breadcrumbs=array(
   'Registry'=>array('site/registry'),
    
	'Syllabus'=>array('index'),
	'Edit',
);

$this->menu=array(
	array('label'=>'List Syllabus', 'url'=>array('index')),
	array('label'=>'Create Syllabus', 'url'=>array('create')),
        array('label'=>'Detailed View', 'url'=>'#','active'=>true),
	array('label'=>'Edit Syllabus', 'url'=>array('update', 'id'=>$model->syllabusCode)),
	array('label'=>'Delete Syllabus', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->syllabusCode),'confirm'=>'Are you sure you want to delete this item?')),
	
);
?>

<div class="title">
    <h3>Detailed View</h3>    
    <h4><strong>Programme: </strong> <span  class="label label-success" > <?php  echo  yii::app()->session['programme']; ?></span></h4>
    <h4><strong>Department: </strong> <span  class="label label-important" > <?php  echo  yii::app()->session['department']; ?></span></h4>
    
  
</div>
<hr/>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'syllabusCode',
		'programmeCode',
		'syl_version',
		'syl_startTerm',
		'syl_startYear',
		'syl_endTerm',
		'syl_endYear',
		'syl_maxCreditHour',
                'syl_minMonth',
		'syl_description',
		'syl_minCGPA',
		'syl_maxCGPA',
		'syl_approvedDate',
	),
)); ?>
