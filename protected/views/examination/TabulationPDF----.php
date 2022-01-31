<?php
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

if($total %30 !=0)
{
    $page = $page + 1;
}
  

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
