<?php $today= date('Y-m-d'); ?>	


    <div class="span-24">    
<?php 
    //$data = array('studentID'=>yii::app()->session['studentID'],'sectionName'=>yii::app()->session['secName'],'batchName'=>yii::app()->session['batName'],'programmeCode'=>yii::app()->session['proCode'],'tra_term'=>yii::app()->session['MainCurTerm'],'tra_year'=>yii::app()->session['MainCurYear']);      
    $value=$model->searchOfferedModule($data['studentID'],$data['term'], $data['year'], $data['programmeCode']);
                 $this->renderPartial('_retakeForm',array('value'=>$value));
?>
    </div>

<div id="success" class="span-24"> 
    

<?php
//exit();
//$getRegType='FormUtil::getModuleRegistrationType($data->reg_type)';
$getModType='FormUtil::getModuleType($data[\'mod_type\'])';
$getModLabIncluded='FormUtil::getModuleLabIncluded($data[\'mod_labIncluded\'])';
$id=yii::app()->session['\'studentIDinReg\''];
$termYear='FormUtil::getTermYear($data[\'ofm_term\'], $data[\'ofm_year\'])';
$flagPrerequisite='ModuleRegistration::flagPrerequisite($data[\'mod_prerequisite\'],$data[\'syllabusCode\'],"'.$id.'")';
$regWithBatSec ='FormUtil::getRegWithBatchSection($data[\'batchName\'], $data[\'sectionName\'])';


$modulePrerequisite=array(
    'name'=>'mod_prerequisite',
    'header'=>'Prerequisite',
    'value'=>$flagPrerequisite,
    
);

$moduleCode=array(
    'name'=>'moduleCode',
    'header'=>'Module Code',
    'value'=>'$data[\'moduleCode\']',
    'footer'=>'modType'
);

$moduleName=array(
    'name'=>'mod_name',
    'header'=>'Module Name',
    'value'=>'$data[\'mod_name\']',
    'footer'=>'Total Credit:'
);

$groupGridColumns = array(
'name' => 'firstLetter',
'value' => '$data[\'mod_group\']',
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
    'name'=>'module type',
    'value'=>$getModType,
    //'footer'=>'modType'
);
$regWith = array(
    //'name'=>'mod_creditHour',
'header'=>'Reg With',
'htmlOptions' =>array('style'=>'text-align:left'),
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
        'extraRowExpression' => '"<b style=\"font-size: 20px; color: #333;\">".$data[\'mod_group\']."</b>"',
        'extraRowHtmlOptions' => array('style'=>'padding:10px'),
      
	'columns'=>array(
           
                $groupGridColumns,
            
            //'moduleRegistrationID',
		$moduleCode,
		$moduleName,
            $ofmCreditHour,
            'reg_date',
            
		
		
                array('header'=>'Registered Term','value'=>$termYear,),
                $modulePrerequisite,  
                $regWith,
                //'reg_type',
               array('header'=>'Reg Status','name'=>'reg_status',),
         
                
            array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{view} {delete}',
            'buttons'=>array
            (
               /*
                'view' => array
                (
                    'label'=>'View Details',
                    'icon'=>'search white',
                    'url'=>'Yii::app()->createUrl("examination/GetTranscriptOf", array("studentID"=>$data[\'studentID\']))',
                    'options'=>array(
                        'class'=>'btn btn-mini btn-success',
                        'data-toggle'=>'tooltip',
                        
                    ),
                ),
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
*/
            ),
            'htmlOptions'=>array(
                'style'=>'width: 220px; ',
                'class'=>'moreButtons',
                
            ),
     ),   
    )
    
    
));  ?>

</div>
<script type="text/javascript">
    $(window).load(function () {
        
         
        $("td:contains('modType')").remove(); 
        $("td:contains('Total Credit')").css('font-weight','bold');
        
        $("td:contains('none')").siblings('td').children('input').replaceWith('<i class="icon-ban-circle"></i>');
        $("td:contains('none')").replaceWith('<td style="color:red">Prerequiste course not clear!</td>');
        
        $("a[rel='<?php echo $today; ?>']").css('display','inline-block');
        
    });
    
    

    
</script>
