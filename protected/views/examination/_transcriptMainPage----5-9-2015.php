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
$gr =0;
//echo $moduleGroup[$gr];exit();
do
{
    $totalGrade = 0;
    $gradePoint  = 0;
   // $termYear=FormUtil::getTermYearWithoutNumberHTMLspan(yii::app()->session['trnsStudentID'],yii::app()->session['term'],yii::app()->session['year']);
   // $termYear=FormUtil::getTermYearForTranscript(yii::app()->session['trnsBatName'], yii::app()->session['trnsProCode'],yii::app()->session['term'],yii::app()->session['year']);
   
    $cgpa = 0;
    $totalModule =0;    
    
    if(FormUtil::SearchRowByGroupName($result,$moduleGroup[$gr]))
    {
        ?>
        <div>
           <span style="min-width: 200px; float: left;"><strong><?php echo $moduleGroup[$gr];?></strong></span>    
        </div>
        <?php
    
    echo $table;
    for($k=1; $k<=$total; $k++)
    {
        
//        if((yii::app()->session['term'] == $result[$k]['tra_term']) && (yii::app()->session['year'] == $result[$k]['tra_year'])){                 
         if(($moduleGroup[$gr] == $result[$k]['mod_group'])){                 
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
                
                 if($gradePoint!=0)
                    $cgpa = round($gradePoint/$totalGrade, 2);                                 
                     
                 yii::app()->session['totalTerm'] = yii::app()->session['totalTerm'] + 1;
                 yii::app()->session['semesterResult'] =yii::app()->session['semesterResult'] + $cgpa;  
                 
                 //echo "This semester CGPA:".round(yii::app()->session['semesterResult']/yii::app()->session['totalTerm'], 2);
                 
                 
               /* yii::app()->session['term'] = yii::app()->session['term']+1;
                if(yii::app()->session['term']>3)
                {
                       yii::app()->session['year'] = yii::app()->session['year']+1;
                       yii::app()->session['term'] = 1;
                }*/
                 yii::app()->session['group'] = $moduleGroup[$gr++];
             $i++;
            
             
         ?>
            <br></br><br></br>
         <?php
             
}while($i<=$end);

  ?>
                    
          
  <?php
  if($end !=FormUtil::countTotalTerm($result))
  {
  ?>
            <br></br><br></br><br></br>
          <!--<br></br><br></br><br></br>-->
  <table border="0"  style="font-size:25px; text-align: left;">
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
        <th>Controller of Examinations</th>
    </tr>
    <tr>
         <th></th>
          <th>Metropolitan University, Sylhet, Bangladesh.</th>
    </tr>

</table>
<?php
  }
?>