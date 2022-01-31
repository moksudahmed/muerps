<?php
/* @var $this SyllabusController */
/* @var $model Syllabus */

$this->breadcrumbs=array(
	'Registry'=>array('site/registry'),
    
	
     'Batch'=>array('Batch/index'),
    'Section'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Section', 'url'=>array('index')),
	array('label'=>'Create Section', 'url'=>'#','active'=>true),
);


?>



  

  
<div class="title">
        <h3>Create Section</h3>
        
        <strong>Batch:</strong> <span  class="label label-warning" ><?php  echo yii::app()->session['batch']; ?></span></h4>
         <h4><strong>Academic Year:</strong> <span  class="label label-info" ><?php echo yii::app()->session['academicYear'];  ?></span></h4>
          <h4><strong>Programme: </strong> <span  class="label label-success" > <?php  echo  yii::app()->session['programme']; ?></span></h4>
        <h4><strong>Department: </strong> <span  class="label label-important" > <?php  echo  yii::app()->session['department']; ?></span></h4>
</div>
<hr/>
  
    <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

