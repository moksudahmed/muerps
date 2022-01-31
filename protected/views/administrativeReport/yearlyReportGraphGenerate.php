<div class="title span-10">
    <h5><strong>Admission Report 2012</strong></h5>
</div>
        

<?php
       $grandTotal =0;
       $total =0;
       $male =0;
       $female=0;
       $pname = " ";
       $count=0;
          foreach ($result as $row)
          {
                   
                         
            if($pname != $row['pro_name'] && $count !=0)
              {
                 $male = abs($total);
                 
                 $this->renderPartial('yearlyReportGraph',
                            array('pname'=>$pname,'male'=>$male,'female'=>$female,),false);                                      
                 $male = 0;
                 $female = 0;
                 $count=0;
                 $total=0;
              }
          
                if($pname != $row['pro_name'])
                {
                             $pname = $row['pro_name'];
                             $female = abs($row['total']);
                             $count++;
                 }
                 else
                 {
                             $total = $total + $row['total'];
                             $male = abs($row['total']);
                             $count++;
                 }                  
                
          if($count==2)
              {
                  $this->renderPartial('yearlyReportGraph',
                            array('pname'=>$pname,'male'=>$male,'female'=>$female,),false);                                      
                  $male = 0;
                  $female = 0;
                  
                  $count=0;
                  $total=0;
              }
          }
 ?>
         
