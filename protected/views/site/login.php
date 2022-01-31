<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>

<h1>Login</h1>



<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	//'id'=>'loginFormInit',
        //'formName'=>'loginForm',
	'enableClientValidation'=>true,
        //'action'=>CController::createUrl('site/loginInit'),
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
    'htmlOptions'=>(array('autocomplete'=>'off',)),
)); ?>

	

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username'); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>
		
	</div>

	<div class="row rememberMe">
		<?php echo $form->checkBox($model,'rememberMe'); ?>
		<?php echo $form->label($model,'rememberMe'); ?>
		<?php echo $form->error($model,'rememberMe'); ?>
	</div>
        
        
        <div id="data" class="row buttons">
        <?php // echo CHtml::ajaxButton('OTG', CController::createUrl('site/loginOTP'), array('type'=>'POST','update'=>'#otp'), array('class' =>'btn btn-success btn-large','data-loading-text'=>'Loading...')); ?>
	
	
	<?php  echo  CHtml::submitButton('login', array('class' =>'btn btn-success btn-large','data-loading-text'=>'Loading...')); ?>	
        </div>
        

<?php $this->endWidget(); ?>
</div><!-- form -->
