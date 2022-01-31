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

$programeCode = 'DBhelper::getProgrammeShortName($data[\'id\'])';

$genderCount = 'FormUtil::countGender($data[\'id\'], $data[\'tra_year\'],$data[\'tra_term\'],$data[\'batchName\'])';

$this->widget('bootstrap.widgets.TbGroupGridView', array(
    //'filter'=>$person,
    'type'=>'striped bordered',
    'dataProvider' => $dataProvider,
    'template' => "{items}",
    //'extraRowColumns'=> array('id'),
    'extraRowExpression' =>  '"<b style=\"font-size: 3em; color: #333;\">".substr($data->id, 0, 1)."</b>"',    
    'extraRowHtmlOptions' => array('style'=>'padding:10px'),
    'columns' => array(
                   // $groupGridColumns,
                    array('name' => 'id','value' => $programeCode, 'header' => 'Programe Name'),
                    array('name' => 'batchName','header' => 'Batch'),
                    
                                        
                    array('name'=>'per_gender', 'header'=>'Gender','footer'=>'Total'),
                    
         array(
            'name'=>'total',
            'header'=>'No of Student',             
            'class'=>'bootstrap.widgets.TbTotalSumColumn'
             
        ),
        array('name'=>'totalGender','value' => $genderCount, 'header'=>'Total'),
        
                ),
   'mergeColumns' => array('id','batchName','totalGender')
));

?>
