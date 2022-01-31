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
    <div class="span-4"  >
            <?php 
        //$backUrl = (!yii::app()->session['mreUrlFlag']?Yii::app()->controller->createUrl('person/searchEngine'):Yii::app()->controller->createUrl('varifyMarks',array('offeredID'=>yii::app()->session['mreOfmID'])));
        $backUrl = Yii::app()->request->urlReferrer;
        $this->widget('bootstrap.widgets.TbMenu', array(
                'type'=>'pills',
                'items'=>array(
                        //array('label'=>'Back', 'icon'=>'icon-arrow-left' , 'url'=>$backUrl, 'linkOptions'=>array('data-toggle'=>'tooltip','data-placement'=>'right', 'title'=>'Faculty Activities',), 'visible'=>true),	
                        array('label'=>'Back', 'icon'=>'icon-arrow-left' , 'url'=>$backUrl, 'linkOptions'=>array('data-toggle'=>'tooltip','data-placement'=>'right',), 'visible'=>true),	
                        //array('label'=>'password', 'icon'=>'icon-edit', 'url'=>Yii::app()->controller->createUrl('site/changePassword'),'linkOptions'=>array(), 'visible'=>true),
                        //array('label'=>'PDF', 'icon'=>'icon-print', 'url'=>Yii::app()->controller->createUrl('AcademicRecordPDF'),'linkOptions'=>array('target'=>'_blank'), 'visible'=>true),

                ),
        ));

        ?>
        </div>



<div class="form span-20" >
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'changePassword-form',
	'enableClientValidation'=>true,
        'htmlOptions'=>(array('autocomplete'=>'off')),
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
    
    'action'=>CController::createUrl('savePassword'),
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

	<p class="note">Fields with <span class="required">*</span> are required.</p>
        
        <div class="row">
            
		<?php  echo $form->labelEx($modelf,'loginID'); ?>
		<?php echo $form->textField($modelf,'loginID',array('disabled'=>true)); ?>
		<?php echo $form->error($modelf,'loginID');  ?>
	</div>
        <div class="row">
		<?php echo $form->labelEx($modelf,'usr_password'); ?>
		<?php echo $form->passwordField($modelf,'usr_password'); ?>
		<?php echo $form->error($modelf,'usr_password'); ?>
		
	</div>
        <div class="row">
		<?php echo $form->labelEx($modelf,'usr_newPassword'); ?>
		<?php echo $form->passwordField($modelf,'usr_newPassword'); ?>
		<?php echo $form->error($modelf,'usr_newPassword'); ?>
		
	</div>
	
        

	<div class="row">
		<?php echo $form->labelEx($modelf,'confirmPassword'); ?>
		<?php echo $form->passwordField($modelf,'confirmPassword'); ?>
		<?php echo $form->error($modelf,'confirmPassword'); ?>
		<p class="hint">
			Password should be minimum 8 characters long.
		</p>
	</div>
	
        
	<div class="row buttons">
		<?php  echo  CHtml::submitButton('submit', array('class' =>'btn btn-success btn-large','data-loading-text'=>'Loading...')); ?>
	</div>
        <div class="modal-content" style="color: blue;">
            Note: if password changed successfully, then user will automatically logged out. </br> Have to login again with new password. Thanks
        </div>

<?php $this->endWidget(); ?>
</div><!-- form -->
</div>
<script type="text/javascript">
    
    
    
    
        $(function(){
        $(window).load(function () {
            
            
            
            $("#User_usr_password").val('0');
            
             
            //$("input[type=text]");
/*
            $("td:contains('modType')").remove(); 
            $("td:contains('Total Registered')").css('font-weight','bold');

            $("td:contains('Ready To Print')").siblings('td').children('input').replaceWith('<i class="icon-ok"></i>');


            $("td:contains('not')").siblings('td').children('a').remove();
            $("td:contains('not')").replaceWith('<td></td>');
*/
        });
    
        
        
        
        $(document).on('keyup','#usr_confirmPassword',function() {
            var pass = $("#usr_newPassword").val();
            var conPass = $("#usr_confirmPassword").val();
            
            //alert(pass);
            if(pass===conPass)
            {
             
            
                
                       $("#submit").attr('disabled','true');
                
            }
            else 
            {
            
                
                       $("#submit").removeAttr('disabled');
                
            }
            
            
            
            
        });
        
    
    
    
    
    });
    
</script>