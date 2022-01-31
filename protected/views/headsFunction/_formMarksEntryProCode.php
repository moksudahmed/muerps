<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<strong>Enter: <br/>(Batch - Section )</strong><br/>

<?php 
            echo CHtml::textField('batchName','',array('required'=>true,'type'=>'number','title'=>'Numeric only','class'=>'span-2','style'=>'font-size:20px; height:40px;'));
        ?>
<strong>-</strong>
<?php 
            echo CHtml::textField('sectionName','',array('required'=>true,'pattern'=>'([A-Z])$','title'=>'Capital Letter!','class'=>'span-2','style'=>'font-size:20px; height:40px;'));
        ?>
<br/>

           <?php  
            echo CHtml::submitButton('Continue', array('class' => 'btn btn-primary btn-large'));
           ?>