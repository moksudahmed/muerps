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
    
        <h3>User Settings</h3>      
    
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
        'action'=>CController::createUrl('userSettings'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
	
        <div class="row ">
            <strong>Examination: </strong> <br/>              
                    
            <?php echo CHtml::radioButtonList('userType','',array('Employee'=>'Employee','Faculty'=>'Faculty'), array('labelOptions'=>array('style'=>'display:inline; font-size:20px; padding-right:10px'), 'separator'=>'  ','required'=>true)); ?>
              
	</div>
        <div class="row">
	<strong>Group:</strong><br/>
		<?php  echo CHtml::dropDownList('dpt_name','dpt_name', FormUtil::getOptionDepartment(), 
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



