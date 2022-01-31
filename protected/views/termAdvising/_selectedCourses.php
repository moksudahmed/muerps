	

<div id="success"> 
    


		 <?php if (Yii::app()->user->hasFlash('success')):?>
			<div class="alert in alert-block fade alert-success">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  <?php echo Yii::app()->user->getFlash('success')?>
			</div>
		<?php endif;?>

    <div class="span-24">
        <div class="span-16">
            <?php  
            if($flag){
            $this->widget('bootstrap.widgets.TbButtonGroup', array(
                'buttons'=>array(
                            array('label'=>'Admitted Terms', 'url'=>array('termAdvising/admittedTerms'),'htmlOptions'=>array('class'=>'btn btn-medium ',)),
                            array('label'=>'Course Advising', 'url'=>array('termAdvising/modulesToBeAdvisied'),'htmlOptions'=>array('class'=>'btn btn-medium ',)),
                            array('label'=>'Advisied Courses',  'url'=>'#','htmlOptions'=>array('class'=>'btn btn-medium btn-danger',)),
                            array('label'=>'Special Retake',  'url'=>array('SpecialRetake'),'htmlOptions'=>array('class'=>'btn btn-medium ',)),                            
                            array('label'=>'Sepcial Course',  'url'=>array('SpecialCourse'),'htmlOptions'=>array('class'=>'btn btn-medium ',)),
//array('label'=>'Registered Courses', 'url'=>array('RegisteredCourse'),'htmlOptions'=>array('class'=>'btn btn-medium ',)),
                            //array('label'=>'Previous Record', 'url'=>array('GetPreviousRecordOf','id'=>yii::app()->session['studentID']),'htmlOptions'=>array('class'=>'btn btn-medium ',)),
                            
                            //array('label'=>'Modules Need to Retake',  'url'=>array('moduleRegistration/needToRetake'),'htmlOptions'=>array('class'=>'btn btn-medium ',)),
                        )
                    )
                 );
            }
            ?>      
        </div>
        <div class="span-6">
            <?php 
            $this->widget('bootstrap.widgets.TbMenu', array(
                    'type'=>'pills',
                    'items'=>array(
                            array('label'=>'Back', 'icon'=>'icon-arrow-left' , 'url'=>Yii::app()->controller->createUrl('termAdvising/index'), 'linkOptions'=>array('data-toggle'=>'tooltip','data-placement'=>'top', 'title'=>'Term Advising',), 'visible'=>true),	
                            array('label'=>'Invoice', 'icon'=>'icon-download', 'url'=>Yii::app()->controller->createUrl('invoicePDF'), 'linkOptions'=>array('target'=>'_blank'), 'visible'=>true),

                            array('label'=>'Academic Record', 'icon'=>'icon-download', 'url'=>Yii::app()->controller->createUrl('ExamDepartment/AcademicRecord',array('studentID'=>yii::app()->session['studentID'])), 'linkOptions'=>array('target'=>'_blank'), 'visible'=>true),
                    ),
            ));

            ?>
        </div>
        
    </div>
    <br/>

    <br/>
    <div class="span-24 title" style="font-size: 20px; padding-bottom: 20px;">Payment Method: <span class="label label-info" style=""> Credit Hour Basis</span></div>
    
    
    <div class="span-24">
        <table class=" table table-condensed">
       <thead>

                                <tr>
                                    <th>
                                        Status
                                    </th>
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
                                    
                                    <th>
                                        Amount
                                    </th>
                                </tr>
                            </thead>
            <tbody>
      
                <?php 
                $total=0; 
                $subTotal=0;
                $admissionFees=0;
                $termFees=0;
                $waiver =0;
                foreach ($model as $item):?>
                <tr>
                                    <td class="span-2" style="padding: 0px 0px 0px 0px;">
                                        <?php echo $item['reg_status']; ?>
                                    </td>
                                    <td class="span-3" style="padding: 0px 0px 0px 0px;">
                                        <?php echo $item['moduleCode']; ?>
                                    </td>
                                    <td class="span-6">
                                        <?php echo $item['mod_name']; ?>
                                    </td>
                                    
                                    
                                    <td class="span-2" >
                                        <?php echo $item['batchName']. FormUtil::getBatchNameSufix($item['batchName']). " ".$item['sectionName']; ?>
                                        
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
                                    <td class="span-3">
                                        <?php echo $item['per_name']; ?> 
                                    </td>
                                  
                                    <td class="span-8" style="text-align: right;" >
                                        <?php
                                        
                                            //$creditFee = FormUtil::getCreditFeesByBatch(yii::app()->session['batName'],yii::app()->session['proCode']);
                                            $creditFee = FormUtil::getCreditFeesByStudentID(yii::app()->session['studentID']);
                                            $totalCreditFee = $creditFee * $item['mod_creditHour'];
                                           
                                            $waiver = FormUtil::getWaiverByStudentID(yii::app()->session['studentID'],$item['offeredModuleID']);
                                            $waiver = (strtolower($item['reg_status'])=='regular'?$waiver:0);
                                            $waiverAmount=($totalCreditFee*$waiver)/100 ;
                                            $afterWaived= $totalCreditFee-$waiverAmount;
                                            
                                         
                                            echo '( '.$item['mod_creditHour'].' * '.$creditFee.'  = '. $totalCreditFee.' ) - '. $waiver.'%  = '.$afterWaived;
                                            $subTotal = $subTotal + $totalCreditFee;
                                            
                                            $total = $total + $afterWaived;
                                            
                                         
                                        ?>
                                    </td>
                                    <td class="span-1" style="font-weight: bold;">
                                        <a class="btn btn-mini" data-toggle="tooltip" rel="tooltip" data-original-title="delete" href="<?php echo Yii::app()->createUrl("termAdvising/deleteSelected", array("id"=>$item['moduleRegistrationID'],"oid"=>$item['offeredModuleID'])) ?>"><i class="icon-remove "></i> </a>
                                        <?php // echo CHtml::link('delete',Yii::app()->createUrl("termAdvising/deleteSelected", array("id"=>$item['moduleRegistrationID'])) , array('class'=>'btn btn-mini btn-danger','data-toggle'=>'tooltip')); ?>
                                    </td>
                                
                    
                </tr>
                
                <?php endforeach; ?>
                  
                 
                 <tr>
                    <td class="" colspan="4" style="font-weight: bold;">
                        
                        After Waiver Tuition Fees
                    
                        <?php  echo '( '.($total/4).' + '.($total/4).' + '.($total/4).' + '.($total/4).' )'; ?>
                    </td>
                    <td colspan="3" style="text-align: right; font-weight: bold; border-color: #000;" >
                        
                        <?php  echo $total.' /-'; ?>
                    </td>
                    <td></td>
                 </tr>
                 <tr>
                    <td class="" colspan="4" style="font-weight: bold;">
                        
                        Semester / Term Fee
                    </td>
                    
                    <td style="text-align: right; font-weight: bold;" colspan="3">
                        
                        <?php   echo $termFees= FormUtil::getCreditFeesByStudentID(yii::app()->session['studentID'],'Semester Fee').' /-'; ?>
                    </td>
                    <td></td>
                 </tr>
                 <?php 
                 
                // echo FormUtil::getTermNumberByStudentID(yii::app()->session['studentID'], yii::app()->session['traTermMod'],yii::app()->session['traYearMod']);
                 
                 if( $feeFlagAdd = FormUtil::getFeeFlagByStudentID(yii::app()->session['studentID'],1)):?>
                 <tr>
                    <td class="" colspan="4" style="font-weight: bold;">
                        
                        Admission Fee
                    </td>
                    
                    <td style="text-align: right; font-weight: bold;" colspan="3">
                        
                        <?php   echo $admissionFees = FormUtil::getFeesByBatch(yii::app()->session['batName'],yii::app()->session['proCode'],'Admission Fee').' /-'; ?>
                    </td>
                    <td></td>
                 </tr>
                 <?php endif; ?>
                 <tr>
                    <td class="" colspan="4" style="font-weight: bold; border-color: #000;">
                        
                        Net Payable
                    </td>
                    
                    <td colspan="3" style="text-align: right; font-weight: bold;  border-color: #000;" >
                        
                        <?php 
                            //$feeFlag = FormUtil::getFeeFlagByStudentID(yii::app()->session['studentID']);
                            
                            //echo (float)$total+((float)$feeFlagAdd?(float)$admissionFees:0)+((float)$feeFlag?(float)$termFees:0).'/-'; 
                            
                            echo (float)$total+((float)$feeFlagAdd?(float)$admissionFees:0)+(float)$termFees.'/-'; 
                            //echo $total+$admissionFees+$termFees.'/-'; 
                            ?>
                    </td>
                    <td></td>
                 </tr>
                 <tr>
                    <td colspan="8">
                        ** no waiver will be calculated for retake course
                    </td>
                    
                 </tr>
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