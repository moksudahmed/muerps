<?php
/* @var $this ModuleController */
/* @var $model Module */

$this->breadcrumbs=array(
   'Registry'=>array('site/registry'),
     
	'Syllabus'=>array('Syllabus/index'),
	'Modules'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Module', 'url'=>array('index')),
        array('label'=>'Create Module', 'url'=>array('create'),'active'=>true),
);
?>

<div class="title">
    
    <h3>Create Module </h3>
    
    <h4><strong>    Syllabus: </strong> <span  class="label label-warning" > <?php  echo  yii::app()->session['syllabus']; ?></span></h4>
<h4><strong>Programme: </strong> <span  class="label label-success" > <?php  echo  yii::app()->session['programme']; ?></span></h4>
        <h4><strong>Department: </strong> <span  class="label label-important" > <?php  echo  yii::app()->session['department']; ?></span></h4>
    
  
</div>
<hr/>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>