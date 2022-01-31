<?php
/* @var $this AdministrativeReportController */

$this->breadcrumbs=array(
   'Registry'=>array('site/registry'),
    
	'Administrative Report'=>array('index'),
	'Report by Gender',
);
?>
<div class="title">
    <h3>Yearly Admission Report Program wise</h3>    
    <h4><strong>Year: </strong> <span  class="label label-important" > <?php  echo  $year; ?></span></h4>
</div>


<div class="row"> 
    <div class="span6" >  
<?php
  $array_data = array();
   array_push($array_data, array('Program', 'Students'));
 
    foreach ($result as $row):
        
        array_push($array_data, array(DBhelper::getProgrammeShortName($row['programmeCode']),(int)$row['total']));
   endforeach;  
   
$this->widget('ext.Hzl.google.HzlVisualizationChart', array('visualization' => 'PieChart',
            'data' => $array_data,
            'options' => array('title' => 'Students admited in different programe')));

?>
    </div>
</div>

<?php
        
$programeCode = 'DBhelper::getProgrammeShortName($data[\'programmeCode\'])';

$genderCount = 'FormUtil::countGender($data[\'programmeCode\'], $data[\'tra_year\'])';



$this->widget('bootstrap.widgets.TbExtendedGridView', array(
  //  'filter'=>$person,
    'type'=>'striped bordered',
    'dataProvider' => $dataProvider,
    'template' => "{items}\n{extendedSummary}",
    'columns' => array(
                   
                    array('name' => 'programmeCode','header' => 'Programe Code'),                                                                          
                 array('name' => 'programmeShortName','value' => $programeCode, 'header' => 'Programe Short Name','footer'=>'Total'),
                    
         array(
            'name'=>'total',
            'header'=>'No of Student',             
            'class'=>'bootstrap.widgets.TbTotalSumColumn'
             
        ),
       // array('name'=>'totalGender','value' => $genderCount, 'header'=>'Total'),
        
                ),
    'extendedSummary' => array(
        'title' => 'Total Students',
        'columns' => array(
            'total' => array('label'=>'Total students', 'class'=>'TbSumOperation')
        )
    ),
    'extendedSummaryOptions' => array(
        'class' => 'well pull-right',
        'style' => 'width:300px'
    ),
));
?>