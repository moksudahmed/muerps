<?php
/* @var $this ModuleController */
/* @var $model Module */

$this->breadcrumbs=array(
    'Department Activities'=>array('headsfunction/index'),
        'Select Term'=>array('headsfunction/selectTerm'),
	'Offered Courses'
);
    


?>


<div class="title span-20">
            <h3 class="title">Offered Courses</h3>
            <h4><strong>Batch: </strong><span class="label label-success"> <?php echo yii::app()->session['batNameOfm'].FormUtil::getBatchNameSufix(yii::app()->session['batNameOfm']); ?>  </span><strong>Section: </strong><span class="label label-important"> <?php echo yii::app()->session['secNameOfm']; ?></span></h4>
            <h6><strong>Academic Term: </strong><span class="label label-info"><?php echo FormUtil::getTerm(yii::app()->session['acTermOfm']); ?> </span><span class="label label-success"> <?php echo yii::app()->session['acYearOfm'];  ?></span></h6>        
    <?php 
$this->widget('bootstrap.widgets.TbMenu', array(
	'type'=>'pills',
	'items'=>array(
            array('label'=>'Back', 'icon'=>'icon-arrow-left' , 'url'=>Yii::app()->controller->createUrl('headsfunction/selectTerm'), 'linkOptions'=>array('data-toggle'=>'tooltip','data-placement'=>'top', 'title'=>'Select Term',), 'visible'=>true),	
           // array('label'=>'XLS', 'icon'=>'icon-download' , 'url'=>Yii::app()->controller->createUrl('OfferedCourseListXLS'), 'linkOptions'=>array('style'=>'text-weight:bold;','data-toggle'=>'tooltip','data-placement'=>'top', 'title'=>'Download',), 'visible'=>true),	
  
               
	),
));
?>         
</div>
<div class="title span2">
    <h4>
    <span class="label label-info"> <?php echo FormUtil::getTermNumberWithSufix(yii::app()->session['batNameOfm'], yii::app()->session['proCodeOfm'],yii::app()->session['batTermOfm'] , yii::app()->session['batYearOfm']);  ?></span>
    <span class="label label-warning"><?php echo FormUtil::getTerm(yii::app()->session['batTermOfm']); ?> </span>
        <span class="label label-success"> <?php echo yii::app()->session['batYearOfm'];  ?></span>
        
        <strong style="letter-spacing:3px;">Selected Term </strong></h4>
    <h6>Programme:<?php  echo DBhelper::getProgrammeByCode(yii::app()->session['proCodeOfm']); ?></h6>
</div>
<hr/>
<div class="span-18">
 <?php  

 
 $this->widget('bootstrap.widgets.TbButtonGroup', array(
    'buttons'=>array(
               array('label'=>'Not Offered', 'url'=>array('offeredModule/notOffered'),'htmlOptions'=>array('class'=>'btn btn-medium ',)),
               array('label'=>'Offered',  'url'=>'#','htmlOptions'=>array('class'=>'btn btn-medium btn-danger',)),
                array('label'=>'All Offered', 'url'=>array('offeredModule/allOffered'),'htmlOptions'=>array('class'=>'btn btn-medium ',)),
       
            )
        )
     );

 ?>
</div>
<div class="span-24">
    <?php
 
//$model = new OfferedModule('search');


$getModType='FormUtil::getModuleType($data->mod_type)';
$getModLabIncluded='FormUtil::getModuleLabIncluded($data->mod_labIncluded)';
$term='FormUtil::getTerm($data->ofm_term)';
$year='$data->ofm_year';

$groupGridColumns = array(
'name' => 'firstLetter',
'value' => '$data->mod_group',
'headerHtmlOptions' => array('style'=>'display:none'),
'htmlOptions' =>array('style'=>'display:none')
);

$ofmTermColumn = array(
'name' => 'ofmTerm',
'value' => "{$term}.' '.{$year}",
        
'htmlOptions' =>array('style'=>'text-align:right')

);

$modType=  array(
    'header'=>'Type',
    'name'=>'mod_type',
    'value'=>$getModType,
    'footer'=>'modType'
);
$modLabIncluded=  array(
    'name'=>'Lab Included',
    'value'=>$getModLabIncluded,
    
);

$modGroup=array(
    'name'=>'mod_group',
    
    'footer'=>'Total Credit:'
);
$ofmCreditHour= array(
    'header'=>'Credit Hour',
'name'=>'mod_creditHour',
    

'class'=>'bootstrap.widgets.TbTotalSumColumn',
'htmlOptions'=>array( 'class'=>'span-4')
);

$editableColumn =  array(
'name' => 'facultyID',
'header' => 'Faculty Name',
'class' => 'bootstrap.widgets.TbEditableColumn',
'headerHtmlOptions' => array('style' => 'width:80px'),
    'htmlOptions'=>array('class'=>'span-7'),
'editable' => array(
    'type' => 'select',
    'url' => Yii::app()->createUrl("offeredModule/editable", array("id"=>'$data->offeredModuleID')),
    'htmlOptions'=>array('style'=>'width:20px;'),
    'source' =>CHtml::listData(FormUtil::getFacultyByDepartment(), 'id', 'text','group')
    )
);


$this->widget('bootstrap.widgets.TbGroupGridView', array(
        
	'id'=>'offeredModule-grid2',
        'type' => 'striped bordered',
    
        'enablePagination' => true,
        'responsiveTable' => true,
	'dataProvider'=>$dataProvider,
	//'filter'=>$model,

    
    	'extraRowColumns'=> array('firstLetter'),
        'extraRowExpression' => '"<b style=\"font-size: 20px; color: #333;\">".$data->mod_group."</b>"',
        'extraRowHtmlOptions' => array('style'=>'padding:10px'),
      
        
	'columns'=>array(
            
                $groupGridColumns,
                //'offeredModuleID',
            
		array('header'=>'Code','value'=>'$data->moduleCode','htmlOptions'=>array( 'class'=>'span-4')),
                array('header'=>'Course Title','value'=>'$data->mod_name','htmlOptions'=>array( 'class'=>'span-8')),
		

		$modType,
		//$modLabIncluded,
                
                $ofmCreditHour,
                
                //$ofmTermColumn,
                $editableColumn,
            
            //$timeSlotCode,
               array('value'=>'$data->mod_prerequisite',),
         
                
            array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>' {delete} ',
            'buttons'=>array
            (
               
                
                'delete' => array
                (
                    'label'=>'delete',
                    'icon'=>'remove white',
                    'url'=>'Yii::app()->createUrl("offeredModule/delete", array("offeredModuleID"=>$data->offeredModuleID))',
                    'options'=>array(
                        'class'=>'btn btn-mini btn-danger',
                        'data-toggle'=>'tooltip',
                        'data-placement'=>'right'
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
<script type="text/javascript" >
    
    
        // prevent the click event
       
    
    $(window).load(function () {
        /*
        $( "td:contains('Spring')").addClass('label label-success span1');
        $( "td:contains('Summer')").addClass('label label-warning span1');
        $( "td:contains('Autumn')").addClass('label label-info span1');
         */
        
        $("td:contains('modType')").remove(); 
        $("td:contains('Total Credit')").css('font-weight','bold');
      
    });
    
</script>