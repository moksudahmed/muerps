<?php
$max_line = 25;


$table ="<br></br><table border=\"1\"  style=\"font-size:30px; text-align: left; \">
                    <thead>
                        <tr>
                            <th width=\"15%\"><strong>Course Code</strong>
                            </th>

                            <th width=\"44%\"><strong>Course Title</strong>
                            </th>

                            <th width=\"9%\"><strong>Credits</strong>
                            </th>

                            <th width=\"8%\"><strong>Grade</strong>
                            </th>

                            <th width=\"15%\"><strong>Grade points per credit</strong>
                            </th>

                            <th width=\"9%\"><strong>Grade points</strong>
                            </th>
                            

                        </tr>
                </thead>
                 <tbody>";
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

if($group_name == 'Compulsory GED' ||  $group_name =="Foundation")
   {
       /*---------- Specially for General Education----- */
     echo '<strong>'.  'General Education Courses'.'</strong>';      
   }
elseif($group_name == 'Optional General Education')
   {
       /*---------- Specially for General Education----- */
     echo '<strong>'.  'Optional General Education Courses'.'</strong>';      
   }
   elseif($group_name == 'Elective Economics')
   {
       /*---------- Specially for General Education----- */
     echo '<strong>'.  'Elective Economics Courses'.'</strong>';      
   }
elseif($group_name == 'Finance and Banking' || $group_name == 'Human Resource Management' || $group_name == 'Management' || $group_name == 'Marketing' || $group_name == 'Information Systems Management' || $group_name == 'Accounting & Information Systems'|| $group_name == 'Tourism and Hospitality Management'|| $group_name == 'Supply Chain Management')
{
     echo '<strong>'.  'Specialization Courses : '.$group_name.'</strong>'; 
}
else{
        echo '<strong>'.  FormUtil::getCourseName($group_name).'</strong>';
   }


//echo var_dump($rows); exit();
$line = 0;
echo $table;  
//$line = 7;  

for($i=$start; $i<$end; $i++)     {
       //if($line <24)
       //{   
		if(isset($rows[$i])== TRUE){   
            ?>
                <tr>
                        <td style="text-align: center;" width="15%">
                          <?php echo $rows[$i]["c_modulecode"];?>
                        </td>
                        <td style="text-align: left;" width="44%">
                            <?php echo  $rows[$i]['c_title']; ?>
                           
                        </td>
                        <td style="text-align: center;" width="9%">
                            <?php 
                                echo  $rows[$i]['c_mod_credithour']; 
                                
                            ?>                            
                        </td>
                        <?php if ($rows[$i]['status'] <> 'Exempted') {?>
                        <td style="text-align: center;" width="8%">
                            <?php echo  $rows[$i]['c_lettergrade']; ?>
                            
                        </td>
                        <td style="text-align: center;" width="15%">
                            <?php echo  $rows[$i]['c_gradepoint']; 
                            
                            ?>
                            
                        </td>
                        <td style="text-align: center;" width="9%">
                            <?php 
                                    echo $rows[$i]['c_cgpa']; 
                                    
                            ?>
                            
                        </td>
                        <?php } 
                        else {?>
                        <td style="text-align: center;" width="32%">
                            <?php 
                                echo  $rows[$i]['status']; 
                                
                            ?>                            
                        </td>
                        <?php } ?>
                    </tr>    
                    
            <?php
       
       //  $line = $line + 1;
      }
     
}

//if($line>=35){
    ?>
     

     <?php
     
/*if($line > $max_line)
{
  $this->renderPartial('_transcriptEnd',array('pdf'=>$pdf),true);  
} */
  /*  $line = 0; 
    $page = true;
}
else
{
    $page = false;
}*/
?>                    
             </tbody>
            </table> 
            <?php
          


      
  
 