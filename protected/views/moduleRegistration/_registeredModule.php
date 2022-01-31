	

<div id="success"> 
    


		 <?php if (Yii::app()->user->hasFlash('success')):?>
			<div class="alert in alert-block fade alert-success">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  <?php echo Yii::app()->user->getFlash('success')?>
			</div>
		<?php endif;?>

    <div class="span-24">
        <div class="span-20">
            <?php  
            if($flag){
            $this->widget('bootstrap.widgets.TbButtonGroup', array(
                'buttons'=>array(
                            array('label'=>'Back',  'url'=>array('termAdmission/termAdmission','flag'=>1),'htmlOptions'=>array('class'=>'btn btn-medium ', 'data-toggle'=>"tooltip", 'title'=>"Admitted Terms",)),
                            array('label'=>'Select Course', 'url'=>array('moduleRegistration/index'),'htmlOptions'=>array('class'=>'btn btn-medium ',)),
                            array('label'=>'Registered Courses',  'url'=>'#','htmlOptions'=>array('class'=>'btn btn-medium btn-danger',)),
                            
                            //array('label'=>'Modules Need to Retake',  'url'=>array('moduleRegistration/needToRetake'),'htmlOptions'=>array('class'=>'btn btn-medium ',)),
                        )
                    )
                 );
            }
            ?>      
        </div>
        
    </div>
    <br/>
<?php

$getRegType='FormUtil::getModuleRegistrationType($data->reg_type,$data->ofmSection,$data->ofmBatch)';
$getModType='FormUtil::getModuleType($data->mod_type)';
$getModLabIncluded='FormUtil::getModuleLabIncluded($data->mod_labIncluded)';
//$termYear='FormUtil::getTermYearWithNumber($data[\'traBatch\'],$data[\'programmeCode\'],$data[\'tra_term\'], $data[\'tra_year\'])';
$getRegWith='FormUtil::getModuleRegistrationBatchSection($data->ofmBatch,$data->ofmSection)';

$termYear='FormUtil::getTermYearWithNumberHTMLspan($data[\'studentID\'],$data[\'tra_term\'], $data[\'tra_year\'])';




$groupGridColumns = array(
'name' => 'firstLetter',
'value' => '$data->tra_term',
'headerHtmlOptions' => array('style'=>'display:none'),
'htmlOptions' =>array('style'=>'display:none')
);






$this->widget('bootstrap.widgets.TbGroupGridView', array(
        
	'id'=>'offeredModule-grid3',
        'type' => 'table-hover'/*'striped'*/,
    
        'enablePagination' => true,
        'responsiveTable' => true,
	'dataProvider'=>  $dataProvider,
	//'filter'=>$model,

    
    	'extraRowColumns'=> array('firstLetter'),
        'extraRowExpression' => $termYear,
        'extraRowHtmlOptions' => array('style'=>'padding:10px;font-size:20px;letter-spacing:2px; text-align:right; '),
      
        
	'columns'=>array(
           
                $groupGridColumns,
                'moduleRegistrationID',
                
            //'offeredModuleID',
            //'termAdmissionID',
		array('header'=>'Module: (Code','value'=>'$data[\'moduleCode\']','footer'=>'modType'),
		array('header'=>'Name','value'=>'$data->mod_name','htmlOptions' =>array('class'=>'span-6')),
                array('header'=>'Type','value'=>$getModType,'htmlOptions' =>array('class'=>'span-2'),),
                array('value'=>$getModLabIncluded,'htmlOptions' =>array('class'=>'span-2'),'footer'=>'Total Credit:'),
                array('name'=>'mod_creditHour','header'=>'Credit','htmlOptions' =>array('style'=>'text-align:left;','class'=>'span-3'),'class'=>'bootstrap.widgets.TbTotalSumColumn',),
                array('header'=>'Prerequisite)','value'=>'$data[\'mod_prerequisite\']',),
		
                
		
		
            
                array('header'=>'Reg: (date,','value'=>'FormUtil::getFormatedDate($data[\'reg_date\'])','htmlOptions' =>array('class'=>'span-4'),),
                array('header'=>'with)','value'=>$getRegWith,'htmlOptions' =>array('class'=>'span-2'),),
                array('value'=>'$data->reg_status','htmlOptions' =>array('class'=>'span-4'),),
             array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>' {Delete}',
            'buttons'=>array
            (
               
                
                'Delete' => array
                (
                    'label'=>'Cancel Term Admission',
                    'icon'=>'remove white',
                    'url'=>'Yii::app()->createUrl("moduleRegistration/delete2", array("id"=>$data->moduleRegistrationID))',
                    'options'=>array(
                        'class'=>'btn btn-mini btn-danger',
                        'data-toggle'=>'tooltip',
                        'rel'=>'$data->termAdmissionID',
                        'style'=>'display:none'
                        

                    ),
                    
                ),
            ),
            'htmlOptions'=>array(
                'style'=>'width: 220px; ',
                'class'=>'moreButtons',
                
            ),
                     
     ),
  
            )
    
    
));  ?>

</div>
<script type="text/javascript" >
    
    
        // prevent the click event
       
    
    $(window).load(function () {
        /*
        $( "td:contains('Spring')").addClass('label label-success span1');
        $( "td:contains('Summer')").addClass('label label-warning span1');
        $( "td:contains('Autumn')").addClass('label label-info span1');
         */
        $("td:contains('modType')").remove(); 
        $("td:contains('Total Credit')").css('font-weight','bold');      
        
        
        $("a[rel='<?php echo yii::app()->session['mrTermAdmissionID'] ?>']").css('display','inline-block');
        
        $( "td:contains('Regular')").css('color','#fff');
        
    });
    
</script>