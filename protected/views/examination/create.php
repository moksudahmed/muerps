<?php
/* @var $this ExaminationController */
/* @var $model Examination */

$this->breadcrumbs=array(
    'Exam'=>array('site/exam'),
	'Examinations'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Examination', 'url'=>array('index')),
	array('label'=>'Create Examination', 'url'=>'#','active'=>true),
);
?>

<div class="title">
    <h3>Create Examination</h3>    
    <h4><strong >Type: </strong> <?php echo yii::app()->session['examName']; ?></h4>
</div>
<hr/>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>