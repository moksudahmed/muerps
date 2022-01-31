<?php
/* @var $this TermAdmissionController */
/* @var $model TermAdmission */

$this->breadcrumbs=array(
    'Registry'=>array('site/registry'),
	
    
     'Batch'=>array('Batch/index'),
    'Sections'=>array('Section/index'),
    'Admitted Terms',
);

$this->menu=array(
	array('label'=>'List TermAdmission', 'url'=>array('index')),
	array('label'=>'Manage TermAdmission', 'url'=>array('admin')),
);
?>

	
<div class="title span5">
            <h3 class="title">Admitted Terms of:
                
            </h3>
            <h4><strong>Section: </strong><span class="label label-important"> <?php echo yii::app()->session['secName']; ?></span><strong>Batch: </strong><span class="label label-success"> <?php echo yii::app()->session['batName'].FormUtil::getBatchNameSufix(yii::app()->session['batName']); ?>  </span></h4>
            <h4>Programme:<?php  echo DBhelper::getProgrammeByCode(yii::app()->session['proCode']); ?></h4>
            
</div>
    
<hr/>




<?php
    $term='FormUtil::getTerm($data->tra_term)';
    $name='$data->batchName';
    $nameSufix='FormUtil::getBatchNameSufix($data->batchName)';
    $year='$data->tra_year';
    
    $groupGridColumns = array(
    'name' => 'firstLetter',
    'value' => '$data->tra_year',
    'headerHtmlOptions' => array('style'=>'display:none'),
    'htmlOptions' =>array('style'=>'display:none')
);    
    
$batchNameColumn = array(
'name' => 'batchName',
'value' => "{$name}.{$nameSufix}",
        
'htmlOptions' =>array('style'=>'text-align:left')

);    

$TermColumn = array(
'name' => 'tra_term',
'value' => "{$term}",
        
'htmlOptions' =>array('style'=>'text-align:left')

);
?>
<?php $this->widget('bootstrap.widgets.TbGroupGridView', array(
	'id'=>'school-grid',
        'type' => 'striped',
        'enablePagination' => true,
        'responsiveTable' => true,
	'dataProvider'=>$dataProvider,
	
    	'extraRowColumns'=> array('firstLetter'),
        'extraRowExpression' => $year,
        'extraRowHtmlOptions' => array('style'=>'padding:10px;font-size:20px;letter-spacing:2px; text-align:right; '),
	'columns'=>array(
            $groupGridColumns,
		
                $TermColumn,
		'tra_year',
                'sectionName',
                $batchNameColumn,
                
                

		 array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{ModuleRegistration}',
            'buttons'=>array
            (
               
                'ModuleRegistration' => array
                (
                    'label'=>'Admitted Students',
                    'icon'=>'user white',
                    'url'=>'Yii::app()->createUrl("termAdmission/studentList", array("tid"=>$data->tra_term,"yid"=>$data->tra_year,"sid"=>$data->sectionName,"bid"=>$data->batchName,"pid"=>$data->programmeCode))',
                    'options'=>array(
                        'class'=>'btn btn-mini btn-warning',
                        'data-toggle'=>'tooltip',
                        
                    ),
                ),
            ),
            'htmlOptions'=>array(
                'style'=>'width: 220px; ',
                'class'=>'moreButtons',
                
            ),
     ),
	),
)); ?>