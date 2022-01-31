<div class="title span-13">
                <h3 >Students Mobile No</h3>            
                
                <h4><strong></strong><span class="label label-warning"><?php echo FormUtil::getBatchProgrammeName(yii::app()->session['attProgram'], yii::app()->session['attBatch']); ?></span></h4>
</div>                   
           
<div class="span-24">
<?php
 


$this->widget('bootstrap.widgets.TbExtendedGridView', array(
  //  'filter'=>$person,
    'type'=>'striped bordered',
    'dataProvider' => $dataProvider,
    'template' => "{items}\n{extendedSummary}",
    'columns' => array(
                   
                    array('name' => 'studentID','header' => 'Student ID'),
                    array('name' => 'name','header' => 'Name'),
                    array('name' => 'mobile_no','header' => 'Mobile No'),                  
                ),
    'extendedSummary' => array(
        'cgpa' => 'Total Students',
        'columns' => array(
            'cgpa' => array('label'=>'Total students', 'class'=>'TbSumOperation')
        )
    ),
    'extendedSummaryOptions' => array(
        'class' => 'well pull-right',
        'style' => 'width:300px'
    ),
));
?>                  

</div>