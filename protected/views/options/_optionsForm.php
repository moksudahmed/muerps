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
    
        <h3>Settings</h3>      
    
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
        'action'=>CController::createUrl('settings'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
	
       
        <div class="row">
	<strong>Group:</strong><br/>
		<?php  echo CHtml::dropDownList('groupName','groupName', FormUtil::getOptionGroup(), 
                    array('prompt' => '--Please Select --',
                        //'value' => '0',
                        'class'=>'span-10',
                       'style'=>'font-size:20px; height:40px;',
                        ));  ?>
        </div>
	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit' , array('class' => 'btn btn-primary btn-large','data-loading-text'=>'Loading....')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->



