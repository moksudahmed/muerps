<?php 
    $markingScheme = MarkingScheme::model()->findByPk($moduleReg[0]['markingSchemeID']?$moduleReg[0]['markingSchemeID']:1);
    $firstHalfMarks = $markingScheme->mrs_attendance+ $markingScheme->mrs_classTest+$markingScheme->mrs_midterm; 
    //$secondHalfMarks= $markingScheme->mrs_final;
    
?>  
<h1><?php echo FormUtil::getTerm(yii::app()->session['mreTerm']).' Term Final Examination'.' '.yii::app()->session['mreYear'] ;?></h1>
    <h3><strong>Programme: </strong> <?php echo DBhelper::getProgrammeByCode(yii::app()->session['mreProCode']); ?> </h3>

   <h3><strong>Academic Year: </strong><?php echo DBhelper::getAcademicYearByBatch(yii::app()->session['mreBatch'],yii::app()->session['mreProCode']).' '.'Batch No.'.yii::app()->session['mreBatch'].FormUtil::getBatchNameSufix(yii::app()->session['mreBatch']); ?></h3>
   <h3><strong>Course: </strong><?php echo yii::app()->session['mreModule']; ?></h3>
 
    

<?php  if ($moduleReg !== null):?>
<table border="1"  style="font-size:30px; text-align: center; ">
    <thead>
	<tr>
                <th>
                    <strong>
                        Student ID		
                    </strong>
		      
                </th>
                <th >
                    <strong>
                        Attendance 	<sup><?php echo $markingScheme->mrs_attendance; ?></sup>
                     </strong>
                </th>
                <th>
                    <strong>
		      Class Test <sup><?php echo $markingScheme->mrs_classTest; ?></sup>
                     </strong>
                </th>
                <th >
                    <strong>
		      Midterm <sup><?php echo $markingScheme->mrs_midterm; ?></sup>
                     </strong>
                </th>
                <th >
                    <strong>
                         Total <sup><?php echo $firstHalfMarks; ?></sup>
                     </strong>
                </th>
 	</tr>
    </thead>
    <tbody>
	<?php $i=1; foreach($moduleReg as $row): ?>
	<tr>
        	<td>
			<?php echo $row['studentID']; ?>
		</td>
       		              <?php
               $sql = "SELECT 
                      \"reg_attendence\",
                      \"reg_classTest\",
                      \"reg_midterm\",                      
                      \"total\"                      
                    FROM
                      vw_getfirsthalfmarkslist
                    WHERE
                      \"studentID\" = '{$row['studentID']}' AND
                      \"offeredModuleID\" = '{$row['offeredModuleID']}'";
                $row3 = Yii::app()->db->createCommand($sql)->queryAll();
                 
                
              ?>
                <td>
		   <?php echo $row['reg_attendence']; ?>
		</td>
                <td>
		   <?php echo $row['reg_classTest']; ?>
		</td>
                <td>
		   <?php echo $row['reg_midterm']; ?>
		</td>
                <td>
		   <?php echo $row['total']; ?>
		</td>
       	</tr>
    </tbody>
     <?php $i++; endforeach; ?>
</table>
<?php endif; ?>
    
</div>
<br></br><br></br><br></br>
 
<table border = "0" width="100%">
    <tr>
        <th>Date:</th>
        <th>Signature of the Examiner:</th>
    </tr>
    <tr>
        <th></th>
        <th>Full Name:</th>
    </tr>
    <tr>
        <th></th>
        <th>Designation:</th>
    </tr>
</table>
 

