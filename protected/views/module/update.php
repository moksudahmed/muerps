<?php
/* @var $this ModuleController */
/* @var $model Module */

$this->breadcrumbs=array(
   'Registry'=>array('site/registry'),
	
	'Syllabus'=>array('Syllabus/index','id'=>Yii::app()->session['programmeCode']),
	'Modules'=>array('index','id'=>Yii::app()->session['syllabusCode']),
	'Edit',
);

$this->menu=array(
	array('label'=>'List Module', 'url'=>array('index','id'=>Yii::app()->session['syllabusCode'])),
	array('label'=>'Create Module', 'url'=>array('create')),
	array('label'=>'View Details', 'url'=>array('view', 'id'=>$model->moduleCode,'pid'=>$model->syllabusCode)),
	array('label'=>'Edit Module', 'url'=>'#','active'=>true),
);
?>

<div class="title">
    
    <h3>Edit Module </h3>
    <h4><strong>Module:</strong> <span  class="label label-info" ><?php echo$model->moduleCode.":".$model->mod_name; ?></span><strong>    Syllabus: </strong> <span  class="label label-warning" > <?php  echo  yii::app()->session['syllabus']; ?></span></h4>
    <h4><strong>Programme: </strong> <span  class="label label-success" > <?php  echo  yii::app()->session['programme']; ?></span></h4>
    <h4><strong>Department: </strong> <span  class="label label-important" > <?php  echo  yii::app()->session['department']; ?></span></h4>
    
  
</div>
<hr/>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>