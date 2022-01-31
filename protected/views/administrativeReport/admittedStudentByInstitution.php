<?php
/* @var $this AdministrativeReportController */

$this->breadcrumbs=array(
   'Registry'=>array('site/registry'),
    
	'Administrative Report'=>array('index'),
	'Report by Institution',
);
?>
<div class="title">
    <h3>Institution wise no of student admitted</h3>    
    
</div>

<?php
 


$this->widget('bootstrap.widgets.TbExtendedGridView', array(
  //  'filter'=>$person,
    'type'=>'striped bordered',
    'dataProvider' => $dataProvider,
    'template' => "{items}\n{extendedSummary}",
    'columns' => array(
                   
                    array('name' => 'ach_institution','header' => 'Institution Name'),                                                                          
                   
                    
         array(
            'name'=>'total',
            'header'=>'No of Student',             
            'class'=>'bootstrap.widgets.TbTotalSumColumn'
             
        ),
         
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