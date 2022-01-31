<?php

$this->breadcrumbs=array(
	'Department Activities'=>array('headsFunction/index'),
        
        'Offered Course List'
	
);

?>

<div class="title span-20">
            <h3>Offered Course List</h3>
            <h4>Exam: <?php echo FormUtil::getTerm( yii::app()->session['ofmLiTerm']);?> Term Final Examination <?php echo yii::app()->session['ofmLiYear'];?></h4>            
      <h4>Programme:<?php  echo DBhelper::getProgrammeByCode(yii::app()->session['ofmLiProCode']); ?></h4>
</div>

<hr/>

<?php 

?>

    
          
  <?php

//$getRegWith='FormUtil::getBatchTermName($data[\'sectionName\'],$data[\'batchName\'],$data[\'programmeCode\'])';
$getRegWith='FormUtil::getBatchName($data[\'batchName\']).\' \'.$data[\'sectionName\']';

$offeredModuleID=array(
    'name'=>'offeredModuleID',
    'header'=>'Id',
    'value'=>'$data[\'offeredModuleID\']',

    'htmlOptions' =>array('class'=>'span-2'),
    
);


$sectionName =array(
    'name'=>'sectionName',
    'header'=>'Section',
    'value'=>'$data[\'sectionName\']',

    'htmlOptions' =>array('class'=>'span-2'),
    
);

$moduleCode=array(
    'name'=>'moduleCode',
    'header'=>'Course Code',
    'value'=>'$data[\'moduleCode\']',

    'htmlOptions' =>array('class'=>'span-2'),
    
);

$moduleName=array(
    
    'name'=>'mod_name',
    'header'=>'Course Title',
    'value'=>'$data[\'mod_name\']',
    'htmlOptions' =>array('class'=>'span-8'),
    
    
);
$facultyName=array(
    
    'name'=>'per_name',
    'header'=>'Faculty',
    'value'=>'$data[\'per_name\']',
    'htmlOptions' =>array('class'=>'span-6',),
    
    
);

$groupGridColumns = array(
'name' => 'firstLetter',
    'header'=>'',
'value' => '$data[\'sectionName\']',
'headerHtmlOptions' => array('style'=>'display:none'),
'htmlOptions' =>array('style'=>'display:none'),
    
);


$editableColumn1 =  array(
'name' => 'facultyID',
'header' => 'Faculty',
'class' => 'bootstrap.widgets.TbEditableColumn',
'headerHtmlOptions' => array('style' => 'width:80px'),
    'htmlOptions'=>array('class'=>'span-8'),
'editable' => array(
    'type' => 'select',
    'url' => Yii::app()->createUrl("offeredModule/editable", array("id"=>'$data->offeredModuleID')),
    'htmlOptions'=>array('style'=>'font-weight:bold; border-bottom: 0px solid'),
    'source' =>CHtml::listData(FormUtil::getFacultyByDepartment(), 'id', 'text','group')
    )
);

$editableColumn2 = array(
                    'name' => 'ofm_approval',
                    'header' => 'Publish',
                    'class' => 'bootstrap.widgets.TbEditableColumn',
                    'headerHtmlOptions' => array('style' => 'width:80px'),
                    'editable' => array(
                        'htmlOptions'=>array('style'=>'font-weight:bold; border-bottom: 0px solid'),
                        'type' => 'select',
                        'url' => Yii::app()->createUrl("facultiesFunction/saveApproval", array("id"=>'$data->offeredModuleID')),
                        'source' => array('yes'=>'Yes','no'=>'No'),
                            'display' => 'js: function(value, sourceData) {
                            var escapedValue = $(this).text(value).html();

                            if(escapedValue==\'yes\')
                            {
                              $(this).html("<span class=\"label label-success\">  Yes <i class=\"icon-ok\"></i> </span>")
                            }
                            else $(this).html("<span class=\"label label-warning\">No <i class=\"icon-remove\"></i></span>")

                          }'


               )
        );
     
$this->widget('bootstrap.widgets.TbGroupGridView', array(
        
	'id'=>'resultPublish-grid',
        'type'=>'striped bordered',
        //'enablePagination' => true,
        'responsiveTable' => true,
	'dataProvider'=> $dataProvider,
	//'filter'=>$model,

    
    	'extraRowColumns'=> array('firstLetter'),
        'extraRowExpression' => $getRegWith,
        'extraRowHtmlOptions' => array('style'=>'padding-right:10px; text-align:right; font-weight:bold ; color: #333;'),

	'columns'=>array(
                          
                $groupGridColumns,                     
           //     array('header'=>'Completed Course','name'=>'id','value'=>'$data[\'moduleCode\']." - ".$data[\'mod_name\']','htmlOptions'=>array('class'=>'span-18')),
            //'offeredModuleID',
             //   $offeredModuleID,
		$moduleCode,
		$moduleName,
                array(   'name'=>'mod_creditHour','header'=>'Credit','htmlOptions' =>array('class'=>'span-1',)),
                array(   'name'=>'mod_group','header'=>'Group','htmlOptions' =>array('class'=>'span-3',)),
                $facultyName,
                
            
                array(   'name'=>'per_email','header'=>'Email','htmlOptions' =>array('class'=>'span-2',)),
                array(   'name'=>'per_mobile','header'=>'Mobile','htmlOptions' =>array('class'=>'span-2',)),
                

		
      //      array('header'=>'Batch Name','value'=>'$data[\'batchName\']','htmlOptions' =>array('class'=>'span-2'),),
               // array('header'=>'Offered To','value'=>$getRegWith,'htmlOptions' =>array('class'=>'span-2'),),
                
                //'mod_group',
               

	
         
    ),
//    'mergeColumns' => array('per_email','per_mobile')
    
));  ?>

