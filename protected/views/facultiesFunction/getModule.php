
                    <strong>Select Course:</strong><br/>

                    <?php echo CHtml::dropDownList('offeredModuleID',yii::app()->session['attOfmID'], 
                        CHtml::listData(FormUtil::getRegisteredModuleNameCode($ofmModule),'offeredModuleID','mod_name','mod_group')
                        ,array(
                        'prompt' => '--Please Select --',
                        'value' => '0',
                            'required'=>true
                    )); ?>
                    <?php // echo $form->error($admission,'batchName'); ?>
<?php  
            echo CHtml::submitButton('Continue', array('class' => 'btn btn-primary btn-large'));
           ?>