<?php

$this->breadcrumbs=array(
	'Department Activities'=>array('headsFunction/index'),
        
        'Result Authentication'
	
);

?>
<div class="title span-18" >
            <h3 class="title">Result Summary Report</h3>
                <h4><strong>Module Name </strong><span class="label label-info"><?php echo $mod_name; ?> </span><br/></h4>
            <h4> <strong>Faculty Name: </strong> <span class="label label-success "><?php  echo $per_name; ?></span></h4>
   <h4> <strong>Batch: </strong> <span class="label label-important "><?php echo $batch_name; ?></span>
            <strong>Section: </strong><span class="label label-important"> <?php echo $sec_name; ?></span></h4>
            
            
</div>

<div class="title span2">
    <?php
        $this->widget('bootstrap.widgets.TbMenu', array(
	'type'=>'badge',
	'items'=>array(
		
	//array('label'=>'Generate 100 Mark Sheet', 'icon'=>'icon-download', 'url'=>Yii::app()->controller->createUrl('GenerateFirstHalfPDF'), 'linkOptions'=>array('target'=>'_blank'), 'visible'=>true),
        array('label'=>'Back', 'icon'=>'icon-arrow-left' , 'url'=>Yii::app()->controller->createUrl('headsFunction/courseAuthentication'), 'linkOptions'=>array('data-toggle'=>'tooltip','data-placement'=>'top', 'title'=>'Result Authentication',), 'visible'=>true),	
	//array('label'=>'Next', 'icon'=>'icon-play-circle', 'url'=>Yii::app()->controller->createUrl('resultSheet'), 'linkOptions'=>array('data-toggle'=>'tooltip','data-placement'=>'right', 'title'=>'Get Result') , 'visible'=>true, ),	
	),
    )); ?>
</div>

<div class="row"> 
    <div class="span8" >  
    
<?php
$array_data = array();
    array_push($array_data, array('Lettergrade', 'Total'));

    foreach ($result as $row):    
      array_push($array_data, array($row['letterGrade'],(int)$row['count']));
   endforeach; 
   
            $this->widget('ext.Hzl.google.HzlVisualizationChart', array('visualization' => 'PieChart',
            'data' => $array_data,
            'options' => array(
                'width' => 800,
                'height' => 420,
                'redFrom' => 90,
                'redTo' => 100,
                'yellowFrom' => 75,
                'yellowTo' => 90,
                'minorTicks' => 5
            )));

?>   
</div>

  <div class="span3" >  
      <span  class="label label-success" ><h4>Summarize list</h4></span>   
<?php


$this->widget(
    'bootstrap.widgets.TbExtendedGridView',
    array(
        'fixedHeader' => true,
        'headerOffset' => 40,
        // 40px is the height of the main navigation at bootstrap
        'type' => 'striped',
        'dataProvider' => $dataProvider,
        'responsiveTable' => true,
        'template' => "{items}",
        'columns' => array(
                   // $groupGridColumns,
                    array('name' => 'letterGrade','header' => 'Letter Grade',  'htmlOptions' =>array('class'=>'span-1'),),
                    array('name' => 'count','header' => 'Total',  'htmlOptions' =>array('class'=>'span-1'),),
                   
            
                ),
    )
);


?>
</div></div>