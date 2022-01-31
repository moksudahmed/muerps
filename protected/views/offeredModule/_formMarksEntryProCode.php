<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<strong>Enter: <br/>(Programme Code - Batch - Section )</strong><br/>
<?php 

                            $this->widget('zii.widgets.jui.CJuiAutoComplete', array(

                                'name'=>'programmeCode',
                                //'source'=>array('115', '112', '113','141','116'),
                                'source'=> $data,
                                'options'=>array(
                                        'minLength'=>'1',

                                    ),
                                'htmlOptions'=>array('required'=>true,'pattern'=>'([0-9][0-9][0-9])$','title'=>'ID have to be like 115','class'=>'span-2',
                                    
                                    ),
                            ));
                ?>
<strong>-</strong>
<?php 
            echo CHtml::textField('batchName','',array('required'=>true,'type'=>'number','title'=>'Numeric only','class'=>'span-2'));
        ?>
<strong>-</strong>
<?php 
            echo CHtml::textField('sectionName','',array('required'=>true,'pattern'=>'([A-Z])$','title'=>'Capital Letter!','class'=>'span-2'));
        ?>
<br/>
<strong>Enter Password:</strong>

        <?php 
           echo CHtml::passwordField('password','',array('required'=>true,'class'=>'span-3'));
        ?>
           <?php  
            echo CHtml::submitButton('Continue', array('class' => 'btn btn-primary btn-large'));
           ?>