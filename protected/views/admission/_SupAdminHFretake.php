<?php
/* @var $this TermAdmissionController */
/* @var $model TermAdmission */

?>

    
    <!--h4><strong>Term: </strong><span class="label label-info"><?php echo FormUtil::getTerm(yii::app()->session['MainCurTerm']); ?> </span><strong> Year: </strong> <span class="label label-success"> <?php echo yii::app()->session['MainCurYear'];  ?></span></h4-->



		 <?php if (Yii::app()->user->hasFlash('warning')):?>
			<div class="alert in alert-block fade alert-danger">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  <?php echo Yii::app()->user->getFlash('warning')?>
			</div>
		<?php endif;?>


<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'term-admission-form',
	'enableAjaxValidation'=>false,
        'enableClientValidation'=>true,
        'action'=>CController::createUrl('moduleRegistration/reTake'),
)); ?>


        <div class="row">
            <strong>Term:</strong> <br/>
                        <?php echo CHtml::radioButtonList('retakeTerm',  (yii::app()->session['retakeTerm']?yii::app()->session['retakeTerm']:FormUtil::getCurrentTerm()),  ZHtml::$Terms, array('labelOptions'=>array('style'=>'display:inline; font-size:20px; padding-right:10px'), 'separator'=>'  ',));  ?>

        </div>
        <div class="row">
        <strong>Year:</strong> <br/>
                        <?php  echo CHtml::dropDownList('retakeYear', (yii::app()->session['retakeYear']?yii::app()->session['retakeYear']:FormUtil::getYear(2008)), FormUtil::yearForDropDown(), 
                            array('prompt' => '--Please Select --',
                                'value' => '0',
                                'class'=>'span-10',
                       'style'=>'font-size:20px; height:40px;',
                                ));  ?>

        </div>
	

	
        
	

	<div class="row">
            
            <strong>Enter Student ID:</strong> <br/>
		
                <?php 
            $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                 
                'name'=>'studentID2',
               // 'source'=>array('111-115-001', '111-112-110', '111-112-100','211-115-001', '211-112-110','211-112-111', '311-112-100',),
                'source'=> Admission::searchAdmissionByDptID(yii::app()->session['MainDepartmentID']),
                'options'=>array(
                        'minLength'=>'7',
                    
                    ),
                'htmlOptions'=>array('required'=>true,'pattern'=>'([0-9][0-9][0-9]-[0-9][0-9][0-9]-[0-9][0-9][0-9])$','title'=>'ID have to be like [111-111-111]',
                      'style'=>'font-size:20px; height:25px;', ),
            ));
            ?>
            
	</div>
        <div class="row">
            <?php //echo Chtml::hiddenField('retakeTerm', yii::app()->session['MainCurTerm']); ?>
            <?php // echo Chtml::hiddenField('retakeYear', yii::app()->session['MainCurYear']); ?>
        </div>
	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit' , array('class' => 'btn btn-primary btn-large','data-loading-text'=>'Loading....')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->



