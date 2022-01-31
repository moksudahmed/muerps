
<?php
/* @var $this ModuleController */
/* @var $model Module */

if($flag)
{
    $this->breadcrumbs=array(
        'Department Activities'=>array('headsfunction/index'),
        'Select Term'=>array('headsfunction/selectTerm'),
            'All Offered Courses'
    );
}
else
{
    $this->breadcrumbs=array(
    'Registry'=>array('site/registry'),
	
    
     'Batch'=>array('Batch/index', 'id'=>Yii::app()->session['programmeCode2']),
    'Sections'=>array('Section/index','id'=>Yii::app()->session['batchName2'], 'pid'=>Yii::app()->session['programmeCode2']),
	'Courses Already Has Been Offered For:'
);
    
}
$batch2=Batch::model()->findByPk(array('batchName'=>$bid,'programmeCode'=>$pid));



?>


<div class="title span-18">
            <h3 class="title">All Offered Courses</h3>
            <h4><strong>Batch: </strong><span class="label label-success"> <?php echo yii::app()->session['batNameOfm'].FormUtil::getBatchNameSufix(yii::app()->session['batNameOfm']); ?>  </span><strong>Section: </strong><span class="label label-important"> <?php echo yii::app()->session['secNameOfm']; ?></span></h4>
            <h6><strong>Academic Term: </strong><span class="label label-info"><?php echo FormUtil::getTerm(yii::app()->session['acTermOfm']); ?> </span><span class="label label-success"> <?php echo yii::app()->session['acYearOfm'];  ?></span></h6>        
       <?php 
$this->widget('bootstrap.widgets.TbMenu', array(
	'type'=>'pills',
	'items'=>array(
            array('label'=>'Back', 'icon'=>'icon-arrow-left' , 'url'=>Yii::app()->controller->createUrl('headsfunction/selectTerm'), 'linkOptions'=>array('data-toggle'=>'tooltip','data-placement'=>'top', 'title'=>'Select Term',), 'visible'=>true),	
            array('label'=>'XLS', 'icon'=>'icon-download' , 'url'=>Yii::app()->controller->createUrl('offeredModule/allOfferedXLS'), 'linkOptions'=>array('style'=>'text-weight:bold;','data-toggle'=>'tooltip','data-placement'=>'top', 'title'=>'Download',), 'visible'=>true),	
  
               
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
 
 if($flag)
 {
 $this->widget('bootstrap.widgets.TbButtonGroup', array(
    'buttons'=>array(
                array('label'=>'Not Offered', 'url'=>array('offeredModule/notOffered'),'htmlOptions'=>array('class'=>'btn btn-medium ',)),
                array('label'=>'Offered',  'url'=>array('offeredModule/offered'),'htmlOptions'=>array('class'=>'btn btn-medium ',)),      
 
                array('label'=>'All Offered', 'url'=>'#','htmlOptions'=>array('class'=>'btn btn-medium btn-danger',))
            )
        )
     );
 }
 ?>
    </div>
    <div class="span-2">
    <?php  
 
 /*
    $this->widget('bootstrap.widgets.TbButtonGroup', array(
    'buttons'=>array(
                array('icon'=>'print ','label'=>'PDF', 'url'=>array('offeredModule/PDF'),'htmlOptions'=>array('class'=>'btn btn-small',)),
                array('icon'=>'print ','label'=>'XLS',  'url'=>array('offeredModule/XLS'),'htmlOptions'=>array('class'=>'btn btn-small',)),      
                
            )
        )
     );
 */
    ?>    
    </div>
<div class="span-24">
 <?php
$getModType='FormUtil::getModuleType($data->mod_type)';
$getModLabIncluded='FormUtil::getModuleLabIncluded($data->mod_labIncluded)';



$groupGridColumns = array(
'name' => 'firstLetter',
'value' => '$data->ofm_term',
'headerHtmlOptions' => array('style'=>'display:none'),
'htmlOptions' =>array('style'=>'display:none')
);

$term='FormUtil::getTerm($data->ofm_term)';
$year='$data->ofm_year';
$termYear='FormUtil::getTermYearWithNumberByBatchHTMLspan($data->batchName,$data->programmeCode,$data->ofm_term, $data->ofm_year)';

$ofmTermColumn = array(
'name' => 'ofmTerm',
    'header'=>'Term',
'value' => "{$term}.' '.{$year}",
'htmlOptions' =>array('style'=>'text-align:right')

);

$ofmCreditHour= array(
    'header'=>'Credit Hour',
'name'=>'mod_creditHour',
    
'htmlOptions' =>array('style'=>'text-align:left; ','class'=>'span-3'),
'class'=>'bootstrap.widgets.TbTotalSumColumn',

);

$this->widget('bootstrap.widgets.TbGroupGridView', array(
        
	'id'=>'offeredModule-grid3',
        'type' => 'striped bordered hover',
    
        'enablePagination' => true,
        'responsiveTable' => true,
	'dataProvider'=>  $model->search3($sid,$bid,$pid),
	//'filter'=>$model,

    
    	'extraRowColumns'=> array('firstLetter'),
        'extraRowExpression' => $termYear,
        'extraRowHtmlOptions' => array('style'=>'padding:10px;font-size:20px;letter-spacing:2px; text-align:right; '),
      
        
	'columns'=>array(
           
                $groupGridColumns,
		array('header'=>'Cuorse Code','name'=>'moduleCode','value'=>'$data->moduleCode','htmlOptions'=>array('class'=>'span-4')),
		array('header'=>'Moudle Name','name'=>'mod_name','value'=>'$data->mod_name','htmlOptions'=>array('class'=>'span-8')),
                array('header'=>'Type','name'=>'mod_type','value'=>$getModType,'footer'=>'modType'),
                array('header'=>'','name'=>'mod_labIncluded','value'=>$getModLabIncluded,'footer'=>'Total Credit:','htmlOptions'=>array('class'=>'span-3')),
                $ofmCreditHour,
                array('header'=>'Prerequisite','name'=>'mod_prerequisite','value'=>'$data->mod_prerequisite','htmlOptions'=>array('class'=>'span-2')),
                array('header'=>'Group','name'=>'mod_group','value'=>'$data->mod_group','htmlOptions'=>array('class'=>'span-6')),
            array('header'=>'Faculty ','name'=>'per_name','value'=>'$data->per_name','htmlOptions' =>array('class'=>'span-8')),
                //$ofmTermColumn,
            
                
               
      
    )
    
    
));  ?>
</div>

<script type="text/javascript">
    
    
        // prevent the click event
       
    
    $(window).load(function () {
        
        
        $("td:contains('modType')").remove(); 
        $("td:contains('Total Credit')").css('font-weight','bold');      
    });
    
</script>
