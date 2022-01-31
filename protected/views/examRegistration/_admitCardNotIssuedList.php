
<div class="span-24 ">
		 <?php if (Yii::app()->user->hasFlash('success')):?>
			<div class="alert in alert-block fade alert-success span-20">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  <?php echo Yii::app()->user->getFlash('success')?>
			</div>
		<?php endif;?>
</div>

<div id="success" class="span-24" >
<?php 
$this->widget('bootstrap.widgets.TbMenu', array(
	'type'=>'pills',
	'items'=>array(
		
		array('label'=>'Export to ADmit Card', 'icon'=>'icon-download', 'url'=>Yii::app()->controller->createUrl('GenerateAdmitCardPDF'), 'linkOptions'=>array('target'=>'_blank'), 'visible'=>true),
		array('label'=>'Export Signature Sheet', 'icon'=>'icon-download', 'url'=>Yii::app()->controller->createUrl('GenerateSignatureSheetPDF'), 'linkOptions'=>array('target'=>'_blank'), 'visible'=>true),
                array('label'=>'Export Register', 'icon'=>'icon-download', 'url'=>Yii::app()->controller->createUrl('GenerateRegisterPDF'), 'linkOptions'=>array('target'=>'_blank'), 'visible'=>true),
                array('label'=>'Back', 'icon'=>'icon-arrow-left', 'url'=>Yii::app()->controller->createUrl('ExamDepartment/index'), 'linkOptions'=>array('data-toggle'=>'tooltip','data-placement'=>'top', 'title'=>'Exam Activities',), 'visible'=>true),
	),
));

?>

    
    <?php


$getRegWith='FormUtil::getModuleRegistrationBatchSection($data->batchName,$data->sectionName)';
    $getAdmitStatus='FormUtil::getAdmitPrintStatus($data->tra_finalAdmitPrint)';

$groupGridColumns = array(
'name' => 'firstLetter',
'value' => $getRegWith,
'headerHtmlOptions' => array('style'=>'display:none'),
'htmlOptions' =>array('style'=>'display:none')
);

$this->widget('bootstrap.widgets.TbGroupGridView', array(
        
	'id'=>'offeredModule-grid2',
        'type' => 'striped',
        'enablePagination' => true,
        'responsiveTable' => true,
	'dataProvider'=>$dataProvider,
	//'filter'=>$model,

    
    	'extraRowColumns'=> array('firstLetter'),
        'extraRowExpression' => $getRegWith,
        'extraRowHtmlOptions' => array('style'=>'padding:10px'),
      
        'bulkActions' => array(
            'actionButtons' => array(
            array(
                'id'=>'oo',
                'icon'=>'plus-sign white',
                'url' => array('examRegistration/selectForAdmitCard'),
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
            'name' => 'termAdmissionID'
            ),
        ),
	'columns'=>array(
/*           
                $groupGridColumns,
		array('header'=>'Code','name'=>'moduleCode','value'=>'$data[moduleCode]',),
		array('header'=>'Moudle Name','name'=>'mod_name','value'=>'$data[mod_name]','htmlOptions'=>array('class'=>'span-18')),
		array('header'=>'Credit Hour','name'=>'mod_creditHour','value'=>'$data[mod_creditHour]','htmlOptions'=>array('class'=>'span-5')),
                array('header'=>'Type','name'=>'mod_type','value'=>$getModType,),
                array('header'=>'','name'=>'mod_labIncluded','value'=>$getModLabIncluded,'htmlOptions'=>array('class'=>'span-4')),
		
              
              
                array('header'=>'prerequisite','name'=>'mod_prerequisite','value'=>'$data[mod_prerequisite]',),
                 array('header'=>'Sequence','name'=>'mod_name','value'=>'$data[mod_sequence]',),
  */
            
                        $groupGridColumns,
                        array('header'=>'ID','value'=>'$data->studentID','htmlOptions' =>array('class'=>'span-6'),'footer'=>'modType'),
                        
                        
			array('header'=>'Name','value'=>'$data->per_name','htmlOptions' =>array('class'=>'span-8'),),
                        
                        
                        array('header'=>'Gender','name'=>'per_gender','htmlOptions' =>array('class'=>'span-1'),),
			//'per_bloodGroup' ,
                        array('header'=>'Mobile','name'=>'per_mobile','htmlOptions' =>array('class'=>'span-2'),),
                
                        array('header'=>'Reg Date','value'=>'$data->tra_finalExamRegDate','htmlOptions' =>array('class'=>'span-2'),'footer'=>'Total Registered:'),
                        array('header'=>'','name'=>'tra_finalExamRegistred','htmlOptions' =>array('style'=>'text-align:left; color:#ffffff;','class'=>'span-1'),'class'=>'bootstrap.widgets.TbTotalSumColumn',),
                        array('header'=>'','value'=>$getAdmitStatus,'htmlOptions' =>array('style'=>'text-align:left;','class'=>'span-5')),
                
            array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>' {print}',
            'buttons'=>array
            (
               'cancel' => array
                (
                    'label'=>'Cancel Print',
                    'icon'=>'remove white',
                    'url'=>'Yii::app()->createUrl("examRegistration/c", array("id"=>$data->termAdmissionID))',
                    'options'=>array(
                        'class'=>'btn btn-mini btn-danger',     
                        'data-toggle'=>'tooltip',
                        'data-placement'=>'right'
                    ),
                ),

                'print' => array
                (
                    'label'=>'Print',
                    'icon'=>'print white',
                    'url'=>'Yii::app()->createUrl("examRegistration/generateAdmitCardPDF", array("traID"=>$data->termAdmissionID))',
                    'options'=>array(
                        'class'=>'btn btn-mini btn-success',
                        'data-toggle'=>'tooltip',
                        'data-placement'=>'right',
                        'target'=>'blank'
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
    
    
    
    
    $(function(){
        
        $(window).load(function () {
        
         
        $("td:contains('modType')").remove(); 
        $("td:contains('Total Registered')").css('font-weight','bold');
        
        $("td:contains('Ready To Print')").siblings('td').children('input').replaceWith('<i class="icon-ok"></i>');
        
        
        $("td:contains('not')").siblings('td').children('a').remove();
        $("td:contains('not')").replaceWith('<td></td>');
        
    });
        
        // prevent the click event
        $(document).on('click','#offeredModule-grid2 a#oo',function() {
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