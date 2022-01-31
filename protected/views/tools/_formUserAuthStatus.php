
<?php
/* @var $this ToolsController */
/* @var $model Tools */



$this->breadcrumbs=array(
	'Tools',
);
?>
<script>
    $(document).ready(function(){
            $("div#group").hide();
            $("input#userType_0").on("click",()=>{
                //alert("Bismillah Hir Rahmanir Rahim");
                $("div#group").hide("slow");
            });
            
            $("input#userType_1").on("click",()=>{
                //alert("Allah Hu Ak Bar");
                $("div#group").show("slow");
            });
        } );
    
</script>
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
        'action'=>CController::createUrl('tools/userAuthStatus'),
)); ?>

        <div class="row ">
            <strong>User Type: </strong> <br/>              
                    
            <?php echo CHtml::radioButtonList('userType',0,array(0=>'Employee',1=>'Faculty'), array('labelOptions'=>array('style'=>'display:inline; font-size:20px; padding-right:10px'), 'separator'=>'  ','required'=>true)); ?>
              
	</div>
        <div id="group" class="row" >
	<strong>Group:</strong><br/>
		<?php  echo CHtml::dropDownList('departmentID','dpt_name', FormUtil::getOptionDepartment(), 
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



