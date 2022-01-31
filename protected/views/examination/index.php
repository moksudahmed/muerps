<?php
/* @var $this ExaminationController */
/* @var $model Examination */

$this->breadcrumbs=array(
    'Exam'=>array('site/exam'),
	'Examinations'=>array('index'),
	
);

$this->menu=array(
	array('label'=>'List Examination', 'url'=>array('index'),'active'=>true),
	array('label'=>'Create Examination', 'url'=>array('create')),
);


?>

<div class="title">
    <h3>Examinations</h3>
    <h4><strong> Examination Type: </strong> <?php echo yii::app()->session['examName']; ?></h4>
</div>
<hr/>

<?php
$groupGridColumns = array(
'name' => 'firstLetter',
'value' => '$data[\'exm_examYear\']',
'headerHtmlOptions' => array('style'=>'display:none'),
'htmlOptions' =>array('style'=>'display:none')
);

$type='FormUtil::getExamType($data->exm_type)';
$examTypeColumn = array(
    'header'=>'Name',
'name' => 'exm_type',
'value' => "{$type}",
        
'htmlOptions' =>array('style'=>'text-align:left;','class'=>'span-5')

);

$term='FormUtil::getTerm($data->exm_examTerm)';
$examTermColumn = array(
    'header'=>'Name',
'name' => 'exm_examTerm',
'value' => "{$term}",
        
'htmlOptions' =>array('style'=>'text-align:right')

);

?>
<?php $this->widget('bootstrap.widgets.TbGroupGridView', array(
	'id'=>'school-grid',
        'type' => 'striped',
        'enablePagination' => false,
        'responsiveTable' => true,
	'dataProvider'=>$model->search($id),
        'extraRowColumns'=> array('firstLetter'),
        'extraRowExpression' => '$data[\'exm_examYear\']',
        'extraRowHtmlOptions' => array('style'=>'padding:10px; text-align:right; font-weight:bold;'),
	'filter'=>$model,
	'columns'=>array(
		
		$groupGridColumns,
		$examTermColumn,
		$examTypeColumn,
		'exm_examYear',
		'exm_startDate',
		'exm_endDate',
		'exm_resultDate',
		
		
		
		 array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{view} ',
            'buttons'=>array
            (
               
                'view' => array
                (
                    'label'=>'View Details',
                    'icon'=>'search white',
                    'url'=>'Yii::app()->createUrl("examination/view", array("id"=>$data->examinationID))',
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
	),
)); ?>

