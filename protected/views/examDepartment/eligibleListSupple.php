<?php

$this->breadcrumbs=array(
	'Exam Activities'=>array('examDepartment/index'),
        
        'Eligible List (Supplementary)'
	
);

?>

<div class="title span-20">
            <h3>Eligible List (Supplementary)</h3>
            <h4><?php echo FormUtil::getTerm( yii::app()->session['eligibleTerm']);?> Term Supplementary Examination <?php echo yii::app()->session['eligibleYear'];?></h4>            
      
</div>

<div class="title span2">
    <h4>
    
    <span class="label label-warning"><?php echo FormUtil::getTerm(yii::app()->session['eligibleTerm']); ?> </span>
        <span class="label label-success"> <?php echo yii::app()->session['eligibleYear'];  ?></span>
        
        <strong style="letter-spacing:3px;">Selected Term </strong></h4>
    
    
      <?php 
$this->widget('bootstrap.widgets.TbMenu', array(
	'type'=>'pills',
	'items'=>array(
            array('label'=>'back', 'icon'=>'icon-arrow-left' , 'url'=>Yii::app()->controller->createUrl('index'), 'linkOptions'=>array('style'=>'text-weight:bold;','data-toggle'=>'tooltip','data-placement'=>'top', 'title'=>'Exam Activities',), 'visible'=>true),	
            array('label'=>'XLS', 'icon'=>'icon-print' , 'url'=>Yii::app()->controller->createUrl('ExamEligibleListSuppleXLS'), 'linkOptions'=>array('style'=>'text-weight:bold;','target'=>'_blank','data-toggle'=>'tooltip','data-placement'=>'top', 'title'=>'Get Details'), 'visible'=>true),	
            array('label'=>'PDF', 'icon'=>'icon-print' , 'url'=>Yii::app()->controller->createUrl('ExamEligibleListSupplePDF'), 'linkOptions'=>array('style'=>'text-weight:bold;','target'=>'_blank','data-toggle'=>'tooltip','data-placement'=>'top', 'title'=>'Get Details'), 'visible'=>true),	
               
	),
));
?>    
</div>
<hr/>
<div class="span-24" style="font-size: 16px;">

<?php

//$getRegType='FormUtil::getModuleRegistrationType($data->reg_type)';

$studentID='FormUtil::getStudentIDBySuppleRegistration($data[\'programmeCode\'],$data[\'id\'],$data[\'exm_examTerm\'], $data[\'exm_examYear\'])';
$faculty='FormUtil::getFacultyBySuppleRegistration($data[\'programmeCode\'],$data[\'id\'],$data[\'exm_examTerm\'], $data[\'exm_examYear\'])';
//$getModType='FormUtil::getModuleType($data[\'mod_type\'])';
//$getModLabIncluded='FormUtil::getModuleLabIncluded($data[\'mod_labIncluded\'])';




$groupGridColumns = array(
'name' => 'firstLetter',
'value' => '$data[\'pro_name\']',
'headerHtmlOptions' => array('style'=>'display:none'),
'htmlOptions' =>array('style'=>'display:none')
);



$this->widget('bootstrap.widgets.TbGroupGridView', array(
        
	'id'=>'moduleRegistration-grid',
        'type' => 'striped bordered hover',
        'enablePagination' => false,
        'responsiveTable' => true,
	'dataProvider'=> $dataProvider,
	//'filter'=>$model,

    
    	'extraRowColumns'=> array('firstLetter'),
        'extraRowExpression' => '$data[\'pro_name\']',
        'extraRowHtmlOptions' => array('style'=>'padding:10px;text-align:right; font-weight: bold'),
      
	'columns'=>array(
           
                $groupGridColumns,
                array('name' => 'id','header'=>'Code',
  //              'value' => $moduleName,
                'htmlOptions' =>array('class'=>'span-2','style'=>'',),'headerHtmlOptions' => array('style'=>''),'footerHtmlOptions' => array('style'=>'font-weight:bold'),
                    'footer'=>'modName'
                ),
                
                array('name' => 'mod_name','header'=>'Title',
  //              'value' => $moduleName,
                'htmlOptions' =>array('class'=>'span-6','style'=>'',),'headerHtmlOptions' => array('style'=>''),'footerHtmlOptions' => array('style'=>'font-weight:bold'),
                'footer' => 'Total Student'
                ),
                array('name' => 'total','header'=>'Total Students',
                
                'htmlOptions' =>array('class'=>'','style'=>'',),'headerHtmlOptions' => array('style'=>''),
                'footerHtmlOptions' => array('style'=>'font-weight:bold','rel'=>'CH'),
                'class'=>'bootstrap.widgets.TbTotalSumColumn'
                ),
               array('header'=>'Student ID',
                'value' => $studentID,
                'htmlOptions' =>array('class'=>'span-5','style'=>'',),'headerHtmlOptions' => array('style'=>''),'footerHtmlOptions' => array('style'=>'font-weight:bold'),
                
                ),
                array('header'=>'Faculty',
                'value' => $faculty,
                'htmlOptions' =>array('class'=>'span-5','style'=>'',),'headerHtmlOptions' => array('style'=>''),'footerHtmlOptions' => array('style'=>'font-weight:bold'),
                
                ),
            
            array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>' ',
            'buttons'=>array
            (
               
                'view' => array
                (
                    'label'=>'View Details',
                    'icon'=>'search white',
                    'url'=>'Yii::app()->createUrl("examination/GetTranscriptOf", array("studentID"=>$data[\'studentID\']))',
                    'options'=>array(
                        'class'=>'btn btn-mini btn-success',
                        'data-toggle'=>'tooltip',
                        
                    ),
                ) ,
         'delete' => array
                (
                    'label'=>'Cancel Retake',
                    'icon'=>'remove white',
                    'url'=>'Yii::app()->createUrl("headsFunction/deleteRetake", array("id"=>$data[\'moduleRegistrationID\']))',
                    'options'=>array(
                        'class'=>'btn btn-mini btn-danger',
                        'data-toggle'=>'tooltip',
                        'rel'=>'$data[\'reg_date\']',
                        'style'=>'display:none'
                    ),
                ),

            ),
            'htmlOptions'=>array(
                'style'=>'width: 220px; ',
                'class'=>'moreButtons',
                
            ),
            'footerHtmlOptions' => array('style'=>'font-weight:bold','rel'=>'CGPA'),
                
     ),   
    ),
    //'mergeColumns' => array('mod_group','reg_date','batchName','reg_status',)
    
));  ?>

<script type="text/javascript">
    $(window).load(function () {
        
         
        $("td:contains('modName')").remove(); 
        //$("td:contains('Total Credit')").css('font-weight','bold');
        
    });
    
    

    
</script>

</div>

