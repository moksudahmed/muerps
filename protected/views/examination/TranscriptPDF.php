<div class="title">
  <table border="0"  style="font-size:22px; text-align: left; ">
   <thead>
        <tr>    
            <th colspan ="7" align ="center"><h1>Academic Transcripts</h1></th>
        </tr>
        <tr><th colspan ="7"><h2>Office of the Controller of Examinations</h2></th></tr>
           <tr class="span-1">
	      <th>Date</th>
              <th colspan ="3">: February 10, 2014</th>
           </tr>
           <tr>	
               <th>Serial No</th>
               <th colspan ="3">: BBA-17/2013</th>
               <th></th>
            </tr>
            <tr>
 		<th>Name</th>
                <th colspan ="6">: Khondakar Moksud Ahmed</th>
             </tr>
             <tr>
                <th>Registration No</th>
                <th colspan ="3"><?php echo ':'.yii::app()->session['trnsStudentID'];?></th>
            </tr>
            <tr>
                <th>Programme</th>
                <th colspan ="6"><?php echo ': '.DBhelper::getProgrammeNameById(yii::app()->session['reProCode']);?></th>
            </tr>
            <tr>

                <th>Batch</th>
                 <th><?php echo ': '.yii::app()->session['reBatName'].FormUtil::getBatchNameSufix(yii::app()->session['reBatchName']);?></th>
           </tr>
        	
    </thead>
     
</table>
     

     <?php 
      $page = 0;     
      $check = FALSE;
      for($i=0; $i<=3; $i++)
      {
      foreach ($subjectRows as $srow) 
         {
       ?>
            
        <p><strong> <?php //echo CHtml::encode($srow['mod_group']);?></strong></p>
            
  	<?php
             $sid = yii::app()->session['trnsStudentID'];
             $sql = "SELECT DISTINCT
                    \"letterGrade\",
                    \"gradePoint\",
                    \"grade_points\",
                     \"mod_creditHour\",
                     \"moduleCode\", 
                     \"mod_name\",
                     \"mod_group\"
                   FROM 
                    vw_transcript
                  WHERE 
                    \"studentID\" = '{$sid}' AND
                    \"mod_group\" = '{$srow['mod_group']}'
                   ";            
             $rows = Yii::app()->db->createCommand($sql)->queryAll();
             ?>
        <table border="1"  style="font-size:25px; text-align: left; ">
        
            <tr>
                <th>Course Code
                </th>
                
                <th colspan="4">Course Title
                </th>
                
                <th>Credits
                </th>
                
                <th>Grade
                </th>
                
                <th colspan ="2">Grade Points per credit
                </th>
                
                <th>Grade points
                </th>
                
            </tr>
            <?php 
            $page++;
            
             foreach ($rows as $row) 
             {
              ?>
            <tr>
                <th>
                    <?php echo CHtml::encode($row['moduleCode']);?>
                </th>
                <th colspan="4">
                    <?php echo CHtml::encode($row['mod_name']);?>
                </th>
                <th>
                    <?php echo CHtml::encode($row['mod_creditHour']);?>
                    
                </th>
                <th>
                    <?php echo CHtml::encode($row['letterGrade']);?>
                </th>
                <th colspan ="2">
                    <?php echo CHtml::encode($row['gradePoint']);?>
                </th>
                <th>
                    <?php echo CHtml::encode($row['grade_points']);?>
                </th>
            </tr>
                
            <?php   
                $page++;
                if($page%6 == 0)
                {
                 $check = TRUE;
            ?>
             </table>
                   <table border="1"  style="font-size:22px; text-align: left; ">
                      <tr>
                          <th>Prepared By</th>
                          <th></th>
                      </tr>
                      <tr>
                          <th></th>
                          <th>Controller of Examinations</th>
                      </tr>
                      <tr>
                          <th>Checked By</th>
                          <th>Metropolitan University, Sylhet, Bangladesh</th>
                      </tr>
                </table>
                 
            <span></span>      
            <span></span>      
            <table border="1"  style="font-size:25px; text-align: left; ">

                    <tr>
                        <th>Course Code
                        </th>

                        <th colspan="4">Course Title
                        </th>

                        <th>Credits
                        </th>

                        <th>Grade
                        </th>

                        <th colspan ="2">Grade Points per credit
                        </th>

                        <th>Grade points
                        </th>

                    </tr>

               <?php 
               
               
               }
               
             }
              
            ?>
            
            </table>
            <span></span>      
         
           <?php
                
             
      
	}
      }
      
	 ?>  
  </div>
  <span></span>

  <p><strong>Total credit hours required for the degree = 126 </strong></p>
  <p><strong>Credit completed in this University =126 </strong></p>
  <p><strong>CGPA = 3.16 </strong></p>
  <p><strong>Grade = B </strong></p>
  <p><strong>Issued at Sylhet, Bangladesh </strong></p>
  
  <div class="title">
  
  <table border="0"  style="font-size:22px; text-align: left; ">
      <tr>
          <th>Prepared By</th>
          <th></th>
      </tr>
      <tr>
          <th></th>
          <th>Controller of Examinations</th>
      </tr>
      <tr>
          <th>Checked By</th>
          <th>Metropolitan University, Sylhet, Bangladesh</th>
      </tr>
  </table>

</div>