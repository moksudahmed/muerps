<?php
/* @var $this ModuleRegistrationController */
/* @var $model ModuleRegistration */

    $this->breadcrumbs=array(
	
	
    
     //'Exam Activities'=>array('examDepartment/index'),
        'Search Result'=>array('person/SearchEngine'),
        //'Personal Profile'=>array('student/studentProfile'),
        'Academic Rerord'
);



?>



<div class="title span-13">
                <h3 >Academic Record</h3>
                <h4><strong>ID:</strong> <span class="label label-info"><?php echo yii::app()->session['trnsStudentID']; ?> </span><br/></h4>
                <h4><strong>Name: </strong> <span class="label label-success"><?php  echo yii::app()->session['trnsStudentName']; ?></span></h4>
                <h4><strong>Academic Year: </strong><span class="label label-warning"><?php echo FormUtil::getTerm(yii::app()->session['trnsAcTerm']); ?> </span><span class="label label-success"> <?php echo yii::app()->session['trnsAcYear'];  ?></span></h4>
</div>           
<div class="title span-8">            
 <h5> <?php echo FormUtil::getBatchTermHTMLspan(yii::app()->session['trnsSecName'],yii::app()->session['trnsBatName'],yii::app()->session['trnsProCode'] ); ?></h5>   
     
         
 <h5>Programme:<?php  echo yii::app()->session['trnsProgramme']; ?></h5>
<?php 
$backUrl = (!yii::app()->session['mreUrlFlag']?Yii::app()->controller->createUrl('person/searchEngine'):Yii::app()->controller->createUrl('varifyMarks',array('offeredID'=>yii::app()->session['mreOfmID'])));
$backUrl = Yii::app()->controller->createUrl('person/searchEngine');
$this->widget('bootstrap.widgets.TbMenu', array(
	'type'=>'pills',
	'items'=>array(
                array('label'=>'Back', 'icon'=>'icon-arrow-left' , 'url'=>$backUrl, 'linkOptions'=>array('data-toggle'=>'tooltip','data-placement'=>'top', 'title'=>'Search Result',), 'visible'=>true),	
		array('label'=>'XLS', 'icon'=>'icon-print', 'url'=>Yii::app()->controller->createUrl('AcademicRecordXLS'),'linkOptions'=>array('target'=>'_blank'), 'visible'=>true),
                array('label'=>'PDF', 'icon'=>'icon-print', 'url'=>Yii::app()->controller->createUrl('AcademicRecordPDF'),'linkOptions'=>array('target'=>'_blank'), 'visible'=>true),
		
		
	),
));

$sid = yii::app()->session['trnsStudentID'];
$sql = "SELECT sum(c_mod_credithour) FROM generate_transcript('{$sid}')";
$credits = Yii::app()->db->createCommand($sql)->queryAll();
    
   
   /*-----------------Transcript summary page (Fornt page) page# 1------------------------------*/
   $headerData = Examination::model()->searchTranscriptHeaderData($sid);
?>
</div>
<div class="title span-3" >
    <?php  if($credits[0]['sum']>=$headerData[0]['syl_maxCreditHour'])
                {?>
                    <span class="badge badge-success"><h2>Complete</h2></span>    
    
                <?php } else{//echo CHtml::image('./photograph/'.yii::app()->session['studentID'].'.jpg',yii::app()->session['studentName']); ?>
                    <span class="badge badge-warning"><h2>Incomplete</h2></span>    
                  <?php }?>
            </div>
<hr/>
        
 <div class="row"> 
    <div class="span-24" >  
        <?php

       $array_data = array();
       $i=1;
       echo yii::app()->session['studentID'];
       array_push($array_data, array('', 'CGPA'));   
       foreach ($result as $row):                
           $str=FormUtil::getTermNumberByStudentID(yii::app()->session['trnsStudentID'], $row['tra_term'], $row['tra_year']);
    
            if($row['tra_year']==yii::app()->session['MainCurYear'])
            {
                 if($row['tra_term']!=yii::app()->session['MainCurTerm'])
                 {
                    array_push($array_data, array($str,(real)$row['total']));                
                 }
            }
            else
            {
                    array_push($array_data, array($str,(real)$row['total']));              
            }
        endforeach; 
  
      $this->widget('ext.Hzl.google.HzlVisualizationChart', array('visualization' => 'LineChart',
            'data' => $array_data,
            'options' => array('title' => 'My Performance', 'class'=>"span-24",
                'height' => 200)));
        ?>
   
       
 
    </div>
</div>               
                   
<div class="span-24">

<?php

//$getRegType='FormUtil::getModuleRegistrationType($data->reg_type)';

$termYear='FormUtil::getTermYearWithNumberHTMLspan($data[\'studentID\'],$data[\'exm_examTerm\'], $data[\'exm_examYear\'])';

//$getModType='FormUtil::getModuleType($data[\'mod_type\'])';
//$getModLabIncluded='FormUtil::getModuleLabIncluded($data[\'mod_labIncluded\'])';

//$exm = FormUtil::SupplyRetakeFilter('lg', '151-115-018','11','CSE-123');

//var_dump($exm);
//exit();


$regWithBatSec ='FormUtil::getRegWithBatchSection($data[\'batchName\'], $data[\'sectionName\'])';
$regDate ='FormUtil::getFormatedDate($data[\'emr_date\'])';
$letterGrade = 'FormUtil::SupplyRetakeFilter($data[\'letterGrade\'],$data[\'studentID\'],$data[\'moduleRegistrationID\'],$data[\'moduleCode\'])';
//$moduleName= 'FormUtil::getModuleTitleHTMLspan($data[\'mod_name\'],$data[\'facultyID\'])';
$creditHour = 'FormUtil::removeCreditHourByLG($data[\'letterGrade\'],$data[\'mod_creditHour\'])';


$groupGridColumns = array(
'name' => 'firstLetter',
'value' => $termYear,
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
        'extraRowExpression' => $termYear,
        'extraRowHtmlOptions' => array('style'=>'padding:10px;text-align:left; font-weight: normal'),
      
	'columns'=>array(
           
                $groupGridColumns,
                array('name' => 'reg_status','header'=>'',
                //'value' => '$data[\'moduleCode\']',
                'htmlOptions' =>array('class'=>'span-1','style'=>'',),'headerHtmlOptions' => array('style'=>''),
                ),
                array('name' => 'moduleCode','header'=>'',
                //'value' => '$data[\'moduleCode\']',
                'htmlOptions' =>array('class'=>'span-3','style'=>'',),'headerHtmlOptions' => array('style'=>''),
                'footer'=>'modName'    
                ),
                array('name' => 'mod_name','header'=>'Title',
  //              'value' => $moduleName,
                'htmlOptions' =>array('class'=>'span-8','style'=>'',),'headerHtmlOptions' => array('style'=>''),'footerHtmlOptions' => array('style'=>'font-weight:bold'),
                'footer' => 'Total Credit'
                ),
                array('name' => 'mod_creditHour','header'=>'CH',
                'value' => $creditHour,
                'htmlOptions' =>array('class'=>'','style'=>'',),'headerHtmlOptions' => array('style'=>''),
                'footerHtmlOptions' => array('style'=>'font-weight:bold','rel'=>'CH'),
                'class'=>'bootstrap.widgets.TbTotalSumColumn'
                ),
               /* array('name' => 'mod_group','header'=>'Group',
                //'value' => '$data[\'moduleCode\']',
                'htmlOptions' =>array('class'=>'span-3','style'=>'',),'headerHtmlOptions' => array('style'=>''),
                ),*/
                
                array('header'=>'On',
                'value' => $regDate,
                'htmlOptions' =>array('class'=>'span-6','style'=>'',),'headerHtmlOptions' => array('style'=>''),
                ),
                array('name'=>'batchName','header'=>'With',
                'value' => $regWithBatSec,
                'htmlOptions' =>array('class'=>'span-1','style'=>'font-weight:bold',),'headerHtmlOptions' => array('style'=>''),
                ),
                
                array('name' => 'markFirstHalf','header'=>'60',
                //'value' => '$data[\'moduleCode\']',
                'htmlOptions' =>array('class'=>'span-1','style'=>'',),'headerHtmlOptions' => array('style'=>''),
                ),
                array('name' => 'emr_mark','header'=>'40',
                //'value' => '$data[\'moduleCode\']',
                'htmlOptions' =>array('class'=>'span-1','style'=>'',),'headerHtmlOptions' => array('style'=>''),
                ),
                array('name' => 'letterGrade','header'=>'LG',
                'value' => $letterGrade,
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
            'template'=>'',
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
         

            ),
            'htmlOptions'=>array(
                'style'=>'width: 220px; ',
                'class'=>'moreButtons',
                
            ),
            'footerHtmlOptions' => array('style'=>'font-weight:bold','rel'=>'CGPA'),
                
     ),   
    ),
    'mergeColumns' => array('mod_group','reg_date','batchName','reg_status',)
    
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