<h>Supplementary List</h5>
<h6><strong>Exam: </strong><span class="label label-info">  <?php echo FormUtil::getTerm( yii::app()->session['rePublishTerm']);?></span><span class="label label-success"> <?php echo "Term Final Examination ".yii::app()->session['rePublishYear'];?></span></h6>            
<h6><strong>Programme: </strong> <?php  echo DBhelper::getProgrammeByCode(yii::app()->session['rePublishProCode']); ?></h6>           
  <?php
$getRegWith='FormUtil::getModuleRegistrationBatchSection($data[\'batchName\'],$data[\'sectionName\'],$data[\'programmeCode\'])';

$groupGridColumns = array(
'name' => 'firstLetter',
'value' => $getRegWith,
'headerHtmlOptions' => array('style'=>'display:none'),
'htmlOptions' =>array('style'=>'display:none'),
    
);
 
$ID=array(
    'name'=>'Student ID',
    'header'=>'Student ID',
    'value'=>'$data[\'id\']',
    'headerHtmlOptions' => array('style'=>'padding:10px; text-align:left; font-size: 1em; color: #333;'),
    'htmlOptions' =>array('style'=>'padding:10px; text-align:left; font-size: 0.8em; color: #333;'),
    
);

$name=array(
    'name'=>'Name',
    'header'=>'Name',
    'value'=>'$data[\'per_name\']',
    'headerHtmlOptions' => array('style'=>'padding:10px; text-align:left; font-size: 1em; color: #333;'),
    'htmlOptions' =>array('style'=>'padding:10px; text-align:left; font-size: 0.8em; color: #333;'),
    
);

$moduleCode=array(
    'name'=>'code',
    'header'=>'Module Code',
    'value'=>'$data[\'moduleCode\']',
    'headerHtmlOptions' => array('style'=>'padding:10px; text-align:left; font-size: 1em; color: #333;'),
    'htmlOptions' =>array('style'=>'padding:10px; text-align:left; font-size: 0.8em; color: #333;'),
    
);

$moduleName=array(
    'name'=>'name',
    'header'=>'Module Name',
    'value'=>'$data[\'mod_name\']',
    'headerHtmlOptions' => array('style'=>'padding:10px; text-align:left; font-size: 1em; color: #333;'),
    'htmlOptions' =>array('style'=>'padding:10px; text-align:left; font-size: 0.8em; color: #333;'),
    
);

$final=array(
    'name'=>'final',
    'header'=>'Out of 40',
    'value'=>'$data[\'markFinal\']',
    'headerHtmlOptions' => array('style'=>'padding:10px; text-align:center; font-size: 1em; color: #333;'),
    'htmlOptions' =>array('style'=>'padding:10px; text-align:center; font-size: 0.8em; color: #333;'),
    
);

$this->widget('bootstrap.widgets.TbGroupGridView', array(
        
	'id'=>'resultPublish-grid',
        'type'=>'striped bordered',
        'enablePagination' => true,
        'responsiveTable' => true,
	'dataProvider'=> $dataProvider,
    
    	'extraRowColumns'=> array('firstLetter'),
        'extraRowExpression' => $getRegWith,
        'extraRowHtmlOptions' => array('style'=>'padding:8px; text-align:right; font-size: 1em; color: #333;'),

        'bulkActions' => array(
            'checkBoxColumnConfig' => array(
            'name' => 'offeredModuleID',
            'checked'=>'false',
               
            )
        ),
	'columns'=>array(                          
                $groupGridColumns,                     
               //array('header'=>'Student ID','value'=>'$data[\'id\']','htmlOptions' =>array('class'=>'span-1'),),
              // array('header'=>'Student ID','value'=>'$data[\'id\']','htmlOptions' =>array('style'=>'padding:10px; text-align:left; font-size: 0.8em; color: #333;'),),
                $ID,
                $name,
                $moduleCode,
                $moduleName,
                $final,
               //array('header'=>'Name','value'=>'$data[\'per_name\']','htmlOptions' =>array('style'=>'padding:10px; text-align:left; font-size: 0.8em; color: #333;'),),
               //array('header'=>'Module Code','value'=>'$data[\'moduleCode\']','htmlOptions' =>array('style'=>'padding:10px; text-align:left; font-size: 0.8em; color: #333;'),),
               //array('header'=>'Module Name','value'=>'$data[\'mod_name\']','htmlOptions' =>array('style'=>'padding:10px; text-align:left; font-size: 0.8em; color: #333;'),),
               //array('header'=>'Out of 40','value'=>'$data[\'markFinal\']','htmlOptions' =>array('style'=>'padding:10px; text-align:left; font-size: 0.8em; color: #333;'),),
    )
    
    
));  ?>

</div><!-- form -->
