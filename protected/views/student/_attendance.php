<!DOCTYPE html> 
<html lang="en"> 
<head> 
<meta charset="utf-8"> 
<title>Attendance Sheet</title> 
<meta name="description" content="Attendance Sheet.">
<p><?php echo DBhelper::getProgrammeByCode($_REQUEST['programmeCode']).'<br/>'; 
                                       echo "Batch:".$_REQUEST['batchName'].'<br/>';
                                       echo "Section:".$_REQUEST['sectionName'].'<br/>';  ?>      
                             
</p> 

 <table cellpadding="0" cellspacing="0" border="1" class="table table-striped table-bordered" id="examp">
        <thead>
          <tr>
            <th>Student-ID</th>
            <th>Name</th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>   
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
            <td><?php echo CHtml::encode($row['per_firstName']) .' '.CHtml::encode($row['per_lastName']);  ?></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          
           <?php 
                } 
            ?>
          
        </tbody>
      </table>
</body>
</html>