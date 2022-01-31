
<?php
/* @var $this AdministrationController */
/* @var $model Administration */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'allAdmission-form1',
	'enableAjaxValidation'=>true,
    'action'=>CController::createUrl('examination/reportTabulation'),
)); ?>

	

	<?php 
        
        //$models = Programme::model()->findAll();
        
        
        
        ?>
    
        
	<div class="row">
            <strong>Term:</strong><br/>
		<?php echo CHtml::radioButtonList('resultTerm',  (yii::app()->session['reTerm']?yii::app()->session['reTerm']:FormUtil::getCurrentTerm()),  ZHtml::$Terms, array('labelOptions'=>array('style'=>'display:inline; font-size:20px; padding-right:10px'), 'separator'=>'  ',));  ?>
	
	</div>
    
        <div class="row">
	<strong>Year:</strong><br/>
		<?php  echo CHtml::dropDownList('resultYear',  (yii::app()->session['reYear']?yii::app()->session['reYear']:FormUtil::getYear()), FormUtil::yearForDropDown(2008), 
                    array('prompt' => '--Please Select --',
                        'value' => '0',
                        'class'=>'span-10',
                       'style'=>'font-size:20px; height:40px;',
                        ));  ?>
        </div>
    
        <div class="row ">
            <strong>Examination: </strong> <br/>
		<?php  echo CHtml::radioButtonList('resultType',(yii::app()->session['reType']?yii::app()->session['reType']:1) ,  ZHtml::enumItem('exm_type'), array('labelOptions'=>array('style'=>'display:inline; font-size:20px; padding-right:10px'), 'separator'=>'  ','required'=>true));  ?>
                <?php //echo CHtml::encode('Supplementary'); ?>
                <?php //echo CHtml::hiddenField('exrType', 2); ?>
	</div>
    <div class="row ">
            <strong>Registration Type: </strong> <br/>
		<?php  echo CHtml::radioButtonList('reRegiType',(yii::app()->session['reRegiType']?yii::app()->session['reRegiType']:'Regular') ,  ZHtml::enumItem('regi_type'), array('labelOptions'=>array('style'=>'display:inline; font-size:20px; padding-right:10px'), 'separator'=>'  ','required'=>true));  ?>
                <?php //echo CHtml::encode('Supplementary'); ?>
                <?php //echo CHtml::hiddenField('exrType', 2); ?>
	</div>

        <div class="row">
            <strong>Programme:</strong><br/>
		<?php //echo $form->labelEx($admission,'programmeCode'); ?>
		<?php echo CHtml::dropDownList('programmeCode','programmeCode', CHtml::listData(FormUtil::getProgrammeByGroupByDepartmentID(yii::app()->session['MainDepartmentID']),
                   'programmeCode','pro_name','group'),array(
                        'prompt' => '--Select Programme--',
                        'value' => '0',
                       'class'=>'span-10',
                       'style'=>'font-size:20px; height:40px;',
                        'required'=>true,
                    'ajax' => array(
                    'type'=>'POST', //request type
                    'url'=>CController::createUrl('examination/getBatch'), //url to call.
                    //Style: CController::createUrl('currentController/methodToCall')
                    'update'=>'#batchName2', //selector to update
                    //'data'=>'js: $(this).val()' 
                    //leave out the data key to pass all form values through
                    )));?>
            	<?php //echo $form->error($admission,'programmeCode'); ?>
	</div>
    <div class="row" >
            
	<strong>Batch:</strong><br/>	
		<?php echo CHtml::dropDownList('batchName2','batchName2',array(),array(
                    'prompt' => '--Select Programme First--',
                        'value' => '0',
                    'class'=>'span-10',
                       'style'=>'font-size:20px; height:40px;',
                        'required' => true,
                    'ajax' => array(
                    'type'=>'POST', //request type
                    'url'=>CController::createUrl('examination/getGroup'), //url to call.
                    //Style: CController::createUrl('currentController/methodToCall')
                    'update'=>'#group', //selector to update
                    //'data'=>'js: $(this).val()' 
                    //leave out the data key to pass all form values through
                    )
                     ));?>
                    
            	<?php // echo $form->error($admission,'batchName'); ?>
	</div>
    <div class="row" >
    <strong>Major Subject Name:</strong><br/>	
		<?php echo CHtml::dropDownList('group','group',array(),array(
                    'prompt' => '--Select  Batch First--',
                        'value' => '0',
                    'class'=>'span-10',
                       'style'=>'font-size:20px; height:40px;',
                        'required' => false,
                    
                     ));?>
                    
            	<?php // echo $form->error($admission,'batchName'); ?>
   </div>
        <div class="row" >
            <strong>Result by Student ID:</strong>
                <?php echo CHtml::checkBox("pass");?>                      
	</div>
  <div class="row">
	
            <span>Enter Student ID:</span>
		
                <?php 
            $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                 
                'name'=>'studentID',
               // 'source'=>array('111-115-001', '111-112-110', '111-112-100','211-115-001', '211-112-110','211-112-111', '311-112-100',),
                'source'=> $data,
                'options'=>array(
                        'minLength'=>'7',
                    
                    ),
                'htmlOptions'=>array('required'=>false,'pattern'=>'([0-9][0-9][0-9]-[0-9][0-9][0-9]-[0-9][0-9][0-9])$','title'=>'ID have to be like [111-111-111]',
                    'class'=>'span-6',
                       'style'=>'font-size:20px; height:25px;',   
                    ),
            ));
            ?>
             
	</div>
  
     <!-- <div class="row" >
          <div class="alert alert-info" role="alert"> <h4><?php //echo CHtml::checkBox("retake");?>Please check the box for Retake Result:</h4>
             
                                     
            </div>
	</div>       -->
		
        <div class="row buttons">
		<?php echo CHtml::submitButton('Submit' , array('class' => 'btn btn-primary btn-large','data-loading-text'=>'Loading....')); ?>
	</div>
        
        
<?php $this->endWidget(); ?>

</div><!-- form -->