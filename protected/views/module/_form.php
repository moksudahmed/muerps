<?php
/* @var $this ModuleController */
/* @var $model Module */
/* @var $form CActiveForm */
?>

<div class="form">
<?php
  $moduleGroup = array();
  
  //$moduleGroup = Options::model()->getControllerOptions('syllabus_module_group');
  //echo var_dump($moduleGroup);

?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'module-form',
	'enableAjaxValidation'=>false,
    'enableClientValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php  echo $form->errorSummary($model); ?>
        <div class="row">
		<?php echo $form->labelEx($model,'moduleCode'); ?>
		<?php echo $form->textField($model,'moduleCode',array('size'=>60,'maxlength'=>100,'required'=>TRUE,)); ?>
		<?php echo $form->error($model,'moduleCode'); ?>
	</div>
         
	<div class="row">
		<?php echo $form->labelEx($model,'mod_name'); ?>
		<?php echo $form->textField($model,'mod_name',array('size'=>60,'maxlength'=>100,'required'=>TRUE)); ?>
		<?php echo $form->error($model,'mod_name'); ?>
	</div>
        
	<div class="row">
		<?php echo $form->labelEx($model,'mod_shortName'); ?>
		<?php echo $form->textField($model,'mod_shortName',array('size'=>60,'maxlength'=>100,'required'=>FALSE)); ?>
		<?php echo $form->error($model,'mod_shortName'); ?>
	</div>



	<div class="row">
		<?php echo $form->labelEx($model,'mod_type'); ?>
		<?php echo ZHtml::enumActiveRadioButtonList(
                            $model,
                            'mod_type',
                            
                            array('rel'=>'type','labelOptions'=>array('style'=>'display:inline; padding-right:10px'), 'separator'=>'  ',) 
       
                        ); ?>
		<?php echo $form->error($model,'mod_type'); ?>
	</div>

	<div id="type" class="row">
		<?php  echo $form->labelEx($model,'mod_labIncluded'); ?>
		<?php echo ZHtml::enumActiveRadioButtonList(
                            $model,
                            'mod_labIncluded',
                            
                            array('labelOptions'=>array('style'=>'display:inline; padding-right:10px'), 'separator'=>'  ',) 
       
                        ); ?>
		<?php echo $form->error($model,'mod_labIncluded'); ?>
	</div>

        
        
	<div class="row">
		<?php echo $form->labelEx($model,'mod_creditHour'); ?>
		<?php echo ZHtml::enumActiveRadioButtonList(
                            $model,
                            'mod_creditHour',
                            
                            array('labelOptions'=>array('style'=>'display:inline; padding-right:10px'), 'separator'=>'  ',) 
       
                        ); ?>
		<?php echo $form->error($model,'mod_creditHour'); ?>
	</div>
        
	<div class="row">
		<?php echo $form->labelEx($model,'mod_mejor'); ?>
		<?php echo ZHtml::enumActiveRadioButtonList(
                            $model,
                            'mod_mejor',
                            
                            array('labelOptions'=>array('style'=>'display:inline; padding-right:10px'), 'separator'=>'  ',) 
       
                        ); ?>
		<?php echo $form->error($model,'mod_mejor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mod_group'); ?>
		<?php echo ZHtml::enumActiveDropDownList(
                            $model,
                            'mod_group',
                            
                            array()
       
                        ); ?>
		<?php echo $form->error($model,'mod_group'); ?>
	</div>
        <div class="row">
		<?php echo $form->labelEx($model,'mod_prerequisite'); ?>
		<?php echo $form->textField($model,'mod_prerequisite',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'mod_prerequisite'); ?>
	</div>
        <div class="row">
		<?php  echo $form->labelEx($model,'mod_sequence'); ?>
		<?php echo $form->textField($model,'mod_sequence',array('size'=>10,'maxlength'=>10,'required'=>FALSE)); ?>
		<?php echo $form->error($model,'mod_sequence');  ?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Continue' : 'Save', array('class' => 'btn btn-primary btn-large','data-loading-text'=>'Loading....')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script type="text/javascript">
$( "input[rel='type']").on( "click", function()
    {
        
        
    if ( $(this).attr('value')=='None Lab' ){//alert('dd');
        $("#type").show('slow');
        $("#Module_mod_creditHour_4").attr('checked',true);
    }
    else 
        {
            $("#type").hide('slow');

            $("#Module_mod_labIncluded_1").attr('checked',true);
            $("#Module_mod_creditHour_1").attr('checked',true);
        }
        

    } );
    
    </script>