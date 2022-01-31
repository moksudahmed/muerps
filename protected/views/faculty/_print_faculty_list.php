<!DOCTYPE html> 
<html lang="en"> 
<head> 
<meta charset="utf-8"> 
<title>Faculty Member List</title> 
<meta name="description" content="faculty memeber list.">

<table cellpadding="0" cellspacing="0" border="1" class="table table-striped table-bordered" id="examp">
        <thead>
               <tr>
            <th>Faculty ID</th>
            <th>Name</th>
            <th>Designation</th>
            <th>Department</th>
            <th>Sex</th>
            <th>Joining Date</th>
            <th>Blood Group</th>
            <th>Date of Birth</th>
            
          </tr>
            
        </thead>
        <tbody>

          
           <?php 
            
            if(!empty($rows))
                 foreach ($rows as $row) 
                {
                            
                    ?>
		
            
            <tr>
                     <td><?php echo CHtml::encode($row['facultyID']) .'<br/>';  ?></td>
                     <td><?php echo CHtml::encode($row['per_title']) .' '.CHtml::encode($row['per_firstName']) .' '.CHtml::encode($row['per_lastName']);  ?></td>
                     <td><?php echo CHtml::encode($row['fac_designation']) .'<br/>';  ?></td>
                     <td><?php echo CHtml::encode($row['per_gender']) .'<br/>';  ?></td>
                     <td><?php echo CHtml::encode($row['fac_joining']) .'<br/>';  ?></td>
                     <td><?php echo CHtml::encode($row['per_bloodGroup']) .'<br/>';  ?></td>
                     <td><?php echo CHtml::encode($row['per_dateOfBirth']) .'<br/>';  ?></td>
                     	
                  </tr>
          
            <?php 

                } 
             ?>
          
        </tbody>
      </table>

              
</body>
</html>
