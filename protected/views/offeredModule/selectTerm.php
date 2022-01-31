<?php
/* @var $this ModuleController */
/* @var $model Module */

$this->breadcrumbs=array(
    'Offer Modules'=>array('offeredModule/index'),
	'Select Term'
);

$this->menu=array(
    array('label'=>'Create Module', 'url'=>array('create')),

	
);

?>






    <div class="title span-18">
        <div class="span-10">
            <h3 >Modules To Be Offered For: </h3>
            
            <h4><strong>Batch: </strong><span class="label label-success"> <?php echo yii::app()->session['batNameOfm'].FormUtil::getBatchNameSufix(yii::app()->session['batNameOfm']); ?>  </span><strong>Section: </strong><span class="label label-important"> <?php echo yii::app()->session['secNameOfm']; ?></span></h4>
            
            
                <div class="form">
        
                    <?php $form=$this->beginWidget('CActiveForm', array(
                            'id'=>'offerModule-form1',
                            'enableAjaxValidation'=>true,
                         'action'=>CController::createUrl('offeredModule'),
                    )); ?>
                <div class="row" >
            
		
                    <h4><strong>Term:</strong></h4>

                    <?php echo CHtml::dropDownList('ofmTermYear',yii::app()->session['batTermOfm'].'-'.yii::app()->session['batYearOfm'], CHtml::listData(FormUtil::getOfferedModuleTerm(yii::app()->session['secNameOfm'],yii::app()->session['batNameOfm'],yii::app()->session['proCodeOfm']),
                   'ofmTermYear','ofm_term','group'),array(
                        'prompt' => '--Please Select --',
                        'value' => '0',
                    ));?>
                    <?php // echo $form->error($admission,'batchName'); ?>
                </div>
                <div class="row" >

                    <?php  
                     echo CHtml::submitButton('Continue', array('class' => 'btn btn-primary btn-large'));
                    ?>
                </div>
                <?php $this->endWidget(); ?>
            </div>
        </div>
        <div class="span-6">
            <h6>Programme:  <?php  echo DBhelper::getProgrammeByCode(yii::app()->session['proCodeOfm']); ?></h6>

        </div>
</div>



