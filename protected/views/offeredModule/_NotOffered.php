
<div class="span-24">
		 <?php if (Yii::app()->user->hasFlash('success')):?>
			<div class="alert in alert-block fade alert-success span-20">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  <?php echo Yii::app()->user->getFlash('success')?>
			</div>
		<?php endif;?>
</div>
<div id="success" class="span-24">


    
    <?php


$getModType='FormUtil::getModuleType($data[\'mod_type\'])';
$getModLabIncluded='FormUtil::getModuleLabIncluded($data[\'mod_labIncluded\'])';


$groupGridColumns = array(
'name' => 'firstLetter',
'value' => '$data[\'mod_group\']',
'headerHtmlOptions' => array('style'=>'display:none'),
'htmlOptions' =>array('style'=>'display:none')
);

$this->widget('bootstrap.widgets.TbGroupGridView', array(
        
	'id'=>'offeredModule-grid2',
        'type' => 'striped bordered',
        'enablePagination' => true,
        'responsiveTable' => true,
	'dataProvider'=>$dataProvider,
	//'filter'=>$model,

    
    	'extraRowColumns'=> array('firstLetter'),
        'extraRowExpression' => '"<b style=\"font-size: 20px; color: #333;\">".$data[\'mod_group\']."</b>"',
        'extraRowHtmlOptions' => array('style'=>'padding:10px'),
      
        'bulkActions' => array(
            'actionButtons' => array(
            array(
                'id'=>'oo',
                'icon'=>'plus-sign white',
                'url' => array('offeredModule/selectModule'),
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
            'name' => 'moduleCode'
            ),
        ),
	'columns'=>array(
           
                $groupGridColumns,
		array('header'=>'Code','value'=>'$data[\'moduleCode\']','htmlOptions'=>array('class'=>'span-4')),
		array('header'=>'Name','value'=>'$data[\'mod_name\']','htmlOptions'=>array('class'=>'span-18')),
		array('header'=>'Credit Hour','name'=>'mod_creditHour','value'=>'$data[\'mod_creditHour\']','htmlOptions'=>array('class'=>'span-5')),
                array('header'=>'Type','value'=>$getModType,),
                array('value'=>$getModLabIncluded,'htmlOptions'=>array('class'=>'span-4')),
		
              
              
                array('header'=>'prerequisite','name'=>'mod_prerequisite','value'=>'$data[\'mod_prerequisite\']',),
                 array('header'=>'Sequence','value'=>'$data[\'mod_sequence\']',),
         
                
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
    
    $(function(){
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