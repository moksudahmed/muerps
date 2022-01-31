<?php
/* @var $this ModuleRegistrationController */
/* @var $model ModuleRegistration */

$this->breadcrumbs=array(
    
	
        'Student Profile' =>array('student/profileIndex'),
	'Registered Course',
	
);



?>


<br/><br/>
    <div class="title">
            <div class="span-14">
                <h3>Registered Course:</h3>
                <h3><strong>Student ID: </strong> <span class="label label-success"> <?php echo yii::app()->session['studentID'];  ?></span></h3>
                 <h3><strong>Name: </strong> <span class="label label-info"> <?php echo yii::app()->session['studentName']; ?></span></h3>
                
                <h4><strong>Section: </strong><span class="label label-important"> <?php echo yii::app()->session['secName']; ?></span><strong>Batch: </strong><span class="label label-success"> <?php echo yii::app()->session['batName'].FormUtil::getBatchNameSufix(yii::app()->session['batName']); ?>  </span></h4>
                
                <h4><strong>Student Academic Year: </strong><span class="label label-info"><?php  echo FormUtil::getTerm(yii::app()->session['acTerm'])." ".yii::app()->session['acYear'] ;  ?></span></h4>
            
            </div>
        <div class="span-6" style="padding:105px 0px 0px 0px;">
            <h6 ><strong>Programme: </strong> <?php  echo DBhelper::getProgrammeByCode(yii::app()->session['proCode']); ?></h6>
        <div class="">
            <?php 
            $this->widget('bootstrap.widgets.TbMenu', array(
                    'type'=>'pills',
                    'items'=>array(

                            array('label'=>'Profile', 'icon'=>'icon-download', 'url'=>Yii::app()->controller->createUrl('student/profileIndex'), 'linkOptions'=>array(), 'visible'=>true),
                            array('label'=>'Academic Record', 'icon'=>'icon-download', 'url'=>Yii::app()->controller->createUrl('student/getResult'), 'linkOptions'=>array(), 'visible'=>true),

                    ),
            ));

            ?>
        </div>
        </div>
            <div class="img-polaroid span-4" >
                <?php echo CHtml::image('./photograph/'.yii::app()->session['studentID'].'.jpg',yii::app()->session['studentName']); ?>
            </div>
                   
     </div>

<hr/>

<?php

$getRegType='FormUtil::getModuleRegistrationType($data->reg_type,$data->ofmSection,$data->ofmBatch)';
$getModType='FormUtil::getModuleType($data->mod_type)';
$getModLabIncluded='FormUtil::getModuleLabIncluded($data->mod_labIncluded)';
$termYear='FormUtil::getTermYearWithNumber($data[\'traBatch\'],$data[\'programmeCode\'],$data[\'tra_term\'], $data[\'tra_year\'])';
$getRegWith='FormUtil::getModuleRegistrationBatchSection($data->ofmBatch,$data->ofmSection)';






$groupGridColumns = array(
'name' => 'firstLetter',
'value' => '$data->tra_term',
'headerHtmlOptions' => array('style'=>'display:none'),
'htmlOptions' =>array('style'=>'display:none')
);






$this->widget('bootstrap.widgets.TbGroupGridView', array(
        
	'id'=>'offeredModule-grid3',
        'type' => 'table-hover'/*'striped'*/,
    
        'enablePagination' => true,
        'responsiveTable' => true,
	'dataProvider'=>  $dataProvider,
	//'filter'=>$model,

    
    	'extraRowColumns'=> array('firstLetter'),
        'extraRowExpression' => $termYear,
        'extraRowHtmlOptions' => array('style'=>'padding:10px;font-size:20px;letter-spacing:2px; text-align:right; '),
      
        
	'columns'=>array(
           
                $groupGridColumns,
               // 'moduleRegistrationID',
                
            //'offeredModuleID',
            //'termAdmissionID',
		array('header'=>'Module: (Code','value'=>'$data[\'moduleCode\']','footer'=>'modType'),
		array('header'=>'Name','value'=>'$data->mod_name','htmlOptions' =>array('class'=>'span-6')),
                array('header'=>'Type','value'=>$getModType,'htmlOptions' =>array('class'=>'span-2'),),
                array('value'=>$getModLabIncluded,'htmlOptions' =>array('class'=>'span-2'),'footer'=>'Total Credit:'),
                array('name'=>'mod_creditHour','header'=>'Credit','htmlOptions' =>array('style'=>'text-align:left;','class'=>'span-3'),'class'=>'bootstrap.widgets.TbTotalSumColumn',),
                array('header'=>'Prerequisite)','value'=>'$data[\'mod_prerequisite\']',),
		
                
		
		
            
                array('header'=>'Reg: (date,','value'=>'FormUtil::getFormatedDate($data[\'reg_date\'])','htmlOptions' =>array('class'=>'span-3'),),
                array('header'=>'with,','value'=>$getRegWith,'htmlOptions' =>array('class'=>'span-2'),),
                array('header'=>'type)','value'=>'$data[\'reg_status\']','htmlOptions' =>array('class'=>'span-4'),),
            
  
            )
    
    
));  ?>

</div>
<script type="text/javascript">
    
    
        // prevent the click event
       
    
    $(window).load(function () {
        
        $( "td:contains('Spring')").addClass('label label-success span1');
        $( "td:contains('Summer')").addClass('label label-warning span1');
        $( "td:contains('Autumn')").addClass('label label-info span1');
         
        $("td:contains('modType')").remove(); 
        $("td:contains('Total Credit')").css('font-weight','bold');      
    });
    
</script>

