<?php
/* @var $this AdministrationController */
/* @var $model Administration */

$this->breadcrumbs=array(
        'Registry'=>array('site/registry'),
    'Faculty'=>array('index','id'=>yii::app()->session['dptID']),
    'Detailed View',
	
);

$this->menu=array(
    
    array('label'=>'List Faculty', 'url'=>array('index','id'=>yii::app()->session['dptID'])),
    array('label'=>'Create Faculty', 'url'=>array('create','flag'=>1)),
    array('label'=>'Detailed View', 'url'=>'#','active'=>true),
	
    array('label'=>'Edit Faculty', 'url'=>array('update', 'id'=>$faculty->facultyID)),
    array('label'=>'Delete Faculty', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$faculty->facultyID),'confirm'=>'Are you sure you want to delete this item?')),
);

?>
<?php
    
?>


    <div class="title">
        
        <div style="float:left">
        <h3>Detailed View</h3>
        
        <h4><strong>Faculty Name: </strong> <span  class="label label-success" > <?php echo $person->per_title." ".$person->per_firstName." ".$person->per_lastName; ?></span></h4>
        <h4><strong>Department: </strong> <span  class="label label-info" > <?php  echo yii::app()->session['department']; ?></span></h4>
        </div>
        <div class="img-polaroid" style="float: right; width:150px; height: auto; ">
            <?php echo CHtml::image('./faculty/'.$faculty->facultyID.'.jpg',$person->per_title." ".$person->per_firstName." ".$person->per_lastName,array('title'=>$person->per_title." ".$person->per_firstName." ".$person->per_lastName)); ?>
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
                 <?php echo $person->per_dateOfBirth; ?>
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
                 Postcode:
             </td>
             <td class="detail-content">
                 <?php echo $person->per_postCode; ?>
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
<h4>Official Details:</h4>
     
     <table class="table table-hover table-bordered detail">
         <tr>
             <td class="detail-title">
                 Designation:
             </td>
             <td class="detail-content">
                 <?php  echo CHtml::encode($faculty->fac_designation!=null? $faculty->fac_designation : "-- N/A --"); ?>
             </td>
         </tr>
         <tr>
             <td class="detail-title">
                 login ID:
             </td>
             <td class="detail-content">
                 <?php  echo CHtml::encode($faculty->fac_loginName!=null? $faculty->fac_loginName : "-- N/A --"); ?>
             </td>
         </tr>
         <tr>
             <td class="detail-title">
                 Joining Date:
             </td>
             <td class="detail-content">
                 <?php  echo CHtml::encode($faculty->fac_joining!=null? $faculty->fac_joining : "-- N/A --"); ?>
             </td>
         </tr>
         <tr>
             <td class="detail-title">
                 Leave Date:
             </td>
             <td class="detail-content">
                 <?php  echo CHtml::encode($faculty->fac_leave!=null? $faculty->fac_leave : "-- N/A --"); ?>
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

     
