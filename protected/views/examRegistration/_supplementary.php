<?php $today= date('Y-m-d'); ?>	




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
//$getRegType='FormUtil::getModuleRegistrationType($data->reg_type)';

$termYear='FormUtil::getTermYearWithNumberHTMLspan($data[\'studentID\'],$data[\'tra_term\'], $data[\'tra_year\'])';

//$getModType='FormUtil::getModuleType($data[\'mod_type\'])';
//$getModLabIncluded='FormUtil::getModuleLabIncluded($data[\'mod_labIncluded\'])';




$regWithBatSec ='FormUtil::getRegWithBatchSection($data[\'batchName\'], $data[\'sectionName\'])';
$regDate ='FormUtil::getFormatedDate($data[\'reg_date\'])';

//$moduleName= 'FormUtil::getModuleTitleHTMLspan($data[\'mod_name\'],$data[\'facultyID\'])';
$creditHour = 'FormUtil::removeCreditHourByLG($data[\'letterGrade\'],$data[\'mod_creditHour\'])';


$groupGridColumns = array(
'name' => 'firstLetter',
'value' => $termYear,
'headerHtmlOptions' => array('style'=>'display:none'),
'htmlOptions' =>array('style'=>'display:none')
);



$this->widget('bootstrap.widgets.TbGroupGridView', array(
        
	'id'=>'moduleRegistration-grid',
        'type' => 'striped bordered hover',
        'enablePagination' => false,
        'responsiveTable' => true,
	'dataProvider'=> $dataProvider,
	//'filter'=>$model,

    
    	'extraRowColumns'=> array('firstLetter'),
        'extraRowExpression' => $termYear,
        'extraRowHtmlOptions' => array('style'=>'padding:10px;text-align:right; font-weight: normal'),
      'bulkActions' => array(
            'actionButtons' => array(
            array(
                'id'=>'oo',
                'icon'=>'plus-sign white',
                'url' => array('examRegistration/SaveSuppleRegistration'),
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
            'name' => 'id',
                'value' => '$data[\'id\'].\'-\'.$data[\'examinationID\']',
            'checked'=>'false',
                
            )
        ),
	'columns'=>array(
           
                $groupGridColumns,
                array('name' => 'reg_status','header'=>'',
                //'value' => '$data[\'moduleCode\']',
                'htmlOptions' =>array('class'=>'span-1','style'=>'',),'headerHtmlOptions' => array('style'=>''),
                ),
                array('name' => 'moduleCode','header'=>'',
                //'value' => '$data[\'moduleCode\']',
                'htmlOptions' =>array('class'=>'span-3','style'=>'','id'=>'modID'),'headerHtmlOptions' => array('style'=>''),
                //'footer'=>'modName'    
                ),
                array('name' => 'mod_name','header'=>'Title',
  //              'value' => $moduleName,
                'htmlOptions' =>array('class'=>'span-8','style'=>'',),'headerHtmlOptions' => array('style'=>''),'footerHtmlOptions' => array('style'=>'font-weight:bold'),
                //'footer' => 'Total Credit'
                ),
                array('name' => 'mod_creditHour','header'=>'CH',
                //'value' => $creditHour,
                'htmlOptions' =>array('class'=>'','style'=>'',),'headerHtmlOptions' => array('style'=>''),'footerHtmlOptions' => array('style'=>'font-weight:bold'),
               // 'class'=>'bootstrap.widgets.TbTotalSumColumn'
                ),
               /* array('name' => 'mod_group','header'=>'Group',
                //'value' => '$data[\'moduleCode\']',
                'htmlOptions' =>array('class'=>'span-3','style'=>'',),'headerHtmlOptions' => array('style'=>''),
                ),*/
                
                
                array('name'=>'batchName','header'=>'With',
                'value' => $regWithBatSec,
                'htmlOptions' =>array('class'=>'span-1','style'=>'',),'headerHtmlOptions' => array('style'=>''),
                ),
                
                array('name' => 'markFirstHalf','header'=>'60',
                //'value' => '$data[\'moduleCode\']',
                'htmlOptions' =>array('class'=>'span-1','style'=>'',),'headerHtmlOptions' => array('style'=>''),
                ),
                array('name' => 'emr_mark','header'=>'40',
                //'value' => '$data[\'moduleCode\']',
                'htmlOptions' =>array('class'=>'span-1','style'=>'font-weight:bold',),'headerHtmlOptions' => array('style'=>''),
                ),
                array('name' => 'letterGrade','header'=>'LG',
                //'value' => '$data[\'moduleCode\']',
                'htmlOptions' =>array('class'=>'span-2','style'=>'font-weight:bold',),'headerHtmlOptions' => array('style'=>''),
                ),
                array('name' => 'gradePoint','header'=>'GP',
                //'value' => '$data[\'moduleCode\']',
                'htmlOptions' =>array('class'=>'span-1','style'=>'',),'headerHtmlOptions' => array('style'=>''),
                ),
                array('name' => 'per_name','header'=>'Faculty',
                //'value' => '$data[\'moduleCode\']',
                'htmlOptions' =>array('class'=>'span-3','style'=>'',),'headerHtmlOptions' => array('style'=>''),
                ),
               /* array('name' => 'per_mobile','header'=>'',
                //'value' => '$data[\'moduleCode\']',
                'htmlOptions' =>array('class'=>'span-2','style'=>'',),'headerHtmlOptions' => array('style'=>''),
                ),*/

            
            array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>' {delete}',
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
                ) ,
         'delete' => array
                (
                    'label'=>'Cancel Retake',
                    'icon'=>'remove white',
                    'url'=>'Yii::app()->createUrl("headsFunction/deleteRetake", array("id"=>$data[\'moduleRegistrationID\']))',
                    'options'=>array(
                        'class'=>'btn btn-mini btn-danger',
                        'data-toggle'=>'tooltip',
                        'rel'=>'$data[\'reg_date\']',
                        'style'=>'display:none'
                    ),
                ),

            ),
            'htmlOptions'=>array(
                'style'=>'width: 220px; ',
                'class'=>'moreButtons',
                
            ),
                
     ),   
    ),
    'mergeColumns' => array('batchName','reg_status',)
    
));  ?>


<script type="text/javascript">
    $(window).load(function () {
        
        $("td:contains('modName')").remove(); 
        $("td:contains('modType')").remove(); 
        $("td:contains('Total Credit')").css('font-weight','bold');
        
        $("td:contains('none')").siblings('td').children('input').replaceWith('<i class="icon-ban-circle"></i>');
        $("td:contains('none')").replaceWith('<td style="color:red">Prerequiste course not clear!</td>');
        if($("#moduleRegistration-grid_c0_all").attr('value')==0)
            {   
                $('#moduleRegistration-grid a#oo').siblings('div').attr('style','position:absolute;top:0;left:0;height:100%;width:100%;display:none;');
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
    
     
    $( "input[type='checkbox']").on( "click", function()
                            {


                                if ( $(this).prop('checked') ){

                                    var selector = $(this).parent().siblings("td[id='modID']").text();
                                    
                                    var flag1 = $(this).attr('value');
                                    //alert(selector);
                                    var val='';
                                    
                                    $("td[id='modID']").each(function() {
                                        //alert($(this).text());
                                        if($(this).text()==selector)
                                            {
                                                
                                                var flag2 = $(this).siblings("td[class='checkbox-column']").children('input').attr('value');
                                                //alert(flag1);
                                                if(flag1!=flag2)
                                                {
                                                    //$(this).siblings("td[class='checkbox-column']").children('input').attr('disabled','true');  //.replaceWith('<i class="icon-ok"></i>');
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
