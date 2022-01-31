<div class="title">
            <h4>Course Distribution List</h4>            
            <h4><strong>Programme: </strong> <?php  echo DBhelper::getProgrammeByCode(yii::app()->session['rePublishProCode']); ?></h4>           
</div>
<?php
$getRegWith='FormUtil::getBatchName($data[\'batchName\'])';
$offeredModuleID=array(
    'name'=>'id',
    'header'=>'Name',
    'value'=>'$data[\'id\']',

    'htmlOptions' =>array('class'=>'span-6'),
    
);
           
$mod_creditHour=array(
    'name'=>'mod_creditHour',
    'header'=>'Credit Hour',
    'value'=>'$data[\'mod_creditHour\']',
    'htmlOptions' =>array('class'=>'span-6'),
    
);
$moduleCode=array(
    'name'=>'moduleCode',
    'header'=>'Module Code',
    'value'=>'$data[\'moduleCode\']',

    'htmlOptions' =>array('class'=>'span-6'),
    
);
$moduleName=array(
    'name'=>'mod_name',
    'header'=>'Module Name',
    'value'=>'$data[\'mod_name\']',

    'htmlOptions' =>array('class'=>'span-6'),
    
);
$sectionName =array(
    'name'=>'sectionName',
    'header'=>'Section',
    'value'=>'$data[\'sectionName\']',

    'htmlOptions' =>array('class'=>'span-6'),
    
);

$facultyName=array(
    
    'name'=>'per_name',
    'header'=>'Faculty Member Name',
    'value'=>'$data[\'per_name\']',
    'htmlOptions' =>array('class'=>'span-20'),
    
    
);

$groupGridColumns = array(
'name' => 'firstLetter',
'value' => $getRegWith,
'headerHtmlOptions' => array('style'=>'display:none'),
'htmlOptions' =>array('style'=>'display:none'),
    
);
     
$this->widget('bootstrap.widgets.TbGroupGridView', array(
        
	'id'=>'resultPublish-grid',
        'type'=>'striped bordered',
        'enablePagination' => true,
        'responsiveTable' => true,
	'dataProvider'=> $dataProvider,
	//'filter'=>$model,

    
    	'extraRowColumns'=> array('firstLetter'),
        'extraRowExpression' => $getRegWith,
        'extraRowHtmlOptions' => array('style'=>'padding:10px; text-align:right; font-size: 1.5em; color: #333;'),

        'bulkActions' => array(
            
            // if grid doesn't have a checkbox column type, it will attach
            // one and this configuration will be part of it
            'checkBoxColumnConfig' => array(
            'name' => 'id',
            'checked'=>'false',
               
            )
        ),
	'columns'=>array(
                          
                $groupGridColumns,                     
           //     array('header'=>'Completed Course','name'=>'id','value'=>'$data[\'moduleCode\']." - ".$data[\'mod_name\']','htmlOptions'=>array('class'=>'span-18')),
            //'offeredModuleID',
                $offeredModuleID,        
		$moduleCode,        
		$moduleName,          
                $mod_creditHour,
                $sectionName,
    //            $facultyName,
                
		
		
      //      array('header'=>'Batch Name','value'=>'$data[\'batchName\']','htmlOptions' =>array('class'=>'span-2'),),
               // array('header'=>'Offered To','value'=>$getRegWith,'htmlOptions' =>array('class'=>'span-2'),),
                
                //'mod_group',
               
         
                
           /* array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{view}',
            'buttons'=>array
            (
               
                'view' => array
                (
                    'label'=>'View Details',
                    'icon'=>'search white',
                    'url'=>'Yii::app()->createUrl("module/view", array("id"=>$data[\'moduleCode\'])',
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
     ),   */
    )
    
    
));  ?>

</div><!-- form -->



