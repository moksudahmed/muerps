<?php

$this->breadcrumbs=array(
	'Heads Functionalities'=>array('headsFunction/index'),
        
        'Publish Result'
	
);

?>

<div class="title">
            <h3>Course Distribution List</h3>            
            <h4><strong>Programme: </strong> <?php  echo DBhelper::getProgrammeByCode(yii::app()->session['rePublishProCode']); ?></h4>           
</div>

<?php 
        $this->widget('bootstrap.widgets.TbMenu', array(
	'type'=>'pills',
	'items'=>array(
		array('label'=>'Export to pdf', 'icon'=>'icon-download', 'url'=>Yii::app()->controller->createUrl('headsFunction/CourseTakenByFacultyPDF', array('id'=>yii::app()->session['trnsStudentID'])), 'linkOptions'=>array('target'=>'_blank'), 'visible'=>true),		
		
	),
));

?>    
<?php //echo $form->errorSummary($admission); ?>
          
  <?php


$getRegWith='FormUtil::getBatchName($data[\'batchName\'])';

$offeredModuleID=array(
    'name'=>'id',
    'header'=>'Id',
    'value'=>'$data[\'id\']',

    'htmlOptions' =>array('class'=>'span-6'),
    
);
           
$mod_creditHour=array(
    'name'=>'mod_creditHour',
    'header'=>'Credit Hour',
    'value'=>'$data[\'mod_creditHour\']',
    'htmlOptions' =>array('class'=>'span-6'),
    
);
$moduleCode=array(
    'name'=>'moduleCode',
    'header'=>'Module Code',
    'value'=>'$data[\'moduleCode\']',

    'htmlOptions' =>array('class'=>'span-6'),
    
);
$moduleName=array(
    'name'=>'mod_name',
    'header'=>'Module Name',
    'value'=>'$data[\'mod_name\']',

    'htmlOptions' =>array('class'=>'span-6'),
    
);
$sectionName =array(
    'name'=>'sectionName',
    'header'=>'Section',
    'value'=>'$data[\'sectionName\']',

    'htmlOptions' =>array('class'=>'span-6'),
    
);

$facultyName=array(
    
    'name'=>'per_name',
    'header'=>'Faculty Member Name',
    'value'=>'$data[\'per_name\']',
    'htmlOptions' =>array('class'=>'span-20'),
    
    
);

$groupGridColumns = array(
'name' => 'firstLetter',
'value' => $getRegWith,
'headerHtmlOptions' => array('style'=>'display:none'),
'htmlOptions' =>array('style'=>'display:none'),
    
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
        'extraRowHtmlOptions' => array('style'=>'padding:10px; text-align:right; font-size: 3em; color: #333;'),

        'bulkActions' => array(
            
            // if grid doesn't have a checkbox column type, it will attach
            // one and this configuration will be part of it
            'checkBoxColumnConfig' => array(
            'name' => 'id',
            'checked'=>'false',
               
            )
        ),
	'columns'=>array(
                          
                $groupGridColumns,                     
           //     array('header'=>'Completed Course','name'=>'id','value'=>'$data[\'moduleCode\']." - ".$data[\'mod_name\']','htmlOptions'=>array('class'=>'span-18')),
            //'offeredModuleID',
                $offeredModuleID,        
		$moduleCode,        
		$moduleName,          
                $mod_creditHour,
                $sectionName,
    //            $facultyName,
                
		
		
      //      array('header'=>'Batch Name','value'=>'$data[\'batchName\']','htmlOptions' =>array('class'=>'span-2'),),
               // array('header'=>'Offered To','value'=>$getRegWith,'htmlOptions' =>array('class'=>'span-2'),),
                
                //'mod_group',
               
         
                
           /* array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{view}',
            'buttons'=>array
            (
               
                'view' => array
                (
                    'label'=>'View Details',
                    'icon'=>'search white',
                    'url'=>'Yii::app()->createUrl("module/view", array("id"=>$data[\'moduleCode\'])',
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
     ),   */
    )
    
    
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