<?php
/* @var $this RegistryController */

$this->breadcrumbs=array(
        
	'Exam Department'=>array('examDepartment/index'),
	
);


?>
<!--h1><?php echo $this->id . '/' . $this->action->id; ?></h1-->

<div class="title">
<h3>
    Exam Department's Functions 
    
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
        
        'Exam Rregistration'=>$this->renderPartial('_examRegistration',null,true,true),
        'Admit Card & Signature Sheet'=>$this->renderPartial('_admitCardIndex',null,true,true),
        'Result'=>$this->renderPartial('_resultIndex',null,true,true),
        'Transcript'=>$this->renderPartial('_transcriptIndex',null,true,true),
        'Supplementary Makrs Entry'=>$this->renderPartial('_SMEmarksEntry',null,true,true),
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
