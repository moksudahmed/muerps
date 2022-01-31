<?php
/* @var $this ModuleController */
/* @var $model Module */

$this->breadcrumbs=array(
    'Examination'=>array('examDepartment/index'),
	
    
        'Registration'=>array('examRegistration/ERExamRegistrationSupple'),
	'Supplementary'
);


?>





<div class="title span-20">
            <h3 ><?php echo FormUtil::getExamName( yii::app()->session['exrType'])?> Examination Registration</h3>
            <h4>ID: <span class="label label-info"><?php echo yii::app()->session['regStudentID']; ?> </h4>
            <h4>Name: <span class="label label-success "><?php  echo yii::app()->session['studentName']; ?></h4>
            
            <h4>Section: <span class="label label-important"> <?php echo yii::app()->session['secName']; ?></span><strong>Batch: </strong><span class="label label-success"> <?php echo yii::app()->session['batName'].FormUtil::getBatchNameSufix(yii::app()->session['batName']); ?>  </h4>
            <h4>Academic Term: <span class="label label-info"><?php echo FormUtil::getTerm(yii::app()->session['acTerm']); ?> </span><span class="label label-success"> <?php echo yii::app()->session['acYear'];  ?></h4>        
            
</div>
<div class="title span2">
    <h4><span class="label label-warning"><?php echo FormUtil::getTerm(yii::app()->session['exrTerm']); ?> </span><span class="label label-success"> <?php echo yii::app()->session['exrYear'];  ?></span><strong style="letter-spacing:3px;">Selected Term </strong></h4>
    <h6>Programme:<?php  echo DBhelper::getProgrammeByCode(yii::app()->session['proCode']); ?></h6>
    <div>
        <?php 

    $this->widget('bootstrap.widgets.TbMenu', array(
            'type'=>'pills',
            'items'=>array(
                    array('label'=>'Back', 'icon'=>'icon-arrow-left' , 'url'=>Yii::app()->controller->createUrl('examRegistration/ERExamRegistrationSupple'), 'linkOptions'=>array('data-toggle'=>'tooltip','data-placement'=>'top', 'title'=>'Registration',), 'visible'=>true),	
                    array('label'=>'Next', 'icon'=>'icon-arrow-right' , 'url'=>Yii::app()->controller->createUrl('examRegistration/SuppleRegList'), 'linkOptions'=>array('data-toggle'=>'tooltip','data-placement'=>'top', 'title'=>'Registered Course',), 'visible'=>true),	
                    array('label'=>'PDF', 'icon'=>'icon-print', 'url'=>Yii::app()->controller->createUrl('examRegistration/supplementaryPDF'),'linkOptions'=>array('data-toggle'=>'tooltip','data-placement'=>'top', 'title'=>'Admit Card','target'=>'_blank'), 'visible'=>true),
                    //array('label'=>'Transcript', 'icon'=>'icon-print', 'url'=>Yii::app()->controller->createUrl('transcriptPDF'), 'linkOptions'=>array('target'=>'_blank','data-toggle'=>'tooltip','data-placement'=>'right', 'title'=>'PDF',), 'visible'=>true),

            ),
    ));

    ?>
    </div>
</div>

<hr/>






<div id="success" class="span-24">

    


<?php

    $this->renderPartial($view,array('dataProvider'=>$dataProvider),false,false);
?>


  
</div>    