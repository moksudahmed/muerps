<style>
td {
    line-height: 200%;
}
</style>

<table border="1"  style="font-size:24px; text-align: center; ">
<thead>
        
  <tr> 
  
      <th rowspan="2" width="8%"><strong>Roll Number</strong></th>
    <th rowspan="2" width="20%"><strong>Name</strong></th>
    <?php
       $i=0;
      
       foreach ($subjectRows as $row) 
       {
          if($i>=$start && $i<$end)
            {
       
               ?>
                 <th width="20%"><strong><?php  echo CHtml::encode($row['moduleCode']).' '.CHtml::encode($row['mod_name']);?></strong></th>            
               <?php
               
            }
            
            $i++;
       }
       $i=0;
     ?>  
  </tr>
<tr>
      <?php      
       
       foreach ($subjectRows as $row) 
       {
          if($i>=$start && $i<$end)
          {
       ?>
	  
            <th width="4%"><strong>60</strong></th>
            <th width="4%"><strong>40</strong></th>
            <th width="4%"><strong>Total</strong></th>
            <th width="4%"><strong>LG</strong></th>
            <th width="4%"><strong>GP</strong></th>
	<?php
        
          }
          $i++;
       }
        
	?>  
  </tr>
</thead>
<tbody>
       <?php 
       $exYear = yii::app()->session['reYear'];
       $exTerm = yii::app()->session['reTerm'];  
       $_batch =yii::app()->session['reBatName'];
       
       $j=1;
       $i=0;
       
      if(!empty($rows))
         foreach ($rows as $row1) 
         {
           if($j>=$cStart && $j<=$cEnd)
          {
       
       ?>
            <tr> 
               <td align="left" width="8%" ><?php echo CHtml::encode($row1['studentID']);?></td>
               <td align="left" width="20%"><?php echo CHtml::encode($row1['per_name']);?></td>
               <?php
                foreach ($subjectRows as $row) 
                {
                    $sql = "SELECT distinct
                      \"moduleCode\",
                      \"markFirstHalf\",
                      \"markFinal\",
                      \"total\",
                      \"letterGrade\",
                      \"gradePoint\"
                        
                    FROM
                      vw_result_final_exam
                    WHERE
                      \"studentID\" = '{$row1['studentID']}' AND 
                      \"moduleCode\" = '{$row['moduleCode']}' AND
                      \"batchName\"='{$_batch}' AND
                      \"exm_examYear\" = '{$exYear}' AND
                      \"exm_examTerm\" = '{$exTerm}' 
                    ORDER BY \"moduleCode\"";
                      
                     $row3 = Yii::app()->db->createCommand($sql)->queryAll();
                     
                     $check = false;
                     
                     foreach ($row3 as $r) 
                     {
                         
                         foreach ($subjectRows as $subject) 
                         {
                               if($i>=$start && $i<$end)
                                {
                                    if ($r['moduleCode'] == $subject['moduleCode']) 
                                    {
                                       
                                    ?>
                                        <td width="4%"><?php echo CHtml::encode($r['markFirstHalf']);?></td>
                                        <td width="4%"><?php echo CHtml::encode($r['markFinal']);?></td>
                                        <td width="4%"><?php echo CHtml::encode($r['total']);?></td>
                                        <?php
                                        if(strcmp($r['letterGrade'],"F*(S)")==0 || strcmp($r['letterGrade'],"F*(R)")==0)
                                        {
                                            ?>
                                            <td width="4%"><?php echo "F*";?></td>
                                            <?php 
                                        
                                        } 
                                        else 
                                        {
                                            ?>
                                                <td width="4%"><?php echo CHtml::encode($r['letterGrade']);?></td>
                                            <?php 
                                        
                                        } 
                                        ?>
                                        
                                        <td width="4%"><?php echo CHtml::encode($r['gradePoint']);?></td>      
                                    <?php
                                     
                                            
                                        $check = true;
                                     
                                    }
                                    else
                                     {

                                        ?>
                                          <!--  <td width="4%"><?php echo '0';?></td>
                                            <td width="4%"><?php echo '0';?></td>
                                            <td width="4%"><?php echo '0';?></td>
                                            <td width="4%"><?php echo '0';?></td>
                                            <td width="4%"><?php echo 'F*';?></td>
                                           -->
                                        <?php
                                         $check = false;

                                     }
                                     //$i++;
                                    
                                }
                                
                                $i++;     
                              
                           }
                           
                        
                     }
                   if($check == FALSE)
                     {
       
                        if($i>$start && $i<$end)
                        {
       
                           
                             ?>
                             <!--   <td width="4%"><?php echo '0';?></td>
                                <td width="4%"><?php echo '0';?></td>
                                <td width="4%"><?php echo '0';?></td>
                                <td width="4%"><?php echo '0';?></td>
                                <td width="4%"><?php echo 'F*';?></td>
                            -->
                             <?php
                           
                             
       
                        }
                           
                         $check = false;
                    
                     }
                     // $check = false;
                      
                  
                      $i=0; 
                }
                
                ?>
              </tr>
  	<?php
          }
          $j++;
          $countPrintPerRow=1;
       
          
                             if($end>4 && $j==5)
                             {
                                //echo $cEnd;
                               // exit();
                             }
      }
      
	 ?>                
   </tbody>
</table>
    <br></br><br></br><br></br>
    <table>
        <tr>
            <th align="left">-------------------------------------------------</th>
            <th align="right">---------------------------------------------------------------</th>
        </tr>
        <tr>
            <th align="left">Signature of Tabulator</th>
            <th align="right">Signature of Controller of Examination</th>
        </tr>
        
    </table>
    
    
