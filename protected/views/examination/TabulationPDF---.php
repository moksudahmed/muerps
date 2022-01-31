<?php
//ini_set('MAX_EXECUTION_TIME', -1);
$start =0;

$end = 4;

$totalpage = 1;
$total = count($subjectRows);  

if($total>4)
{
   $totalpage = 2;
  
}
 
$cStart =0;
$limit = 30;
$cEnd = $limit;
$cTotal = count($rows);
$page = $cTotal / $limit;
//echo $cTotal;
//exit();

if($total %30 !=0)
{
    $page = $page + 1;
}
//$page = 6;
//echo $page;
//exit();

for($j=0;$j<$page-1; $j++)
 {
         
        for($i = 0; $i<$totalpage; $i++)
        {
                $pdf->AddPage();     
               $html = $this->renderPartial('_TabulationPDF', array(
                     'rows'=>$rows,'subjectRows'=>$subjectRows,'pdf'=>$pdf,'start'=>$start,'end'=>$end,'cStart'=>$cStart,'cEnd'=>$cEnd,
                 ), true);
              
                
                $pdf->writeHTML($html, true, false, true, false, '');
                $start = $end++;
                $end = $total;

        }   
        
        if($limit<$cTotal)
        {
           $cStart = $cEnd+1;
           $cEnd = $cEnd + $limit;
        }
        else
        {
           $cStart = $cEnd;
           $cEnd = $cTotal;
        }
            
            $start =0;
            $end = 4;
            //$limit = $limit +24;
        
 }
  ?>
