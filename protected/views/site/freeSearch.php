<?php
/* @var $this PersonController */
/* @var $model Person */
/* @var $form CActiveForm */
 
/*You need to change the URL as per your requirements, else this will show error page*/
//$model_name=Yii::app()->controller->id;
//$current_url=$baseUrl."/".$model_name;
 
/*To Send the additional data if needed*/
//$reference_id = 88;
//$customer_id = 77;


?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'search_form',
	'enableAjaxValidation'=>true,
    'action'=>CController::createUrl('person/searchEngine'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<input  name="query" type="text" id="faq_search_input" style="background-color: #FFFFFF" />
	</div>

	

	<div class="row buttons">
            <?php echo CHtml::submitButton('Submit' , array('class' => 'btn btn-primary btn-large','data-loading-text'=>'Loading....')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
