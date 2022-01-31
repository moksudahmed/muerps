<div class="title">
       
</div>
<h4> Batch wise admission list</h4>

<?php
//echo var_dump($dataProvider); exit();
if ($rows !== null):?>
<table border = "1" width="100%" align ="left">
    
	<tr>
                <th colspan="3">
                    <strong>
                        Program		
                    </strong>
		      
                </th>
                <th colspan="3">
                    <strong>
                        Batch
                    </strong>
		      
                </th>
                <th colspan="3">
                    <strong>
                        Section
                    </strong>
		      
                </th>
                <th colspan="5" >
                    <strong>
		      Total
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
                       <?php echo CHtml::encode($data['pro_name']);?>		
                    </strong>
		      
                </th>
                <th colspan="3">
                    <strong>
                       <?php echo CHtml::encode($data['batchName']);?>		
                    </strong>
		      
                </th>
                <th colspan="3">
                    <strong>
                       <?php echo CHtml::encode($data['sectionName']);?>		
                    </strong>
		      
                </th>
                <th colspan="5">
                    <strong>
		      <?php echo CHtml::encode($data['total']);?>		
                     </strong>
                </th>
                
 	</tr>
              
         <?php     
          }
             
        ?>
    
    	
     
</table>
<?php endif; ?>
