<?php $today= date('Y-m-d'); ?>	


    <div class="span-24">    
<?php 
    $data = array('studentID'=>yii::app()->session['studentID'],'sectionName'=>yii::app()->session['secName'],'batchName'=>yii::app()->session['batName'],'programmeCode'=>yii::app()->session['proCode'],'tra_term'=>yii::app()->session['retakeTerm'],'tra_year'=>yii::app()->session['retakeYear']);      
    $value=$model->searchOfferedModule($data['studentID'],$data['tra_term'], $data['tra_year'], $data['programmeCode']);
                 $this->renderPartial('_retakeForm',array('value'=>$value));
?>
    </div>


    

<?php

//$getRegType='FormUtil::getModuleRegistrationType($data->reg_type)';
$getModType='FormUtil::getModuleType($data[\'mod_type\'])';
$getModLabIncluded='FormUtil::getModuleLabIncluded($data[\'mod_labIncluded\'])';
$id=yii::app()->session['\'studentID\''];
$termYear='FormUtil::getTermYear($data[\'tra_term\'], $data[\'tra_year\'])';
$flagPrerequisite='ModuleRegistration::flagPrerequisite($data[\'mod_prerequisite\'],$data[\'syllabusCode\'],"'.$id.'")';
$regWithBatSec ='FormUtil::getRegWithBatchSection($data[\'batchName\'], $data[\'sectionName\'])';
$regDate ='FormUtil::getFormatedDate($data[\'reg_date\'])';

$modulePrerequisite=array(
    'name'=>'mod_prerequisite',
    'header'=>'Prerequisite',
    'value'=>$flagPrerequisite,
    
);

$moduleCode=array(
    'name'=>'moduleCode',
    'header'=>'Code',
    'value'=>'$data[\'moduleCode\']',
    'htmlOptions'=>array('class'=>'span-3'),
    'footer'=>'modType'
);

$moduleName=array(
    'name'=>'mod_name',
    'header'=>'Title',
    'value'=>'$data[\'mod_name\']',
    'htmlOptions'=>array('class'=>'span-7'),
    'footer'=>'Total Credit:'
);

$groupGridColumns = array(
'name' => 'firstLetter',
'value' => $termYear,
'headerHtmlOptions' => array('style'=>'display:none'),
'htmlOptions' =>array('style'=>'display:none')
);

$modLabIncluded=  array(
    'name'=>'Lab Included',
    'value'=>$getModLabIncluded,
  
);

$ofmCreditHour= array(
'name'=>'mod_creditHour',
'header'=>'Credit',
'htmlOptions' =>array('style'=>'text-align:left'),
'class'=>'bootstrap.widgets.TbTotalSumColumn',
//'footer'=>'Total Credit:'
);
$modType=  array(
    'name'=>' type',
    'value'=>$getModType,
    //'footer'=>'modType'
);
$regWith = array(
    //'name'=>'mod_creditHour',
'header'=>'Batch',
'htmlOptions' =>array('style'=>'text-align:left; font-weight: bold'),
'value'=> $regWithBatSec,
    
);
$this->widget('bootstrap.widgets.TbGroupGridView', array(
        
	'id'=>'moduleRegistration-grid',
        'type' => 'striped',
        'enablePagination' => false,
        'responsiveTable' => true,
	'dataProvider'=> $dataProvider,
	//'filter'=>$model,

    
    	'extraRowColumns'=> array('firstLetter'),
        'extraRowExpression' => $termYear,
        'extraRowHtmlOptions' => array('style'=>'padding:10px;text-align:right; font-weight: bold'),
      
	'columns'=>array(
           
                $groupGridColumns,
            
            //'moduleRegistrationID',
		$moduleCode,
		$moduleName,
            $ofmCreditHour,
            array('header'=>'Group','name'=>'mod_group',),
              //  $modulePrerequisite,  
            
		
                
                //'reg_type',
               
		array('header'=>'Reg On','name'=>'reg_date','value'=>$regDate,'htmlOptions'=>array('style'=>'font-weight: none', 'class'=>'span-4')),
             $regWith,
            array('header'=>'Status','name'=>'reg_status',),
           array('header'=>'LG','name'=>'letterGrade','value'=>'$data[\'letterGrade\']','htmlOptions'=>array('style'=>'font-weight: bold; font-size:16px;', 'class'=>'span-2')),     
                
            array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>' {delete}',
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
     ),   
    )
    
    
));  ?>

<script type="text/javascript">
    $(window).load(function () {
        
         
        $("td:contains('modType')").remove(); 
        $("td:contains('Total Credit')").css('font-weight','bold');
        
        $("td:contains('none')").siblings('td').children('input').replaceWith('<i class="icon-ban-circle"></i>');
        $("td:contains('none')").replaceWith('<td style="color:red">Prerequiste course not clear!</td>');
        
        $("a[rel='<?php echo $today; ?>']").css('display','inline-block');
        
    });
    
    

    
</script>
