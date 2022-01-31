<?php
/* @var $this ModuleRegistrationController */
/* @var $model ModuleRegistration */

$this->breadcrumbs=array(
   'Student\'s Info'=>array('admission/studentsInfo'),
	'Term Advising'=>array('termAdvising/index'),
        'Advised Terms' =>array('termAdvising/admittedTerms'),
	'Course Advising',
	
);



?>


<div class="title span-20" >
            <h3 >Course Advising</h3>
            <h4>ID: <span class="label label-important"><?php echo yii::app()->session['studentID']; ?> </span><br/></h4>
            <h4>Name: <span class="label label-success "><?php  echo yii::app()->session['studentName']; ?></span></h4>
            
            <!--h5><strong>Section: </strong><span class="label label-important"> <?php echo yii::app()->session['secName']; ?></span><strong>Batch: </strong><span class="label label-success"> <?php echo yii::app()->session['batName'].FormUtil::getBatchNameSufix(yii::app()->session['batName']); ?>  </span></h5-->
            <h4> <?php echo FormUtil::getBatchTermHTMLspan(yii::app()->session['secName'], yii::app()->session['batName'], yii::app()->session['proCode'])  ?></h4>
            
</div>
<div class="title span2">
    
    <h4>
        <span class="label label-info"><?php    echo     FormUtil::getTermNumberWithSufix(yii::app()->session['batName'],yii::app()->session['proCode'],yii::app()->session['traTerm'],yii::app()->session['traYear']); ?></span>
            
        <span class="label label-warning">
        <?php echo FormUtil::getTerm(yii::app()->session['traTerm']); ?> </span>
        <span class="label label-success"> <?php echo yii::app()->session['traYear'];  ?></span>
        <strong style="letter-spacing:3px;">Selected Term </strong></h4>
    <h6>Programme:<?php  echo DBhelper::getProgrammeByCode(yii::app()->session['proCode']); ?></h6>
</div>

<hr/>


<?php $this->renderPartial($view,array('model'=>$model,'dataProvider'=>$dataProvider,'flag'=>$flag)); ?>

