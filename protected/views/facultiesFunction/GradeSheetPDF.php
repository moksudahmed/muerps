<?php
$start =0;

$end = 25;

$totalpage = 1;
//$total = count($subjectRows);  

/*if($total>5)
{
   $totalpage = 2;
}
*/
 
//$cStart =0;
$limit = 25;
//$cEnd = $limit;
$total = count($rows);

$page = $total / $limit;

if($total %25 !=0)
{
    $page = $page + 1;
}

for($j=0;$j<=$page-1; $j++)
 {
  
                $pdf->AddPage();          
                $html = $this->renderPartial('_GradeSheetPDF', array(
                     'rows'=>$rows,'subjectRows'=>$subjectRows,'pdf'=>$pdf,'start'=>$start,'end'=>$end,
                     'gradeSummary'=>$gradeSummary,
                 ), true);
                $pdf->writeHTML($html, true, false, true, false, '');
                $start = $end++;
        
        if($limit<$total)
        {
              $end = $end + $limit;
        }
        else
        {
            $end = $limit;
        }
        

 }
 
            $html = $this->renderPartial('_GradeSheetSummaryPDF', array(
                     'rows'=>$rows,'subjectRows'=>$subjectRows,'pdf'=>$pdf,'start'=>$start,'end'=>$end,
                     'gradeSummary'=>$gradeSummary,
                 ), true);
                $pdf->writeHTML($html, true, false, true, false, '');
       
  ?>
