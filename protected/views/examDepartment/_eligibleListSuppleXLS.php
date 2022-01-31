

<div class="title span-20">
            <h3>Eligible List (Supplementary)</h3>
            <h4><?php echo FormUtil::getTerm( yii::app()->session['eligibleTerm']);?> Term Supplementary Examination <?php echo yii::app()->session['eligibleYear'];?></h4>            
      
</div>


<div class="span-24" style="font-size: 16px;">

<?php

//$getRegType='FormUtil::getModuleRegistrationType($data->reg_type)';

$studentID='FormUtil::getStudentIDBySuppleRegistration($data[\'programmeCode\'],$data[\'id\'],$data[\'exm_examTerm\'], $data[\'exm_examYear\'])';
$faculty='FormUtil::getFacultyBySuppleRegistration($data[\'programmeCode\'],$data[\'id\'],$data[\'exm_examTerm\'], $data[\'exm_examYear\'])';
//$getModType='FormUtil::getModuleType($data[\'mod_type\'])';
//$getModLabIncluded='FormUtil::getModuleLabIncluded($data[\'mod_labIncluded\'])';




$groupGridColumns = array(
'name' => 'firstLetter',
'value' => '',
'headerHtmlOptions' => array('style'=>'display:none'),
'htmlOptions' =>array('style'=>'display:none')
);



$this->widget('bootstrap.widgets.TbGroupGridView', array(
        
	'id'=>'moduleRegistration-grid',
        'type' => 'striped bordered hover',
        'enablePagination' => false,
        'responsiveTable' => true,
	'dataProvider'=> $dataProvider,
	//'filter'=>$model,

    
    	'extraRowColumns'=> array('firstLetter'),
        'extraRowExpression' => '$data[\'pro_name\']',
        'extraRowHtmlOptions' => array('style'=>'padding:10px;text-align:right; font-weight: bold'),
      
	'columns'=>array(
           
                $groupGridColumns,
                array('name' => 'id','header'=>'Code',
  //              'value' => $moduleName,
                'htmlOptions' =>array('class'=>'span-2','style'=>'',),'headerHtmlOptions' => array('style'=>''),'footerHtmlOptions' => array('style'=>'font-weight:bold'),
                    
                ),
                
                array('name' => 'mod_name','header'=>'Title',
  //              'value' => $moduleName,
                'htmlOptions' =>array('class'=>'span-6','style'=>'',),'headerHtmlOptions' => array('style'=>''),'footerHtmlOptions' => array('style'=>'font-weight:bold'),
                
                ),
                
               array('header'=>'Student ID',
                'value' => $studentID,
                'htmlOptions' =>array('class'=>'span-5','style'=>'',),'headerHtmlOptions' => array('style'=>''),'footerHtmlOptions' => array('style'=>'font-weight:bold'),
                
                ),
                array('header'=>'Faculty',
                'value' => $faculty,
                'htmlOptions' =>array('class'=>'span-5','style'=>'',),'headerHtmlOptions' => array('style'=>''),'footerHtmlOptions' => array('style'=>'font-weight:bold'),
                
                ),
            
          
    ),
    
    
));  ?>


</div>

