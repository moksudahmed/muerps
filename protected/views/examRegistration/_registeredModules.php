	

<div id="success"> 
    


		 <?php if (Yii::app()->user->hasFlash('success')):?>
			<div class="alert in alert-block fade alert-success">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  <?php echo Yii::app()->user->getFlash('success')?>
			</div>
		<?php endif;?>

    <div class="span-20" style="text-align: right;">
        <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'term-admission-form2',
            'enableAjaxValidation'=>false,
            'enableClientValidation'=>true,
            'action'=>CController::createUrl('examRegistration/Register'),
        )); ?>
       To Register: <strong>  <?php echo FormUtil::getTerm( yii::app()->session['exrTerm']).FormUtil::getExamType(yii::app()->session['exrType']).yii::app()->session['exrYear'];?></strong>

        <?php echo CHtml::hiddenField('termAdmissionID', $model->termAdmissionID); ?>
        <?php echo CHtml::hiddenField('studentID', $model->studentID); ?>
		<?php echo CHtml::submitButton('Click Here' , array('class' => 'btn btn-success btn-large','data-loading-text'=>'Loading....')); ?>
	
        <?php $this->endWidget(); ?>
     
    </div>
<?php

$getRegType='FormUtil::getModuleRegistrationType($data->reg_type,$data->ofmSection,$data->ofmBatch)';
$getModType='FormUtil::getModuleType($data->mod_type)';
$getModLabIncluded='FormUtil::getModuleLabIncluded($data->mod_labIncluded)';
$termYear='FormUtil::getTermYear($data->tra_term, $data->tra_year)';
$getRegWith='FormUtil::getModuleRegistrationBatchSection($data->traBatch,$data->traSection)';






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
                'moduleRegistrationID',
                
            //'offeredModuleID',
            //'termAdmissionID',
		array('header'=>'Module: (Code','value'=>'$data->moduleCode','footer'=>'modType'),
		array('header'=>'Name','value'=>'$data->mod_name','htmlOptions' =>array('class'=>'span-6')),
                array('header'=>'Type','value'=>$getModType,'htmlOptions' =>array('class'=>'span-2'),),
                array('value'=>$getModLabIncluded,'htmlOptions' =>array('class'=>'span-2'),'footer'=>'Total Credit:'),
                array('name'=>'mod_creditHour','header'=>'Credit Hour','htmlOptions' =>array('style'=>'text-align:left;','class'=>'span-3'),'class'=>'bootstrap.widgets.TbTotalSumColumn',),
                array('header'=>'Prerequisite)','value'=>'$data->mod_prerequisite',),
		
                
		
		
            
                array('header'=>'Reg: (date,','value'=>'$data->reg_date','htmlOptions' =>array('class'=>'span-2'),),
                array('header'=>'with,','value'=>$getRegWith,'htmlOptions' =>array('class'=>'span-2'),),
                array('header'=>'type)','value'=>$getRegType,'htmlOptions' =>array('class'=>'span-4'),),
            
  
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
    
</script></script>