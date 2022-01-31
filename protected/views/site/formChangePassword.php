<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
        //'Faculty Activities'=>array('facultiesFunction/index'),
	'Change Password',
);
?>

<div class="span-24">
<div class="title span-18">
    <h3>Reset Password  </h3>
      
</div>
    




<div class="form span-20" >
<?php $form=$this->beginWidget('CActiveForm', array(
	//'id'=>'ChangePasswordForm',
    //'action'=>CController::createUrl('savePasswordByToken'),
	'enableClientValidation'=>true,
    'htmlOptions'=>(array('autocomplete'=>'off',)),
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
    
    
)); ?>
    
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
    
    
    
    
    <?php // echo CHtml::hiddenField('personID', $model->personID);
            echo $form->hiddenField($model,'resetToken');
    ?>

    
    
	<p class="note">Fields with <span class="required">*</span> are required.</p>
        
        <div class="row">
            
		<?php  echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('disabled'=>true)); ?>
		<?php echo $form->error($model,'username');  ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>
		
	</div>
	
        

	<div class="row">
		<?php echo $form->labelEx($model,'confirmPassword'); ?>
		<?php echo $form->passwordField($model,'confirmPassword'); ?>
		<?php echo $form->error($model,'confirmPassword'); ?>
		
	</div>
	 <div class="row">
            
		
		<?php echo $form->error($model,'msg');  ?>
	</div>
        
	<div class="row buttons">
		<?php  echo  CHtml::submitButton('submit', array('class' =>'btn btn-success btn-large','data-loading-text'=>'Loading...')); ?>
	</div>
 

<?php $this->endWidget(); ?>
</div><!-- form -->
</div>
<script type="">
  /*  $(()=>{
        
        $(window).on('click', ()=>{
            var x = document.getElementById("ChangePasswordForm_msg_em_").innerText;
         //var val = $('#ChangePasswordForm_msg_em_').innerText;   
         alert(x);       
                
                
        });
        
        
        
    });

    */
</script>