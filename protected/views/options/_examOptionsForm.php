<?php
/* @var $this OptionsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Options',
);

$this->menu=array(
	array('label'=>'Create Options', 'url'=>array('create')),
	array('label'=>'Manage Options', 'url'=>array('admin')),
        array('label'=>'Settings', 'url'=>array('inputSettings')),
        array('label'=>'User Settings', 'url'=>array('inputUserSettings')),
);
?>
<div class="title span-12">
    
        <h3>Examinations Settings</h3>      
    
    </div>

<hr/>
<?php
/* @var $this OptionController */
/* @var $model Options */

?>
		 <?php if (Yii::app()->user->hasFlash('warning')):?>
			<div class="alert in alert-block fade alert-danger">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  <?php echo Yii::app()->user->getFlash('warning')?>
			</div>
		<?php endif;?>


<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'settings-form',
	'enableAjaxValidation'=>false,
    'enableClientValidation'=>true,
    'action'=>CController::createUrl('examTypeSettings'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
	
       
        <div class="row">
	<strong>Supplementary Examination Type:</strong><br/>
	
	<?php 
	$accountStatus = array('2'=>'Regular', '3'=>'Special');
	$exam = Options::getOptions('current_supple_exam_type');
//	echo $exam;
	?>
		<?php echo CHtml::radioButtonList('examType','examType' ,  $accountStatus, array('labelOptions'=>array('style'=>'display:inline; padding-right:10px'), 'separator'=>'  ',));  ?>
            
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit' , array('class' => 'btn btn-primary btn-large','data-loading-text'=>'Loading....')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->



