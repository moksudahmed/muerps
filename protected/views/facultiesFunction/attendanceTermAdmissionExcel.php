<div class="title">
    <h3>    Attendance Sheet    </h3>

    <strong> Programme:</strong> <?php echo DBhelper::getProgrammeByCode(yii::app()->session['attProCode']); ?><br/>
    <strong>Batch:</strong> <span class="label label-success"> <?php echo yii::app()->session['attBatName'].FormUtil::getBatchNameSufix(yii::app()->session['attBatName']); ?>,  </span><strong>  Section: </strong><span class="label label-important"> <?php echo yii::app()->session['attSecName']; ?></span><br/>
    <strong>Course:</strong> <span class="label label-info"><?php echo yii::app()->session['course-'.$id]; ?></span>        <br/>
    
    <strong>Faculty:</strong> <span class="label label-info"><?php echo yii::app()->session['faculty-'.$id]; ?></span>        <br/>
</div>
<?php  if ($dataProvider !== null):?>
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
                <th colspan="2" >
                    <strong>
		      Mobile
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
          foreach ($dataProvider as $data)
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
                <th colspan="2">
                    <strong>
		      <?php echo CHtml::encode($data['per_mobile']);?>		
                     </strong>
                </th>
                <?php
                for ($i=1; $i<=32; $i++)
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
