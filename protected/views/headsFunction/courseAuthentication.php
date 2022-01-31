<?php

$this->breadcrumbs=array(
	'Department Activities'=>array('headsFunction/index'),
        
        'Result Authentication'
	
);

?>

<div class="title span-20">
            <h3>Result Authentication</h3>
            <h4><?php echo FormUtil::getTerm( yii::app()->session['caTerm']);?> Term Final Examination <?php echo yii::app()->session['caYear'];?></h4>            
            
            <h5 ><strong style="padding-right: 10px;">Department:</strong><span class="label label-success"><?php echo FormUtil::getDepartmentByID(yii::app()->session['MainDepartmentID'],yii::app()->session['MainUserType']); ?></span></h5>

</div>
<div class="span-4">
    <h4>
    
    <span class="label label-warning"><?php echo FormUtil::getTerm(yii::app()->session['caTerm']); ?> </span>
        <span class="label label-success"> <?php echo yii::app()->session['caYear'];  ?></span>
        
        <strong style="letter-spacing:3px;">Selected Term </strong></h4>
    <h6>Programme:<?php  echo DBhelper::getProgrammeByCode(yii::app()->session['caProCode']); ?></h6>
    <?php
            $this->widget('bootstrap.widgets.TbMenu', array(
	'type'=>'pills',
	'items'=>array(
		
	//array('label'=>'Generate 100 Mark Sheet', 'icon'=>'icon-download', 'url'=>Yii::app()->controller->createUrl('GenerateFirstHalfPDF'), 'linkOptions'=>array('target'=>'_blank'), 'visible'=>true),
        array('label'=>'Back', 'icon'=>'icon-arrow-left' , 'url'=>Yii::app()->controller->createUrl('headsFunction/index'), 'linkOptions'=>array('data-toggle'=>'tooltip','data-placement'=>'top', 'title'=>'Department Activities',), 'visible'=>true),	
	//array('label'=>'Next', 'icon'=>'icon-play-circle', 'url'=>Yii::app()->controller->createUrl('resultSheet'), 'linkOptions'=>array('data-toggle'=>'tooltip','data-placement'=>'right', 'title'=>'Get Result') , 'visible'=>true, ),	
	),
    )); ?>
</div>
<hr/>
<div class="span-10">
<?php if (Yii::app()->user->hasFlash('success')):?>
			<div class="alert in alert-block fade alert-success">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  <?php echo Yii::app()->user->getFlash('success')?>
			</div>
		<?php endif;?>
    
                <?php if (Yii::app()->user->hasFlash('warning')):?>
			<div class="alert in alert-block fade alert-danger">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  <?php echo Yii::app()->user->getFlash('warning')?>
			</div>
		<?php endif;?>
</div>
<div id="success" class="">
    
          
  <?php

$getRegWith='FormUtil::getBatchTermName($data[\'sectionName\'],$data[\'batchName\'],$data[\'programmeCode\'])';
//$getRegWith='FormUtil::getBatchName($data[\'batchName\'])';

$offeredModuleID=array(
    'name'=>'offeredModuleID',
    'header'=>'Id',
    'value'=>'$data[\'offeredModuleID\']',

    'htmlOptions' =>array('class'=>'span-2'),
    
);


$sectionName =array(
    'name'=>'sectionName',
    'header'=>'Section',
    'value'=>'$data[\'sectionName\']',

    'htmlOptions' =>array('class'=>'span-2'),
    
);

$moduleCode=array(
    'name'=>'moduleCode',
    'header'=>'Code',
    'value'=>'$data[\'moduleCode\']',

    'htmlOptions' =>array('class'=>'span-3'),
    
);

$moduleName=array(
    
    'name'=>'mod_name',
    'header'=>'Course Title',
    'value'=>'$data[\'mod_name\']',
    'htmlOptions' =>array('class'=>'span-1'),
    
    
);
$facultyName=array(
    
    'name'=>'per_name',
    'header'=>'Faculty',
    'value'=>'$data[\'per_name\']',
    'htmlOptions' =>array('class'=>'span-3',),
    
    
);

$groupGridColumns = array(
'name' => 'firstLetter',
'value' => $getRegWith,
'headerHtmlOptions' => array('style'=>'display:none'),
'htmlOptions' =>array('style'=>'display:none'),
    
);


$editableColumn1 =  array(
'name' => 'userID',
'header' => 'Access To',
'class' => 'bootstrap.widgets.TbEditableColumn',
'headerHtmlOptions' => array('style' => 'width:80px'),
    'htmlOptions'=>array('class'=>'span-10'),
'editable' => array(
    'type' => 'select',
    'url' => Yii::app()->createUrl("offeredModule/editable", array("id"=>'$data->offeredModuleID')),
    'htmlOptions'=>array('style'=>'font-weight:bold; border-bottom: 0px solid'),
    'source' =>CHtml::listData(FormUtil::getFacultyByUser(), 'id', 'text','group')
    )
);

$editableColumn2 = array(
                    'name' => 'ofm_approval',
                    'header' => 'Approved',
                    'class' => 'bootstrap.widgets.TbEditableColumn',
                    'headerHtmlOptions' => array('style' => 'width:80px'),
                    'editable' => array(
                        'htmlOptions'=>array('style'=>'font-weight:bold; border-bottom: 0px solid'),
                        'type' => 'select',
                        'url' => Yii::app()->createUrl("facultiesFunction/saveApproval", array("id"=>'$data->offeredModuleID')),
                        'source' => array(1=>'Yes',0=>'No'),
                            'display' => 'js: function(value, sourceData) {
                            var escapedValue = $(this).text(value).html();

                            if(escapedValue==1)
                            {
                              $(this).html("<span class=\"label label-success\">  Yes <i class=\"icon-ok\"></i> </span>")
                            }
                            else $(this).html("<span class=\"label label-warning\">No <i class=\"icon-remove\"></i></span>")

                          }'


               )
        );

$editableColumn4 = array(
                    'name' => 'ofm_publish',
                    'header' => '',
                    'class' => 'bootstrap.widgets.TbEditableColumn',
                    'headerHtmlOptions' => array('style' => 'width:80px'),
                    'editable' => array(
                        'htmlOptions'=>array('style'=>'font-weight:bold; border-bottom: 0px solid'),
                        'type' => 'select',
                        'url' => Yii::app()->createUrl("facultiesFunction/saveApproval", array("id"=>'$data->offeredModuleID')),
                        'source' => array(1=>'Publish',0=>'No'),
                            'display' => 'js: function(value, sourceData) {
                            var escapedValue = $(this).text(value).html();

                            if(escapedValue==1)
                            {
                              $(this).html("<span class=\"label label-success\" style=\" padding:5px 5px 5px 5px; font-size:20px;\">P <a href=\"#\" data-toggle=\"tooltip\" title=\"Published\"> <i class=\"icon-ok\"></i> </a></span>")
                            }
                            else $(this).html("<span class=\"label label-warning\" style=\" padding:5px 5px 5px 5px;\">U <a href=\"#\" data-toggle=\"tooltip\" title=\"Unpublished\"><i class=\"icon-remove \"></i></a></span>")

                          }'


               )
        );

$editableColumn3 =  array(
'name' => 'ofm_maxCapacity',
'header' => 'Capacity',
'class' => 'bootstrap.widgets.TbEditableColumn',
'headerHtmlOptions' => array('style' => 'width:80px'),
    'htmlOptions'=>array('class'=>'span-1'),
'editable' => array(
    'type' => 'text',
    'url' => Yii::app()->createUrl("offeredModule/editable", array("id"=>'$data->offeredModuleID')),
    'htmlOptions'=>array('style'=>'font-weight:bold; border-bottom: 0px solid'),
    
    )
);
     
$this->widget('bootstrap.widgets.TbGroupGridView', array(
        
	'id'=>'resultPublish-grid',
        'type'=>'striped bordered',
        'enablePagination' => true,
        'responsiveTable' => true,
	'dataProvider'=> $dataProvider,
	//'filter'=>$model,

    
    	'extraRowColumns'=> array('firstLetter'),
        'extraRowExpression' => $getRegWith,
        'extraRowHtmlOptions' => array('style'=>'padding-right:10px; text-align:right; font-weight:bold ; font-size:16px; color: #333;'),
/*
        'bulkActions' => array(
            'actionButtons' => array(
            array(
                'id'=>'oo',
                'icon'=>'plus-sign white',
                'url' => array('headsfunction/updatePublishResult'),
            'buttonType' => 'link',
            'type' => 'warning',
            'size' => 'large',
            'label' => 'Publish Result',
            //'click' => 'js:function(values){console.log(values);}'
     // 'click' => 'js:batchActions'

                )
            ),
            // if grid doesn't have a checkbox column type, it will attach
            // one and this configuration will be part of it
            'checkBoxColumnConfig' => array(
            'name' => 'offeredModuleID',
            'checked'=>'false',
               
            )
        ),*/
	'columns'=>array(
                          
                $groupGridColumns,                     
           //     array('header'=>'Completed Course','name'=>'id','value'=>'$data[\'moduleCode\']." - ".$data[\'mod_name\']','htmlOptions'=>array('class'=>'span-18')),
            //'offeredModuleID',
             //   $offeredModuleID,
		$moduleCode,
		$moduleName,
                array(   'name'=>'mod_creditHour','header'=>'','htmlOptions' =>array('class'=>'span-1',)),
                $editableColumn4,    
                array(   'name'=>'ofm_approval','header'=>'','htmlOptions' =>array('class'=>'span-2','rel'=>'entry',)),
            //    $editableColumn2,
               // $sectionName,
                //$facultyName,
                //$editableColumn3,
                
                array(   'name'=>'per_name','header'=>'','htmlOptions' =>array('class'=>'span-2',)),
            
                array(   'name'=>'per_email','header'=>'','htmlOptions' =>array('class'=>'span-1',)),
                array(   'name'=>'per_mobile','header'=>'','htmlOptions' =>array('class'=>'span-2',)),
                $editableColumn1,

		
      //      array('header'=>'Batch Name','value'=>'$data[\'batchName\']','htmlOptions' =>array('class'=>'span-2'),),
               // array('header'=>'Offered To','value'=>$getRegWith,'htmlOptions' =>array('class'=>'span-2'),),
                
                //'mod_group',
               

		 array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{marksEntry} {regStudent} {regResult}',
            'buttons'=>array
            (
               
                'marksEntry' => array
                (
                    'label'=>'Marks Entry',
                    'icon'=>'search ',
                    'url'=>'Yii::app()->createUrl("facultiesFunction/varifyMarks", array("offeredID"=>$data[\'offeredModuleID\']))',
                    'options'=>array(
                        'class'=>'btn btn-mini btn-info',
                        'data-toggle'=>'tooltip',
                        'target'=>'_blank',
                        
                    ),
                ),
                'regStudent' => array
                (
                    'label'=>'Registered Students',
                    'icon'=>'user ',
                    'url'=>'Yii::app()->createUrl("headsFunction/regStudentToCourse", array("offeredModuleID"=>$data[\'offeredModuleID\']))',
                    'options'=>array(
                        'class'=>'btn btn-mini btn-success',
                        'data-toggle'=>'tooltip',
                        
                    ),
                ),
                  'regResult' => array
                (
                    'label'=>'Result Summary Report',
                    'icon'=>'info-sign',
                    'url'=>'Yii::app()->createUrl("headsFunction/resultSummary", array("offeredModuleID"=>$data[\'offeredModuleID\'], "mod_name"=>$data[\'mod_name\'],"per_name"=>$data[\'per_name\'], "batch_name"=>$data[\'batchName\'], "sec_name"=>$data[\'sectionName\']))',
                    'options'=>array(
                        'class'=>'btn btn-mini btn-info',
                        'data-toggle'=>'tooltip',
                        
                    ),
                ),
                
            ),
            'htmlOptions'=>array(
                'style'=>'width: 440px; ',
                'class'=>'moreButtons span-2',
                
            ),
                     
     ),
         
    ),
    'mergeColumns' => array('per_email','per_mobile')
    
));  ?>

</div><!-- form -->




<script type="text/javascript">
    
    $(function(){
        // prevent the click event
        $(document).on('click','#resultPublish-grid a#oo',function() {
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



    $(window).load(function () {
        
            $("td[rel='entry']").each(function() {
                //alert($(this).val());

                    var ch = $(this).text(); 


                    //alert('gp +'+ch);

                    if(ch==1)
                    {        
                        $(this).html("<span class=\"badge badge-info\" style=\" padding:5px 5px 5px 5px;\"><a href=\"#\" data-toggle=\"tooltip\" title=\"Marks entry complete\"><i class=\"icon-ok icon-white\"></i></a></span>")
                    }
                    //else $(this).html("<span class=\"label label-danger\">No <i class=\"icon-remove\"></i></span>")
            });         
        
        
  
    });
</script>