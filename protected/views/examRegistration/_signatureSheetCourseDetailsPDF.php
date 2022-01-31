<style>
td {
    line-height: 200%;
}
</style>
<h1>Courses of Examination</h1>
<?php
        $sql2 = "SELECT DISTINCT
                    *
                    FROM vw_admit_card
                    WHERE
                      \"studentID\" = :studentID AND
                         \"programmeCode\" = :proCode AND
                      \"batchName\" = :batName AND
                      \"sectionName\" = :secName AND
                      \"exm_examTerm\" = :exmTerm AND
                      \"exm_examYear\" = :exmYear
                    ";
            $dataTwo = ExamRegistration::model()->findAllBySql($sql2,array(':studentID'=>$row['studentID'], ':proCode'=>$proCode,':batName'=>$batName,'secName'=>$secName,':exmTerm'=>$exmTerm,':exmYear'=>$exmYear));
?>
<table border="1"  style="font-size:30px; text-align: left; ">
<thead>
  <tr>
     <th height="50">Date and Time</th>  
     <th height="50">Course Code No</th>  
     <th height="50">Course Title</th>
     <th height="50">Signature of Examinee</th>
     <th height="50">Signature of Invigilator</th>
  </tr>
</thead>
<tbody>
    <?php
         foreach ($dataTwo as $r) 
             {
    ?>
    <tr>
        <td height="100"></td>
        <td height="100"><?php echo $r['moduleCode'];?></td>
        <td height="100"><?php echo $r['mod_name'];?></td>
        <td height="100"></td>
        <td height="100"></td>
    </tr>
    <?php }?>
    
</tbody>
</table>
<p>&nbsp;</p>
<p style="font-size:6pt;">&nbsp;</p>

<table border="0" style="font-size:10pt; text-align: left; ">

    <thead>
      <tr>
         <td>Controller of Examinations</td>  
         <td>Signature of the Candidate</td>
      </tr>
      <tr>
         <td>Date</td>  
         <td>Date</td>
      </tr>
    </tdead>
    </table>

 <?php 