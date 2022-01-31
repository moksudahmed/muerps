<?php

$this->breadcrumbs=array(
	'Heads Functionalities'=>array('headsFunction/index'),
        
        'Supplementary List'
	
);

?>

<div class="title">
            <h3>Supplementary List</h3>
            <h4><strong>Exam: </strong><span class="label label-info">  <?php echo FormUtil::getTerm( yii::app()->session['rePublishTerm']);?></span><span class="label label-success"> <?php echo "Term Final Examination ".yii::app()->session['rePublishYear'];?></span></h4>            
            <h4><strong>Programme: </strong> <?php  echo DBhelper::getProgrammeByCode(yii::app()->session['rePublishProCode']); ?></h4>           
</div>
      <?php 
        $this->widget('bootstrap.widgets.TbMenu', array(
	'type'=>'pills',
	'items'=>array(
		array('label'=>'Export to pdf', 'icon'=>'icon-download', 'url'=>Yii::app()->controller->createUrl('headsFunction/SupplementaryListPDF', array('id'=>yii::app()->session['trnsStudentID'])), 'linkOptions'=>array('target'=>'_blank'), 'visible'=>true),		
		
	),
));

?>    
  <?php

$getRegWith='FormUtil::getModuleRegistrationBatchSection($data[\'batchName\'],$data[\'sectionName\'],$data[\'programmeCode\'])';

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
    
    	'extraRowColumns'=> array('firstLetter'),
        'extraRowExpression' => $getRegWith,
        'extraRowHtmlOptions' => array('style'=>'padding:10px; text-align:right; font-size: 3em; color: #333;'),

        'bulkActions' => array(
           /* 'actionButtons' => array(
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
            ),*/
            // if grid doesn't have a checkbox column type, it will attach
            // one and this configuration will be part of it
            'checkBoxColumnConfig' => array(
            'name' => 'offeredModuleID',
            'checked'=>'false',
               
            )
        ),
	'columns'=>array(
                          
                $groupGridColumns,                     
               array('header'=>'Student ID','value'=>'$data[\'id\']','htmlOptions' =>array('class'=>'span-2'),),
               array('header'=>'Name','value'=>'$data[\'per_name\']','htmlOptions' =>array('class'=>'span-2'),),
               array('header'=>'Module Name','value'=>'$data[\'mod_name\']','htmlOptions' =>array('class'=>'span-2'),),         
               array('header'=>'Out of 40','value'=>'$data[\'markFinal\']','htmlOptions' =>array('class'=>'span-2'),),
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