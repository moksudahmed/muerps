<?php
/* @var $this AdministrativeReportController */

$this->breadcrumbs=array(
   'Registry'=>array('site/registry'),
    
	'Tools'=>array('index'),	
);


$this->widget('bootstrap.widgets.TbGridView', array(
    'id'=>'customer-grid',
    'type'=>'striped bordered condensed',
    'dataProvider'=>$dataProvider,
   // 'filter'=>$model,
    'columns'=>array(
        array(
                    'header'=>'Module Registration ID',
                    'value'=>'$data[\'moduleRegistrationID\']',
                    'htmlOptions' =>array('class'=>'span-2','style'=>'font-weight:bold;',),
                    ),
           
		array(
                //'name'=>'moduleCode',
                'header'=>'Offered Module ID',
                'value'=>'$data[\'offeredModuleID\']',
      //          'footer'=>'modType',
                'htmlOptions' =>array('id'=>'modID','class'=>'span-2'),
                ),
                array(
                  //  'name'=>'mod_name',
                    'header'=>'Module Code',
                    'value'=>'$data[\'moduleCode\']',
    //                'footer'=>'Total Credit:',
                    'htmlOptions' =>array('id'=>'modName','class'=>'span-2',),
                    ),
           
	   array('name'=>'Attendence',
                'header'=>'Attendence','value'=>'$data[\'reg_attendence\']',
                'htmlOptions' =>array('class'=>'span-2'),),
            
            array('name'=>'classTest',
                'header'=>'Class Test','value'=>'$data[\'reg_classTest\']',
                'htmlOptions' =>array('class'=>'span-2'),),
            
            
            array('name'=>'midterm',
                'header'=>'Midterm','value'=>'$data[\'reg_midterm\']',
                'htmlOptions' =>array('class'=>'span-2'),),        
             array('name'=>'emr_mark',
                    'header'=>'Final','value'=>'$data[\'emr_mark\']',
                    'htmlOptions' =>array('class'=>'span-2'),),
             array('name'=>'emr_absent',
                    'header'=>'Status','value'=>'$data[\'emr_absent\']',
                    'htmlOptions' =>array('class'=>'span-2'),),
    ),
));
