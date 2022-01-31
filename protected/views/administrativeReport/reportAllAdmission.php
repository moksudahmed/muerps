<?php
/* @var $this AdmissionController */
/* @var $model Admission */

$this->breadcrumbs=array(
	'Registry'=>array('site/registry'),
        'Administrative Report'=>array('administrativeReport/index'),
        'All Admission'
	
);

$this->menu=array(
	array('label'=>'AdmissionReport', 'url'=>'#','active'=>true),
	
);
?>

<div class="title span-20">
            <h3 >
                All Admitted Students For:
            </h3>
            <h4><strong style="letter-spacing:3px;">Selected Term: </strong><span class="label label-warning"><?php echo FormUtil::getTerm(yii::app()->session['adReTerm']); ?> </span><span class="label label-success"> <?php echo yii::app()->session['adReYear'];  ?></span></h4>
            <h4><strong>Batch: </strong><span class="label label-important"> <?php echo yii::app()->session['adReBatName'].FormUtil::getBatchNameSufix(yii::app()->session['adReBatName']); ?>  </span></h4>
            <h4><strong>Programme: </strong><span class="label label-info"> <?php  echo DBhelper::getProgrammeByCode(yii::app()->session['adReProCode']); ?>  </span></h4>
            <?php 
$this->widget('bootstrap.widgets.TbMenu', array(
	'type'=>'pills',
	'items'=>array(
		
		
		array('label'=>'Back', 'icon'=>'icon-arrow-left' , 'url'=>Yii::app()->controller->createUrl('administrativeReport/index'), 'linkOptions'=>array('data-toggle'=>'tooltip','data-placement'=>'top', 'title'=>'Registry',), 'visible'=>true),	
		array('label'=>'Export to PDF', 'icon'=>'icon-download', 'url'=>Yii::app()->controller->createUrl('allAdmissionPDF'), 'linkOptions'=>array('target'=>'_blank'), 'visible'=>true),
		//array('label'=>'Export to EXCEL', 'icon'=>'icon-download', 'url'=>Yii::app()->controller->createUrl('allAdmissionExcel'), 'linkOptions'=>array('target'=>'_blank'), 'visible'=>true),
	),
));

?>
</div>




<hr/>

<?php

$admStatus='FormUtil::getAdmissionStatus($data[\'adm_status\'])';
$groupGridColumns = array(
'name' => 'firstLetter',
'value' => '$data[\'sectionName\']',
'headerHtmlOptions' => array('style'=>'display:none'),
'htmlOptions' =>array('style'=>'display:none')
);
?>
<?php 
$this->widget('bootstrap.widgets.TbGroupGridView', array(
	'id'=>'school-grid',
        'type' => 'striped',
        'enablePagination' => true,
        'responsiveTable' => true,
	'dataProvider'=>$dataProvider,
    
	'filter'=>$model,
    'extraRowColumns'=> array('firstLetter'),
//        'extraRowExpression' => $section,
        'extraRowHtmlOptions' => array('style'=>'padding:10px;font-size:20px;letter-spacing:2px; text-align:left; '),
	'columns'=>array(
		$groupGridColumns,
		array('header'=>'Student ID','value'=>'$data[\'studentID\']', 'htmlOptions'=>array('class'=>'span-3')),
                array('header'=>'Name','value'=>'$data[\'per_name\']', 'htmlOptions'=>array('class'=>'span-5')),
               array('header'=>'Father\'s Name','value'=>'$data[\'per_fathersName\']', 'htmlOptions'=>array('class'=>'span-5')),
		array('header'=>'DoB','value'=>'$data[\'per_dateOfBirth\']', 'htmlOptions'=>array('class'=>'span-2')),
                array('header'=>'Blood Group','value'=>'$data[\'per_bloodGroup\']', 'htmlOptions'=>array('class'=>'span-3')),
                array('header'=>'Mobile','value'=>'$data[\'per_mobile\']', 'htmlOptions'=>array('class'=>'span-3')),
		array('header'=>'Admission Date','value'=>'$data[\'adm_date\']', 'htmlOptions'=>array('class'=>'span-3')),
                array('value'=>$admStatus, 'htmlOptions'=>array('class'=>'span-2')),
          /*     
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>' {view} ',
            'buttons'=>array
            (
                
                'view' => array
                (
                    'label'=>'View Details',
                    'icon'=>'search white',
                    'url'=>'Yii::app()->createUrl("admission/view", array("id"=>$data[\'studentID\']))',
                    'options'=>array(
                        'class'=>'btn btn-mini btn-success',
                        'data-toggle'=>'tooltip',
                        
                    ),
                ),
                /*
                'print_act' => array
                (
                    'label'=>'print',
                    'icon'=>'print',
                    'url'=>'Yii::app()->createUrl("student/printAct", array("id"=>$data->studentID))',
                    'options'=>array(
                        'class'=>'btn btn-mini',
                        'data-toggle'=>'tooltip',
                        'data-placement'=>'right'
                    ),
                ),*/
       /*     ),
            'htmlOptions'=>array(
                'style'=>'width: 220px; ',
                'class'=>'moreButtons',
                
            ),
     ),*/
    )
    
    
)); 
?>

