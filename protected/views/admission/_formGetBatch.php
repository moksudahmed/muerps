<?php
/* @var $this AdministrationController */
/* @var $model Administration */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'admission-form2',
	'enableAjaxValidation'=>true,
        'action'=>CController::createUrl('index'),
)); 




?>





        
	<div class="row">
		
            	<?php echo CHtml::dropDownList('sectionName','sectionName', CHtml::listData($data,
                   'sec','sectionName','group'),array(
                    'prompt' => '--Select Batch First--',
                        'value' => '0',
                       'required'=>true,
                       'style'=>'text-align:left;',
                    /*'ajax' => array(
                    'type'=>'POST', //request type
                    'url'=>CController::createUrl('admission/create'), //url to call.
                    //Style: CController::createUrl('currentController/methodToCall')
                    'update'=>'#form', //selector to update
                    //'data'=>'js: $(this).val()' 
                    //leave out the data key to pass all form values through
                    )*/ ));?>
	</div>
        <div class="row btn-large">
           <?php  
            echo CHtml::submitButton('Submit', array('class' => 'btn btn-primary btn-large'));
           ?>
        </div>
        
        
<?php $this->endWidget(); ?>

</div><!-- form -->