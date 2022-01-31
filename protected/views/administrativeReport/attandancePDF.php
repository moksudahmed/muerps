<!DOCTYPE html> 
<html lang="en"> 
<head> 
<meta charset="utf-8"> 
<div class="title">
<h4 class="title">Tabulation Sheet</h4>
<h4><strong> <?php  echo DBhelper::getProgrammeShortNameById(yii::app()->session['programmeCode']).' '.yii::app()->session['batchName'].FormUtil::getBatchNameSufix(yii::app()->session['batchName']).' '.'Batch'.'('.yii::app()->session['reportYear'].'-'.FormUtil::getTerm(yii::app()->session['reportTerm']).')'; ?></strong></h4>
<h4><strong> <?php  echo yii::app()->session['reportTerm'], yii::app()->session['reportYear']; ?></strong></h4>

</div>
<meta name="description" content="tabulation report.">

</head>

<body>
<table border = "1">
  <tr> 
  
    <th rowspan="2">Roll Number</th>
    <th rowspan="2">Name</th>
    <?php

       foreach ($subjectRows as $row) 
       {
       ?>
        <th colspan="5"><?php  echo CHtml::encode($row['coursecode']).' '.CHtml::encode($row['coursetitle']);?></th>      
        
    <?php

        }
        
    ?>  
  </tr>
  <tr>
      <?php      
       foreach ($subjectRows as $row) 
       {
       ?>
	  
            <th>60</th>
            <th>40</th>
            <th>Total</th>
            <th>LG</th>
            <th>GP</th>
	<?php
	}
        
	?>  
  </tr>
       <?php 
            
      if(!empty($rows))
         foreach ($rows as $row1) 
         {
       ?>
            <tr> 
               <th><?php echo CHtml::encode($row1['rollnumber']);?></th>
               <th><?php echo CHtml::encode($row1['name']);?></th>
               <?php
                foreach ($subjectRows as $row) 
                {
                    $sql = "SELECT
                      \"coursecode\",
                      \"mark60\",
                      \"mark40\",
                      \"total\",
                      \"lg\",
                      \"gp\"
                    FROM
                      vw_final_result
                    WHERE
                      \"rollnumber\" = '{$row1['rollnumber']}' AND 
                      \"coursecode\" = '{$row['coursecode']}'
                    ORDER BY \"coursecode\"";
                      
                     $row3 = Yii::app()->db->createCommand($sql)->queryAll();
                     
                     $check = false;
                     foreach ($row3 as $r) 
                     {
                          if ($r['coursecode'] == $row['coursecode']) 
                            {
                            ?>
                                <th><?php echo CHtml::encode($r['mark60']);?></th>
                                <th><?php echo CHtml::encode($r['mark40']);?></th>
                                <th><?php echo CHtml::encode($r['total']);?></th>
                                <th><?php echo CHtml::encode($r['gp']);?></th>
                                <th><?php echo CHtml::encode($r['lg']);?></th>      
                            <?php
                            $check = true;
                             }
                         
                     }
                     if($check == FALSE)
                     {
                             ?>
                                <th><?php echo '0';?></th>
                                <th><?php echo '0';?></th>
                                <th><?php echo '0';?></th>
                                <th><?php echo '0';?></th>
                                <th><?php echo 'F*';?></th>
                             
                             <?php
                      
                     }
                }
                ?>
              </tr>
  	<?php
	}
	 ?>  
              

    <br></br><br></br><br></br>
    <p>-------------------------------------------------</p>
    <p>Tabulator Signature</p>
        
</table>

</body>
</html>

<?PHP
/*function findArrayIndex($arr, $searchId) {

    $arrLen = count($arr);
    for($i=0; $i < $arrLen; $i++) {
       if($arr[$i][id] == $searchId) return $i;
    }

    return -1;

}*/
?>