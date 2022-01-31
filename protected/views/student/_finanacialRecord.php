<?php
/* @var $this ModuleRegistrationController */
/* @var $model ModuleRegistration */

$this->breadcrumbs=array(
    
	
         'Student Profile'=>array('student/profileIndex'),
	'Fees Structure',
	
);



?>

<?php
$total = 0;
?>                                                       
<div class ="container-fluid">
    
        <div class = "row">
            <h2>Fees Structure</h2>
        </div>
    <div class = "row">
    <table class="table table-striped">

        <tbody>
          <?php

            foreach ($rows as $row):

              ?>

            <tr>
                 <td width="10%"><?php echo 'Tuttion Fees'; ?></td>
                 <td width="10%"><?php echo $row['moduleCode']; ?></td>
                 <td width="50%"><?php echo $row['mod_name']; ?></td>
                 <td width="10%"><?php echo $row['mod_creditHour']; ?></td>
                 <td width="10%"><?php echo $row['sectionName']; ?></td>
                 
                 <td  width="20%"> <?php  
                     echo FormUtil::getCreditFeesByBatch(yii::app()->session['batName'],yii::app()->session['proCode'],$row['mod_creditHour']);
                       $total = $total + FormUtil::getCreditFeesByBatch(yii::app()->session['batName'],yii::app()->session['proCode'],$row['mod_creditHour']);
                    ?>             
                 </td>

            </tr>
           <?php endforeach;?>
        </tbody>

    </table>

    <table class="table table-striped">
       <thead>
           <tr>            
                <th width="90%"><strong>Total Amount</strong></th>
                <th width="20%" style="font-size:25px; text-align: left;"><strong><?php echo $total; ?></strong></th>
             </tr>  
             <tr>            
                <th width="90%"><strong>Waiver</strong></th>
                <th width="20%" style="font-size:25px; text-align: left;"><strong><?php echo FormUtil::getWaiverByStudentID(yii::app()->session['studentID']).'%'; ?></strong></th>
             </tr>    
             <tr>
                <th width="90%"><strong>After Waived Total Payable</strong></th>
                <th width="20%" style="font-size:25px; text-align: left;"><strong><?php echo $total = $total-($total*FormUtil::getWaiverByStudentID(yii::app()->session['studentID']))/100; ?></strong></th>
              </tr>    


        </thead>    
    </table>
    <br></br>
    <table class="table table-striped">

        <tr>
            <td width ="100%"><strong>
                    <?php 

                    echo "* Per credit hour fee taka: ".FormUtil::getCreditFeesByBatch(yii::app()->session['batName'],yii::app()->session['proCode'],1);                
                    ?> 
                    </strong></td>
            </tr>
            <tr>
            <td width ="100%"><strong>
                    <?php 
                    $instalment = $total / 4;
                    echo "* Can pay in 4 installments,  taka: ".$instalment.' + '.$instalment.' + '.$instalment.' + '.$instalment.' = '.$total;                
                    ?> 
                    </strong></td>
            </tr>
    </table>
        
        <?php 
                  echo  CHtml::submitButton('Check another/Back', array('class' =>'btn btn-success btn-large'));
        ?>
        
    </div>
</div>