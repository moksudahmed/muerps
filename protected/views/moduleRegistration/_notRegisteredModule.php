	

<div id="success"> 
    

<h5>
		 <?php if (Yii::app()->user->hasFlash('success')):?>
			<div class="alert in alert-block fade alert-success">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  <?php echo Yii::app()->user->getFlash('success')?>
			</div>
		<?php endif;?>
</h5>

<?php  
$this->widget('bootstrap.widgets.TbButtonGroup', array(
    'buttons'=>array(
                
                array('label'=>'Back',  'url'=>array('termAdmission/termAdmission','flag'=>1),'htmlOptions'=>array('class'=>'btn btn-medium ', 'data-toggle'=>"tooltip", 'title'=>"Admitted Terms",)),
                array('label'=>'Select Course', 'url'=>'#','htmlOptions'=>array('class'=>'btn btn-medium btn-danger',)),
                array('label'=>'Registered Courses', 'url'=>array('moduleRegistration/RegisteredModule'),'htmlOptions'=>array('class'=>'btn btn-medium ',)),
                
               // array('label'=>'Modules Need to Retake',  'url'=>array('moduleRegistration/needToRetake'),'htmlOptions'=>array('class'=>'btn btn-medium ',)),
            )
        )
     );
?>

<?php

//$getRegType='FormUtil::getModuleRegistrationType($data->reg_type)';
$getModType='FormUtil::getModuleType($data[\'mod_type\'])';
$getModLabIncluded='FormUtil::getModuleLabIncluded($data[\'mod_labIncluded\'])';
$id=yii::app()->session['studentID'];
//$termYear='FormUtil::getTermYear($data->tra_term, $data->tra_year)';
$flagPrerequisite='ModuleRegistration::flagPrerequisite($data[\'mod_prerequisite\'],$data[\'syllabusCode\'],"'.$id.'")';



$modulePrerequisite=array(
    'name'=>'mod_prerequisite',
    'header'=>'Prerequisite',
    'value'=>$flagPrerequisite,
    
);

$moduleCode=array(
    'name'=>'moduleCode',
    'header'=>'Module Code',
    'value'=>'$data[\'moduleCode\']',
    'footer'=>'modType'
);

$moduleName=array(
    'name'=>'mod_name',
    'header'=>'Module Name',
    'value'=>'$data[\'mod_name\']',
    'footer'=>'Total Credit:'
);

$groupGridColumns = array(
'name' => 'firstLetter',
'value' => '$data[\'mod_group\']',
'headerHtmlOptions' => array('style'=>'display:none'),
'htmlOptions' =>array('style'=>'display:none')
);

$modLabIncluded=  array(
    'name'=>'Lab Included',
    'value'=>$getModLabIncluded,
  
);

$ofmCreditHour= array(
'name'=>'mod_creditHour',
'header'=>'Credit',
'htmlOptions' =>array('style'=>'text-align:left'),
'class'=>'bootstrap.widgets.TbTotalSumColumn',
//'footer'=>'Total Credit:'
);
$modType=  array(
    'name'=>'module type',
    'value'=>$getModType,
    //'footer'=>'modType'
);

$this->widget('bootstrap.widgets.TbGroupGridView', array(
        
	'id'=>'moduleRegistration-grid',
        'type' => 'striped',
        'enablePagination' => false,
        'responsiveTable' => true,
	'dataProvider'=> $dataProvider,
	//'filter'=>$model,

    
    	'extraRowColumns'=> array('firstLetter'),
        'extraRowExpression' => '$data[\'mod_group\']',
        'extraRowHtmlOptions' => array('style'=>'padding:10px; text-align:right; font-weight:bold;'),
      
        'bulkActions' => array(
            'actionButtons' => array(
            array(
                'id'=>'oo',
                'icon'=>'plus-sign white',
                'url' => array('moduleRegistration/selectModule'),
            'buttonType' => 'link',
            'type' => 'primary',
            'size' => 'large',
            'label' => 'Save Selected Modules',
            //'click' => 'js:function(values){console.log(values);}'
     // 'click' => 'js:batchActions'

                )
            ),
            // if grid doesn't have a checkbox column type, it will attach
            // one and this configuration will be part of it
            'checkBoxColumnConfig' => array(
            'name' => 'offeredModuleID',
            'checked'=>'true',
            )
        ),
	'columns'=>array(
           
                $groupGridColumns,
            
            'offeredModuleID',
		$moduleCode,
		$moduleName,
            $ofmCreditHour,
            'mod_prerequisite',
		$modulePrerequisite,
            $modLabIncluded,
		
		$modType,
                
                
                //'mod_group',
               
         
                
            array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{view}',
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
    )
    
    
));  ?>

</div>
<script type="text/javascript">
    $(window).load(function () {
        
         
        $("td:contains('modType')").remove(); 
        $("td:contains('Total Credit')").css('font-weight','bold');
        
        $("td:contains('none')").siblings('td').children('input').replaceWith('<i class="icon-ban-circle"></i>');
        $("td:contains('none')").replaceWith('<td style="color:red">Prerequiste course not clear!</td>');
        if($("#moduleRegistration-grid_c0_all").attr('value')==1)
            {   $('#moduleRegistration-grid a#oo').siblings('div').attr('style','position:absolute;top:0;left:0;height:100%;width:100%;display:none;');
                $('#moduleRegistration-grid a#oo').removeClass('disabled');
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
    
    
    
    
    });
    
</script>