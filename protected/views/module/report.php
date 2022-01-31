<?php
/* @var $this ModuleController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
   'registry'=>array('site/registry'),
    	    'School'=>array('school/index'),
        'Department'=>array('Department/index', 'id'=> Yii::app()->session['schoolID']),
	'Programme'=>array('Programme/index', 'id'=>Yii::app()->session['departmentID']),
	'Syllabus'=>array('Syllabus/index','id'=>Yii::app()->session['programmeCode']),
	'Modules',
);

$this->menu=array(
	array('label'=>'List Module', 'url'=>array('index','id'=>Yii::app()->session['syllabusCode'])),
	
);

$pdf = new FPDF('p', 'mm', 'A4');

?>
<!--
<h1>Modules</h1>
<h5>[ <?php// echo yii::app()->session['programmeName']; ?> ]</h5>
<h5>[ <?php// echo yii::app()->session['syllabusCode']; ?> ]</h5>
-->

<?php 
    $pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'Hello World!');
$pdf->Output();

?>

