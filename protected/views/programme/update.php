<?php
/* @var $this ProgrammeController */
/* @var $model Programme */

$this->breadcrumbs=array(
   'Registry'=>array('site/registry'),
	
	'Programme'=>array('Programme/index'),
	'Edit',
);

$this->menu=array(
	array('label'=>'List Programme', 'url'=>array('index')),
	array('label'=>'Create Programme', 'url'=>array('create')),
        array('label'=>'Detailed View', 'url'=>array('view', 'id'=>$model->programmeCode)),
	array('label'=>'Edit Programme', 'url'=>array('update', 'id'=>$model->programmeCode),'active'=>true),
	
);
?>

<div class="title">
    <h3>Edit Programme</h3>    
     <h4><strong>Department: </strong> <span  class="label label-success" > <?php  echo yii::app()->session['department'] ; ?></span></h4>
</div>
<hr/>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>