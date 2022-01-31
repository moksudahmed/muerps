<?php
/* @var $this ModuleController */
/* @var $model Module */

$this->breadcrumbs=array(
   'Registry'=>array('site/registry'),
    
	'Syllabus'=>array('Syllabus/index'),
	'Modules'=>array('index'),
        'Detailed View'
);

$this->menu=array(
	array('label'=>'List Module', 'url'=>array('index')),
	array('label'=>'Create Module', 'url'=>array('create')),
        array('label'=>'View Details', 'url'=>'#','active'=>true),	
        array('label'=>'Edit Module', 'url'=>array('update', 'id'=>$model->moduleCode,'pid'=>$model->syllabusCode)),
	array('label'=>'Delete Module', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->moduleCode,'pid'=>$model->syllabusCode),'confirm'=>'Are you sure you want to delete this item?')),
	
);
?>


<div class="title">
    
    <h3>Detailed View </h3>
    <h4><strong>Module:</strong> <span  class="label label-info" ><?php echo$model->moduleCode.":".$model->mod_name; ?></span><strong>    Syllabus: </strong> <span  class="label label-warning" > <?php  echo  yii::app()->session['syllabus']; ?></span></h4>
<h4><strong>Programme: </strong> <span  class="label label-success" > <?php  echo  yii::app()->session['programme']; ?></span></h4>
        <h4><strong>Department: </strong> <span  class="label label-important" > <?php  echo  yii::app()->session['department']; ?></span></h4>
    
  
</div>
<hr/>
<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'moduleCode',
		
		'mod_name',
		'mod_shortName',
		'mod_creditHour',
		'mod_type',
		'mod_labIncluded',
		'mod_mejor',
		'mod_group',
                'mod_prerequisite',
		'mod_sequence',
	),
)); ?>
