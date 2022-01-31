<!DOCTYPE html> 
<html lang="en"> 
<head> 
<meta charset="utf-8"> 
<?php 
           
      if(!empty($rows))
                 foreach ($rows as $row) 
                {
                            
            ?>
<title>Student Profile <?php echo CHtml::encode($row['per_title']).' '.CHtml::encode($row['per_firstName']).' '.CHtml::encode($row['per_lastName']).'<br/>'.'Student ID:'.CHtml::encode($row['studentID']) .'<br/>';  ?></title> 

          </tr>

<meta name="description" content="Student Profile.">

 <table cellpadding="0" cellspacing="0" border="1" class="table table-striped table-bordered" id="examp">
        
     
     
      <thead>
                     

          <tr>
                   <td>Programme Code</td>               
                   <td><?php echo CHtml::encode($row['programmeCode']) .'<br/>';  ?></td>
            
          </tr>
          <tr>
                   <td>Batch Name</td>               
                   <td><?php echo CHtml::encode($row['batchName']) .'<br/>';  ?></td>
            
          </tr>
          
          <tr>
                   <td>Section Name</td>               
                   <td><?php echo CHtml::encode($row['sectionName']) .'<br/>';  ?></td>
            
          </tr>
          
          <tr>
                   <td>Admission Date</td>               
                   <td><?php echo CHtml::encode($row['adm_date']) .'<br/>';  ?></td>
            
          </tr>
        </thead>
        <tbody>
            

                <tr>
                   <td>Title</td>               
                   <td><?php echo CHtml::encode($row['per_title']) .'<br/>';  ?></td>
                </tr>
                 <tr>
                   <td>First Name</td>               
                   <td><?php echo CHtml::encode($row['per_firstName']) .'<br/>';  ?></td>
                </tr>
                <tr>
                   <td>Last Name</td>               
                   <td><?php echo CHtml::encode($row['per_lastName']);  ?></td>
                 </tr>

                <tr>
                   <td>Sex</td>               
                   <td><?php echo CHtml::encode($row['per_gender']);  ?></td>
                 </tr>
                <tr>
                   <td>Date of Birth</td>               
                   <td><?php echo CHtml::encode($row['per_dateofBirth']);  ?></td>
                 </tr>
                <tr>
                   <td>Blood Group</td>               
                   <td><?php echo CHtml::encode($row['per_bloodGroup']);  ?></td>
                 </tr>
                <tr>
                   <td>Father Name</td>               
                   <td><?php echo CHtml::encode($row['per_fathersName']);  ?></td>
                 </tr>
                <tr>
                   <td>Mother Name</td>               
                   <td><?php echo CHtml::encode($row['per_mothersName']);  ?></td>
                 </tr>
                <tr>
                   <td>Nationality</td>               
                   <td><?php echo CHtml::encode($row['per_nationality']);  ?></td>
                 </tr>
                <tr>
                   <td>Spouse Name</td>               
                   <td><?php echo CHtml::encode($row['per_spouseName']);  ?></td>
                 </tr>
                <tr>
                   <td>Permanent Address</td>               
                   <td><?php echo CHtml::encode($row['per_permanentAddress']);  ?></td>
                 </tr>

                 <tr>
                   <td>Post code</td>               
                   <td><?php echo CHtml::encode($row['per_postCode']);  ?></td>
                 </tr>
                 
                 <tr>
                   <td>Telephone</td>               
                   <td><?php echo CHtml::encode($row['per_telephone']);  ?></td>
                 </tr>
                 
                 <tr>
                   <td>Mobile No</td>               
                   <td><?php echo CHtml::encode($row['per_mobile']);  ?></td>
                 </tr>

                 <tr>
                   <td>Email</td>               
                   <td><?php echo CHtml::encode($row['per_email']);  ?></td>
                 </tr>
                 
                 <tr>
                   <td>Present Address</td>               
                   <td><?php echo CHtml::encode($row['per_presentAddress']);  ?></td>
                 </tr>
                 
                 <tr>
                   <td>Marital Status</td>               
                   <td><?php echo CHtml::encode($row['per_maritalStatus']);  ?></td>
                 </tr>
                 
                 <tr>
                    <td>Criminal Conviction</td>               
                    <td><?php echo CHtml::encode($row['per_criminalConviction']);  ?></td>
                 </tr>
                 
                 <tr>
                 
                   <td>Conviction Details</td>               
                   <td><?php echo CHtml::encode($row['per_convictionDetails']);  ?></td>
                 </tr>
                 
                 <tr>
                 <td>Entry Date</td>               
                 <td><?php echo CHtml::encode($row['per_entryDate']);  ?></td>
                 </tr>
             
           <?php 
                } 
            ?>
          
        </tbody>
      </table>
</body>
</html>