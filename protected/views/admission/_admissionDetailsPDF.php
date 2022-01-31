<style>
p{
  
    font-family: "Times New Roman";
    font-size: 30px; /* 40px/16=2.5em */
    color:white;
    background-color:  #C2C2C2;
    position: relative;
    top: 30px;
    right: 50px;
}  
h8 {
    font-family: "Times New Roman";
    font-size: 30px; /* 40px/16=2.5em */
    color:white;    
    position: relative;
    top: 30px;
    right: 50px;
}
</style>
<table border="0" style="font-family: Times New Roman; font-size:20pt; text-align: center; ">
    <tr>
        <td colspan ="3" style="text-align: center; ">
          
        </td>
        <td style="text-align: right; "> 
        </td>
    </tr>
    <tr>
        <td colspan ="3" style="text-align: center; ">
            <h2>Application Form</h2>            
        </td>
        <td style="text-align: right; "> <?php echo CHtml::image(dirname(Yii::app()->getBasePath()).DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'images.jpg', 'DORE',array("width"=>"100px")); ?>
        </td>
    </tr>
</table>
<h8>Details of the programme you want to attend</h8>
<br>
<br>
<table border="0" style="font-family: Times New Roman; font-size:5pt; text-align: left; ">
     
    <tr>
        <td style="font-family: Times New Roman;font-size:30px;  text-align: left;"><strong>Programme Title</strong></td>
        <td colspan="2" style="font-family: Times New Roman;font-size:30px;  text-align: left;">:<?php  echo DBhelper::getProgrammeNameById(yii::app()->session['proCode']); ?></td>
    </tr>
    <tr>
        <td style="font-family: Times New Roman;font-size:30px;  text-align: left;"><strong>Academic Year</strong></td>
        <td colspan="2" style="font-family: Times New Roman;font-size:30px;  text-align: left;">:<?php  echo FormUtil::getTerm($student->stu_academicTerm)." ".$student->stu_academicYear ;?></td>
    </tr>
    <tr>
        <td colspan="2" style="font-family: Times New Roman; font-size:25px;  text-align: left;">                     
        <h3><strong>Student ID:<?php echo $admission->studentID;  ?></strong></h3> 
        </td>                   
         <td></td>

    </tr>
</table>

<p><strong>1. Personal Details:</strong></p>
<table border="0" style="font-family: Times New Roman; font-size:10pt; text-align: left; ">
    
<tbody>
    
    <tr>
             <td >
                Name
             </td>
             <td colspan="2">:
                 <?php echo $person->per_firstName." ".$person->per_lastName; ?>
             </td>
     </tr>
     
     <tr>
             <td>
                 Date of Birth
             </td>
             <td colspan="2">:
                 <?php echo date("jS M Y",strtotime($person->per_dateOfBirth)); ?>
             </td>
     </tr>
    <tr>
             <td>
                 Gender
             </td>
             <td colspan="2">:
                 <?php 
                 if($person->per_gender =='male')
                        echo "Male"; 
                 else echo "Female";
                 ?>
             </td>
    </tr>
    
    <tr>
             <td>
                 Blood Group
             </td>
             <td colspan="2">:                
                 <?php 
                 if ($person->per_bloodGroup !='unknown')
                     echo $person->per_bloodGroup; 
                 else
                     echo '';
                     ?>
             </td>
     </tr>
     <tr>
             <td>
                 Nationality
             </td>
             <td colspan="2">:
                 <?php echo $person->per_nationality; ?>
             </td>
         </tr>
         <tr>
             <td>
                 Father's Name
             </td>
             <td colspan="2">:
                 <?php echo $person->per_fathersName; ?>
             </td>
         </tr>
         <tr>
             <td>
                 Mother's Name
             </td>
             <td colspan="2">:
                 <?php echo $person->per_mothersName; ?>
             </td>
         </tr>
         <tr>
             <td>
                 Marital Status
             </td>
             <td colspan="2">:
                 <?php if($person->per_maritalStatus =='single')
                         echo "Single";
                    else echo "Married"; ?>
             </td>
         </tr>
         <tr>
             <td>
                 Spouse Name
             </td>
             <td colspan="2">:
                 <?php echo CHtml::encode($person->per_spouseName!=null? $person->per_spouseName : "-- N/A --");  ?>
             </td>
         </tr>
         <tr>
             <td>
                 Present Address
             </td>
             <td colspan="2">:
                 <?php echo $person->per_presentAddress; ?>
             </td>
         </tr>
         <tr>
             <td>
                 Permanent Address
             </td>
             <td colspan="2">:
                 <?php echo $person->per_permanentAddress; ?>
             </td>
         </tr>
        <tr>
             <td>
                 Mobile
             </td>
             <td colspan="2">:
                 <?php echo '+88'.$person->per_mobile; ?>
             </td>
         </tr>
         <tr>
             <td>
                 Telephone
             </td>
             <td colspan="2">:
                <?php echo CHtml::encode($person->per_telephone!=null? $person->per_telephone : "-- N/A --"); ?>
             </td>
         </tr>
         <tr>
             <td>
                 Email
             </td>
             <td colspan="2">:
                 <?php echo CHtml::encode($person->per_email!=null? $person->per_email : "-- N/A --"); ?>
             </td>
         </tr>
         <tr>
             <td></td>
             <td></td>
         </tr>
</tbody>
</table>

<p><strong>2. Guardian's Details</strong></p>
<table border="0" style="font-family: Times New Roman; font-size:10pt; text-align: left; ">
    <tbody>
      
         <tr>
             <td>
                 Name
             </td>
             <td colspan="2">:
                 <?php  echo CHtml::encode($student->stu_guardiansName!=null? $student->stu_guardiansName : "-- N/A --"); ?>
             </td>
         </tr>
         <tr>
             <td>
                 Mobile
             </td>
             <td>:
                 <?php  echo '+88'.CHtml::encode($student->stu_guardiansMobile!=null? $student->stu_guardiansMobile : "-- N/A --"); ?>
             </td>
         </tr>
         <tr>
             <td>
                 Address
             </td>
             <td colspan="2">:
                 <?php  echo CHtml::encode($student->stu_guardiansAddress!=null? $student->stu_guardiansAddress : "-- N/A --"); ?>
             </td>
         </tr>
         <tr>
             <td></td>
             <td></td>
         </tr>
    </tbody>
</table>
<p><strong>3. Admission Details:</strong></p>
<table border="0" style="font-family: Times New Roman; font-size:10pt; text-align: left; ">
   
    <tbody>    
                  
         <tr>
             <td>
                 Admission Date
             </td>
             <td colspan="2">:
                 <?php  echo CHtml::encode($admission->adm_date!=null? date("jS, M Y",strtotime($admission->adm_date)) : "-- N/A --"); ?>
             </td>
         </tr>
         <tr>
             <td>
                  Waiver
             </td>
             <td colspan="2">:
                 <?php  echo CHtml::encode($admission->waiverID!=null? Waiver::model()->findByPk($admission->waiverID)->wav_title : "-- N/A --"); ?>
             </td>
         </tr>
         <tr>
             <td>
                  Remarks
             </td>
             <td colspan="2">:
                 <?php  echo CHtml::encode($admission->adm_remarks!=null? $admission->adm_remarks : "-- N/A --"); ?>
             </td>
         </tr>
         
         <tr>
             <td>
                  Conditions
             </td>
             <td colspan="2">:
                 <?php  echo CHtml::encode($student->stu_conditions!=null? $student->stu_conditions : "-- N/A --"); ?>
             </td>
         </tr>
         <tr>
             <td></td>
             <td></td>
         </tr>
  </tbody>
</table>
<p><strong>4. Previous study at Metropolitan University</strong></p>
<table border="0" style="font-family: Times New Roman; font-size:10pt; text-align: left; ">
    
    <tbody>    
        
         <tr>
             <td>
                 Previous ID
             </td>
             <td colspan="2">:
                 <?php  echo CHtml::encode($student->stu_previousID!=null? $student->stu_previousID : "-- N/A --"); ?>
             </td>
         </tr>
         <tr>
             <td>
                 Previous Degree
             </td>
             <td colspan="2">:
                 <?php  echo CHtml::encode($student->stu_previousDegree!=null? $student->stu_previousDegree : "-- N/A --"); ?>
             </td>
         </tr>
         <tr>
             <td></td>
             <td></td>
         </tr>
 </tbody>
</table>
<p><strong>5. Criminal Convictions</strong></p>
<table border="0" style="font-family: Times New Roman; font-size:10pt; text-align: left; ">
    
    <tbody>    
          
         <tr>
             <td>
                 
                 Criminal Conviction
             </td>
             <td colspan="2">:
                 <?php  echo CHtml::encode($person->per_criminalConviction==1? "YES" : "NO"); ?>
             </td>
         </tr>
         <tr>
             <td>
                 Conviction Details
             </td>
             <td colspan="2">:
                 <?php  echo CHtml::encode($person->per_convictionDetails!=null? $person->per_convictionDetails : "-- N/A --"); ?>
             </td>
         </tr>
         
         <tr>
             <td></td>
             <td></td>
         </tr>
    </tbody>
    
</table>
