<?php
/* @var $this SchoolController */
/* @var $model School */

$this->breadcrumbs=array(
    'Registry'=>array('site/registry'),
	'School'=>array('index'),
	'Detailed View',
);

$this->menu=array(
	array('label'=>'List School', 'url'=>array('index')),
	array('label'=>'Create School', 'url'=>array('create')),
        array('label'=>'Detailed View ', 'url'=>array('view', 'id'=>$model->schoolID),'active'=>TRUE),
	array('label'=>'Edit School', 'url'=>array('update', 'id'=>$model->schoolID)),
	array('label'=>'Delete School', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->schoolID),'confirm'=>'Are you sure you want to delete this item?')),
	
);
?>

<div class="title">
    <h3>Detailed View</h3>
    <h4><strong>School Name: </strong> <span  class="label label-info" > <?php  echo $model->sch_name ; ?></span></h4>
    
            
       
</div>
<hr/>
<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'sch_code',
		'sch_name',
		
		/*'sch_dean',
		'sch_deanStatus',*/
                'sch_remarks',
		
	),
)); ?>
