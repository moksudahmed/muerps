<?php
/* @var $this SyllabusController */
/* @var $model Syllabus */

$this->breadcrumbs=array(
   'Registry'=>array('site/registry'),
    
	'Syllabus'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Syllabus', 'url'=>array('index')),
	array('label'=>'Create Syllabus', 'url'=>array('create'),'active'=>true),
);
?>


<div class="title">
    <h3>Create Syllabus</h3>    
    <h4><strong>Programme: </strong> <span  class="label label-success" > <?php  echo  yii::app()->session['programme']; ?></span></h4>
    <h4><strong>Department: </strong> <span  class="label label-important" > <?php  echo  yii::app()->session['department']; ?></span></h4>
    
  
</div>
<hr/>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>