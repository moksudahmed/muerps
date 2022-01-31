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
</style>

 
<?php 

if($acHistory=  AcademicHistory::model()->findAllByAttributes(array('personID'=>$person->personID)))
    {
    ?>
<p><strong>6. Educational Qualifications:</strong></p>
<table border="1" style="font-family: Times New Roman; font-size:10pt; text-align: left; ">
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
else
    {
    ?>
        <table border="1" style=" font-family: Times New Roman; font-size:10pt; text-align: left; ">
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
                  <tr>
                  
                            <td ></td>
                            <td ></td>
                            <td ></td>
                            <td ></td>
                            <td ></td>
                            <td ></td>
                        </tr>
                        <tr>                            
                            <td ></td>
                            <td ></td>
                            <td ></td>
                            <td ></td>
                            <td ></td>
                            <td ></td>
                        </tr>
              </tbody>
        </table>

<?php }?>
<table>
    <tr>
        <td></td>
    </tr>
</table>
<p><strong>7. Employment Records:</strong></p>

<?php 

    if($jobExp= JobExperiance::model()->findAllByAttributes(array('personID'=>$person->personID)))
    {
    ?>
     
     <table border="1" style="font-family: Times New Roman; font-size:10pt; text-align: left; ">
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
    else
    {
    ?>
        <table border="1" style=" font-family: Times New Roman; font-size:10pt; text-align: left; ">
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
                  <tr>
                  <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                  <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
              </tbody>
        </table>

<?php }?>
