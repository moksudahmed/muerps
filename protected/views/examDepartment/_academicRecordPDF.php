<h3>Academic Record</h3>
<strong>ID:<?php echo yii::app()->session['trnsStudentID']; ?></strong>
<br></br>
<strong>Name: <?php  echo yii::app()->session['trnsStudentName']; ?></strong>
<br></br>
<strong><?php echo FormUtil::getBatchTermHTMLspan(yii::app()->session['trnsSecName'],yii::app()->session['trnsBatName'],yii::app()->session['trnsProCode'] ).', '.FormUtil::getTerm(yii::app()->session['trnsAcTerm']); ?><?php echo yii::app()->session['trnsAcYear'];  ?></strong>
<br></br>
<strong>Programme:<?php  echo yii::app()->session['trnsProgramme']; ?></strong>
<br></br>
<?php
$sid = yii::app()->session['trnsStudentID'];
       
       
//$getRegType='FormUtil::getModuleRegistrationType($data->reg_type)';

$termYear='FormUtil::getTermYearWithoutNumberHTMLspan($data[\'studentID\'],$data[\'exm_examTerm\'], $data[\'exm_examYear\'])';

//$getModType='FormUtil::getModuleType($data[\'mod_type\'])';
//$getModLabIncluded='FormUtil::getModuleLabIncluded($data[\'mod_labIncluded\'])';




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


$this->widget(
    'bootstrap.widgets.TbGroupGridView',
    array(
        'fixedHeader' => true,
        'headerOffset' => 40,
        // 40px is the height of the main navigation at bootstrap
        'type' => 'striped',
        'dataProvider' => $dataProvider,
        'responsiveTable' => true,
        'template' => "{items}",
        
        'extraRowColumns'=> array('firstLetter'),
        'extraRowExpression' => $termYear,
        'extraRowHtmlOptions' => array('style'=>'padding:10px;text-align:left; font-weight:bold'),
      
        
        'columns'=>array(
           
                $groupGridColumns,
               array('name' => 'reg_status','header'=>'Code',
                'value' => '$data[\'moduleCode\']',
                'htmlOptions' =>array('width' => 60),'headerHtmlOptions' => array('width'=>'60','style'=>'font-weight:bold'),
                ),
              /*  array('name' => 'moduleCode','header'=>'Code',
                //'value' => '$data[\'moduleCode\']',
                'htmlOptions' =>array('width' => 45),'headerHtmlOptions'=>array('width'=>'50','style'=>'font-weight:bold'),
                 
                ),*/
                array('name' => 'mod_name','header'=>'Title',
  //              'value' => $moduleName,
                'htmlOptions' =>array('width' => 200),'headerHtmlOptions' => array('width'=>'200','style'=>'font-weight:bold'),
              
                ),
                array('name' => 'reg_status','header'=>'Status',
                //'value' => '$data[\'moduleCode\']',
                'htmlOptions' =>array('width' => 45),'headerHtmlOptions' => array('width'=>'40','style'=>'font-weight:bold'),
                ),
                array('name' => 'mod_creditHour','header'=>'CH',
                'value' => $creditHour,
                'htmlOptions' =>array('width' => 25),'headerHtmlOptions' => array('width'=>'40','style'=>'font-weight:bold'),
                ),              
              
                array('name'=>'batchName','header'=>'With',
                'value' => $regWithBatSec,
                'htmlOptions' =>array('width' => 55,'style'=>'font-weight:bold',),'headerHtmlOptions' => array('width'=>'40','style'=>'font-weight:bold'),
                ),
                
               /* array('name' => 'markFirstHalf','header'=>'60',
                //'value' => '$data[\'moduleCode\']',
                'htmlOptions' =>array('width' => 40),'headerHtmlOptions' => array('width'=>'40','style'=>'font-weight:bold'),
                ),
                array('name' => 'emr_mark','header'=>'40',
                //'value' => '$data[\'moduleCode\']',
                'htmlOptions' =>array('width' => 40),'headerHtmlOptions' => array('width'=>'40','style'=>'font-weight:bold'),
                ),*/
                array('name' => 'letterGrade','header'=>'LG',
                'value' => $letterGrade,
                'htmlOptions' =>array('width' => 50,'style'=>'font-weight:bold',),'headerHtmlOptions' => array('width'=>'40', 'style'=>'font-weight:bold'),
                ),
                array('name' => 'gradePoint','header'=>'GP/CH',
                //'value' => '$data[\'moduleCode\']',
                'htmlOptions' =>array('width' => 40),'headerHtmlOptions' => array('style'=>'font-weight:bold'),
                ),
               ),
     //   'mergeColumns' => array('reg_date','batchName','reg_status',)
        
        
    )
);


 $sql = "SELECT * FROM calculate_cgpa_and_gpa('{$sid}')";
 $rows = Yii::app()->db->createCommand($sql)->queryAll();
  
 $sql = "SELECT sum(c_mod_credithour) FROM generate_transcript('{$sid}')";
 $credits = Yii::app()->db->createCommand($sql)->queryAll();
 echo "<strong>Credit completed:".$credits[0]['sum']."</strong>"."<br/></br/></br/>";
 echo "<strong>CGPA:".$rows[0]['cgpa']."</strong>";
 ?>