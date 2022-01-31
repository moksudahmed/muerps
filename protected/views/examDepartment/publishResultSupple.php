<?php

$this->breadcrumbs=array(
	'Exam Activities'=>array('examDepartment/index'),
        
        'Publish Result (Supplementary)' 
	
);

?>

<div class="title span-20">
            <h3>Publish Result </h3>
            <h4><?php echo FormUtil::getTerm( yii::app()->session['reTerm']);?> Term <?php echo FormUtil::getExamName( yii::app()->session['reType']); ?> Examination <?php echo yii::app()->session['reYear'];?></h4>            
      
</div>

<div class="title span2">
    <h4>
    
    <span class="label label-warning"><?php echo FormUtil::getTerm(yii::app()->session['reTerm']); ?> </span>
        <span class="label label-success"> <?php echo yii::app()->session['reYear'];  ?></span>
        
        <strong style="letter-spacing:3px;">Selected Term </strong></h4>
    <h6>Programme:<?php  echo DBhelper::getProgrammeByCode(yii::app()->session['reProCode']); ?></h6>
    
      <?php 
$this->widget('bootstrap.widgets.TbMenu', array(
	'type'=>'pills',
	'items'=>array(
            array('label'=>'back', 'icon'=>'icon-arrow-left' , 'url'=>Yii::app()->controller->createUrl('index'), 'linkOptions'=>array('style'=>'text-weight:bold;','data-toggle'=>'tooltip','data-placement'=>'top', 'title'=>'Exam Activities',), 'visible'=>true),	
  
               
	),
));
?>    
</div>
<hr/>
<!-- form -->


<div id="success" class="span-24" style=" ">
    <h4>Batches of supplementary students:</h4>
    <?php
$getRegWith='FormUtil::getBatchName($data[\'batchName\'])';
$getACterm ='FormUtil::getAcademicYear($data[\'batchName\'],$data[\'id\'])';

if($examType == 2){


 $batchName=array(
    'name'=>'batchName',
    'header'=>'Batch',
    'value'=>$getRegWith,

    'htmlOptions' =>array('class'=>'span-2','style'=>'font-weight:normal; font-size:25px;'),
    
);

 $ACterm=array(
    'header'=>'Academic Year',
    
    'value'=>$getACterm,

    'htmlOptions' =>array('class'=>'span-3','style'=>'font-weight:normal; font-size:25px;'),
    
);
 
$examType = 3;
$this->widget('bootstrap.widgets.TbGroupGridView', array(
        
        'id'=>'publishedResult-grid1',
        'type' => 'striped bordered',
        'enablePagination' => true,
        'responsiveTable' => true,
	'dataProvider'=>$dataProvider,
    
	

    
    	//'extraRowColumns'=> array('firstLetter'),
        //'extraRowExpression' => $getRegWith,
        //'extraRowHtmlOptions' => array('style'=>'padding:10px; text-align:right; font-size: 3em; color: #333;'),
        
        'bulkActions' => array(
            
            /*'actionButtons' => array(
            array(
                'id'=>'oo',
                'icon'=>'plus-sign white',
                'url'=>'Yii::app()->createUrl("headsfunction/index", array())',
                //'url' => array('headsfunction/index'),
            'buttonType' => 'button',
            'type' => 'primary',
            'size' => 'large',
            'label' => 'Finish',
            //'click' => 'js:function(values){console.log(values);}'
     // 'click' => 'js:batchActions'

           /*     )
            ),*/
            // if grid doesn't have a checkbox column type, it will attach
            // one and this configuration will be part of it
            'checkBoxColumnConfig' => array(
            'name' => 'id',
            
            ),
            
        ),
    
        
	'columns'=>array(
                          
              //  $groupGridColumns,                     
           //     array('header'=>'Completed Course','name'=>'id','value'=>'$data[\'moduleCode\']." - ".$data[\'mod_name\']','htmlOptions'=>array('class'=>'span-18')),

               // $offeredModuleID,
		//$moduleCode,
		//$moduleName,             
            
            $batchName,
            $ACterm,
            
            //$publishResult,
            //    $sectionName,
                //$facultyName,            
               //array('header'=>'','value'=>$getAdmitStatus,'htmlOptions' =>array('style'=>'text-align:left;','class'=>'span-5')),
		
                
            array('header'=>'Result Tabulation',
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>' {result} {tabulation}',
            'buttons'=>array
            (
                'result' => array
                (
                    'label'=>'Result',
                    'icon'=>'print white',
                    'url'=>'Yii::app()->createUrl("examination/ResultSheetSupplyPDF", array("proCode"=>$data[\'id\'],"batchName"=>$data[\'batchName\'],"term"=>$data[\'term\'],"year"=>$data[\'year\'],"examType"=>2))',
                    'options'=>array(
                        'class'=>'btn btn-large btn-warning',
                        'data-toggle'=>'tooltip',
                        'data-placement'=>'left',
                        'target'=>'_blank'
                    ),
                ),
                'tabulation' => array
                (
                    'label'=>'Tabulation',
                    'icon'=>'print white',
                    'url'=>'Yii::app()->createUrl("examination/TabulationSupplyPDF", array("proCode"=>$data[\'id\'],"batchName"=>$data[\'batchName\'],"term"=>$data[\'term\'],"year"=>$data[\'year\'],"examType"=>2))',
                    'options'=>array(
                        'class'=>'btn btn-large btn-success',
                        'data-toggle'=>'tooltip',
                        'data-placement'=>'right',
                        'target'=>'_blank'
                    ),
                ),
                
            ),
            'htmlOptions'=>array(
                'style'=>'text-align: center; ',
                'class'=>'moreButtons span-2',
                
            ),
     ),   
    )
    
    
));
}
else{
    $batchName=array(
        'name'=>'batchName',
        'header'=>'Batch',
        'value'=>$getRegWith,
    
        'htmlOptions' =>array('class'=>'span-2','style'=>'font-weight:normal; font-size:25px;'),
        
    );
    
     $ACterm=array(
        'header'=>'Academic Year',
        
        'value'=>$getACterm,
    
        'htmlOptions' =>array('class'=>'span-3','style'=>'font-weight:normal; font-size:25px;'),
        
    );
     
    $examType = 3;
    $this->widget('bootstrap.widgets.TbGroupGridView', array(
            
            'id'=>'publishedResult-grid1',
            'type' => 'striped bordered',
            'enablePagination' => true,
            'responsiveTable' => true,
        'dataProvider'=>$dataProvider,
        
        
    
        
            //'extraRowColumns'=> array('firstLetter'),
            //'extraRowExpression' => $getRegWith,
            //'extraRowHtmlOptions' => array('style'=>'padding:10px; text-align:right; font-size: 3em; color: #333;'),
            
            'bulkActions' => array(
                
                /*'actionButtons' => array(
                array(
                    'id'=>'oo',
                    'icon'=>'plus-sign white',
                    'url'=>'Yii::app()->createUrl("headsfunction/index", array())',
                    //'url' => array('headsfunction/index'),
                'buttonType' => 'button',
                'type' => 'primary',
                'size' => 'large',
                'label' => 'Finish',
                //'click' => 'js:function(values){console.log(values);}'
         // 'click' => 'js:batchActions'
    
               /*     )
                ),*/
                // if grid doesn't have a checkbox column type, it will attach
                // one and this configuration will be part of it
                'checkBoxColumnConfig' => array(
                'name' => 'id',
                
                ),
                
            ),
        
            
        'columns'=>array(
                              
                  //  $groupGridColumns,                     
               //     array('header'=>'Completed Course','name'=>'id','value'=>'$data[\'moduleCode\']." - ".$data[\'mod_name\']','htmlOptions'=>array('class'=>'span-18')),
    
                   // $offeredModuleID,
            //$moduleCode,
            //$moduleName,             
                
                $batchName,
                $ACterm,
                
                //$publishResult,
                //    $sectionName,
                    //$facultyName,            
                   //array('header'=>'','value'=>$getAdmitStatus,'htmlOptions' =>array('style'=>'text-align:left;','class'=>'span-5')),
            
                    
                array('header'=>'Result Tabulation',
                'class'=>'bootstrap.widgets.TbButtonColumn',
                'template'=>' {result} {tabulation}',
                'buttons'=>array
                (
                    'result' => array
                    (
                        'label'=>'Result',
                        'icon'=>'print white',
                        'url'=>'Yii::app()->createUrl("examination/ResultSheetSupplyPDF", array("proCode"=>$data[\'id\'],"batchName"=>$data[\'batchName\'],"term"=>$data[\'term\'],"year"=>$data[\'year\'],"examType"=>3))',
                        'options'=>array(
                            'class'=>'btn btn-large btn-warning',
                            'data-toggle'=>'tooltip',
                            'data-placement'=>'left',
                            'target'=>'_blank'
                        ),
                    ),
                    'tabulation' => array
                    (
                        'label'=>'Tabulation',
                        'icon'=>'print white',
                        'url'=>'Yii::app()->createUrl("examination/TabulationSupplyPDF", array("proCode"=>$data[\'id\'],"batchName"=>$data[\'batchName\'],"term"=>$data[\'term\'],"year"=>$data[\'year\'],"examType"=>3))',
                        'options'=>array(
                            'class'=>'btn btn-large btn-success',
                            'data-toggle'=>'tooltip',
                            'data-placement'=>'right',
                            'target'=>'_blank'
                        ),
                    ),
                    
                ),
                'htmlOptions'=>array(
                    'style'=>'text-align: center; ',
                    'class'=>'moreButtons span-2',
                    
                ),
         ),   
        )
        
        
    ));
}  



  ?>

</div><!-- form -->
<script type="text/javascript">
    
    
    
    
    $(function(){
        
        $(window).load(function () {
        
         
        $("td:contains('offeredModuleID')").remove(); 
       
        
        $("td:contains('1')").siblings('td').children('input').replaceWith('<i class="icon-ok"></i>');
        
        
        $("td:contains('not')").siblings('td').children('a').remove();
        $("td:contains('not')").replaceWith('<td></td>');
        
    });
        
        // prevent the click event
        $(document).on('click','#publishedResult-grid1 a#oo',function() {
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

