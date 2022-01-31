
<div id="success" class="span-24"> 

	
    
<div class="span-16">

<?php  
$this->widget('bootstrap.widgets.TbButtonGroup', array(
    'buttons'=>array(
                
                array('label'=>'Advised Terms',  'url'=>array('admittedTerms','flag'=>1),'htmlOptions'=>array('class'=>'btn btn-medium ',)),
                array('label'=>'Course Advising', 'url'=>'#','htmlOptions'=>array('class'=>'btn btn-medium btn-danger',)),
                array('label'=>'Advisied Courses'.' ('.yii::app()->session['totalCourse'].')', 'url'=>array('SelectedCourses'),'htmlOptions'=>array('class'=>'btn btn-medium ',)),
                array('label'=>'Special Retake',  'url'=>array('SpecialRetake'),'htmlOptions'=>array('class'=>'btn btn-medium ',)),
                array('label'=>'Sepcial Course',  'url'=>array('SpecialCourse'),'htmlOptions'=>array('class'=>'btn btn-medium ',)),
                //array('label'=>'Registered Courses', 'url'=>array('RegisteredCourse'),'htmlOptions'=>array('class'=>'btn btn-medium ',)),
               // array('label'=>'Previous Record', 'url'=>array('GetPreviousRecordOf','id'=>yii::app()->session['studentID']),'htmlOptions'=>array('class'=>'btn btn-medium ',)),
                
                //array('label'=>'Modules Need to Retake',  'url'=>array('moduleRegistration/needToRetake'),'htmlOptions'=>array('class'=>'btn btn-medium ',)),
            )
        )
     );
?>
</div>
    <div class="span-6">
            <?php 
            $this->widget('bootstrap.widgets.TbMenu', array(
                    'type'=>'pills',
                    'items'=>array(
                            array('label'=>'Back', 'icon'=>'icon-arrow-left' , 'url'=>Yii::app()->controller->createUrl('termAdvising/index'), 'linkOptions'=>array('data-toggle'=>'tooltip','data-placement'=>'top', 'title'=>'Term Advising',), 'visible'=>true),	
                            array('label'=>'Invoice', 'icon'=>'icon-download', 'url'=>Yii::app()->controller->createUrl('invoicePDF'), 'linkOptions'=>array('target'=>'_blank'), 'visible'=>true),
                            array('label'=>'Admit Card', 'icon'=>'icon-print', 'url'=>Yii::app()->controller->createUrl('examRegistration/generateAdmitCardPDF',array('traID'=>yii::app()->session['termAdmissionID'])), 'linkOptions'=>array('target'=>'_blank'), 'visible'=>true),
                            array('label'=>'Academic Record', 'icon'=>'icon-download', 'url'=>Yii::app()->controller->createUrl('ExamDepartment/AcademicRecord',array('studentID'=>yii::app()->session['studentID'])), 'linkOptions'=>array('target'=>'_blank'), 'visible'=>true),
                    ),
            ));

            ?>
        </div>
    <div class="span-24">
        <h5 >Syllabus Version:<?php echo yii::app()->session['sylCode'];  ?></h5>
            <h5>
                             <?php if (Yii::app()->user->hasFlash('success')):?>
                                    <div class="alert in alert-block fade alert-success span-20">
                                      <button type="button" class="close" data-dismiss="alert">&times;</button>
                                      <?php echo Yii::app()->user->getFlash('success')?>
                                    </div>
                            <?php endif;?>
            </h5>
                    
            
    </div>
    <div class="span-24">
<?php

//$getRegType='FormUtil::getModuleRegistrationType($data->reg_type)';
//$getModType='FormUtil::getModuleType($data[\'mod_type\'])';
$getModLabIncluded='FormUtil::getModuleLabIncluded($data[\'mod_labIncluded\'])';
$id=yii::app()->session['studentID'];
//$termYear='FormUtil::getTermYear($data->tra_term, $data->tra_year)';
$flagPrerequisite='ModuleRegistration::flagPrerequisite($data[\'mod_prerequisite\'],$data[\'syllabusCode\'],"'.$id.'")';
$flagRetake='FormUtil::getRetakeFlagInfo($data[\'retakeLetterGrade\'])';
$getRegWith='FormUtil::getBatchTermName($data[\'sectionName\'],$data[\'batchName\'],$data[\'programmeCode\'])';
$getTimeSlot ='FormUtil::getTimeSlotByOfferedModuleID($data[\'offeredModuleID\'])';







$groupGridColumns = array(
    
'name' => 'firstLetter',
'value' => $getRegWith,
'headerHtmlOptions' => array('style'=>'display:none'),
'htmlOptions' =>array('style'=>'display:none'),
    
);






$this->widget('bootstrap.widgets.TbGroupGridView', array(
        
	'id'=>'moduleRegistration-grid',
        'type'=>'striped bordered',
        'enablePagination' => false,
        'responsiveTable' => true,
	'dataProvider'=> $dataProvider,
	//'filter'=>$model,

    
    	'extraRowColumns'=> array('firstLetter'),
        'extraRowExpression' => $getRegWith,
        'extraRowHtmlOptions' => array('style'=>'padding:10px; text-align:right; font-weight:bold;'),
      
        'bulkActions' => array(
            'actionButtons' => array(
            array(
                'id'=>'oo',
                'icon'=>'plus-sign white',
                'url' => array('selectModule'),
            'buttonType' => 'link',
            'type' => 'primary',
            'size' => 'large',
            'label' => 'Save Selected Courses',
       //     'click' => 'js:function(values){console.log(values);}',
     //'click' => 'js:batchActions'

                )
            ),
            // if grid doesn't have a checkbox column type, it will attach
            // one and this configuration will be part of it
            'checkBoxColumnConfig' => array(
            'name' => 'offeredModuleID',
            'checked'=>'false',
             
            )
        ),
	'columns'=>array(
           
                $groupGridColumns,
            
            //'offeredModuleID',
                array(
                    'header'=>'CL*',
                    'value'=>'$data[\'capacityLeft\']',
                    'htmlOptions' =>array('class'=>'span-1','style'=>'font-weight:bold;',),
                    ),
		array(
                //'name'=>'moduleCode',
                //'header'=>'Code',
                'value'=>'$data[\'moduleCode\']',
      //          'footer'=>'modType',
                'htmlOptions' =>array('id'=>'modID','class'=>'span-2'),
                ),
                array(
                    'name'=>'mod_name',
                    'header'=>'Title',
                    'value'=>'$data[\'mod_name\']',
    //                'footer'=>'Total Credit:',
                    'htmlOptions' =>array('id'=>'modName','class'=>'span-5',),
                    ),
/*	
                array(
                'name'=>'mod_creditHour',
                'header'=>'Credit',
                'htmlOptions' =>array('style'=>'text-align:left'),
                'class'=>'bootstrap.widgets.TbTotalSumColumn',
                //'footer'=>'Total Credit:'
                ),
  */          
	/*	array(
                'name'=>'mod_prerequisite',
                'header'=>'Prerequisite',
                'value'=>$flagPrerequisite,

               ),*/
             array(
                'name'=>'Time Slot',
                'value'=>$getTimeSlot,
                'htmlOptions' =>array('class'=>'span-5','style'=>'text-align:left'),
                //'footer'=>'modType'
               ),
  /*          array(
                'name'=>'Lab Included',
                'value'=>$getModLabIncluded,

            ),*/
		
            array('name'=>'mod_group','header'=>'Group','value'=>'$data[\'mod_group\']','htmlOptions' =>array('class'=>'span-2'),),
            array(
                'name'=>'retakeLetterGrade',
                'header'=>'LG*',
                //'value'=>$flagRetake,
                'htmlOptions' =>array('class'=>'span-2','style'=>'font-weight:bold; font-size:20px;',),

               ),
               // array('header'=>'Offered To','value'=>$getRegWith,'htmlOptions' =>array('class'=>'span-2'),),
                
                //'mod_group',
               
         
                
            array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'',
            'buttons'=>array
            (
               
                'view' => array
                (
                    'label'=>'View Details',
                    'icon'=>'search white',
                    'url'=>'Yii::app()->createUrl("module/view", array("id"=>$data[\'moduleCode\'],"pid"=>$data[\'syllabusCode\']))',
                    'options'=>array(
                        'class'=>'btn btn-mini btn-success',
                        'data-toggle'=>'tooltip',
                        
                    ),
                ),
                

            ),
            'htmlOptions'=>array(
                'style'=>'width: 220px; ',
                'class'=>'moreButtons',
                
            ),
     ),   
    ),
    'mergeColumns' => array('mod_group',)
    
));  ?>
    </div>
</div>
<script type="text/javascript">
    
   
    $(window).load(function () {
        <?php 
        
        $ofm =   Offeredmodule::model()->findAllByAttributes(array('sectionName'=>yii::app()->session['secName'],'batchName'=>yii::app()->session['batName'],'programmeCode'=>yii::app()->session['proCode'],'ofm_term'=>yii::app()->session['traTerm'],'ofm_year'=>yii::app()->session['traYear']));
        
        foreach ($ofm as $item)
        {
            
        
            echo "$( \"input[value='{$item->offeredModuleID}']\" ).attr('checked','checked');"; 
            echo "$(\"input[value='{$item->offeredModuleID}']\").parent().parent().css('background-color', '#C1FCC1');";
        }
        ?>
   
        var grid = $("#moduleRegistration-grid");
	if ($("input[name='moduleRegistration-grid_c0\[\]']:checked", grid).length)
	{

		$(".bulk-actions-btn", grid).removeClass("disabled");
		$("div.bulk-actions-blocker",grid).hide();
	}
	else
	{
		$(".bulk-actions-btn", grid).addClass("disabled");
		$("div.bulk-actions-blocker",grid).show();
	}
        
        $("td:contains('none')").siblings('td').children('input').replaceWith('<i class="icon-ban-circle"></i>');
        $("td:contains('none')").replaceWith('<td style="color:red">Prerequiste course not clear!</td>');
        
    if($("#moduleRegistration-grid_c0_all").attr('value')==1)
            { 
                $('#moduleRegistration-grid a#oo').siblings('div').attr('style','position:absolute;top:0;left:0;height:100%;width:100%;display:none;');
                //$('#moduleRegistration-grid a#oo').removeClass('disabled');
            }
    });
    
    
    $(function(){
        // prevent the click event
        $(document).on('click','#moduleRegistration-grid a#oo',function() {
            var url=$(this).attr('href');
            //alert(url);
            
          var data = { 'offered[]' : []};
$(":checked").each(function() {
    //alert($(this).val());
    
  data['offered[]'].push($(this).val());
});

//alert(data['offered[]']);
/*
$.post('http://localhost:8082/muErpSolV1/index.php?r=offeredModule/selectModule', { name: "John", time: "2pm" });
    */
  /* if (!confirm("Do you Want of Select following Code: "+data['offered[]'])){
      return false;
    }*/
    $.ajax({url:url,
        type:'post',
        data: data,
        success:function(result){
      $("#success").html(result); url='';
    }});
    
    return true;
    });
    
    
    
    $( "input[type='checkbox']").on( "click", function()
                            {


                                if ( $(this).prop('checked') ){

                                    var selector = $(this).parent().siblings("td[id='modID']").text();
                                    
                                    var flag1 = $(this).attr('value');
                                    //alert(flag1);
                                    var val='';
                                    
                                    $("td[id='modID']").each(function() {
                                        
                                        if($(this).text()==selector)
                                            {
                                                
                                                var flag2 = $(this).siblings("td[class='checkbox-column']").children('input').attr('value');
                                                if(flag1!=flag2)
                                                {
                                                    //$(this).siblings("td[class='checkbox-column']").children('input').attr('disabled','true');  //.replaceWith('<i class="icon-ok"></i>');
                                                    $(this).siblings("td[class='checkbox-column']").children('input').removeAttr('checked');                                                
                                                    $(this).siblings("td[class='checkbox-column']").children('input').hide('slow');
                                                    
                                                }
                                                //val = val+ $(this).text();
                                            }
                                            
                                      
                                    });
                                    //alert(val);
                                }
                                else 
                                {
                                     var selector = $(this).parent().siblings("td[id='modID']").text();
                                        $("td[id='modID']").each(function() {
                                                if($(this).text()==selector)
                                                {
                                        
                                                    $(this).siblings("td[class='checkbox-column']").children('input').show('slow');  //.replaceWith('<i class="icon-ok"></i>');
                                                
                                                //val = val+ $(this).text();
                                                }
                                            
                                      
                                    });
                                }


                            } );
    
    
    
    });
    
</script>