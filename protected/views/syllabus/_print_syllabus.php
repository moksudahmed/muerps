<!DOCTYPE html> 
<html lang="en"> 
<head> 
<meta charset="utf-8"> 
<title>Syllabus</title> 
<meta name="description" content="admission report.">
<p><?php echo DBhelper::getProgrammeByCode($_REQUEST['programmeCode']).'<br/>'; 
?>      

</p> 
<table cellpadding="0" cellspacing="0" border="1" class="table table-striped table-bordered" id="examp">
        <thead>
               <tr>
            <th>Course Code</th>
            <th>Short Name</th>
            <th>Course Title</th>
            <th>Course Type</th>
            <th>Lab</th>
            <th>Group</th>
            <th>Credit Hours</th>
            
            
          </tr>
            
        </thead>
        <tbody>

          
           <?php 
            
            if(!empty($rows))
                 foreach ($rows as $row) 
                {
                            
                    ?>
                 <tr>
                     <td><?php echo CHtml::encode($row['moduleCode']) .'<br/>';  ?></td>
                     <td><?php echo CHtml::encode($row['mod_shortName']) .'<br/>';  ?></td>
                     <td><?php echo CHtml::encode($row['mod_name']) .'<br/>';  ?></td>
                     <td><?php echo CHtml::encode($row['mod_type']) .'<br/>';  ?></td>
                     <td><?php echo CHtml::encode($row['mod_labIncluded']) .'<br/>';  ?></td>
                     <td><?php echo CHtml::encode($row['mod_group']) .'<br/>';  ?></td>
                     <td><?php echo CHtml::encode($row['mod_creditHour']) .'<br/>';  ?></td>
                     	
                  </tr>
          
            <?php 

                } 
             ?>
          
        </tbody>
      </table>

              
</body>
</html>
