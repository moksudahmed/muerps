<?php
/* @var $this ModuleRegistrationController */
/* @var $model ModuleRegistration */

    $this->breadcrumbs=array(
	'Examination'=>array('examDepartment/index'),
	
    
        'Registration'
);




?>

<div class="title span-20">
    <h3 ><?php echo FormUtil::getExamName( yii::app()->session['exrType'])?> Examination Registration</h3>    
    <h4>Term:  <span class="label label-warning"><?php echo FormUtil::getTerm( yii::app()->session['exrTerm'])?> </span> <span class="label label-success"> <?php echo yii::app()->session['exrYear'];?></span></h4>
</div>
<div class="span-4" >
            <?php 
        //$backUrl = (!yii::app()->session['mreUrlFlag']?Yii::app()->controller->createUrl('person/searchEngine'):Yii::app()->controller->createUrl('varifyMarks',array('offeredID'=>yii::app()->session['mreOfmID'])));
        $backUrl = Yii::app()->controller->createUrl('examDepartment/index');
        $this->widget('bootstrap.widgets.TbMenu', array(
                'type'=>'pills',
                'items'=>array(
                        array('label'=>'Back', 'icon'=>'icon-arrow-left' , 'url'=>$backUrl, 'linkOptions'=>array('data-toggle'=>'tooltip','data-placement'=>'right', 'title'=>'Home',), 'visible'=>true),	
                        //array('label'=>'password', 'icon'=>'icon-edit', 'url'=>Yii::app()->controller->createUrl('site/changePassword'),'linkOptions'=>array(), 'visible'=>true),
                        //array('label'=>'PDF', 'icon'=>'icon-print', 'url'=>Yii::app()->controller->createUrl('AcademicRecordPDF'),'linkOptions'=>array('target'=>'_blank'), 'visible'=>true),

                ),
        ));

        ?>
</div>
    <!--h5>Examination:    <span class="label label-info">Supplementary</span></h5-->
<div class="span-14">

	<h5>
		 <?php if (Yii::app()->user->hasFlash('warning')):?>
			<div class="alert in alert-block fade alert-danger">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  <?php echo Yii::app()->user->getFlash('warning')?>
			</div>
		<?php endif;?>
    
                <?php if (Yii::app()->user->hasFlash('success')):?>
			<div class="alert in alert-block fade alert-success">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  <?php echo Yii::app()->user->getFlash('success')?>
			</div>
		<?php endif;?>
</h5>


<div class="form">

                
    
        <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'term-admission-form',
	'enableAjaxValidation'=>false,
        'enableClientValidation'=>true,
        'action'=>CController::createUrl('examRegistration/Supplementary'),
        )); ?>

	

	
<div class="row">
	
	
            <span style="font-weight:bold;font-size:25px;">Student ID:</span>
		
                <?php   
                
                    echo Chtml::hiddenField('retakeTerm', yii::app()->session['MainCurTerm']); 
                    echo Chtml::hiddenField('retakeYear', yii::app()->session['MainCurYear']); 
        
                    $this->widget('zii.widgets.jui.CJuiAutoComplete', array(

                    'name'=>'regStudentID',
                   // 'source'=>array('111-115-001', '111-112-110', '111-112-100','211-115-001', '211-112-110','211-112-111', '311-112-100',),
                    'source'=> Admission::searchAdmissionByDptID(yii::app()->session['MainDepartmentID']),
                    'options'=>array(
                            'minLength'=>'7',

                        ),
                    'htmlOptions'=>array('required'=>true,'pattern'=>'([0-9][0-9][0-9]-[0-9][0-9][0-9]-[0-9][0-9][0-9])$','title'=>'ID have to be like [111-111-111]',
                        'style'=>'height:30px; font-size:25px; margin-right:10px;',   

                        ),
                    ));
            ?>
            
	
        
		<?php echo CHtml::submitButton('Submit' , array('class' => 'btn btn-primary btn-large','data-loading-text'=>'Loading....')); ?>
            
</div>


                <?php $this->endWidget(); ?>

                </div>
  </div>     