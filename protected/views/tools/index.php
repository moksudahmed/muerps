<?php
/* @var $this AdministrativeReportController */

$this->breadcrumbs=array(
   'Registry'=>array('site/registry'),
    
	'Tools'=>array('index'),	
);

?>

<div class="span-24">
<div class="title span-23">
    <h3>Tools  </h3>
      
</div>
    



<div class="span-4 right">

<?php 

//echo 'Bismillah Hir Rahmanir Rahim';
//exit();
    $backUrl=Yii::app()->controller->createUrl('site/registry');
    $backTitle='Registry';


//$backUrl = (!yii::app()->session['mreUrlFlag']?Yii::app()->controller->createUrl('index') : Yii::app()->controller->createUrl('headsFunction/courseAuthentication'));
//$backTitle = (!yii::app()->session['mreUrlFlag']?'Faculty Activities' : 'Result Authentication');


$this->widget('bootstrap.widgets.TbMenu', array(
	'type'=>'pills',
	'items'=>array(
		
	//array('label'=>'Generate 100 Mark Sheet', 'icon'=>'icon-download', 'url'=>Yii::app()->controller->createUrl('GenerateFirstHalfPDF'), 'linkOptions'=>array('target'=>'_blank'), 'visible'=>true),
        array('label'=>'Back', 'icon'=>'icon-arrow-left' , 'url'=>$backUrl, 'linkOptions'=>array('data-toggle'=>'tooltip','data-placement'=>'top', 'title'=>$backTitle,), 'visible'=>true),	
	//array('label'=>'Next', 'icon'=>'icon-play-circle', 'url'=>Yii::app()->controller->createUrl('resultSheet'), 'linkOptions'=>array('data-toggle'=>'tooltip','data-placement'=>'right', 'title'=>'Get Result') , 'visible'=>true, ),	
	),
));

            
                ?>
    
</div>
<div class="span-20">    
<?php 
$this->widget('zii.widgets.jui.CJuiAccordion',array(
    'panels'=>array(               
        'User Authentication Status'=>$this->renderPartial('_formUserAuthStatus',null,true,true),        
        'Delete term admission'=>$this->renderPartial('_formDeleteTermAdmission',null,true,true),
        //'Batch Transfer'=>$this->renderPartial('form',null,true,true),
        'Change module to a batch'=>$this->renderPartial('form',null,true,true),                
        'Delete a student record'=>$this->renderPartial('form',null,true,true),                
      //  'Delete a employee/faculty record'=>$this->renderPartial('_formDeleteEmployeeRecord',null,true,true),                
        'Copy syllabus'=>$this->renderPartial('_formCopySyllabus',null,true,true),                
        'Locked Courses'=>$this->renderPartial('_formLockedCourse',null,true,true),                
        'Delete Module Registration'=>$this->renderPartial('_formDeleteModuleRegistration',null,true,true),                
        'Audit Table'=>$this->renderPartial('_formAuditTable',null,true,true),                
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
</div>
</div>