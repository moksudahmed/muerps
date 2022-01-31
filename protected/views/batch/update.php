<?php
/* @var $this SyllabusController */
/* @var $model Syllabus */

$this->breadcrumbs=array(
   'Registry'=>array('site/registry'),
    
	'Batch'=>array('index'),
	

	'Edit',
);

$this->menu=array(
	
	array('label'=>'List Batch', 'url'=>array('index')),
	array('label'=>'Create Batch', 'url'=>array('create')),
        array('label'=>'Detailed View', 'url'=>array('view', 'id'=>$model->batchName,'pid'=>$model->programmeCode)),
	array('label'=>'Edit Batch', 'url'=>'#','active'=>true),
	
);
?>

<div class="title">
    <h3>Edit Batch</h3>    
    <h4><strong>Programme: </strong> <span  class="label label-success" > <?php  echo  yii::app()->session['programme']; ?></span></h4>
    <h4><strong>Department: </strong> <span  class="label label-important" > <?php  echo  yii::app()->session['department']; ?></span></h4>
    
  
</div>
<hr/>


<?php echo $this->renderPartial('_update', array('model'=>$model,'fees'=>$fees)); ?>