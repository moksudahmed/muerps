<?php
/* @var $this ExaminationController */
/* @var $model Examination */

$this->breadcrumbs=array(
    'Exam'=>array('site/exam'),
	'Examinations'=>array('index'),
	
	'Edit',
);

$this->menu=array(
	array('label'=>'List Examination', 'url'=>array('index')),
	array('label'=>'Create Examination', 'url'=>array('create')),
	array('label'=>'Detailed View', 'url'=>array('view', 'id'=>$model->examinationID)),
	array('label'=>'Edit Examination', 'url'=>'#','active'=>true),
);
?>

<div class="title">
    <h3>Create Examination</h3>    
    <h4><strong >Examination Type: </strong> <?php echo yii::app()->session['examName']; ?></h4>
</div>
<hr/>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>