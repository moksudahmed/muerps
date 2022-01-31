<?php
/* @var $this RegistryController */

$this->breadcrumbs=array(
        'Exam'=>array('site/exam'),
	'Result',
	
);


$this->menu=array(
	array('label'=>'Student Administration', 'url'=>'#','active'=>true),

);
?>
<!--h1><?php echo $this->id . '/' . $this->action->id; ?></h1-->




<?php 
$this->widget('zii.widgets.jui.CJuiAccordion',array(
    'panels'=>array(
       
       // 'Signature Sheet'=>$this->renderPartial('_allResultForm',null,true,true),
        'Tabulation'=>$this->renderPartial('_allResultForm',null,true,true),
//        'Result Sheet'=>$this->renderPartial('_allResultForm',null,true,true),
  //      'Admission Reports'=>$this->renderPartial('_allAdmissionForm',null,true,true),
    //    'Attendance'=>$this->renderPartial('_attandanceForm',null,true,true),
        //'Term Admission'=>$this->renderPartial('_termAdmission',null,true,true),
        //'Term Admission Reports'=>$this->renderPartial('_allResultForm',null,true,true),
        // panel 3 contains the content rendered by a partial view
        //'panel 3'=>$this->renderPartial('_form_1',null,true),
        //'Batch Transfer reports'=>array('panel 4.1'=>'content for panel 4.1','panel 4.2'=>'content for panel 4.2',),
        
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
