<?php
/* @var $this ToolsController */
/* @var $model Tools */

?>
		 <?php if (Yii::app()->user->hasFlash('warning')):?>
			<div class="alert in alert-block fade alert-danger">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  <?php echo Yii::app()->user->getFlash('warning')?>
			</div>
		<?php endif;?>


<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'term-admission-form',
	'enableAjaxValidation'=>false,
        'enableClientValidation'=>true,
        'action'=>CController::createUrl('auditTable'),
)); ?>

        <div class="row">
        <strong>Date From:</strong><br/>

        <?php $this->widget('zii.widgets.jui.CJuiDatePicker',
                                    array(
                                          //  'attribute'=>'per_dateOfBirth',
                                           // 'model'=>$person,
                                           'name'=>'fromDate',
                                            'options' => array(
                                            'mode'=>'focus',
                                            'dateFormat'=>'yy-mm-dd',
                                            'showAnim' => 'slideDown',
                                            ),
                                            'htmlOptions'=>array('size'=>30,'class'=>'date span-10','style'=>'font-size:20px; height:25px;'),
                    )
                    );?>

                    <?php //echo $form->textField($persons,'per_dateOfBirth'); ?>
                    <?php //echo $form->error($person,'per_dateOfBirth'); ?>
            </div>
            <div class="row">
        <strong>Date To:</strong><br/>

        <?php $this->widget('zii.widgets.jui.CJuiDatePicker',
                                    array(
                                          //  'attribute'=>'per_dateOfBirth',
                                           // 'model'=>$person,
                                           'name'=>'toDate',
                                            'options' => array(
                                            'mode'=>'focus',
                                            'dateFormat'=>'yy-mm-dd',
                                            'showAnim' => 'slideDown',
                                            ),
                                            'htmlOptions'=>array('size'=>30,'class'=>'date span-10','style'=>'font-size:20px; height:25px;'),
                    )
                    );?>

                    <?php //echo $form->textField($persons,'per_dateOfBirth'); ?>
                    <?php //echo $form->error($person,'per_dateOfBirth'); ?>
            </div>
        <div class="row">
	<strong>Select Table</strong><br/>
                
<?php  echo CHtml::dropDownList('table','table', FormUtil::tableDropDown(), 
                    array('prompt' => '--Please Select --',
                        //'value' => '0',
                        'class'=>'span-10',
                       'style'=>'font-size:20px; height:40px;',
                        ));  ?>
        </div>
       
        <div class="row buttons">
		<?php echo CHtml::submitButton('Generate Log' , array('class' => 'btn btn-primary btn-large','data-loading-text'=>'Loading....')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->



