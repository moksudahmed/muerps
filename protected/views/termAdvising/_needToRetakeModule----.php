	

<div id="success"> 
    

<h5>
		 <?php if (Yii::app()->user->hasFlash('warning')):?>
			<div class="alert in alert-block fade alert-danger">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  <?php echo Yii::app()->user->getFlash('warning')?>
			</div>
		<?php endif;?>
    
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
                
                array('label'=>'Admitted Terms', 'url'=>array('termAdmission/termAdmission'),'htmlOptions'=>array('class'=>'btn btn-medium ',)),
                array('label'=>'Not Registered', 'url'=>array('moduleRegistration/index'),'htmlOptions'=>array('class'=>'btn btn-medium ',)),        
                array('label'=>'Registered Modules', 'url'=>array('moduleRegistration/RegisteredModule'),'htmlOptions'=>array('class'=>'btn btn-medium ',)),
                array('label'=>'Modules Need to Retake', 'url'=>'#','htmlOptions'=>array('class'=>'btn btn-medium btn-danger',)),
            )
        )
     );
?>
    
<?php 
    $data = array('studentID'=>yii::app()->session['studentID'],'sectionName'=>yii::app()->session['secName'],'batchName'=>yii::app()->session['batName'],'programmeCode'=>yii::app()->session['proCode'],'tra_term'=>yii::app()->session['traTerm'],'tra_year'=>yii::app()->session['traYear']);      
    $value=$model->searchOfferedModule($data['studentID'],$data['tra_term'], $data['tra_year'], $data['programmeCode']);
                 $this->renderPartial('_retakeForm',array('value'=>$value));
?>
    
<?php

//$getRegType='FormUtil::getModuleRegistrationType($data->reg_type)';
$getModType='FormUtil::getModuleType($data[\'mod_type\'])';
$getModLabIncluded='FormUtil::getModuleLabIncluded($data[\'mod_labIncluded\'])';
$id=yii::app()->session['\'studentID\''];
$termYear='FormUtil::getTermYear($data[\'tra_term\'], $data[\'tra_year\'])';
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
        'enablePagination' => true,
        'responsiveTable' => true,
	'dataProvider'=> $dataProvider,
	//'filter'=>$model,

    
    	'extraRowColumns'=> array('firstLetter'),
        'extraRowExpression' => '"<b style=\"font-size: 20px; color: #333;\">".$data[\'mod_group\']."</b>"',
        'extraRowHtmlOptions' => array('style'=>'padding:10px'),
      
	'columns'=>array(
           
                $groupGridColumns,
            
            'offeredModuleID',
		$moduleCode,
		$moduleName,
            $ofmCreditHour,
            
            $modLabIncluded,
		
		$modType,
                array('header'=>'Registered Term','value'=>$termYear,),
                $modulePrerequisite,  
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
                    'url'=>'Yii::app()->createUrl("examination/GetTranscriptOf", array("studentID"=>$data[\'studentID\']))',
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
   if (!confirm("Do you Want of Select following Code: "+data['offered[]'])){
      return false;
    }
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