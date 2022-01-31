

<div class="title span-13">
                <h3 >Academic Record</h3>
                <h4><strong>ID:</strong> <span class="label label-info"><?php echo yii::app()->session['trnsStudentID']; ?> </span><br/></h4>
                <h4><strong>Name: </strong> <span class="label label-success"><?php  echo yii::app()->session['trnsStudentName']; ?></span></h4>
                <h4><strong>Academic Term: </strong><span class="label label-warning"><?php echo FormUtil::getTerm(yii::app()->session['trnsAcTerm']); ?> </span><span class="label label-success"> <?php echo yii::app()->session['trnsAcYear'];  ?></span></h4>
</div>           
<div class="title span-8">            
 <h5> <?php echo FormUtil::getBatchTermHTMLspan(yii::app()->session['trnsSecName'],yii::app()->session['trnsBatName'],yii::app()->session['trnsProCode'] ); ?></h5>   
     
         
            <h6>Programme:<?php  echo yii::app()->session['trnsProgramme']; ?></h6>

</div>

<hr/>
        
            
                   
<div class="span-24">

<?php

//$getRegType='FormUtil::getModuleRegistrationType($data->reg_type)';
$termYear='FormUtil::getTermYear($data[\'exm_examTerm\'], $data[\'exm_examYear\'])';
$termNumber='FormUtil::getTermNumberByStudentID($data[\'studentID\'],$data[\'exm_examTerm\'], $data[\'exm_examYear\'])';

$getModType='FormUtil::getModuleType($data[\'mod_type\'])';
$getModLabIncluded='FormUtil::getModuleLabIncluded($data[\'mod_labIncluded\'])';


$creditHour = 'FormUtil::removeCreditHourByLG($data[\'letterGrade\'],$data[\'mod_creditHour\'])';

$regWithBatSec ='FormUtil::getRegWithBatchSection($data[\'batchName\'], $data[\'sectionName\'])';
$regDate ='FormUtil::getFormatedDate($data[\'reg_date\'])';

//$moduleName= 'FormUtil::getModuleTitleHTMLspan($data[\'mod_name\'],$data[\'facultyID\'])';



$groupGridColumns = array(
'name' => 'Term',
'value' => $termYear,
'headerHtmlOptions' => array('style'=>'display:none'),
'htmlOptions' =>array('style'=>'display:none'),
'footerHtmlOptions' => array('rel'=>'Term'),
                //'footer'=>'Term Year'    
);



$this->widget('bootstrap.widgets.TbGroupGridView', array(
        
	'id'=>'moduleRegistration-grid',
        'type' => 'striped bordered',
        'enablePagination' => false,
        'responsiveTable' => true,
	'dataProvider'=> $dataProvider,
	//'filter'=>$model,

    
    	'extraRowColumns'=> array('Term'),
        'extraRowExpression' => $termNumber,
        'extraRowHtmlOptions' => array('style'=>'padding:10px;text-align:left; font-weight: bold'),
      
	'columns'=>array(
           
                $groupGridColumns,
            
                array('name' => 'moduleCode','header'=>'',
                //'value' => '$data[\'moduleCode\']',
                'htmlOptions' =>array('class'=>'span-3','style'=>'',),'headerHtmlOptions' => array('style'=>''),
                
                ),
                array('name' => 'mod_name','header'=>'Title',
  //              'value' => $moduleName,
                'htmlOptions' =>array('class'=>'span-4','style'=>'',),'headerHtmlOptions' => array('style'=>''),'footerHtmlOptions' => array('style'=>'font-weight:bold'),
                'footer' => 'Total Credit Complite'
                ),
                array('name' => 'mod_creditHour','header'=>'CH',
                'value' => $creditHour,
                'htmlOptions' =>array('class'=>'span-1','style'=>'',),'headerHtmlOptions' => array('style'=>''),'footerHtmlOptions' => array('style'=>'font-weight:bold'),
                'class'=>'bootstrap.widgets.TbTotalSumColumn'
                ),
               /* array('name' => 'mod_group','header'=>'Group',
                //'value' => '$data[\'moduleCode\']',
                'htmlOptions' =>array('class'=>'span-3','style'=>'',),'headerHtmlOptions' => array('style'=>''),
                ),*/
               /* 
                array('name' => 'reg_date','header'=>'On',
                'value' => $regDate,
                'htmlOptions' =>array('class'=>'span-3','style'=>'',),'headerHtmlOptions' => array('style'=>''),
                ),
                array('name'=>'batchName','header'=>'With',
                'value' => $regWithBatSec,
                'htmlOptions' =>array('class'=>'span-1','style'=>'font-weight:bold',),'headerHtmlOptions' => array('style'=>''),
                ),
                array('name' => 'reg_status','header'=>'',
                //'value' => '$data[\'moduleCode\']',
                'htmlOptions' =>array('class'=>'span-1','style'=>'',),'headerHtmlOptions' => array('style'=>''),
                ),*/
              /*  array('name' => 'markFirstHalf','header'=>'60',
                //'value' => '$data[\'moduleCode\']',
                'htmlOptions' =>array('class'=>'span-1','style'=>'',),'headerHtmlOptions' => array('style'=>''),
                ),
                array('name' => 'emr_mark','header'=>'40',
                //'value' => '$data[\'moduleCode\']',
                'htmlOptions' =>array('class'=>'span-1','style'=>'',),'headerHtmlOptions' => array('style'=>''),
                ),*/
                array('name' => 'letterGrade','header'=>'LG',
                //'value' => '$data[\'moduleCode\']',
                'htmlOptions' =>array('class'=>'span-2','style'=>'font-weight:bold',),'headerHtmlOptions' => array('style'=>''),
                ),
                array('name' => 'gradePoint','header'=>'GP/CH',
                //'value' => '$data[\'moduleCode\']',
                'htmlOptions' =>array('class'=>'span-1','style'=>'',),'headerHtmlOptions' => array('style'=>''),
                ),
                array('name' => 'cgpa','header'=>'GP',
                //'value' => '$data[\'moduleCode\']',
                'htmlOptions' =>array('class'=>'span-1','style'=>'',),'headerHtmlOptions' => array('style'=>''),
                    'footerHtmlOptions' => array('style'=>'font-weight:bold','rel'=>'GP'),
                    'class'=>'bootstrap.widgets.TbTotalSumColumn'
                ),
                
            
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
            'footerHtmlOptions' => array('style'=>'font-weight:bold','rel'=>'CGPA'),    
     ),   
    ),
    'mergeColumns' => array('Term',)
    
));  ?>


<script type="text/javascript">
    $(window).load(function () {
        
         
        $("td:contains('modName')").remove(); 
        //$("td:contains('Total Credit')").css('font-weight','bold');
        
        var ch = $("td[rel='CH']").text(); 
        var gp = $("td[rel='GP']").text(); 
        var cgpa= (gp/ch); 
        //alert('gp +'+cgpa);
       
        $("td[rel='CGPA']").text('CGPA : '+cgpa.toFixed(2));
    });
    
    

    
</script>

</div>