<?php
       $i=0;
       $pcode=$rows[1]['programmeCode'];
       $bcode=$rows[1]['batchName'];
       $pName = FormUtil::getBatchProgrammeName($pcode,$bcode);
       ?>
        <h4><?php echo $pName;?></h4>
       
       <?php
       foreach ($rows as $row) 
       {
           
           if($pcode==$row['programmeCode'] && $bcode==$row['batchName'])
           {            
            ?>
            
            <span><?php echo CHtml::encode($row['studentID']);?></span>              
        <?php      
           }
           else if($pcode==$row['programmeCode'] && $bcode!=$row['batchName'])
           {?>
               <h4><?php echo $pName;?></h4>
               <span><?php echo CHtml::encode($row['studentID']);?></span>              
           <?php           
           
           }
           else
           {?>
                <h4><?php echo $pName;?></h4>
               <span><?php echo CHtml::encode($row['studentID']);?></span>              
           <?php
           
           }
          $bcode=$row['batchName'];
          $pcode=$row['programmeCode'];
          $pName = FormUtil::getBatchProgrammeName($pcode,$bcode);
       }
      
     ?>  