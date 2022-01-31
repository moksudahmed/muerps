<?php
/* @var $this ModuleController */
/* @var $model Module */

$this->breadcrumbs=array(
    'Department Activities'=>array('headsFunction/index'),
	'Select Term'
);

$this->menu=array(
    array('label'=>'Create Module', 'url'=>array('create')),

	
);

?>






    <div class="title span-24">
        <div class="span-18">
            <h3 >Select Term </h3>
            
            <h4><strong>Programme: </strong><span class="label label-success"> <?php  echo DBhelper::getProgrammeByCode(yii::app()->session['proCodeOfm']); ?></span></h4>
            
            
            
                <div class="form">
        
                    <?php $form=$this->beginWidget('CActiveForm', array(
                            'id'=>'offerModule-form1',
                            'enableAjaxValidation'=>true,
                         'action'=>CController::createUrl('offeredModule/offeredModule'),
                    )); ?>
                <div class="row" >
            <div class="row" id="batch">
            
		
                <strong><?php echo CHtml::encode("Section:") ?></strong>
        <br/>
		<?php echo CHtml::dropDownList('batchName','batchName', CHtml::listData(FormUtil::getBatchByProgramme(yii::app()->session['proCodeOfm']),
                   'title','value','group'),array(
                    'prompt' => '--Select Programme First--',
                        'value' => '0',
                        'required'=>'true',
                       'class'=>'span-10',
                       'style'=>'font-size:20px;  height:40px;',
                    'ajax' => array(
                    'type'=>'POST', //request type
                    'url'=>CController::createUrl('headsFunction/getTerm'), //url to call.
                    //Style: CController::createUrl('currentController/methodToCall')
                    'update'=>'#term',
                    
                    //'data'=>'js: $(this).val()' 
                    //leave out the data key to pass all form values through
                    )
                      ));?>
                     
            	<?php // echo $form->error($admission,'batchName'); ?>
	</div>
                    <div id="term">
                        
                    </div>
                <?php $this->endWidget(); ?>
            </div>
        </div>
        
</div>
        <div class="span-4">
            <?php 
$this->widget('bootstrap.widgets.TbMenu', array(
	'type'=>'pills',
	'items'=>array(
            array('label'=>'Back', 'icon'=>'icon-arrow-left' , 'url'=>Yii::app()->controller->createUrl('headsfunction/index'), 'linkOptions'=>array('data-toggle'=>'tooltip','data-placement'=>'top', 'title'=>'Department Activities',), 'visible'=>true),	
           // array('label'=>'XLS', 'icon'=>'icon-download' , 'url'=>Yii::app()->controller->createUrl('OfferedCourseListXLS'), 'linkOptions'=>array('style'=>'text-weight:bold;','data-toggle'=>'tooltip','data-placement'=>'top', 'title'=>'Download',), 'visible'=>true),	
  
               
	),
));
?>   
            
        </div>



