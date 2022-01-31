<?php $today= date('Y-m-d'); ?>	



    

<?php

//$getRegType='FormUtil::getModuleRegistrationType($data->reg_type)';
$getModType='FormUtil::getModuleType($data[\'mod_type\'])';
$getModLabIncluded='FormUtil::getModuleLabIncluded($data[\'mod_labIncluded\'])';
$id=yii::app()->session['\'studentID\''];
$termYear='FormUtil::getTermYear($data[\'ofm_term\'], $data[\'ofm_year\'])';
$flagPrerequisite='ModuleRegistration::flagPrerequisite($data[\'mod_prerequisite\'],$data[\'syllabusCode\'],"'.$id.'")';
$regWithBatSec ='FormUtil::getRegWithBatchSection($data[\'ofmBatch\'], $data[\'ofmSection\'])';
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
    'htmlOptions'=>array('class'=>'span-6'),
    'footer'=>'Total Credit:'
);

$groupGridColumns = array(
'name' => 'firstLetter',
'value' => '$data[\'reg_status\']',
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
        'extraRowExpression' => '$data[\'reg_status\']',
        'extraRowHtmlOptions' => array('style'=>'padding:10px; text-align:right; font-weight:bold;','rel'=>'extrarow'),
      
	'columns'=>array(
           
                $groupGridColumns,
            
            //'moduleRegistrationID',
		$moduleCode,
		$moduleName,
            $ofmCreditHour,
            
            array('header'=>'Group','name'=>'mod_group',),
                $modulePrerequisite,  
            
		
                
                //'reg_type',
               
                
		array('header'=>'Reg On','name'=>'reg_date','value'=>$regDate,'htmlOptions'=>array('style'=>'font-weight: none', 'class'=>'span-3')),
            //array('header'=>'Term','value'=>$termYear,'htmlOptions'=>array('style'=>'font-weight: normal','class'=>'span-3')),
                //array('header'=>'Status','name'=>'reg_status',),
            $regWith,
                
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
                /*
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
                ),*/

            ),
            'htmlOptions'=>array(
                'style'=>'width: 220px; ',
                'class'=>'moreButtons',
                
            ),
     ),   
    )
    
    
));  ?>


    
    <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'module-registration-form',
	'enableAjaxValidation'=>false,
    'action'=>CController::createUrl('moduleRegistration/cancelRetake'),)); 
    ?>

	

	

	<div class="row span-22" style="text-align: right;" >
	
                <?php echo CHtml::hiddenField('termAdmissionID', yii::app()->session['termAdmissionID2']);  ?>
	
		<?php echo CHtml::submitButton('Cancel Retake', array('id'=>'Retake','disabled'=>true,'class' => 'btn btn-large btn-danger','data-loading-text'=>'Loading....')); ?>
	</div>

<?php $this->endWidget(); ?>


<script type="text/javascript">
    $(window).load(function () {
        
            
           var flag = false;
           var str = $("td[rel='extrarow']").text();
           
           
             flag = ((str.search('Retake')>0)?true:false);
            
               
           if(flag)
               {
                   //alert('ok..........');
                   $('#Retake').removeAttr('disabled');
               }
               //else alert($("td[rel='extrarow']").text());
                   
        $("td:contains('Total Credit')").css('font-weight','bold');
        
        $("td:contains('none')").siblings('td').children('input').replaceWith('<i class="icon-ban-circle"></i>');
        $("td:contains('none')").replaceWith('<td style="color:red">Prerequiste course not clear!</td>');
        
    });
    
    

    
</script>
