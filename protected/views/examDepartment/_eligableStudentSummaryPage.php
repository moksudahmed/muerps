<p><h2>Summery of Eligible Students for various program</h2></p>

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
                'class'=>'bootstrap.widgets.TbTotalSumColumn'
                ),
                
            
            ),
    ));
?>