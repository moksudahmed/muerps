<?php
/* @var $this SchoolController */
/* @var $model School */

$this->breadcrumbs=array(
    'Registry'=>array('site/registry'),
	'Schools'=>array('index'),
	
	'Edit',
);

$this->menu=array(
	array('label'=>'List School', 'url'=>array('index')),
	array('label'=>'Create School', 'url'=>array('create')),
        array('label'=>'Detailed View ', 'url'=>array('view', 'id'=>$model->schoolID),),
	array('label'=>'Edit School', 'url'=>array('update', 'id'=>$model->schoolID),'active'=>TRUE),
);
?>

<div class="title">
    <h3>Edit School</h3>
    <h4><strong>School Name: </strong> <span  class="label label-info" > <?php  echo $model->sch_name ; ?></span></h4>
    
            
        
</div>
<hr/>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>