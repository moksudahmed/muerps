<?php
/* @var $this TermAdmissionController */
/* @var $model TermAdmission */

$this->breadcrumbs=array(
       'Exam '=>array('examRegistration/index'),
	'Admit Card',
	
);

?>

<div class="title span-18">
    <h3>Generate Admit Card</h3>  
    <h4>Term: <span class="label label-warning"><?php echo FormUtil::getTerm(yii::app()->session['aciTerm']); ?> </span><span class="label label-success"> <?php echo yii::app()->session['aciYear'];  ?></span></h4>
</div>

<div class="span-14">
    <!--h5>Examination:    <span class="label label-info">Supplementary</span></h5-->


	<h5>
		 <?php if(Yii::app()->user->hasFlash('warning')):?>
			<div class="alert in alert-block fade alert-danger">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  <?php echo Yii::app()->user->getFlash('warning')?>
			</div>
		<?php endif;?>
    
                <?php if(Yii::app()->user->hasFlash('success')):?>
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
        'action'=>CController::createUrl('generateAdmitCard'),
)); ?>
	

	<div class="row">
	
            <span style="font-weight:bold;font-size:25px;">Student ID:</span>
		
                <?php 
            $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                 
                'name'=>'studentID',
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
            
	
		<?php echo CHtml::submitButton('Generate' , array('class' => 'btn btn-primary btn-large','data-loading-text'=>'Loading....')); ?>

        </div>

<?php $this->endWidget(); ?>

</div><!-- form -->
</div>


