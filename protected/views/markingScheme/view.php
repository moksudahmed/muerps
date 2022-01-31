<?php
/* @var $this MarkingSchemeController */
/* @var $model MarkingScheme */

$this->breadcrumbs=array(
    'Examination'=>array('site/exam'),
	'Marking Schemes'=>array('index'),
	'Detailed View',
);

$this->menu=array(
	array('label'=>'List MarkingScheme', 'url'=>array('index')),
	array('label'=>'Create MarkingScheme', 'url'=>array('create')),
    	array('label'=>'Detailed View', 'url'=>'#','active'=>true),
	array('label'=>'Edit MarkingScheme', 'url'=>array('update', 'id'=>$model->markingSchemeID)),
	
	
);
?>

<div class="title">
    <h3>Detailed View</h3>
    <h4><strong>Scheme: </strong> <span  class="label label-info" > <?php  echo $model->mrs_versionNo ; ?></span></h4>
</div>
<hr/>
<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
	'attributes'=>array(

		'mrs_versionNo',
		'mrs_startTerm',
		'mrs_startYear',
		'mrs_endTerm',
		'mrs_endYear',
            'mrs_gradingSchemeName',
            'mrs_attendance',
		'mrs_classTest',
		'mrs_midterm',
		'mrs_final',
	
		
		'mrs_attendancePass',
		'mrs_classTestPass',
		'mrs_midtermPass',
                
		'mrs_finalPass',
		
	),
)); ?>
