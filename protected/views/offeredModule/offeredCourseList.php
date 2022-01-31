<?php

$this->breadcrumbs=array(
	'Department Activities'=>array('headsFunction/index'),
        
        'Offered Course List'
	
);

?>

<div class="title span-20">
            <h3>Offered Course List</h3>
            <h4>Exam: <?php echo FormUtil::getTerm( yii::app()->session['ofmLiTerm']);?> Term Final Examination <?php echo yii::app()->session['ofmLiYear'];?></h4>            
       
</div>
<div class="title span2">
    <h4>
    
    <span class="label label-warning"><?php echo FormUtil::getTerm(yii::app()->session['ofmLiTerm']); ?> </span>
        <span class="label label-success"> <?php echo yii::app()->session['ofmLiYear'];  ?></span>
        
        <strong style="letter-spacing:3px;">Selected Term </strong></h4>
    <h6>Programme:<?php  echo DBhelper::getProgrammeByCode(yii::app()->session['ofmLiProCode']); ?></h6>
       <?php 
$this->widget('bootstrap.widgets.TbMenu', array(
	'type'=>'pills',
	'items'=>array(
            array('label'=>'Back', 'icon'=>'icon-arrow-left' , 'url'=>Yii::app()->controller->createUrl('headsFunction/index'), 'linkOptions'=>array('data-toggle'=>'tooltip','data-placement'=>'top', 'title'=>'Department Activities',), 'visible'=>true),	
            array('label'=>'XLS', 'icon'=>'icon-download' , 'url'=>Yii::app()->controller->createUrl('OfferedCourseListXLS'), 'linkOptions'=>array('style'=>'text-weight:bold;','data-toggle'=>'tooltip','data-placement'=>'top', 'title'=>'Download',), 'visible'=>true),	
  
               
	),
));
?> 
</div>
<hr/>

<?php 

?>
<div id="success" >
    
          
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

    'htmlOptions' =>array('class'=>'span-4'),
    
);

$moduleName=array(
    
    'name'=>'mod_name',
    'header'=>'Course Title',
    'value'=>'$data[\'mod_name\']',
    'htmlOptions' =>array('class'=>'span-8'),
    
    
);
$facultyName=array(
    
    'name'=>'per_name',
    'header'=>'Faculty',
    'value'=>'$data[\'per_name\']',
    'htmlOptions' =>array('class'=>'span-6',),
    
    
);

$groupGridColumns = array(
'name' => 'firstLetter',
'value' => $getRegWith,
'headerHtmlOptions' => array('style'=>'display:none'),
'htmlOptions' =>array('style'=>'display:none'),
    
);


$editableColumn1 =  array(
'name' => 'facultyID',
'header' => 'Faculty',
'class' => 'bootstrap.widgets.TbEditableColumn',
'headerHtmlOptions' => array('style' => 'width:80px'),
    'htmlOptions'=>array('class'=>'span-8'),
'editable' => array(
    'type' => 'select',
    'url' => Yii::app()->createUrl("offeredModule/editable", array("id"=>'$data->offeredModuleID')),
    'htmlOptions'=>array('style'=>'font-weight:bold; border-bottom: 0px solid'),
    'source' =>CHtml::listData(FormUtil::getFacultyByDepartment(), 'id', 'text','group')
    )
);

$editableColumn2 = array(
                    'name' => 'ofm_approval',
                    'header' => 'Publish',
                    'class' => 'bootstrap.widgets.TbEditableColumn',
                    'headerHtmlOptions' => array('style' => 'width:80px'),
                    'editable' => array(
                        'htmlOptions'=>array('style'=>'font-weight:bold; border-bottom: 0px solid'),
                        'type' => 'select',
                        'url' => Yii::app()->createUrl("facultiesFunction/saveApproval", array("id"=>'$data->offeredModuleID')),
                        'source' => array('yes'=>'Yes','no'=>'No'),
                            'display' => 'js: function(value, sourceData) {
                            var escapedValue = $(this).text(value).html();

                            if(escapedValue==\'yes\')
                            {
                              $(this).html("<span class=\"label label-success\">  Yes <i class=\"icon-ok\"></i> </span>")
                            }
                            else $(this).html("<span class=\"label label-warning\">No <i class=\"icon-remove\"></i></span>")

                          }'


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
        'extraRowHtmlOptions' => array('style'=>'padding-right:10px; text-align:right; font-weight:bold ; color: #333;'),
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
                array(   'name'=>'mod_creditHour','header'=>'Credit','htmlOptions' =>array('class'=>'span-1',)),
                array(   'name'=>'mod_group','header'=>'Group','htmlOptions' =>array('class'=>'span-3',)),
                $facultyName,
                
            
                array(   'name'=>'per_email','header'=>'','htmlOptions' =>array('class'=>'span-2',)),
                array(   'name'=>'per_mobile','header'=>'','htmlOptions' =>array('class'=>'span-2',)),
                

		
      //      array('header'=>'Batch Name','value'=>'$data[\'batchName\']','htmlOptions' =>array('class'=>'span-2'),),
               // array('header'=>'Offered To','value'=>$getRegWith,'htmlOptions' =>array('class'=>'span-2'),),
                
                //'mod_group',
               

	
         
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
    
</script>