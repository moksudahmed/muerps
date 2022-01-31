<?php
/* @var $this AdministrativeReportController */

$this->breadcrumbs=array(
   'Registry'=>array('site/registry'),
    
	'Administrative Report'=>array('index'),
	'Report by Students Consecutive CGPA',
);
?>
<div class="title">
    <h3>Students Mobile NO</h3>    
    
</div>
<?php 
$backUrl = (!yii::app()->session['mreUrlFlag']?Yii::app()->controller->createUrl('person/searchEngine'):Yii::app()->controller->createUrl('varifyMarks',array('offeredID'=>yii::app()->session['mreOfmID'])));
$backUrl = Yii::app()->controller->createUrl('person/searchEngine');
$this->widget('bootstrap.widgets.TbMenu', array(
	'type'=>'pills',
	'items'=>array(
                array('label'=>'Back', 'icon'=>'icon-arrow-left' , 'url'=>$backUrl, 'linkOptions'=>array('data-toggle'=>'tooltip','data-placement'=>'top', 'title'=>'Search Result',), 'visible'=>true),	
		array('label'=>'XLS', 'icon'=>'icon-print', 'url'=>Yii::app()->controller->createUrl('StudentsMobileNoXLS'),'linkOptions'=>array('target'=>'_blank'), 'visible'=>true),
		//array('label'=>'PDF', 'icon'=>'icon-print', 'url'=>Yii::app()->controller->createUrl('AcademicRecordPDF'),'linkOptions'=>array('target'=>'_blank'), 'visible'=>true),
		
	),
));

?>
<?php
 


$this->widget('bootstrap.widgets.TbExtendedGridView', array(
  //  'filter'=>$person,
    'type'=>'striped bordered',
    'dataProvider' => $dataProvider,
    'template' => "{items}\n{extendedSummary}",
    'columns' => array(
                   
                    array('name' => 'studentID','header' => 'Student ID'),
                    array('name' => 'name','header' => 'Name'),
                    array('name' => 'mobile_no','header' => 'Mobile No'),
                    
                ),
    'extendedSummary' => array(
        'cgpa' => 'Total Students',
        'columns' => array(
            'cgpa' => array('label'=>'Total students', 'class'=>'TbSumOperation')
        )
    ),
    'extendedSummaryOptions' => array(
        'class' => 'well pull-right',
        'style' => 'width:300px'
    ),
));
?>