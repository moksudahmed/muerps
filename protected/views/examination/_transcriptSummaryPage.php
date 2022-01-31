<table border="0"  style="font-size:28px; text-align: left;">
   <thead>
        <tr>    
            <th colspan ="2" align ="left"><strong><i>Transcript of Academic Record</i></strong></th>
        </tr>
        <tr colspan ="1" >
 		<th>Name of the Student</th>
                <th colspan ="1"><?php echo ': '.$headerData[0]['name'] ?></th>
         </tr>
         <tr colspan ="1" >
                <th>ID No</th>
                <th colspan ="1"><?php echo ': '.$headerData[0]['studentID'] ?></th>
         </tr>
        
         <tr colspan ="1" >
                <th>Nationality</th>
                <th colspan ="1"><?php echo ': '.$headerData[0]['per_nationality'] ?></th>
         </tr>
         <tr colspan ="1" >
                <th>Degree awarded</th>
                <?php
                if($credits[0]['sum']>=$headerData[0]['syl_maxCreditHour'])
                {
                ?>
                <th colspan ="1" WIDTH="65%"><strong><?php echo ': '.$headerData[0]['pro_officialName'] ?></strong></th>
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
         <?php
          //  if ($obtain_cgpa >= 3.90 && $obtain_cgpa <=3.94){
                ?>
            <!--     <tr colspan ="1" >
                        <th>Academic award</th>
                        <th colspan ="1">: <strong><i><?php //echo  'Magna Cum Laude';  ?></strong></i></th>
                 </tr>-->
              <?php /*}
               elseif($obtain_cgpa >= 3.95){  ?>
                        <tr colspan ="1" >
                        <th>Academic award</th>
                        <th colspan ="1">: <strong><i><?php echo 'Summa Cum Laude and Gold Medal';  ?></strong></i></th>
                 </tr>
               <?php }*/                                    
          ?>
        <tr colspan ="1" >
                <th>Academic session</th>
                <th colspan ="1"><?php echo ': '.FormUtil::getMonthNameFromAcademicTerm($headerData[0]['stu_academicTerm']).' '.$headerData[0]['stu_academicYear'] ?></th>
         </tr>
        
         
         
         <tr colspan ="1" >
                <th>Duration of the Programme</th>
                <th colspan ="1"><?php echo ': '.$headerData[0]['duration']?></th>
         </tr>
         <tr colspan ="1" >
               <th>Year of completion of the degree</th>
              <?php
               if($credits[0]['sum']>=$headerData[0]['syl_maxCreditHour'])
                {
                  if(yii::app()->session['passYear'] == true){
                   
                     // $date = 2011;
                  ?>
                    <th colspan ="1"><?php echo ': '.$date; ?></th>
                   <?php }
                    elseif(yii::app()->session['customPassYear'] == true){
                      //  echo (yii::app()->session['completionYear']);
                      //  exit();
                        $date = yii::app()->session['completionYear'];
                        ?>
                         <th colspan ="1"><?php echo ': '.$date; ?></th>
                   <?php }
                  
                   else{?>
                    <th colspan ="1"><?php echo ': '.Yii::app()->dateFormatter->format("yyyy", $date); ?></th>
                    <?php }?>
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
       
         <?php if ($credit_exemption > 0){?>
             <tr colspan ="1" >
                <th>Credit completed in this University</th>
                <th colspan ="1"><?php echo ': ';echo $credits[0]['sum']- $credit_exemption ?></th>
         </tr>
          <tr colspan ="1" >
                <th>Credit exempted</th>
                <th colspan ="1"><?php echo ': '.$credit_exemption ?></th>
         </tr>        
         <?php }
         else {?>
             <tr colspan ="1" >
                <th>Credit completed in this University </th>
                <th colspan ="1"><?php echo ': '.$credits[0]['sum'] ?></th>
             </tr>
         <?php }?>
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



<div>
<?php
$image = Yii::app()->baseUrl . '/images/'."gpa.png";
echo CHtml::image($image , ' ' , array(
   'style' => 'max-height: 128px;',
)); ?> 
    </div>


<strong><i>Accreditation:</i></strong>
<br></br>
                
<table border="0"  style="font-size:28px; text-align: left;">
    <tr><th>Established in 2003. Metropolitan University, Sylhet, Bangladesh is approved by The Government of the People’s Republic of Bangladesh and the University 
        Grants Commission of Bangladesh.</th></tr>
    <tr><th>The curricula and programmes of the University have been duly approved by the University Grants Commission (UGC) of Bangladesh. </th></tr>
    <tr><th>Honourable President of the People’s Republic of Bangladesh is the Chancellor of Metropolitan University, Sylhet, Bangladesh. The Chairman, Board of 
Trustees, is the President of the University, The Vice - Chancellor is an appointee of the President of the country in his capacity as the Chancellor of the 
University.</th></tr>
</table>

<br></br><br></br>
<strong><i>Academic Calendar:</i></strong>
<p>The academic year is divided into 3 terms of Spring, Summer and Autumn as follows:</p>              
<br></br><br></br>

<table border="0"  style="font-size:28px; text-align: left;">
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
    <?php echo "This Academic Transcript contains"." ".$totalPage." (".FormUtil::get_convert_number($totalPage).")"." "."pages"; ?></strong></span>
</div>

<br></br><br></br>
<br></br><br></br>
<table border="0"  style="font-size:28px; text-align: left;">
    <tr>
        <th><strong><i>Prepared by</i></strong></th>
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
        <th><strong><i>Checked by</i></strong></th>
        <th style="font-size:30px; text-align: center;"><strong><i>Controller of Examinations</i></strong></th>
    </tr>
    <tr>
         <th></th>
          <th style="font-size:30px; text-align: center;"><strong><?php echo Options::getOptions('organization_name_with_location'); ?></strong></th>
    </tr>

</table>
<?php
            
   ?>  