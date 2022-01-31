<div class="title span-13">
                <h3 >Students with CGPA less than 2.00 for three consecutive terms</h3>            
                
                <h4><strong>Term: </strong><span class="label label-warning"><?php echo FormUtil::getTerm(yii::app()->session['attTerm']); ?> </span><span class="label label-success"> <?php echo  yii::app()->session['attYear'];  ?></span></h4>
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
                    array('name' => 'programmeCode','header' => 'Program Code'),
                    array('name' => 'batchName','header' => 'Batch Name'),
                    array('name' => 'sectionName','header' => 'Section Name'),
                    array('name' => 'cgpa','header' => 'CGPA'),
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