<div class="title">
Term Admission List
</div>

    
<h4>Term: <span class="label label-info"><?php yii::app()->session['eligibleTerm']; ?></span></h4>    
<h4>Term: <span class="label label-info"><?php yii::app()->session['eligibleYear']; ?></span></h4>    
    

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
		      Batch
                     </strong>
                </th>
                <th colspan="5" >
                    <strong>
		      Programme
                     </strong>
                </th>
 
	</tr>
        
        <?php
          foreach ($rows as $data)
          {
         ?>
        <tr>
                <th colspan="3">
                    <strong>
                       <?php 
                       echo CHtml::encode($data['studentID']);
                       ?>		
                    </strong>
		      
                </th>
                <th colspan="5">
                    <strong>
		      <?php echo CHtml::encode($data['batchName']);?>		
                     </strong>
                </th>
                <th colspan="5">
                    <strong>
		      <?php echo CHtml::encode($data['pro_shortName']);?>		
                     </strong>
                </th>
     	</tr>
              
         <?php     
          }
             
        ?>
    
    	
     
</table>
<?php endif; ?>
