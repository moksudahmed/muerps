<?php

$this->breadcrumbs=array(
	'Department Activities'=>array('headsFunction/index'),
        
        'Course Authentication'=>array('headsFunction/courseAuthentication'),
        'Registered Students'=>array('headsFunction/RegStudentToCourse'),
	'Assing New Students'
);

?>

<div class="title span-20">
            <h3>Assign New Students</h3>
            <h4> <?php echo FormUtil::getBatchTermHTMLspan(yii::app()->session['caSectionName'],yii::app()->session['caBatchName'],yii::app()->session['rePublishProCode'] ); ?></h4>
            
            <h4><strong>Course: </strong><span class="label label-success"><?php echo yii::app()->session['caModule']; ?></span></h4>
            <h4><strong>Faculty Name: </strong><span class="label label-info"><?php echo yii::app()->session['caFacultyName']; ?></span></h4>
           
      
</div>
<div class="title span2">
    <h4>
    
    <span class="label label-warning"><?php echo FormUtil::getTerm(yii::app()->session['caTerm']); ?> </span>
        <span class="label label-success"> <?php echo yii::app()->session['caYear'];  ?></span>
        
        <strong style="letter-spacing:3px;">Selected Term </strong></h4>
    <h6>Programme:<?php  echo DBhelper::getProgrammeByCode(yii::app()->session['rePublishProCode']); ?></h6>
    <?php
            $this->widget('bootstrap.widgets.TbMenu', array(
	'type'=>'pills',
	'items'=>array(
		
	//array('label'=>'Generate 100 Mark Sheet', 'icon'=>'icon-download', 'url'=>Yii::app()->controller->createUrl('GenerateFirstHalfPDF'), 'linkOptions'=>array('target'=>'_blank'), 'visible'=>true),
        array('label'=>'Back', 'icon'=>'icon-arrow-left' , 'url'=>Yii::app()->controller->createUrl('headsFunction/RegStudentToCourse'), 'linkOptions'=>array('data-toggle'=>'tooltip','data-placement'=>'top', 'title'=>'RegStudentToCourse',), 'visible'=>true),	
	//array('label'=>'Next', 'icon'=>'icon-play-circle', 'url'=>Yii::app()->controller->createUrl('resultSheet'), 'linkOptions'=>array('data-toggle'=>'tooltip','data-placement'=>'right', 'title'=>'Get Result') , 'visible'=>true, ),	
	),
    )); ?>
</div>
<hr/>

       

<?php 

    
    $this->renderPartial('_assaignStudentToCourse',array(
                    'dataProvider'=>$dataProvider
                    ));?>

