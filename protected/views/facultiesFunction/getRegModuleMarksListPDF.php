<?php 
    $markingScheme = MarkingScheme::model()->findByPk($moduleReg[0]['markingSchemeID']?$moduleReg[0]['markingSchemeID']:1);
    $firstHalfMarks = $markingScheme->mrs_attendance+ $markingScheme->mrs_classTest+$markingScheme->mrs_midterm; 
    //$secondHalfMarks= $markingScheme->mrs_final;
    
?>  
<h2><?php echo FormUtil::getTerm(yii::app()->session['mreTerm']).' Term Final Examination'.' '.yii::app()->session['mreYear'] ;?></h2>
<table border = "0" style="font-size:30px; text-align: left; " width="100%">
    <tr>
        <th width="40%"><strong>Programme: </strong> <?php echo yii::app()->session['mreProCode'].':'.DBhelper::getProgrammeShortName(yii::app()->session['mreProCode']); ?> </th>
        <th width="60%"><?php echo FormUtil::getBatchTermHTMLspan(yii::app()->session['mreSection'],yii::app()->session['mreBatch'],yii::app()->session['mreProCode'] ); ?></th>
    </tr>
    <tr>
        <!--th width="40%"><strong>Academic Year: </strong><?php echo DBhelper::getAcademicYearByBatch(yii::app()->session['mreBatch'],yii::app()->session['mreProCode']); ?></th-->
        <th width="60%"><strong>Course: </strong><?php echo yii::app()->session['mreModule']; ?></th>
    </tr>
    
</table>
 
        

<?php  if ($moduleReg !== null):?>
<table border="1"  style="font-size:30px; text-align: center; ">
    <thead>
	<tr>
                <th width="20%">
                    <strong>
                        Student ID		
                    </strong>
		      
                </th>
                <th width="20%">
                    <strong>
                        Attendance <br>	<?php echo '('.$markingScheme->mrs_attendance.')'; ?>
                     </strong>
                </th>
                <th width="12%">
                    <strong>
		      Class Test <br><?php echo '('.$markingScheme->mrs_classTest.')'; ?>
                     </strong>
                </th>
                <th width="15%">
                    <strong>
		      Midterm <br><?php echo '('.$markingScheme->mrs_midterm.')'; ?>
                     </strong>
                </th>
                
                <th width="15%">
                    <strong>
                         Out of (60)<br>
                     </strong>
                </th>
                <th width="15%">
                    <strong>
                         Final<br><?php echo '(40)'; ?>
                     </strong>
                </th >
                <th width="15%">
                    <strong>
                         Out of (100)<br>
                     </strong>
                </th>
 	</tr>
    </thead>
    <tbody>
	<?php $i=1; foreach($moduleReg as $row): ?>
	<tr>
        	<td width="20%">
			<?php echo $row['studentID']; ?>
		</td>
       		              <?php
               $sql = "SELECT 
                      \"reg_attendence\",
                      \"reg_classTest\",
                      \"reg_midterm\", 
                      \"markFirstHalf\",
                      \"emr_mark\",
                      \"total\"
                    FROM
                      vw_consolidate_mark
                    WHERE
                      \"studentID\" = '{$row['studentID']}' AND
                      \"offeredModuleID\" = '{$row['offeredModuleID']}'";
                $row3 = Yii::app()->db->createCommand($sql)->queryAll();
                 
                
              ?>
                <td width="20%">
		   <?php echo $row['reg_attendence']; ?>
		</td>
                <td width="12%">
		   <?php echo $row['reg_classTest']; ?>
		</td>
                <td width="15%">
		   <?php echo $row['reg_midterm']; ?>
		</td>
                <td width="15%">
		   <?php echo $row['markFirstHalf']; ?>
		</td>
                <td width="15%">
		   <?php echo $row['emr_mark']; ?>
		</td>
                
                <td width="15%">
		   <?php echo $row['total']; ?>
		</td>
       	</tr>
    </tbody>
     <?php $i++; endforeach; ?>
</table>
<?php endif; ?>
    
</div>
<br></br><br></br><br></br>
<br></br>


<table border="0"  style="font-size:28px; text-align: left; ">
        <thead>
            <tr><th></th><th></th></tr>
            <tr><th></th><th></th></tr>
            
            <tr>
                <th>-------------------------------------------------</th>
                <th style="font-size:28px; text-align: right;">-------------------------------------------------</th>
            </tr>
        <tr>
            <th>Signature of the Examiner:</th>
            <th style="font-size:28px; text-align: right;">Signature of the Department Head</th>
        </tr>
        <tr><th><?php echo yii::app()->session['MainFacultyName'];?></th>
            <th style="font-size:28px; text-align: left;"></th></tr>
        <tr>
            <th>Date:</th>
            <th></th>
        </tr>
        </thead>
        
</table>
    