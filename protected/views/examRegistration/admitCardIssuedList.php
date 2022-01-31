<?php
/* @var $this AdministrationController */
/* @var $model Administration */

$this->breadcrumbs=array(
	'Exam Activities'=>array('examDepartment/index'),
	
        
	'Admit Card & Signature Sheet',
);




?>
<div class="title span-18">
            <h3 >
                Admit Card & Signature Sheet
            </h3>
            <h4><strong>Term: </strong><span class="label label-info">  <?php echo FormUtil::getTerm( yii::app()->session['aciTerm']);?></span><span class="label label-success"> <?php echo "Term ".yii::app()->session['aciExamType']." Examination ".yii::app()->session['aciYear'];?></span></h4>
            <h4><strong>Batch: </strong><span class="label label-success"> <?php echo yii::app()->session['aciBatName'].FormUtil::getBatchNameSufix(yii::app()->session['aciBatName']); ?>  </span><strong>Section: </strong><span class="label label-important"> All </span></h4>
            
</div>



<div class="title span2">
    <h4><span class="label label-warning"><?php echo FormUtil::getTerm(yii::app()->session['aciTerm']); ?> </span><span class="label label-success"> <?php echo yii::app()->session['aciYear'];  ?></span><strong style="letter-spacing:3px;">Selected Term </strong></h4>
    <h6>Programme:<?php  echo DBhelper::getProgrammeByCode(yii::app()->session['aciProCode']); ?></h6>
</div>
<hr/>

<?php $this->renderPartial($view,array('dataProvider'=>$dataProvider),FALSE,true); ?>