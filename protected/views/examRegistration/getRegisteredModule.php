<?php
/* @var $this ModuleController */
/* @var $model Module */

$this->breadcrumbs=array(
    'Department Functions'=>array('offeredModule/index'),
	'Select Module'
);

$this->menu=array(
    array('label'=>'Create Module', 'url'=>array('create')),

	
);



?>






    <div class="title ">
        <div class="span-18">
            <h3 >Marks Checking or Update: </h3>
             <?php if (Yii::app()->user->hasFlash('success')):?>
			<div class="alert in alert-block fade alert-success">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  <?php echo Yii::app()->user->getFlash('success')?>
			</div>
		<?php endif;?>
    
                <?php if (Yii::app()->user->hasFlash('warning')):?>
			<div class="alert in alert-block fade alert-danger">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  <?php echo Yii::app()->user->getFlash('warning')?>
			</div>
		<?php endif;?>
            
            
            
                <div class="form">
        
                    <?php $form=$this->beginWidget('CActiveForm', array(
                            'id'=>'offerModule-form1',
                            'enableAjaxValidation'=>true,
                         'action'=>CController::createUrl('examRegistration/GetRegModuleMarksList'),
                    )); ?>
                    
                    <?php
                        
                    ?>
                    
                <div class="row" >
            
                    <h4><strong>Term: </strong><span class="label label-success"> <?php echo FormUtil::getTerm(yii::app()->session['mreTerm']); ?>  </span><strong>Year: </strong><span class="label label-info"> <?php echo yii::app()->session['mreYear']; ?></span></h4>
                    <h4><strong>Select Module:</strong></h4>

                    <?php echo CHtml::dropDownList('offeredModuleID',yii::app()->session['mreOfmID'], 
                        CHtml::listData(FormUtil::getRegisteredModuleNameCode($ofmModule),'offeredModuleID','mod_name','mod_group')
                        ,array(
                        'prompt' => '--Please Select --',
                        'value' => '0',
                            'required'=>true
                    )); ?>
                    <?php // echo $form->error($admission,'batchName'); ?>
                </div>
                    <div class="row">
                        <strong>Marks Checking or Update:</strong><br/>
                        <?php echo CHtml::radioButtonList('mreHalf', (yii::app()->session['mreHalf']?yii::app()->session['mreHalf']:1) ,  array(1=>'60(Attendance + Class Test + Midterm)',2=>'40(Final)',3=>'Old Student Entry (60+40)'), array('labelOptions'=>array('style'=>'display:inline; padding-right:10px'), 'separator'=>'  ',));  ?>
                </div>
                <div class="row" >

                    <?php  
                     echo CHtml::submitButton('Continue', array('class' => 'btn btn-primary btn-large'));
                    ?>
                </div>
                
                <?php $this->endWidget(); ?>
            </div>
        </div>
        <div class="span-7">
            <h4><strong>Batch: </strong><span class="label label-success"> <?php echo yii::app()->session['mreBatch'].FormUtil::getBatchNameSufix(yii::app()->session['mreBatch']); ?>  </span><strong>Section: </strong><span class="label label-important"> <?php echo yii::app()->session['mreSection']; ?></span></h4>
            <h6>Programme:  <?php  echo DBhelper::getProgrammeByCode(yii::app()->session['mreProCode']); ?></h6>

        </div>
</div>



