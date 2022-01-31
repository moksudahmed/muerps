
<?php
     
/* @var $this DepartmentController */
/* @var $dataProvider CActiveDataProvider */

 
$pdf =new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(40,10,'Welcome to Metropolitan University!');
$pdf->output();
       
            
  
?>
