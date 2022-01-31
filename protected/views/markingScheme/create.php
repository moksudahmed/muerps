<?php
/* @var $this MarkingSchemeController */
/* @var $model MarkingScheme */

$this->breadcrumbs=array(
    
        'Examination'=>array('site/exam'),
	'Marking Schemes'=>array('index'),
	'Create Marking Schemes',
);

$this->menu=array(
	array('label'=>'List MarkingScheme', 'url'=>array('index')),
	array('label'=>'Create MarkingScheme', 'url'=>'#','active'=>true),
);
?>


<div class="title">
    <h3>Create Marking Schemes</h3>
</div>
<hr/>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>