<style>
td {
    line-height: 200%;
}
</style>
<table border="0"  style="font-size:24px; text-align: left; ">
<thead>
     
  <tr>
      <th><?php echo FormUtil::getTerm($exmTerm).' Term '.$exmType.' Examination '.$exmYear;?></th>
  </tr>
  <tr>
      <th>Programme:<?php echo Programme::model()->findByPk(yii::app()->session['aciProCode'])->pro_shortName;?></th>
  </tr>
  <tr>
      <th>Batch:<?php echo $batName.FormUtil::getBatchNameSufix($batName).' '.$secName;?></th>
  </tr>
 </thead>
</table>            

<table border="1"  style="font-size:24px; text-align: left; ">
<thead>
    <tr>
        <th>Student ID</th>
        <th>Name of the Candidate</th>
        <th>Date</th>
        <th>Signature</th>
        <th>Date </th>
        <th>Signature</th>
    </tr>
 </thead>
 <tbody>
 <?php
     foreach($model as $row):
 ?>   
    <tr>
        <td><?php echo $row['studentID']; ?></td>
        <td><?php echo $row['per_name']; ?></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    
    <?php endforeach; ?>

</tbody>
</table>            
