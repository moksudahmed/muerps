<?php
$sql2 = "SELECT DISTINCT
                        *
                        FROM vw_admit_card
                        WHERE
                          \"studentID\" = :studentID AND
                             \"programmeCode\" = :proCode AND
                          \"batchName\" = :batName AND
                        
                          \"exm_examTerm\" = :exmTerm AND
                          \"exm_examYear\" = :exmYear
                        ";
                $dataTwo = ExamRegistration::model()->findAllBySql($sql2,array(':studentID'=>$row['studentID'], ':proCode'=>$proCode,':batName'=>$batName,':exmTerm'=>$exmTerm,':exmYear'=>$exmYear));
?>    
<!--Second Part -->
<table border="0" style="font-size:10pt; text-align: left; ">
  <tr>
    <td colspan="3"><?php echo CHtml::image(dirname(Yii::app()->getBasePath()).DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'MU.jpg', 'DORE',array("width"=>"120px")); ?></td>
    <td></td>
    <td rowspan="1" style="font-size:24px; text-align: right; "> </td>
  </tr>
  <tr>
    <td colspan="3"><i><strong><?php echo FormUtil::getTerm($exmTerm).' Term '.$exmType.' Examination '.$exmYear;?></strong></i></td>
    <td></td>
    <td rowspan="7" style="font-size:24px; text-align: right; ">
     <?php
     if (file_exists('./photograph/'.$row['studentID'].'.jpg')) {
      echo CHtml::image('./photograph/'.$row['studentID'].'.jpg', 'DORE',array("width"=>"120px", "height"=>"130px"));
  } else {
    echo CHtml::image('./images/images.jpg', 'DORE',array("width"=>"150px")); 
  }
 
     //echo CHtml::image('./photograph/'.$row['studentID'].'.jpg', 'DORE',array("width"=>"150px")); ?>
     <?php //echo CHtml::image('./images/images.jpg', 'DORE',array("width"=>"150px")); ?>
    </td>
  </tr>
  
  <tr>
    <td>Programme:</td>
    <td colspan="3"><?php echo Programme::model()->findByPk(yii::app()->session['aciProCode'])->pro_shortName;?></td>   
  </tr>     
  <tr>
    <td>Batch:</td>
    <td colspan="3"><?php echo $batName.FormUtil::getBatchNameSufix($batName);?></td>
  </tr>
  <tr>
    <td>Student ID:</td>
    <td colspan="3"><?php echo $row['studentID']; ?></td>
  </tr>
  <tr>
    <td>Name of the Candidate:</td>
    <td colspan="3"><?php echo $row['per_name']; ?></td>
  </tr>
  <tr>
    <td>Father's Name:</td>
    <td colspan="3"><?php echo $row['per_fathersName']; ?></td>
  </tr>
  <tr>
    <td>Mother's Name:</td>
    <td colspan="3"><?php echo $row['per_mothersName']; ?></td>    
  </tr>  
</table> 
<p>Courses of Examination</p>
<table border="1" style="font-size:10pt; text-align: left; ">
    <thead>
      <tr>
         <th width="30%">Course Code</th>  
         <th width="70%">Course Title</th>
      </tr>
    </thead>
    <tbody>
        <?php
             foreach ($dataTwo as $r) 
                 {
        ?>
        <tr >
            <td width="30%"><?php echo $r['moduleCode'];?></td>
            <td width="70%"><?php echo $r['mod_name'];?></td>
        </tr>
        <?php }?>

    </tbody>
</table>
<p>&nbsp;</p>
<table border="0" style="font-size:10pt; text-align: left; ">

    <thead>
        <tr>
            <td rowspan="7" style="font-size:24px; text-align: left; "> <?php echo CHtml::image(dirname(Yii::app()->getBasePath()).DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'Signature.jpg', 'DORE',array("width"=>"120px")); ?></td>
            <td></td>               
        </tr>
    </thead>
    <tbody>
   
      <tr>         
         <td>Controller of Examinations</td> 
         <td>Signature of the Candidate</td>
      </tr>
      <tr>
         <td></td>  
         <td>Date</td>
      </tr>
    </tbody>
</table>

