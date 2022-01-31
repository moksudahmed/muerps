
<table border="0"  style="font-size:30px; text-align: left;">
   <thead>
        <tr>    
            <th colspan ="3" align ="center"><strong>Academic Transcripts</strong></th>
        </tr>
        <tr colspan ="1" >
 		<th>Name</th>
                <th colspan ="2"><?php echo ': '.$headerData[0]['name'] ?></th>
         </tr>
         <tr colspan ="1" >
                <th>Registration No</th>
                <th colspan ="2"><?php echo ': '.$headerData[0]['studentID'] ?></th>
         </tr>
        <tr colspan ="1" >
                <th>Programme</th>
                <th colspan ="2" WIDTH="65%"><?php echo ': '.$headerData[0]['pro_name'] ?></th>
         </tr>
        
        <tr colspan ="1" >
                <th>Batch</th>
                <th colspan ="2"><?php echo ': '.$headerData[0]['batchName'].FormUtil::getBatchNameSufix($headerData[0]['batchName']) ?></th>
         </tr>
                     	
    </thead>
</table>


<?php 
$table ="<table border=\"1\"  style=\"font-size:30px; text-align: left; \">
                    <thead>
                        <tr>
                            <th width=\"15%\">Course Code
                            </th>

                            <th width=\"45%\">Course Title
                            </th>

                            <th width=\"10%\">Credits
                            </th>

                            <th width=\"10%\">Grade
                            </th>

                            <th width=\"15%\">Grade Points per credit
                            </th>

                            <th width=\"15%\">Grade points
                            </th>
                            

                        </tr>
                </thead>
                 <tbody>";
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$rowCount=0;

$j= yii::app()->session['groupModuleCount'];

do
{
    $totalGrade = 0;
    $gradePoint  = 0;
    //$termYear=FormUtil::getTermYearWithNumber(yii::app()->session['trnsBatName'], yii::app()->session['trnsProCode'],yii::app()->session['term'],yii::app()->session['year']);
    $cgpa = 0;
    $totalModule =0;    
   if($moduleGroup[$j] == 'Compulsory GED')
   {
       /*---------- Specially for General Education----- */
          ?>
        <div>
           <span style="min-width: 200px; float: left;"><strong><?php echo 'General Education';?></strong></span>    
        </div>
        <?php
   }
   else{
        ?>
        <div>
           <span style="min-width: 200px; float: left;"><strong><?php echo $moduleGroup[$j]?></strong></span>    
        </div>
        <?php
   }
     echo $table;
    
    for($k=$start; $k<=$end; $k++)
    {
         
        if($moduleGroup[$j] == $result[$k]['mod_group']){                 
            ?>
                <tr>
                        <td width="15%">
                           <?php echo  $result[$k]['moduleCode']; ?>
                        </td>
                        <td width="45%">
                            <?php echo  $result[$k]['mod_name']; ?>
                           
                        </td>
                        <td width="10%">
                            <?php 
                                echo  $result[$k]['mod_creditHour']; 
                                $totalGrade += $result[$k]['mod_creditHour']; 
                            ?>
                        </td>
                        <td width="10%">
                            <?php echo  $result[$k]['letterGrade']; ?>
                            
                        </td>
                        <td width="15%">
                            <?php echo  $result[$k]['gradePoint']; 
                            
                            ?>
                            
                        </td>
                        <td width="15%">
                            <?php 
                                    echo  $result[$k]['cgpa']; 
                                    $gradePoint += $result[$k]['cgpa'];
                            ?>
                            
                        </td>
                    </tr>    
                    
            <?php
        $rowCount++;
        }
    }
   
      
              ?>                    
             </tbody>
            </table> 
            <?php
            
            ?>
            <br></br>
              <?php
           
        
            
         ?>
            
         <?php

        if ($rowCount ==24) break;
       $j++;        
        
}while($j<=count($moduleGroup));
yii::app()->session['groupModuleCount'] = $j;
if($end!=count($result))
{
  ?>

<br></br><br></br>
<br></br><br></br>
<table border="0"  style="font-size:30px; text-align: left;">
    <tr>
        <th>Prepared by</th>
        <th></th>
    </tr>
    <tr>
        <th></th>
        <th></th>
    </tr>
    <tr>
        <th></th>
        <th></th>
    </tr>
    <tr>
        <th>Checked by</th>
        <th style="font-size:30px; text-align: center;">Controller of Examinations</th>
    </tr>
    <tr>
         <th></th>
          <th>Metropolitan University, Sylhet, Bangladesh.</th>
    </tr>

</table>                  
  <?php
}
  ?>