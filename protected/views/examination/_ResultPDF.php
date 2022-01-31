<style>
td {
    line-height: 200%;
}
</style>
<?php
  $opt = Options::model()->findByAttributes(array('option_name'=>'erp_name'));
  $optV = Options::model()->findByAttributes(array('option_name'=>'erp_version'));
  
  $h = 5;
  $w = 25;
  $x = 15;
  $align = 'L';
  $pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
  $pdf->SetFillColor(0,0,0);
  $pdf->SetTextColor(0,0,0);  
  $pdf->MultiCell(25,13,'Roll Number',1,$align,$fill = false,$ln = 1,$x,
		  	30,$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,
		 	$maxh = 0,$valign = 'T',$fitcell = false); 		
  $x= $x + $w;
  $pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
  $pdf->SetFillColor(0,0,0);
  $pdf->SetTextColor(0,0,0);
  //$pdf->MultiCell(60, 10, 'Name', 1, 'C', 1, 0);
  

  
       $i=0;
       $x = 40;
       
       foreach ($subjectRows as $row) 
       {
          if($i>=$start && $i<$end)
            {
       
              $pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
              $pdf->SetFillColor(0,0,0);
              $pdf->SetTextColor(0,0,0);
              //$pdf->MultiCell(30, 10, $row['moduleCode'].$row['mod_name'], 1, 'C', 1, 0);
              $pdf->MultiCell(46,8,$row['modulecode'].' '.$row['mod_name'],1,$align,$fill = false,$ln = 1,$x,
		  	30,$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,
		 	$maxh = 0,$valign = 'T',$fitcell = false); 		
               $x = $x + 46;
            }
            
            $i++;
       }
      
       $align = 'C';      
       $k=0;
       $x = 40;
       $y = 38; 
       foreach ($subjectRows as $row) 
       {
          if($k>=$start && $k<$end)
          {
             $pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
              $pdf->SetFillColor(0,0,0);
              $pdf->SetTextColor(0,0,0);
              //$pdf->MultiCell(30, 10, '60', 1, 'C', 1, 0);
              
              $pdf->MultiCell(23,$h,'LG',1,$align,$fill = false,$ln = 1,$x,
		  	$y,$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,
		 	$maxh = 0,$valign = 'T',$fitcell = false); 		
              $x=$x+23;
              $pdf->MultiCell(23,$h,'GP',1,$align,$fill = false,$ln = 1,$x,
		  	$y,$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,
		 	$maxh = 0,$valign = 'T',$fitcell = false); 		
              $x=$x+23;
       
        
          }
          $k++;
       }
        
	 $j=1;
        
           $exYear = yii::app()->session['reYear'];
           $exTerm = yii::app()->session['reTerm'];  
           $_batch =yii::app()->session['reBatName'];
          
           $x = 15;  
           $y = 43; 
           $h=5;
            foreach ($rows as $rowID) 
              {
                    if($j>=$cStart && $j<=$cEnd)
                      {
                             
                        $pdf->MultiCell(25,$h,$rowID['studentID'],1,$align,$fill = false,$ln = 1,$x,
		  	$y,$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,
		 	$maxh = 0,$valign = 'T',$fitcell = false); 		
                        
                        $y = $y+5;         
                    }
                    
                      $j++;
                      
                      
               }
               
           $x = 17;  
           $y = 43; 
           $k=0;
     
   $k=0;
   
   $model = new Examination();
   
   foreach ($subjectRows as $row) 
   {
         if($k>=$start && $k<$end)
         {
                       
              $j=1;
              foreach($rows as $rowID)
              {
                     if($j>=$cStart && $j<=$cEnd)
                      {
                                        
                       $rowMark = $model->getTabulationRow($rowID['studentID'],$row['modulecode'],$_batch,yii::app()->session['examinationID']);
                                        
                  
                        if(strcmp($rowMark['letterGrade'],"F*(S)")==0 || strcmp($rowMark['letterGrade'],"F*(R)")==0)
                        {
                            $pdf->MultiCell(23,$h,$rowMark['letterGrade'],1,$align,$fill = false,$ln = 1,$x+23,
                            $y,$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,
                            $maxh = 0,$valign = 'T',$fitcell = false); 	

                         } 
                         else 
                        {  
                             $pdf->MultiCell(23,$h,$rowMark['letterGrade'],1,$align,$fill = false,$ln = 1,$x+23,
                             $y,$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,
                             $maxh = 0,$valign = 'T',$fitcell = false); 		                                                             

                         } 
                        $pdf->MultiCell(23,$h,$rowMark['gradePoint'],1,$align,$fill = false,$ln = 1,$x+46,
		  	$y,$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,
		 	$maxh = 0,$valign = 'T',$fitcell = false); 		                                                                                     
                            
                        
                        $y = $y+5;                 
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
            <td></td>            
           <td align="right"> <?php echo CHtml::image(dirname(Yii::app()->getBasePath()).DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'Signature.jpg', 'DORE',array("width"=>"120px")); ?></td>
        </tr>
     
        <tr>
            <td>** R = Retake, S = Supplementary</td>
            <td align="right">---------------------------------------------------</td>
            
        </tr>
        <tr>
            <td>Printed on <?php  echo date('d/m/Y'); ?> by <?php echo $opt->option_value .' ('.$optV->option_value.')';  ?></td>
            <td align="right">Signature of Controller of Examination</td>

        </tr>
    </table>
             