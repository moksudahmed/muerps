<?php
/* @var $this AdministrativeReportController */

$this->breadcrumbs=array(
   'Registry'=>array('site/registry'),
    
	'Administrative Report'=>array('index'),
	'Passing out student report',
);
?>
<div class="title">
    <h3>Passing out report</h3>        
</div>
<?php 
$backUrl = (!yii::app()->session['mreUrlFlag']?Yii::app()->controller->createUrl('examDepartment/index'):Yii::app()->controller->createUrl('varifyMarks',array('offeredID'=>yii::app()->session['mreOfmID'])));
$backUrl = Yii::app()->controller->createUrl('examDepartment/index');
$this->widget('bootstrap.widgets.TbMenu', array(
	'type'=>'pills',
	'items'=>array(
                array('label'=>'Back', 'icon'=>'icon-arrow-left' , 'url'=>$backUrl, 'linkOptions'=>array('data-toggle'=>'tooltip','data-placement'=>'top', 'title'=>'Search Result',), 'visible'=>true),	
		array('label'=>'XLS', 'icon'=>'icon-print', 'url'=>Yii::app()->controller->createUrl('PassingOutReportXLS'),'linkOptions'=>array('target'=>'_blank'), 'visible'=>true),
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
                   
                    array('name' => 'studentid','header' => 'Student ID'),
                    array('name' => 'comletedcredit','header' => 'Credit Completed'),                   
                    array('name' => 'status','header' => 'Status'),
                    
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