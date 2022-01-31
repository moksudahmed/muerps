<div class="title">
    Attendance Sheet    
</div>
<h4> Programme: <?php echo DBhelper::getProgrammeByCode(yii::app()->session['attProCode']); ?></h4>
    <h4>Batch: <span class="label label-success"> <?php echo yii::app()->session['attBatName'].FormUtil::getBatchNameSufix(yii::app()->session['attBatName']); ?>,  </span><strong>  Section: </strong><span class="label label-important"> <?php echo yii::app()->session['attSecName']; ?></span></h4>
    <h4>Course: <span class="label label-info"><?php echo yii::app()->session['attModule']; ?></span></h4>        
    
<h4>Faculty: <span class="label label-info"><?php echo yii::app()->session['attFacultyID']; ?></span></h4>        

<?php  if ($rows !== null):?>
<table border = "1" width="100%" align ="left">
    
	<tr>
                <th colspan="3">
                    <strong>
                        Student ID		
                    </strong>
		      
                </th>
                <th colspan="5" >
                    <strong>
		      Name
                     </strong>
                </th>
                <?php
                for ($i=1; $i<=30; $i++)
                {
                    
                
                ?>
                <th >
                    <strong>
                         <?php echo $i; ?>
                     </strong>
                </th>
                <?php
                }
                ?>
 	</tr>
        
        <?php
          foreach ($rows as $data)
          {
         ?>
        <tr>
                <th colspan="3">
                    <strong>
                       <?php echo CHtml::encode($data['studentID']);?>		
                    </strong>
		      
                </th>
                <th colspan="5">
                    <strong>
		      <?php echo CHtml::encode($data['per_name']);?>		
                     </strong>
                </th>
                <?php
                for ($i=1; $i<=35; $i++)
                {
                    
                
                ?>
                <th >
                    <strong>
                         
                     </strong>
                </th>
                <?php
                }
                ?>
 	</tr>
              
         <?php     
          }
             
        ?>
    
    	
     
</table>
<?php endif; ?>
