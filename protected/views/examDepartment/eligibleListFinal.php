<?php

$this->breadcrumbs=array(
	'Exam Activities'=>array('examDepartment/index'),
        
        'Eligible List (Final)'
	
);

?>

<div class="title span-20">
            <h3>Eligible List (Final)</h3>
            <h4><?php echo FormUtil::getTerm( yii::app()->session['eligibleTerm']);?> Term Final Examination <?php echo yii::app()->session['eligibleYear'];?></h4>            
      
</div>

<div class="title span2">
    <h4>
    
    <span class="label label-warning"><?php echo FormUtil::getTerm(yii::app()->session['eligibleTerm']); ?> </span>
        <span class="label label-success"> <?php echo yii::app()->session['eligibleYear'];  ?></span>
        
        <strong style="letter-spacing:3px;">Selected Term </strong></h4>
    
    
      <?php 
$this->widget('bootstrap.widgets.TbMenu', array(
	'type'=>'pills',
	'items'=>array(
            array('label'=>'back', 'icon'=>'icon-arrow-left' , 'url'=>Yii::app()->controller->createUrl('index'), 'linkOptions'=>array('style'=>'text-weight:bold;','data-toggle'=>'tooltip','data-placement'=>'top', 'title'=>'Exam Activities',), 'visible'=>true),	
            array('label'=>'PDF', 'icon'=>'icon-print' , 'url'=>Yii::app()->controller->createUrl('ExamEligibleListFinalPDF'), 'linkOptions'=>array('style'=>'text-weight:bold;','target'=>'_blank','data-toggle'=>'tooltip','data-placement'=>'top', 'title'=>'Get Details'), 'visible'=>true),	
            array('label'=>'XL', 'icon'=>'icon-print' , 'url'=>Yii::app()->controller->createUrl('TermAdmissionListExcel'), 'linkOptions'=>array('style'=>'text-weight:bold;','target'=>'_blank','data-toggle'=>'tooltip','data-placement'=>'top', 'title'=>'Term Admission List'), 'visible'=>true),	
            
	),
));
?>    
</div>
<hr/>
<div id="success" class="span-24" style=" ">
    <h4>Summery of Eligible Students for various program</h4>

  <?php

$groupGridColumns = array(
'name' => 'firstLetter',
'value' => '$data[\'id\']',
'headerHtmlOptions' => array('style'=>'display:none'),
'htmlOptions' =>array('style'=>'display:none'),
    
);
$this->widget('bootstrap.widgets.TbGroupGridView', array(
    
    'type'=>'striped bordered',
    'dataProvider' =>  $dataProvider,
    'template' => "{items}",
    'columns' =>array(
              //  $groupGridColumns, 
   
               // $proCode,
               // $noOfStudent,        
               //array('name'=>'id', 'header'=>'Dept. Name', 'htmlOptions'=>array('style'=>'width: 60px')),
                array('name'=>'pro_shortName', 'header'=>'Programme name', 'footer'=>'Total Students'),
                //array('name'=>'total', 'header'=>'No of Student'),
                array(
                'name'=>'total',
                'header'=>'No of Students',
                    'footerHtmlOptions'=>array('style'=>'font-weight:bold;'),
                'class'=>'bootstrap.widgets.TbTotalSumColumn'
                ),
                
            
            ),
    ));
?>
</div>

