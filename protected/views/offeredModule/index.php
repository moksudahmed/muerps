<?php
/* @var $this RegistryController */

$this->breadcrumbs=array(
        
	'Department Functions'=>array('offeredModule/index'),
	
);


?>
<!--h1><?php echo $this->id . '/' . $this->action->id; ?></h1-->

<div class="title">
<h3>
    Department's Functionalities 
    
</h3>
</div>
<br/>

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



<?php 
$this->widget('zii.widgets.jui.CJuiAccordion',array(
    'panels'=>array(
        'Subject wise Marks Verification'=>$this->renderPartial('_formMarksEntry',null,true,true),
        //'Course Offer'=>$this->renderPartial('_formOfferedModule',null,true,true),
        //'Term Advising'=>$this->renderPartial('_termAdvising',null,true,true),
        'Print Attendance'=>$this->renderPartial('_formPrintAttendance',null,true,true),
        // panel 3 contains the content rendered by a partial view
        //'panel 3'=>$this->renderPartial('_form_1',null,true),
        
    ),
    // additional javascript options for the accordion plugin
    'options'=>array(
        'animated'=>'bounceslide',
        'style'=>array('minHeight'=>'200'),
        'autoHeight'=>false,
        'icons'=>array(
            "header"=>"ui-icon-plus",//ui-icon-circle-arrow-e
            "headerSelected"=>"ui-icon-circle-arrow-s",//ui-icon-circle-arrow-s, ui-icon-minus
        ),
        
    ),
    'htmlOptions'=>array('class'=>'time_cell'),
        
    
));
?>
