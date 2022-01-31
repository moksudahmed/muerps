<?php
$start =0;

$end = 4;

$totalpage = 1;
$total = count($subjectRows);  

if($total>4)
{
   $totalpage = floor($total/4);
   if($total%4!=0)
       $totalpage = $totalpage+1;
    //$totalpage = 2;
     
   
}

 
$cStart =0;
$limit = 28;
$cEnd = $limit;
$cTotal = count($rows);
$page = $cTotal / $limit;
if($total %28 !=0)
{
    $page = $page + 1;
}
else
{
    $page = 1;
}
 

for($j=0;$j<=$page-1; $j++)
 {
         
        for($i = 0; $i<$totalpage; $i++)
        {
                $pdf->AddPage();     
               $html = $this->renderPartial('_TabulationPDF', array(
                     'rows'=>$rows,'subjectRows'=>$subjectRows,'pdf'=>$pdf,'start'=>$start,'end'=>$end,'cStart'=>$cStart,'cEnd'=>$cEnd,
                 ), true);
              
                
                $pdf->writeHTML($html, true, false, true, false, '');
                $start = $end++;
                if($end+3<$total)
                    $end = $end+3;
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
            $end = 4;
            //$limit = $limit +24;
        
 }
 //echo $cStart.' '.$cEnd;exit();
  ?>
