<style>
td {
    line-height: 250%;
}
</style>

<?php 

?>
<table border = "0" style="font-size:30px; text-align: left; " width="100%">
    <tr><th><h2><?php echo FormUtil::getTerm(yii::app()->session['MainCurTerm']).' Term Final Examination'.' '.yii::app()->session['MainCurYear'];?></h2>           
        </th>
    </tr>
    <tr>
        <th width="40%"><strong>Programme: </strong> <?php echo yii::app()->session['mreProCode'].':'.DBhelper::getProgrammeShortName(yii::app()->session['mreProCode']); ?> </th>
        <th width="60%"><strong>Batch: </strong><?php echo yii::app()->session['mreBatch'].FormUtil::getBatchNameSufix(yii::app()->session['mreBatch']).' '.yii::app()->session['mreSection']; ?></th>
    </tr>
    <tr>
        <th width="40%"><strong>Academic Year: </strong><?php echo DBhelper::getAcademicYearByBatch(yii::app()->session['mreBatch'],yii::app()->session['mreProCode']); ?></th>
        <th width="60%"><strong>Course: </strong><?php echo yii::app()->session['mreModule']; ?></th>
    </tr>
    
</table>
<br></br> 
<table border="1"  style="font-size:30px; text-align: center; ">
    <thead>
	<tr>
                <th width="20%">
                    <strong>
                        Student ID		
                    </strong>
		      
                </th>
                <th width="50%"><strong>Name</strong></th>
                <th width="15%"><strong>LG</strong></th>
                <th width="15%"><strong>GP</strong></th>
	
        </tr>

 	
    </thead>
    <tbody>
               <?php 
               
               $term=  yii::app()->session['MainCurTerm'];
               $year = yii::app()->session['MainCurYear'];
               $i =0;
               
                 foreach ($rows as $row1) 
                 {
               
                 if($i>=$start && $i<$end)
                 {
               ?>

             <tr>
        	<td width="20%">
			<?php echo CHtml::encode($row1['studentID']);?>
		</td>
                <td width="50%" style="font-size:30px; text-align: left; ">
			<?php echo CHtml::encode($row1['per_name']);?>
		</td>
               <?php $moduleCode=yii::app()->session['mreModuleCode'];
               
                    $sql = "SELECT distinct
                          \"moduleCode\",
                          \"letterGrade\",
                          \"gradePoint\"
                            FROM
                              vw_result_final_exam
                            WHERE
                              \"studentID\" = '{$row1['studentID']}' AND 
                              \"moduleCode\" = '{$moduleCode}' and \"exm_examTerm\"={$term} and \"exm_examYear\"={$year}
                            ORDER BY \"moduleCode\"";
                              
                            $row3 = Yii::app()->db->createCommand($sql)->queryAll();
               
               
                    foreach ($row3 as $r) 
                     {
                        ?>
                            <td width="15%">
                               <?php echo CHtml::encode($r['letterGrade']);?>
                            </td>
                            <td width="15%">
                               <?php echo CHtml::encode($r['gradePoint']);?>
                            </td>
                            <?php 
     
                    } ?>
            </tr>
         <?php  
                }
             $i++;
             
           }
          ?>
    </tbody>
    
</table>

    
</div>
