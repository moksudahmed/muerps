<div class="title span-10">
    <h5><strong></strong><span class="label label-important"> <?php ?></span><strong> </strong><span class="label label-success"> </span></h5>
            <h6><strong></strong><span class="label label-info"><?php?></span></h6>        
</div>

<table border="0"  style="font-size:25px; text-align: left;">
                    <thead>
                        <tr>
                            <th colspan ="3">
                            </th>

                            <th>
                            </th>
                           <th>
                            </th>
                
                            <th>
                            </th>
                        </tr>
                </thead>

                <tbody>

        <?php
       $grandTotal =0;
       $total =0;
       $pname = " ";
       $count=0;
          foreach ($result as $row)
          {
                            
              ?>
             <?php             
            if($pname != $row['pro_name'] && $count !=0)
              {

                ?>
                    <tr>
                         <td colspan ="3"></td>
                        
                         <td style="font-size:25px; text-align: right;"><strong><u>
                            Total</strong></u>
                        </td>
                        <td style="font-size:25px; text-align: right;"><strong><u><?php echo $total;?></u></strong></td>
                        <td style="font-size:25px; text-align: right;"><strong><u><?php echo $total;?></u></strong></td>
                    </tr>
              <?php   
              $grandTotal = $grandTotal+$total;
              $count=0;
              $total=0;
              }
          
         ?>
            <tr>
                
                <?php
                   if($pname != $row['pro_name'])
                   {
                        ?>
                        <td colspan ="3">
                            <?php echo CHtml::encode($row['pro_name'])?>
                       </td>
                       <td style="font-size:25px; text-align: right;">Male:</td>

                       <td >
                       <?php 
                            echo $row['total']; 
                            $total = $total + $row['total'];
                            ?>
                       </td>   
                            <td></td>
                            <?php
                             $pname = $row['pro_name'];
                             $count++;
                 }
                 else
                 {
                        ?>
                         <td colspan ="3"></td>
                         <td style="font-size:25px; text-align: right;">Female:</td>
                         <td>
                                  <?php echo $row['total']; 
                                  $total = $total + $row['total'];
                                  $count++;
                                  ?>
                             </td>
                             <td></td>
                             <?php
                 }
                   
                   ?>
                </tr>
                   
                   <?php
                
          
          if($count==2)
              {
                  ?>
                    <tr>
                         <td colspan ="3"></td>
                         
                        <td style="font-size:25px; text-align: right;">
                            <strong><u>Total</u></strong>
                        </td>
                        <td style="font-size:25px; text-align: right;"><strong><u><?php echo $total;?></u></strong></td>
                        <td style="font-size:25px; text-align: right;"><strong><u><?php echo $total;?></u></strong></td>
                    </tr>
                    <?php   
                    $grandTotal = $grandTotal + $total;
                    $count=0;
                    $total=0;
              }
          }
         ?>
         <tr>
              <td colspan ="3" style="font-size:25px; text-align: right;">
                  <strong><u>Grand Total</u></strong>
              </td>
                        
               <td>
                
                </td>
                <td></td>
                <td style="font-size:25px; text-align: right;"><strong><u><?php echo $grandTotal;?></u></strong></td>
           </tr>
        </tbody>
 </table>
