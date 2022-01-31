<table border="0"  style="font-size:25px; text-align: left;">
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
$table ="<table border=\"1\"  style=\"font-size:25px; text-align: left; \">
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


$i=$start;

do
{
    $totalGrade = 0;
    $gradePoint  = 0;
    $termYear=FormUtil::getTermYearWithNumber(yii::app()->session['trnsBatName'], yii::app()->session['trnsProCode'],yii::app()->session['term'],yii::app()->session['year']);
    $cgpa = 0;
    $totalModule =0;    
    if(FormUtil::SearchRow($result,yii::app()->session['term'],yii::app()->session['year']))
    {
        ?>
        <div>
           <span style="min-width: 200px; float: left;"><strong><?php echo $termYear?></strong></span>    
        </div>
        <?php
    
    echo $table;
    for($k=1; $k<=$total; $k++)
    {
        if((yii::app()->session['term'] == $result[$k]['tra_term']) && (yii::app()->session['year'] == $result[$k]['tra_year'])){                 
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
              
        }

      }
              ?>                    
             </tbody>
            </table> 
            <br></br>
              <?php
        }       
        if($totalGrade!=0)
                echo "This semester CGPA:".round($gradePoint/$totalGrade, 2);//"Grade:".FormUtil::getGPA(round($gradePoint/$totalGrade, 2)

                 
                yii::app()->session['term'] = yii::app()->session['term']+1;
                if(yii::app()->session['term']>3)
                {
                       yii::app()->session['year'] = yii::app()->session['year']+1;
                       yii::app()->session['term'] = 1;
                }
             $i++;
         ?>
            <br></br><br></br>
         <?php
             
}while($i<=$end);

  ?>
                    
  