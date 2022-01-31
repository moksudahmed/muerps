<style>
td {
    line-height: 200%;
}
</style>
<?php
  $h = 5;
  $w = 25;
  $x = 15;
  $align = 'L';
  $pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
  $pdf->SetFillColor(0,0,0);
  $pdf->SetTextColor(0,0,0);  
  $pdf->MultiCell(25,13,'Rool Number',1,$align,$fill = false,$ln = 1,$x,
		  	30,$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,
		 	$maxh = 0,$valign = 'T',$fitcell = false); 		
  $x= $x + $w;
  $pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
  $pdf->SetFillColor(0,0,0);
  $pdf->SetTextColor(0,0,0);
  //$pdf->MultiCell(60, 10, 'Name', 1, 'C', 1, 0);
  $pdf->MultiCell($w+33,13,'Name',1,$align,$fill = false,$ln = 1,$x,
		  	30,$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,
		 	$maxh = 0,$valign = 'T',$fitcell = false); 		
  

  
       $i=0;
       $x = 98;
       
       foreach ($subjectRows as $row) 
       {
          if($i>=$start && $i<$end)
            {
       
              $pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
              $pdf->SetFillColor(0,0,0);
              $pdf->SetTextColor(0,0,0);
              //$pdf->MultiCell(30, 10, $row['moduleCode'].$row['mod_name'], 1, 'C', 1, 0);
              $pdf->MultiCell(46,8,$row['moduleCode'].' '.$row['mod_name'],1,$align,$fill = false,$ln = 1,$x,
		  	30,$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,
		 	$maxh = 0,$valign = 'T',$fitcell = false); 		
               $x = $x + 46;
            }
            
            $i++;
       }
      
             
       $k=0;
       $x = 98;
       $y = 38; 
       foreach ($subjectRows as $row) 
       {
          if($k>=$start && $k<$end)
          {
             $pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
              $pdf->SetFillColor(0,0,0);
              $pdf->SetTextColor(0,0,0);
              //$pdf->MultiCell(30, 10, '60', 1, 'C', 1, 0);
              $pdf->MultiCell(9,$h,'60',1,$align,$fill = false,$ln = 1,$x,
		  	$y,$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,
		 	$maxh = 0,$valign = 'T',$fitcell = false); 		
              $x=$x+9;
              $pdf->MultiCell(9,$h,'40',1,$align,$fill = false,$ln = 1,$x,
		  	$y,$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,
		 	$maxh = 0,$valign = 'T',$fitcell = false); 		
              $x=$x+9;
              $pdf->MultiCell(10,$h,'Total',1,$align,$fill = false,$ln = 1,$x,
		  	$y,$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,
		 	$maxh = 0,$valign = 'T',$fitcell = false); 		
              $x=$x+10;
              $pdf->MultiCell(9,$h,'LG',1,$align,$fill = false,$ln = 1,$x,
		  	$y,$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,
		 	$maxh = 0,$valign = 'T',$fitcell = false); 		
              $x=$x+9;
              $pdf->MultiCell(9,$h,'GP',1,$align,$fill = false,$ln = 1,$x,
		  	$y,$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,
		 	$maxh = 0,$valign = 'T',$fitcell = false); 		
              $x=$x+9;
       
        
          }
          $k++;
       }
        
	 $j=1;
        
           $exYear = yii::app()->session['reYear'];
           $exTerm = yii::app()->session['reTerm'];  
           $_batch =yii::app()->session['reBatName'];
          
           $x = 15;  
           $y = 43; 
           $h=4.5;
            foreach ($rows as $rowID) 
              {
                    if($j>=$cStart && $j<=$cEnd)
                      {
                             
                        $pdf->MultiCell(25,$h,$rowID['studentID'],1,$align,$fill = false,$ln = 1,$x,
		  	$y,$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,
		 	$maxh = 0,$valign = 'T',$fitcell = false); 		
                        
                        $pdf->MultiCell(58,$h,$rowID['per_name'],1,$align,$fill = false,$ln = 1,$x+25,
		  	$y,$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,
		 	$maxh = 0,$valign = 'T',$fitcell = false); 		
                        $y = $y+4.5;         
                    }
                    
                      $j++;
                      
                      
               }
               
           $x = 98;  
           $y = 43; 
           $k=0;
     
   $k=0;
   foreach ($subjectRows as $row) 
   {
         if($k>=$start && $k<$end)
         {
                       
              $j=1;
              foreach($rows as $rowID)
              {
                     if($j>=$cStart && $j<=$cEnd)
                      {
                                        
                       $rowMark = FormUtil::getTabulationRow($rowID['studentID'],$row['moduleCode'],$_batch,$exYear,$exTerm);
                                        
                       $pdf->MultiCell(9,$h,$rowMark['markFirstHalf'],1,$align,$fill = false,$ln = 1,$x,
                       $y,$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,
                       $maxh = 0,$valign = 'T',$fitcell = false); 		

                        
                        $pdf->MultiCell(9,$h,$rowMark['markFinal'],1,$align,$fill = false,$ln = 1,$x+9,
		  	$y,$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,
		 	$maxh = 0,$valign = 'T',$fitcell = false); 		
                        

                        $pdf->MultiCell(10,$h,$rowMark['total'],1,$align,$fill = false,$ln = 1,$x+18,
		  	$y,$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,
		 	$maxh = 0,$valign = 'T',$fitcell = false); 		             
                        
                  
                        if(strcmp($rowMark['letterGrade'],"F*(S)")==0 || strcmp($rowMark['letterGrade'],"F*(R)")==0)
                        {
                            $pdf->MultiCell(9,$h,"F*",1,$align,$fill = false,$ln = 1,$x+28,
                            $y,$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,
                            $maxh = 0,$valign = 'T',$fitcell = false); 	

                         } 
                         else 
                        {  
                             $pdf->MultiCell(9,$h,$rowMark['letterGrade'],1,$align,$fill = false,$ln = 1,$x+28,
                             $y,$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,
                             $maxh = 0,$valign = 'T',$fitcell = false); 		                                                             

                         } 
                        $pdf->MultiCell(9,$h,$rowMark['gradePoint'],1,$align,$fill = false,$ln = 1,$x+37,
		  	$y,$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,
		 	$maxh = 0,$valign = 'T',$fitcell = false); 		                                                                                     
                            
                        
                        $y = $y+4.5;                 
                         }
                         
                         $j++;
                         
                 }
                                               
                                      
                  $x = $x+46;
                  $y = 43; 
           }  
           $k++;
          //$x = 111;   
 }            
?>
<br></br>
<br></br>
<br></br>
    <table>
        <tr>
            <td>** R = Retake, S = Supplementary</td>
            <td align="right">---------------------------------------------------------------</td>
            
        </tr>
        <tr>
            <td></td>
            <td align="right">Signature of Controller of Examination</td>

        </tr>
    </table>
    

             