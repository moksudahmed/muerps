
<?php
/* @var $this ModuleController */
/* @var $model Module */


//$batch2=Batch::model()->findByPk(array('batchName'=>$bid,'programmeCode'=>$pid));



?>


<div class="title span-18">
            <h3 class="title">All Offered Courses</h3>
            <h4>Batch: <?php echo yii::app()->session['batNameOfm'].FormUtil::getBatchNameSufix(yii::app()->session['batNameOfm']); ?>  </h4>
            <h4>Section: <?php echo yii::app()->session['secNameOfm']; ?></h4>
            <h4>Academic Term: <?php echo FormUtil::getTerm(yii::app()->session['acTermOfm']); ?> <?php echo yii::app()->session['acYearOfm'];  ?></h4>        
            <h4>Programme:<?php  echo DBhelper::getProgrammeByCode(yii::app()->session['proCodeOfm']); ?></h4>
</div>
    


<hr/>
    
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
$termYear='FormUtil::getTermYearWithNumberByBatch($data->batchName,$data->programmeCode,$data->ofm_term, $data->ofm_year)';

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
        'type' => 'table-hover'/*'striped'*/,
    
        //'enablePagination' => true,
        'responsiveTable' => true,
	'dataProvider'=>  $dataProvider,
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


