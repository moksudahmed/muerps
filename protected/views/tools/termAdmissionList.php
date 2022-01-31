<?php
/* @var $this AdministrativeReportController */

$this->breadcrumbs=array(
   'Registry'=>array('site/registry'),
    
	'Tools'=>array('index'),	
);
?>
<h2><?php echo $msg; ?></h2>
<?php 
$getACterm ='FormUtil::getTerm($data[\'tra_term\'])';
$ACterm=array(
    'header'=>'Term',
    
    'value'=>$getACterm,

    'htmlOptions' =>array('class'=>'span-3','style'=>'text-align:left'),
    
);
$this->widget('bootstrap.widgets.TbGridView', array(
    'id'=>'customer-grid',
    'type'=>'striped bordered condensed',
    'dataProvider'=>$dataProvider,
   // 'filter'=>$model,
    'columns'=>array(
        array(
                    'header'=>'Term Admission ID',
                    'value'=>'$data[\'termAdmissionID\']',
                    'htmlOptions' =>array('class'=>'span-2','style'=>'font-weight:bold;',),
                    ),
           
		array(
                //'name'=>'moduleCode',
                'header'=>'Section Name',
                'value'=>'$data[\'sectionName\']',
      //          'footer'=>'modType',
                'htmlOptions' =>array('id'=>'modID','class'=>'span-2'),
                ),
                array(
                  //  'name'=>'mod_name',
                    'header'=>'Batch Name',
                    'value'=>'$data[\'batchName\']',
    //                'footer'=>'Total Credit:',
                    'htmlOptions' =>array('id'=>'modName','class'=>'span-2',),
                    ),
            $ACterm,
            /* array(
               // 'name'=>'Time Slot',
                'header'=>'Term',
                'value'=>'$data[\'tra_term\']',
                'htmlOptions' =>array('class'=>'span-2','style'=>'text-align:left'),
                //'footer'=>'modType'
               ), */
	   array('name'=>'Year',
                'header'=>'Year','value'=>'$data[\'tra_year\']',
                'htmlOptions' =>array('class'=>'span-2'),),
            
            array('name'=>'tra_date',
                'header'=>'Date','value'=>'$data[\'tra_date\']',
                'htmlOptions' =>array('class'=>'span-2'),),
            
            
            array('name'=>'tra_finalExamRegistred',
                'header'=>'Final Exam Registred','value'=>'$data[\'tra_finalExamRegistred\']',
                'htmlOptions' =>array('class'=>'span-2'),),         
        
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{reset} {active}',
            'buttons'=>array
            (
               
                'reset' => array
                (
                    'label'=>'View',
                    'icon'=>'icon-search icon-white',
                    'url'=>'Yii::app()->createUrl("tools/viewTerm", array("tID"=>$data[\'termAdmissionID\']))',
                    'options'=>array(
                        'class'=>'btn btn-small btn-success',
                    ),
                ),
                'active' => array
                (
                    'label'=>'Delete',
                    'icon'=>'icon-remove icon-white',                  
                    'url'=>'Yii::app()->createUrl("tools/deleteTermAdmission", array("tID"=>$data[\'termAdmissionID\']))',                    
                    'options'=>array(
                        'class'=>'btn btn-small btn-danger',
                    ),
                ),
                
            ),
           'htmlOptions'=>array(
                'style'=>'text-align: center; ',
                'class'=>'moreButtons span-2',
                
            ),
        ) 
    ),
));
