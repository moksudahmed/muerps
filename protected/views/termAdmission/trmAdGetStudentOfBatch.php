<?php

$this->breadcrumbs=array(
	'Student\'s Info'=>array('admission/studentInfo'),
        
//        'Course Authentication'=>array('headsFunction/courseAuthentication'),

	'Term Admission Advance'
);

?>

<div class="title span-20">
            <h3>Term Admission Advance</h3>
            <h4> <?php echo FormUtil::getBatchTermHTMLspan(yii::app()->session['traSecNameAdv'],yii::app()->session['traBatNameAdv'],yii::app()->session['traProCodeAdv'] ); ?></h4>
            
           
           
      
</div>
<div class="title span2">
    <h4>
    
    <span class="label label-warning"><?php echo FormUtil::getTerm(yii::app()->session['traTermAdv']); ?> </span>
        <span class="label label-success"> <?php echo yii::app()->session['traYearAdv'];  ?></span>
        
        <strong style="letter-spacing:3px;">Selected Term </strong></h4>
    <h6>Programme:<?php  echo DBhelper::getProgrammeByCode(yii::app()->session['traProCodeAdv']); ?></h6>
    <?php
            $this->widget('bootstrap.widgets.TbMenu', array(
	'type'=>'pills',
	'items'=>array(
		
	//array('label'=>'Generate 100 Mark Sheet', 'icon'=>'icon-download', 'url'=>Yii::app()->controller->createUrl('GenerateFirstHalfPDF'), 'linkOptions'=>array('target'=>'_blank'), 'visible'=>true),
        array('label'=>'Back', 'icon'=>'icon-arrow-left' , 'url'=>Yii::app()->controller->createUrl('admission/studentsInfo'), 'linkOptions'=>array('data-toggle'=>'tooltip','data-placement'=>'top', 'title'=>'Student\'s Info',), 'visible'=>true),	
	//array('label'=>'Next', 'icon'=>'icon-play-circle', 'url'=>Yii::app()->controller->createUrl('resultSheet'), 'linkOptions'=>array('data-toggle'=>'tooltip','data-placement'=>'right', 'title'=>'Get Result') , 'visible'=>true, ),	
	),
    )); ?>
</div>
<hr/>

       

<?php 

    
    $this->renderPartial('_noneAdmittedStudent',array(
                    'dataProvider'=>$dataProvider
                    ));?>

