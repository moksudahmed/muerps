

<div class="title span-16">
            <h3 >Total Result Of:<br/>
                <strong>ID:</strong><span class="label label-info"><?php echo yii::app()->session['trnsStudentID']; ?> </span><br/>
                <strong>Name: </strong> <span class="label label-success "><?php  echo yii::app()->session['trnsStudentName']; ?></span>
            </h3>
            
            
</div>
<div class="title span-10">
    <h5><strong>Section: </strong><span class="label label-important"> <?php echo yii::app()->session['trnsSecName']; ?></span><strong>Batch: </strong><span class="label label-success"> <?php echo yii::app()->session['trnsBatName'].FormUtil::getBatchNameSufix(yii::app()->session['trnsBatName']); ?>  </span></h5>
            <h6><strong>Academic Term: </strong><span class="label label-info"><?php echo FormUtil::getTerm(yii::app()->session['trnsAcTerm']); ?> </span><span class="label label-success"> <?php echo yii::app()->session['trnsAcYear'];  ?></span></h6>        
<?php 

$this->widget('bootstrap.widgets.TbMenu', array(
	'type'=>'pills',
	'items'=>array(
		
		array('label'=>'Transcript', 'icon'=>'icon-download', 'url'=>Yii::app()->controller->createUrl('transcriptPDF'), 'linkOptions'=>array('target'=>'_blank'), 'visible'=>true),
		
	),
));

?>
</div>
<hr/>


<?php

$getRegType='FormUtil::getModuleRegistrationType($data[\'reg_type\'],$data[\'sectionName\'],$data[\'batchName\'])';
$termYear='FormUtil::getTermYearWithNumber($data[\'batchName\'],$data[\'programmeCode\'],$data[\'tra_term\'], $data[\'tra_year\'])';


$getRegWith='FormUtil::getModuleRegistrationBatchSection($data[\'batchName\'],$data[\'sectionName\'])';


//echo date('d-F-y','2013-12-31');



$groupGridColumns = array(
'name' => 'firstLetter',
'value' => '$data[\'tra_term\']',
'headerHtmlOptions' => array('style'=>'display:none'),
'htmlOptions' =>array('style'=>'display:none')
);






$this->widget('bootstrap.widgets.TbGroupGridView', array(
        
	'id'=>'offeredModule-grid3',
        'type' => 'table-hover'/*'striped'*/,
    
        'enablePagination' => true,
        'responsiveTable' => true,
	'dataProvider'=>  $dataProvider,
	//'filter'=>$model,

    
    	'extraRowColumns'=> array('firstLetter'),
        'extraRowExpression' => $termYear,
        'extraRowHtmlOptions' => array('style'=>'padding:10px;font-size:20px;letter-spacing:2px; text-align:right; '),
      
        
	'columns'=>array(
           
                $groupGridColumns,
                
		array('header'=>'Course: (Code','value'=>'$data[\'moduleCode\']','htmlOptions' =>array('class'=>'span-2'),'footer'=>'modType'),
		array('header'=>'Name','value'=>'$data[\'mod_name\']','htmlOptions' =>array('class'=>'span-7')),
                
                array('name'=>'mod_creditHour','header'=>'Credit Hour)','htmlOptions' =>array('style'=>'text-align:left;','class'=>'span-3'),'class'=>'bootstrap.widgets.TbTotalSumColumn',),
                
		
                
		
		
            
                array('header'=>'Reg: (date,','value'=>'FormUtil::getFormatedDate($data[\'reg_date\'])','htmlOptions' =>array('class'=>'span-3'),),
                array('header'=>'with,','value'=>$getRegWith,'htmlOptions' =>array('class'=>'span-2'),),
                array('header'=>'type)','value'=>$getRegType,'htmlOptions' =>array('class'=>'span-4'),),
            array('header'=>'First Half','value'=>'$data[\'markFirstHalf\']','htmlOptions' =>array('class'=>'span-2')),
            array('header'=>'Final','value'=>'$data[\'markSecondHalf\']','htmlOptions' =>array('class'=>'span-2')),
            array('header'=>'Letter Grade','value'=>'$data[\'letterGrade\']','htmlOptions' =>array('class'=>'span-2')),
            array('header'=>'Grade Point','value'=>'$data[\'gradePoint\']','htmlOptions' =>array('class'=>'span-2')),
  
            )
    
    
));  ?>

</div>
<script type="text/javascript">
    
    
        // prevent the click event
       
    
    $(window).load(function () {
        
        $( "td:contains('Spring')").addClass('label label-success span1');
        $( "td:contains('Summer')").addClass('label label-warning span1');
        $( "td:contains('Autumn')").addClass('label label-info span1');
         
        $("td:contains('modType')").remove(); 
        $("td:contains('Total Credit')").css('font-weight','bold');      
    });
    
</script>

