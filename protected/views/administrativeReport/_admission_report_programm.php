<!DOCTYPE html> 
<html lang="en"> 
<head> 
<meta charset="utf-8"> 
<title>Admission Report</title> 
<meta name="description" content="admission report.">
<p><?php echo DBhelper::getProgrammeByCode($_REQUEST['programmeCode']).'<br/>'; 
                                       echo "Academic Year:".$_REQUEST['stu_academicYear'].'<br/>';    ?>      
     
                             <?php
                                   
                                       if ($_REQUEST['stu_academicTerm']==1)
                                           echo "Academic Term: Spring".'<br/>';
                                       
                                       else if ($_REQUEST['stu_academicTerm']==2)
                                           echo "Academic Term: Summer".'<br/>';
                                       else 
                                           echo "Academic Term: Autumn".'<br/>';
                                               
                                         ?>
</p> 
<table cellpadding="0" cellspacing="0" border="1" class="table table-striped table-bordered" id="examp">
        <thead>
               <tr>
            <th>Student-ID</th>
            <th>Name</th>
            <th>Sex</th>
            <th>DOB</th>
            <th>Blood Group</th>
            <th>Father Name</th>
            <th>Address</th>
            <th>Mobile No</th>
            <th>Admission Date</th>
          </tr>
            
        </thead>
        <tbody>

          
           <?php 
            
      if(!empty($rows))
                 foreach ($rows as $row) 
                {
                            
            ?>
         <tr>
                           
            <td><?php echo CHtml::encode($row['studentID']) .'<br/>';  ?></td>
            <td><?php echo CHtml::encode($row['per_title']) .' '.CHtml::encode($row['per_firstName']) .' '.CHtml::encode($row['per_lastName']);  ?></td>
            <td><?php echo CHtml::encode($row['per_gender']) .'<br/>';  ?></td>
            <td><?php echo CHtml::encode($row['per_dateofBirth']) .'<br/>';  ?></td>
            <td><?php echo CHtml::encode($row['per_bloodGroup']) .'<br/>';  ?></td>
            <td><?php echo CHtml::encode($row['pr.per_fathersName']) .'<br/>';  ?></td>
            <td><?php echo CHtml::encode($row['pr.per_presentAddress']) .'<br/>';  ?></td>
            <td><?php echo CHtml::encode($row['per_mobile']) .'<br/>';  ?></td>
             
            <td><?php echo CHtml::encode($row['adm_date']) .'<br/>';  ?></td>
            
          </tr>
          
           <?php 
            
                } 
            ?>
          
        </tbody>
      </table>

          <?php

if(!empty($rows1))
                 foreach ($rows1 as $row1) 
                {
                      echo "Total Admission:";
                      echo CHtml::encode($row1['COUNT(*)']) .'<br/>'; 
                      
                } 
  
if(!empty($rows2))
                 foreach ($rows2 as $row2) 
                {
                      echo "Male:";
                      echo CHtml::encode($row2['COUNT(per_gender)']) .'<br/>'; 
                      
                } 
 if(!empty($rows3))
                 foreach ($rows3 as $row3) 
                {
                      echo "Female:";
                      echo CHtml::encode($row3['COUNT(per_gender)']) .'<br/>'; 
                      
                } 

?>
              
</body>
</html>
