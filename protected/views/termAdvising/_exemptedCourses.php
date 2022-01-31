	

<div id="success"> 
    


		 <?php if (Yii::app()->user->hasFlash('success')):?>
			<div class="alert in alert-block fade alert-success">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  <?php echo Yii::app()->user->getFlash('success')?>
			</div>
		<?php endif;?>

    <div class="span-24">
        <div class="span-14">
            <?php  
            if($flag){
            $this->widget('bootstrap.widgets.TbButtonGroup', array(
                'buttons'=>array(
                            array('label'=>'Admitted Terms', 'url'=>array('termAdvising/allAdmittedTerms'),'htmlOptions'=>array('class'=>'btn btn-medium ',)),
                            array('label'=>'Course Exemption', 'url'=>array('termAdvising/modulesToBeExmaption'),'htmlOptions'=>array('class'=>'btn btn-medium ',)),
                            array('label'=>'Exempted Courses',  'url'=>'#','htmlOptions'=>array('class'=>'btn btn-medium btn-danger',)),
                            //array('label'=>'Registered Courses', 'url'=>array('RegisteredCourse'),'htmlOptions'=>array('class'=>'btn btn-medium ',)),
                            //array('label'=>'Previous Record', 'url'=>array('GetPreviousRecordOf','id'=>yii::app()->session['studentID']),'htmlOptions'=>array('class'=>'btn btn-medium ',)),
                            
                            //array('label'=>'Modules Need to Retake',  'url'=>array('moduleRegistration/needToRetake'),'htmlOptions'=>array('class'=>'btn btn-medium ',)),
                        )
                    )
                 );
            }
            ?>      
        </div>
        <div class="span-8">
         
        </div>
        
    </div>
    <br/>

    <br/>

    <?php 
    
    
        
    
    
    ?>
    
    <div class="span-24">
        <table class=" table table-condensed">
       <thead>

                                <tr>
                                    <!--th>
                                        Head
                                    </th-->
                                    <th>
                                        Code
                                    </th>
                                    <th>
                                        Title
                                    </th>
                                    
                                    
                                    <th>
                                        Batch
                                    </th>
                                    <th>
                                        Routine
                                    </th>
                                    <th>
                                        Faculty
                                    </th>                                   
                                   
                                </tr>
                            </thead>
            <tbody>
      
                <?php 
                $total=0; 
                $subTotal=0;
                $admissionFees=0;
                $termFees=0;
                $totalMonth =FormUtil::getMonthByBatch(yii::app()->session['batName'],yii::app()->session['proCode']);                
                $waiver = FormUtil::getWaiverByStudentID2(yii::app()->session['studentID']);    
                //$creditFee = FormUtil::getCreditFeesByBatch(yii::app()->session['batName'],yii::app()->session['proCode']);
                $creditFee = FormUtil::getCreditFeesByStudentID(yii::app()->session['studentID']);
                $totalCredit = FormUtil::getCreditHourByBatch(yii::app()->session['batName'],yii::app()->session['proCode']);                

                $monthlyFee = round(($creditFee*$totalCredit)/$totalMonth);                
                
                $waivedMonthlyFee = $monthlyFee*4 -((($monthlyFee*4)*$waiver)/100);
                
                $total = $waivedMonthlyFee;
                
                foreach ($model as $item):?>
                <tr>
                    
                                    <td class="span-3" style="padding: 0px 0px 0px 0px;">
                                        <?php echo $item['moduleCode']; ?>
                                    </td>
                                    <td class="span-6">
                                        <?php echo $item['mod_name']; ?>
                                    </td>
                                    
                                    
                                    <td class="span-2" >
                                        <?php echo $item['batchName']. FormUtil::getBatchNameSufix($item['batchName']). " ".$item['sectionName']."<strong>".(strtolower($item['reg_status'])=='retake'?' (Re)':'')."</strong>"; ?>
                                    </td>
                                    <td class="span-8">
                                        <table class="table table-bordered">
                                            <?php $rou = Routine::model()->findAllByAttributes(array('offeredModuleID'=>$item['offeredModuleID'])); ?>
                                            <?php foreach ($rou as $item2):?>
                                            <tr>
                                                <td><?php echo $item2['timeSlotCode']; ?></td>
                                                <td><?php echo $item2['roomCode']; ?></td>
                                            </tr>
                                            <?php endforeach;?>
                                        </table>
                                    </td>
                                    <td class="span-4">
                                        <?php echo $item['per_name']; ?> 
                                    </td>
                                  
                                    <td class="span-7" style="text-align: right;" >
                                        
                                        
                                        <?php
                                        
                                        
                                        
                                        //echo $totalCreditFee;
                                        
                                        if(strtolower($item['reg_status'])=='retake')
                                        {
                                            
                                            
                                        $waiver2 = FormUtil::getWaiverByStudentID(yii::app()->session['studentID'],$item['offeredModuleID']);
                                        //$creditFee = FormUtil::getCreditFeesByBatch(yii::app()->session['batName'],yii::app()->session['proCode']);
                                        $totalCreditFee = $creditFee * $item['mod_creditHour'];
                                        $waiverAmount=($totalCreditFee*$waiver2)/100 ;
                                        $afterWaived= $totalCreditFee-$waiverAmount;
                                            
                                            echo '( '.$item['mod_creditHour'].' * '.$creditFee.'  = '. $totalCreditFee.' ) - '. $waiverAmount.'  = '.$afterWaived;
                                            $subTotal = $subTotal + $totalCreditFee;
                                            
                                            //$total = $total + $afterWaived;
                                        }
                                        else
                                        {
                                            echo "N/A";
                                        }
                                         
                                        ?>
                                    </td>
                                    <td class="span-1" style="font-weight: bold;">
                                        <a class="btn btn-mini" data-toggle="tooltip" rel="tooltip" data-original-title="delete" href="<?php echo Yii::app()->createUrl("termAdvising/deleteSelected", array("id"=>$item['moduleRegistrationID'],"oid"=>$item['offeredModuleID'])) ?>"><i class="icon-remove "></i> </a>
                                        <?php // echo CHtml::link('delete',Yii::app()->createUrl("termAdvising/deleteSelected", array("id"=>$item['moduleRegistrationID'])) , array('class'=>'btn btn-mini btn-danger','data-toggle'=>'tooltip')); ?>
                                    </td>
                                
                    
                </tr>
                
                <?php endforeach; ?>
                <tr>
                                        
                    <td style="border-color: #000;"></td>
                 </tr>    
                 
                 <?php 
                 
                // echo FormUtil::getTermNumberByStudentID(yii::app()->session['studentID'], yii::app()->session['traTermMod'],yii::app()->session['traYearMod']);
                 
                 if( $feeFlagAdd = FormUtil::getFeeFlagByStudentID(yii::app()->session['studentID'],1)):?>
                 <tr>
                    <td class="" colspan="5" style="font-weight: bold;">
                        
                        Admission Fee
                    </td>
                    
                    <td style="text-align: right; font-weight: bold;" colspan="1">
                        
                        <?php   echo $admissionFees = FormUtil::getFeesByBatch(yii::app()->session['batName'],yii::app()->session['proCode'],'Admission Fee').' /-'; ?>
                    </td>
                    <td></td>
                 </tr>
                 <?php endif; ?>
                
            </tbody>
        </table>
    </div>
</div>  
    
<script type="text/javascript">
    
    
        // prevent the click event
       
    
    $(window).load(function () {
        
        
        $("td:contains('modType')").remove(); 
        
        $("td:contains('Total Credit')").css('font-weight','bold');      
        $("td:contains('Total Amount')").css('font-weight','bold');  
        
        var range = parseFloat($("#totalFees").val());
        $("#creditFees").val(range);
    });
    
    
    
</script>