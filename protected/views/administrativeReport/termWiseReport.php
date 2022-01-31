<?php
/* @var $this AdministrativeReportController */

$this->breadcrumbs=array(
   'Registry'=>array('site/registry'),
    
	'Administrative Report'=>array('index'),
	'Report by Gender',
);
?>
<div class="title">
    <h3>Term wise Admission Report by Male and Female</h3>    
    <h4><strong>Term: </strong> <span  class="label label-success" > <?php  echo FormUtil::getTerm($term); ?></span>
    <strong>Year: </strong> <span  class="label label-important" > <?php  echo  $year; ?></span></h4>
</div>



<?php
$programeCode = 'DBhelper::getProgrammeShortName($data[\'programmeCode\'])';

$genderCount = 'FormUtil::countGenderNewlyAdmittedStudent($data[\'programmeCode\'], $data[\'stu_academicYear\'],$data[\'stu_academicTerm\'])';


$this->widget('bootstrap.widgets.TbGroupGridView', array(
    //'filter'=>$person,
    'type'=>'striped bordered',
    'dataProvider' => $dataProvider,
    'template' => "{items}",
    'extraRowColumns'=> array('programmeCode'),
    'extraRowExpression' => '"<b style=\"font-size: 3em; color: #333;\">".substr($data->programmeCode, 0, 1)."</b>"',    
    'extraRowHtmlOptions' => array('style'=>'padding:10px'),
    'columns' => array(
                   // $groupGridColumns,
                    array('name' => 'programmeCode','value' => $programeCode, 'header' => 'Programe Name'),
                                                                              
                    array('name'=>'per_gender', 'header'=>'Gender','footer'=>'Total'),
                    
         array(
            'name'=>'total',
            'header'=>'No of Student',             
            'class'=>'bootstrap.widgets.TbTotalSumColumn'
             
        ),
        array('name'=>'totalGender','value' => $genderCount, 'header'=>'Total'),
        
                ),
   'mergeColumns' => array('programmeCode','totalGender')
));
//echo $result[1][1];
?>
