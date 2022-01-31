<?php
/* @var $this TermAdmissionController */
/* @var $model TermAdmission */

?>
<div class="title">
    
    <h4><strong>Term: </strong><span class="label label-info"><?php echo FormUtil::getTerm(yii::app()->session['MainCurTerm']); ?> </span><span class="label label-success"> <?php echo yii::app()->session['MainCurYear'];  ?></span></h4>
</div>
<hr/>

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
        'action'=>CController::createUrl('headsFunction/individualCourseReg'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	

	<div class="row">
	
            <span>Enter Student ID:</span>
		
                <?php 
            $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                 
                'name'=>'studentIDinReg',
               // 'source'=>array('111-115-001', '111-112-110', '111-112-100','211-115-001', '211-112-110','211-112-111', '311-112-100',),
                'source'=> Admission::searchAdmissionByDptID(yii::app()->session['MainDepartmentID']),
                'options'=>array(
                        'minLength'=>'7',
                    
                    ),
                'htmlOptions'=>array('required'=>true,'pattern'=>'([0-9][0-9][0-9]-[0-9][0-9][0-9]-[0-9][0-9][0-9])$','title'=>'ID have to be like [111-111-111]',
                       'style'=>'font-size:20px; height:25px;',),
            ));
            ?>
            
	</div>
        <div class="row">
            <?php echo Chtml::hiddenField('inRegTerm', yii::app()->session['MainCurTerm']); ?>
            <?php echo Chtml::hiddenField('inRegYear', yii::app()->session['MainCurYear']); ?>
        </div>
	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit' , array('class' => 'btn btn-primary btn-large','data-loading-text'=>'Loading....')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->



