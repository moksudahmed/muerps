<?php
/* @var $this ModuleController */
/* @var $model Module */

$this->breadcrumbs=array(
    'Department Activities'=>array('headsfunction/index'),
    'Select Term'=>array('headsfunction/selectTerm'),
	'Select Course'
);


?>





<div class="title span-20">
            <h3 class="title">Select Course</h3>
            <h4><strong>Batch: </strong><span class="label label-success"> <?php echo yii::app()->session['batNameOfm'].FormUtil::getBatchNameSufix(yii::app()->session['batNameOfm']); ?>  </span><strong>Section: </strong><span class="label label-important"> <?php echo yii::app()->session['secNameOfm']; ?></span></h4>
            <h6><strong>Academic Term: </strong><span class="label label-info"><?php echo FormUtil::getTerm(yii::app()->session['acTermOfm']); ?> </span><span class="label label-success"> <?php echo yii::app()->session['acYearOfm'];  ?></span></h6>        
        <?php 
$this->widget('bootstrap.widgets.TbMenu', array(
	'type'=>'pills',
	'items'=>array(
            array('label'=>'Back', 'icon'=>'icon-arrow-left' , 'url'=>Yii::app()->controller->createUrl('headsfunction/selectTerm'), 'linkOptions'=>array('data-toggle'=>'tooltip','data-placement'=>'top', 'title'=>'Select Term',), 'visible'=>true),	
           // array('label'=>'XLS', 'icon'=>'icon-download' , 'url'=>Yii::app()->controller->createUrl('OfferedCourseListXLS'), 'linkOptions'=>array('style'=>'text-weight:bold;','data-toggle'=>'tooltip','data-placement'=>'top', 'title'=>'Download',), 'visible'=>true),	
  
               
	),
));
?>     
</div>
<div class="title span2">
    <h4>
    <span class="label label-info"> <?php echo FormUtil::getTermNumberWithSufix(yii::app()->session['batNameOfm'], yii::app()->session['proCodeOfm'],yii::app()->session['batTermOfm'] , yii::app()->session['batYearOfm']);  ?></span>
    <span class="label label-warning"><?php echo FormUtil::getTerm(yii::app()->session['batTermOfm']); ?> </span>
        <span class="label label-success"> <?php echo yii::app()->session['batYearOfm'];  ?></span>
        
        <strong style="letter-spacing:3px;">Selected Term </strong></h4>
    <h6>Programme:<?php  echo DBhelper::getProgrammeByCode(yii::app()->session['proCodeOfm']); ?></h6>
</div>
<hr/>
<div class="span-18">
 <?php  

 
 $this->widget('bootstrap.widgets.TbButtonGroup', array(
    'buttons'=>array(
               array('label'=>'Not Offered', 'url'=>'#','htmlOptions'=>array('class'=>'btn btn-medium btn-danger',)),
               array('label'=>'Offered',  'url'=>array('offeredModule/offered'),'htmlOptions'=>array('class'=>'btn btn-medium ',)),
                array('label'=>'All Offered', 'url'=>array('offeredModule/allOffered'),'htmlOptions'=>array('class'=>'btn btn-medium ',))
            )
        )
     );

?>
</div>
<?php

    $this->renderPartial('_NotOffered',array('dataProvider'=>$dataProvider));
?>