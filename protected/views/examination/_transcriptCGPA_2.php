<?php
//$data = FormUtil::countCompletedCredit(yii::app()->session['trnsStudentID']);

?>
<table border="0"  style="font-size:30px; text-align: left;">
   <thead>
        <tr colspan ="1" >
 		<th>Total Credit hours required for the degree:<?php echo $headerData[0]['syl_maxCreditHour']?></th>
         </tr>
         <tr colspan ="1" >
            <th>Credit completed in this University:<?php echo $completedCredit ?></th>
         </tr>
        <tr colspan ="1" >
                <th>CGPA:<?php echo round($CGPA, 2)?></th>
         </tr>
         
        <?php
        
        IF ($CGPA == 4.00)
		$gpa ="A+";
	ELSEIF ($CGPA >=3.75 && $CGPA <4.00) 
		$gpa ="A";
	ELSEIF ($CGPA >=3.50 && $CGPA <3.75) 
		$gpa ="A-";
	ELSEIF ($CGPA >=3.25 && $CGPA <3.50) 
		$gpa ="B+";
	ELSEIF ($CGPA >=3.00 && $CGPA <3.25) 
		$gpa ="B";
	ELSEIF ($CGPA >=2.75 && $CGPA <3.00)
		$gpa ="B-";
	ELSEIF ($CGPA >=2.50 && $CGPA <2.75)
		$gpa ="C+";
	ELSEIF ($CGPA >=2.25 && $CGPA <2.50) 
		$gpa ="C";
	ELSEIF ($CGPA >=2.00 && $CGPA <2.25) 
		$gpa ="D";
	ELSE		
		$gpa ="F*";
	
        ?>
         <tr colspan ="1" >
                <th>GPA:<?php echo $gpa?></th>
         </tr>
        <tr colspan ="1" >
                <th>Issued at Sylhet, Bangladesh.</th>                
         </tr>
                     	
    </thead>
</table>
<br></br><br></br><br></br>



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
        <th>Controller of Examinations</th>
    </tr>
    <tr>
         <th></th>
          <th>Metropolitan University, Sylhet, Bangladesh.</th>
    </tr>

</table>                  
  