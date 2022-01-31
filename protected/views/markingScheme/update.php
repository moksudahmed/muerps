<?php
/* @var $this MarkingSchemeController */
/* @var $model MarkingScheme */

$this->breadcrumbs=array(
    'Examination'=>array('site/exam'),
	'Marking Schemes'=>array('index'),
	
	'Edit',
);

$this->menu=array(
	array('label'=>'List MarkingScheme', 'url'=>array('index')),
	array('label'=>'Create MarkingScheme', 'url'=>array('create')),
	array('label'=>'Detailed View', 'url'=>array('view', 'id'=>$model->markingSchemeID)),
	array('label'=>'Edit MarkingScheme', 'url'=>'#','active'=>true),
);
?>

<div class="title">
    <h3>Edit Marking Scheme</h3>
    <h4><strong>Scheme: </strong> <span  class="label label-info" > <?php  echo $model->mrs_versionNo ; ?></span></h4>
</div>
<hr/>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>