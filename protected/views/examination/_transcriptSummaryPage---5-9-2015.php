<?php
$sql= "select \"exm_resultDate\" from vw_examination_detail where \"studentID\"='{$headerData[0]['studentID']}';"; 
$examDate = Yii::app()->db->createCommand($sql)->queryAll();
//$date = DateTime::createFromFormat("Y-m-d", $examDate[0]['exm_resultDate']);

//$sql= "SELECT count(vw_transcript.\"gradePoint\")FROM public.vw_transcript where \"studentID\"='{$headerData[0]['studentID']}';";
//$examDate = Yii::app()->db->createCommand($sql)->queryAll();

  

?>
<table border="0"  style="font-size:25px; text-align: left;">
   <thead>
        <tr>    
            <th colspan ="2" align ="left"><strong>Transcript of Academic Record</strong></th>
        </tr>
        <tr colspan ="1" >
 		<th>Name of the Student</th>
                <th colspan ="1"><?php echo ': '.$headerData[0]['name'] ?></th>
         </tr>
         <tr colspan ="1" >
                <th>Identification/Registration Number</th>
                <th colspan ="1"><?php echo ': '.$headerData[0]['studentID'] ?></th>
         </tr>
        
         <tr colspan ="1" >
                <th>Nationality</th>
                <th colspan ="1"><?php echo ': '.$headerData[0]['per_nationality'] ?></th>
         </tr>
         <tr colspan ="1" >
                <th>Degree awarded</th>
                <?php
                if($completedCredit>=$headerData[0]['syl_maxCreditHour'])
                {
                ?>
                <th colspan ="1" WIDTH="65%"><strong><?php echo ': '.$headerData[0]['pro_name'] ?></strong></th>
                <?php
                }
                else
                {
                ?>
                <th colspan ="1" WIDTH="65%"><strong><?php echo ': ---' ?></strong></th>
                <?php
                }
                ?>
         </tr>
        
        <tr colspan ="1" >
                <th>Academic session</th>
                <th colspan ="1"><?php echo ': '.FormUtil::getTerm($headerData[0]['stu_academicTerm']).' '.$headerData[0]['stu_academicYear'] ?></th>
         </tr>
         <tr colspan ="1" >
                <th>Duration of the Programme</th>
                <th colspan ="1"><?php echo ': '.$headerData[0]['duration'].' '.'Years' ?></th>
         </tr>
         <tr colspan ="1" >
               <th>Year of completion of the degree</th>
              <?php
               if($headerData[0]['sum']>=$headerData[0]['syl_maxCreditHour'])
                {
                ?>
                <th colspan ="1"><?php //echo ':'.Yii::app()->locale->getDateFormat('mm/dd/yyyy'); ?></th>
            <?php
                }
                else
                {
                ?>
                <th colspan ="1"><?php echo ': ---' ?></th>
                <?php
                }
                ?>

         </tr>
         
         <tr colspan ="1" >
                <th>Credit hours required for the degree</th>
                <th colspan ="1"><?php echo ': '.$headerData[0]['syl_maxCreditHour'] ?></th>
         </tr>
         <tr colspan ="1" >
                <th>Credit completed in this University</th>
                <th colspan ="1"><?php echo ': '.$completedCredit ?></th>
         </tr>
         <tr colspan ="1" >
                <th>Officially approved instruction medium</th>
                <th colspan ="1">: English</th>
         </tr>
         <tr colspan ="1" >
	      <th>Maximum attainable GPA</th>
              <th colspan ="1"><?php echo ': '.$headerData[0]['syl_maxCGPA'].'.00' ?></th>
           </tr>
           <tr colspan ="1" >	
               <th>Minimum GPA required for the degree</th>
               <th colspan ="1"><?php echo ': '.$headerData[0]['syl_minCGPA'].'.00' ?></th>

            </tr>
            	
    </thead>
</table>

<br></br><br></br>
<div>
    <span style="min-width: 200px; float: left;"><strong>Accreditation:</strong></span>
</div>
                
<table border="0"  style="font-size:25px; text-align: left;">
    <tr><th>Established in 2003. Metropolitan University, Sylhet, Bangladesh is approved by The Government of the People’s Republic of Bangladesh and the University 
        Grants Commission of Bangladesh.</th></tr>
    <tr><th>The curricula and programmes of the University have been duly approved by the University Grants Commission (UGC) of Bangladesh. </th></tr>
    <tr><th>Honourable President of the People’s Republic of Bangladesh is the Chancellor of Metropolitan University, Sylhet, Bangladesh. The Chairman, Board of 
Trustees, is the President of the University, The Vice - Chancellor is an appointee of the President of the country in his capacity as the Chancellor of the 
University.</th></tr>
</table>

<br></br><br></br>
<div>
    <span style="min-width: 200px; float: left;"><strong>Academic Calender:</strong></span>
</div>
                
<div>
    <span style="min-width: 200px; float: left;">The academic year is divided into 3 terms of Spring, Summer and Autumn as follows:</span>
</div>
<br></br><br></br>

<table border="0"  style="font-size:25px; text-align: left;">
    <tr>
        <th></th>
        <th>Spring Term:</th>
        <th>Start in January</th>
        <th>13 Weeks</th>
    </tr>

    <tr>
        <th></th>
        <th>Summer Term:</th>
        <th>Start in May</th>
        <th>13 Weeks</th>
    </tr>

    <tr>
        <th></th>
        <th>Autumn Term:</th>
        <th>Start in September</th>
        <th>13 Weeks</th>
    </tr>
    
</table>
<br></br><br></br>

<div>
    <span style="min-width: 200px; float: left;"><strong>
    <?php echo "This Academic Transcript contains"." ".$totalPage."(".FormUtil::get_convert_number($totalPage).")"." "."pages"; ?></strong></span>
</div>

<br></br><br></br>
<br></br><br></br>
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
            
   ?>  