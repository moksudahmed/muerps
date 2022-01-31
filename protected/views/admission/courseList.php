<?php
/* @var $this TermAdmissionController */
/* @var $model TermAdmission */

$this->breadcrumbs=array(
        'Student\'s Info'=>array('admission/studentsInfo'),
	'Term Advising'=>array('termAdvising/index'),
	'Advised Terms',
);

$this->menu=array(
	array('label'=>'List TermAdmission', 'url'=>array('index')),
	array('label'=>'Manage TermAdmission', 'url'=>array('admin')),
);

$today= date('Y-m-d');
//echo $today;

?>

	
<div class="title span-18" >
            <h3 class="title">Advised Terms</h3>
                <h4><strong>ID: </strong><span class="label label-info"><?php echo yii::app()->session['studentID']; ?> </span><br/></h4>
            <h4>    <strong>Name: </strong> <span class="label label-success "><?php  //echo yii::app()->session['studentName']; ?></span></h4>
    <h4> <?php echo FormUtil::getBatchTermHTMLspan($sectionName, $batchName, $programmeCode)  ?></h4>
            <!--h4><strong>Section: </strong><span class="label label-important"> <?php echo $sectionName; ?></span><strong>Batch: </strong><span class="label label-success"> <?php echo $batchName.FormUtil::getBatchNameSufix($batchName); ?>  </span></h4-->
            
            
</div>
<div class="title span-12">
    <h4><span class="label label-warning"><?php echo FormUtil::getTerm(yii::app()->session['traTerm']); ?> </span><span class="label label-success"> <?php echo yii::app()->session['traYear'];  ?></span><strong style="letter-spacing:3px;">Selected Term </strong></h4>
    <h6>Programme:<?php  echo DBhelper::getProgrammeByCode($programmeCode); ?></h6>
    <?php 
            $this->widget('bootstrap.widgets.TbMenu', array(
                    'type'=>'pills',
                    'items'=>array(

                            //array('label'=>'Back', 'icon'=>'icon-left-arrow', 'url'=>Yii::app()->controller->createUrl('invoicePDF'), 'linkOptions'=>array('target'=>'_blank'), 'visible'=>true),
                            array('label'=>'Back', 'icon'=>'icon-arrow-left' , 'url'=>Yii::app()->controller->createUrl('admission/studentsInfo'), 'linkOptions'=>array('data-toggle'=>'tooltip','data-placement'=>'top', 'title'=>'Term Advising',), 'visible'=>true),	
                    ),
            ));

     ?>
</div>
    
<hr/>
<div class="form">
        
                    <?php $form=$this->beginWidget('CActiveForm', array(
                            'id'=>'offerModule-form1',
                            'enableAjaxValidation'=>true,
                         'action'=>CController::createUrl('GetObsulateCourse'),
                    )); ?>
                    
                    <?php
                        
                    ?>
                    
    	
	<?php 
        
        
        //    echo CHtml::hiddenField('mreTerm', yii::app()->session['MainCurTerm']);
         //   echo CHtml::hiddenField('mreYear', yii::app()->session['MainCurYear']);
       // echo $sectionName; exit();
        //  echo var_dump($programmeCode); exit();
        ?>
    
    
                <div class="row" >
                    <div class="title span-8"><h2>Select Module</h2></div>
                   <?php echo CHtml::dropDownList('moduleCode','moduleCode', 
                        CHtml::listData(FormUtil::getOldSyllabusModule($id,$sectionName,$batchName,$programmeCode),'offeredModuleID','moduleCode')
                        ,array(
                        'prompt' => '--Please Select --',
                        'value' => '0',
                            'class'=>'span-14',
                       'style'=>'font-size:16px; height:40px;',
                            'required'=>true
                    )); ?>
                    <?php // echo $form->error($admission,'batchName'); ?>
                </div>
                    
                <div class="row" >

                    <?php  
                     echo CHtml::submitButton('Continue', array('class' => 'btn btn-primary btn-large'));
                    ?>
                </div>
                
                <?php $this->endWidget(); ?>
            </div>