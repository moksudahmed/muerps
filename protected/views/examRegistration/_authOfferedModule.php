
    
    
        <strong>Password:</strong><br/>
        <?php 
            echo CHtml::passwordField('password','',array('required'=>true));
        ?>
           <?php  
            echo CHtml::submitButton('Continue', array('class' => 'btn btn-primary btn-large'));
           ?>
       
            
