<?php
$start =0;

$end = 5;

$totalpage = 1;
$total = count($subjectRows);

if($total>5)
{
   $totalpage = floor($total/5);
   if($total%5!=0)
       $totalpage = $totalpage+1;
   //$totalpage = 2;
}

 
$cStart =0;
$limit = 25;
$cEnd = $limit;
$cTotal = count($rows);
$page = $cTotal / $limit;

if($total %25 !=0)
{
    $page = $page + 1;
}
  
$page = ($page<1?$page=2:$page);

for($j=0;$j<$page-1; $j++)
 {
         
        for($i = 0; $i<$totalpage; $i++)
        {
                $pdf->AddPage();     
               $html = $this->renderPartial('_ResultPDF', array(
                     'rows'=>$rows,'subjectRows'=>$subjectRows,'pdf'=>$pdf,'start'=>$start,'end'=>$end,'cStart'=>$cStart,'cEnd'=>$cEnd,
                 ), true);
              
                
                $pdf->writeHTML($html, true, false, true, false, '');
                $start = $end++;
                
                if($end+4<$total)
                    $end = $end+4;
                else
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
            $end = 5;
            //$limit = $limit +24;
        
 }
 
  ?>