<?php
/* @var $this AdministrationController */
/* @var $model Administration */

$this->breadcrumbs=array(
        'Student Administration'=>array('StudentAdministration'),
	'List Student'=>array('index'),
	'Detailed View'
);

$this->menu=array(
        array('label'=>'Student Administration', 'url'=>array('studentAdministration')),
	array('label'=>'List Student', 'url'=>array('index')),
        array('label'=>'New Admission', 'url'=>array('create','flag'=>true)),
        array('label'=>'Detailed View', 'url'=>'#','active'=>true),
	array('label'=>'Edit Student', 'url'=>array('update','id'=>$student->studentID),),
    array('label'=>'Generate PDF', 'url'=>array('admissionFormPDF','id'=>$student->studentID),'target'=>'blank'),
);

?>
<?php
    
?>


    <div class="title">
            <div class="span-8">
                <h3>Detailed View</h3>
                <h3><strong>Student ID: </strong> <span class="label label-success"> <?php echo $admission->studentID;  ?></span></h3>
                <h4 style="padding-right: 10px;"><strong>Batch: </strong><span class="label label-warning"> <?php echo yii::app()->session['batch']; ?>  </span><strong>Section: </strong><span class="label label-important"> <?php echo yii::app()->session['section']; ?></span></h4>
                
                <h4><strong>Student Academic Year: </strong><span class="label label-info"><?php  echo FormUtil::getTerm($student->stu_academicTerm)." ".$student->stu_academicYear ;  ?></span></h4>
            
            </div>
        <div class="span-4" style="padding:105px 0px 0px 0px;">
            <h6 ><strong>Programme: </strong> <?php  echo yii::app()->session['programme']; ?></h6>
        </div>
            <div class="img-polaroid span-4" >
                <?php echo CHtml::image('./photograph/'.$student->studentID.'.jpg',$person->per_title." ".$person->per_firstName." ".$person->per_lastName,array('title'=>$person->per_title." ".$person->per_firstName." ".$person->per_lastName)); ?>
            </div>
                   
     </div>

<hr/>
<h4>Personal Details:</h4>
     
     <table class="table table-hover table-bordered detail">
         <tr>
             <td class="detail-title ">
                Name:
             </td>
             <td class="detail-content">
                 <?php echo $person->per_title." ".$person->per_firstName." ".$person->per_lastName; ?>
             </td>
         </tr>
         <tr>
             <td class="detail-title">
                 Gender:
             </td>
             <td class="detail-content">
                 <?php echo $person->per_gender; ?>
             </td>
         </tr>
         <tr>
             <td class="detail-title">
                 Date of Birth:
             </td>
             <td class="detail-content">
                 <?php echo date("jS, M Y",strtotime($person->per_dateOfBirth)); ?>
             </td>
         </tr>
         <tr>
             <td class="detail-title">
                 Blood Group:
             </td>
             <td class="detail-content">
                 <?php echo $person->per_bloodGroup; ?>
             </td>
         </tr>
         <tr>
             <td class="detail-title">
                 Nationality:
             </td>
             <td class="detail-content">
                 <?php echo $person->per_nationality; ?>
             </td>
         </tr>
         <tr>
             <td class="detail-title">
                 Fathers Name:
             </td>
             <td class="detail-content">
                 <?php echo $person->per_fathersName; ?>
             </td>
         </tr>
         <tr>
             <td class="detail-title">
                 Mothers Name:
             </td>
             <td class="detail-content">
                 <?php echo $person->per_mothersName; ?>
             </td>
         </tr>
         <tr>
             <td class="detail-title">
                 Marital Status:
             </td>
             <td class="detail-content">
                 <?php echo $person->per_maritalStatus; ?>
             </td>
         </tr>
         <tr>
             <td class="detail-title">
                 Spouse Name:
             </td>
             <td class="detail-content">
                 <?php echo CHtml::encode($person->per_spouseName!=null? $person->per_spouseName : "-- N/A --");  ?>
             </td>
         </tr>
         <tr>
             <td class="detail-title">
                 Present Address:
             </td>
             <td class="detail-content">
                 <?php echo $person->per_presentAddress; ?>
             </td>
         </tr>
         
         <tr>
             <td class="detail-title">
                 Permanent Address:
             </td>
             <td class="detail-content">
                 <?php echo $person->per_permanentAddress; ?>
             </td>
         </tr>
         
         
         <tr>
             <td class="detail-title">
                 Mobile:
             </td>
             <td class="detail-content">
                 <?php echo $person->per_mobile; ?>
             </td>
         </tr>
         <tr>
             <td class="detail-title">
                 Telephone:
             </td>
             <td class="detail-content">
                <?php echo CHtml::encode($person->per_telephone!=null? $person->per_telephone : "-- N/A --"); ?>
             </td>
         </tr>
         <tr>
             <td class="detail-title">
                 Email:
             </td>
             <td class="detail-content">
                 <?php echo CHtml::encode($person->per_email!=null? $person->per_email : "-- N/A --"); ?></span>
             </td>
         </tr>
         <tr>
             <td class="detail-title">
                 Criminal Conviction:
             </td>
             <td class="detail-content">
                 <?php  echo CHtml::encode($person->per_criminalConviction==1? "YES" : "NO"); ?>
             </td>
         </tr>
         <tr>
             <td class="detail-title">
                 Conviction Details:
             </td>
             <td class="detail-content">
                 <?php  echo CHtml::encode($person->per_convictionDetails!=null? $person->per_convictionDetails : "-- N/A --"); ?>
             </td>
         </tr>
     </table>
<br/>
<h4>Admission Details:</h4>
     
     <table class="table table-hover table-bordered detail">
         <tr>
             <td class="detail-title">
                 Admission Date:
             </td>
             <td class="detail-content">
                 <?php  echo CHtml::encode($admission->adm_date!=null? date("jS, M Y",strtotime($admission->adm_date)) : "-- N/A --"); ?>
             </td>
         </tr>
         <tr>
             <td class="detail-title">
                 Guardians Name:
             </td>
             <td class="detail-content">
                 <?php  echo CHtml::encode($student->stu_guardiansName!=null? $student->stu_guardiansName : "-- N/A --"); ?>
             </td>
         </tr>
         <tr>
             <td class="detail-title">
                 Guardians Mobile:
             </td>
             <td class="detail-content">
                 <?php  echo CHtml::encode($student->stu_guardiansMobile!=null? $student->stu_guardiansMobile : "-- N/A --"); ?>
             </td>
         </tr>
         <tr>
             <td class="detail-title">
                 Guardians Address:
             </td>
             <td class="detail-content">
                 <?php  echo CHtml::encode($student->stu_guardiansAddress!=null? $student->stu_guardiansAddress : "-- N/A --"); ?>
             </td>
         </tr>
      
         <tr>
             <td class="detail-title">
                  Conditions:
             </td>
             <td class="detail-content">
                 <?php  echo CHtml::encode($student->stu_conditions!=null? $student->stu_conditions : "-- N/A --"); ?>
             </td>
         </tr>
            <tr>
             <td class="detail-title">
                 Previous ID:
             </td>
             <td class="detail-content">
                 <?php  echo CHtml::encode($student->stu_previousID!=null? $student->stu_previousID : "-- N/A --"); ?>
             </td>
         </tr>
         <tr>
             <td class="detail-title">
                 Previous Degree:
             </td>
             <td class="detail-content">
                 <?php  echo CHtml::encode($student->stu_previousDegree!=null? $student->stu_previousDegree : "-- N/A --"); ?>
             </td>
         </tr>
         <tr>
             <td class="detail-title">
                  Waiver:
             </td>
             <td class="detail-content">
                 <?php  echo CHtml::encode($admission->waiverID!=null? Waiver::model()->findByPk($admission->waiverID)->wav_title : "-- N/A --"); ?>
             </td>
         </tr>
         <tr>
             <td class="detail-title">
                  Payment Method:
             </td>
             <td class="detail-content">
                 <?php  echo CHtml::encode($student->stu_paymentMethod==1?"Credit Hour Basis": "Monthly Basis"); ?>
             </td>
         </tr>
         <tr>
             <td class="detail-title">
                  Remarks:
             </td>
             <td class="detail-content">
                 <?php  echo CHtml::encode($admission->adm_remarks!=null? $admission->adm_remarks : "-- N/A --"); ?>
             </td>
         </tr>
     </table>
<br/>
<?php 

    if($acHistory=  AcademicHistory::model()->findAllByAttributes(array('personID'=>$person->personID)))
    {
    ?>
<h4>Academic History:</h4>
     
     <table class="table table-hover table-bordered detail">
         <thead>
                        <tr>
                            <th>Degree</th>
                            <th>Group</th>
                            <th>Board</th>
                            <th>Institution</th>
                            <th>Passing Year</th>
                            <th>Result</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($acHistory as $ach) {
                         ?>
                        
                        <tr>
                            <td><?php echo $ach->ach_degree ?></td><td><?php echo $ach->ach_group ?></td><td><?php echo $ach->ach_board ?></td><td><?php echo $ach->ach_institution ?></td><td><?php echo $ach->ach_passingYear ?></td><td><?php echo $ach->ach_result ?></td>
                        </tr>
                        <?php 
                        }
                        ?>
                    </tbody>
     </table>
     <?php
    }
    ?>

<?php 

    if($jobExp= JobExperiance::model()->findAllByAttributes(array('personID'=>$person->personID)))
    {
    ?>
<h4>Job Experience:</h4>
     
     <table class="table table-hover table-bordered detail">
         <thead>
                        <tr>
                  <th>Employer</th>
                            <th>Address</th>
                            <th>Contact</th>
                            <th>Position</th>
                            <th>Joining Date</th>
                            <th>Leave Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($jobExp as $joe) {
                         ?>
                        
                        <tr>
                            <td><?php echo $joe->joe_employer ?></td><td><?php echo $joe->joe_address ?></td><td><?php echo $joe->joe_contact ?></td><td><?php echo $joe->joe_position ?></td><td><?php echo $joe->joe_startDate ?></td><td><?php echo $joe->joe_endDate ?></td>
                        </tr>
                        <?php 
                        }
                        ?>
                    </tbody>
     </table>
     <?php
    }
    ?>

     
