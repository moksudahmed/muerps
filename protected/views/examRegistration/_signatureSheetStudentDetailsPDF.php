<style>
td {
    line-height: 200%;
}
</style>
<table border="0"  style="font-size:30px; text-align: left; ">
<thead>
  <tr >
      <th><strong><i><?php echo FormUtil::getTerm($exmTerm).' Term '.$exmType.' Examination '.$exmYear;?></i></strong></th>
      <th></th>
  </tr>
  <tr>
      <th>Programme:<?php echo Programme::model()->findByPk(yii::app()->session['aciProCode'])->pro_shortName;?></th>
      <th>Batch:<?php echo $batName.FormUtil::getBatchNameSufix($batName).' '.$secName;?></th>
  </tr>
  
  <tr>
        <th>Student ID:<?php echo $row['studentID']; ?></th>
        <th>Name of the Candidate:<?php echo $row['per_name']; ?></th>
    </tr>
    <tr>
        <th>Academic Year:<?php echo FormUtil::getTerm($row['stu_academicTerm']).' '.$row['stu_academicYear']; ?></th>
       <th></th>
    </tr>
    <tr>

        <th></th>
    </tr>
    
    <tr>

        <th></th>
    </tr>


</thead>
</table>            
