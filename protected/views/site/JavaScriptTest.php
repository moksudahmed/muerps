<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of newPHPClass
 *
 * @author ron
 */

 //Yii::app()->clientScript->registerCoreScript("jquery");
//Yii::app()->clientScript->registerCoreScript('jquery.ui'); 


?>

<div>

    
    <form>
    <p>
    <input type="checkbox" name="newsletter1" value="Hourly" >
    <input type="checkbox" name="newsletter" value="Daily" checked>
    <input type="checkbox" name="newsletter" value="Weekly">
    <input type="checkbox" name="newsletter" value="Monthly" checked>
    <input type="checkbox" name="newsletter" value="Yearly"  />
    </p>
    <div id="ok2">
    <input type="text" name="ok" value="ok"  />
    </div>
    </form>
    <script type="text/javascript">
    var countChecked = function() {
    var n = $( "input:checked" ).length;
    $( "#ok" ).text( n + (n === 1 ? " is" : " are") + " checked!" );
    };
    
    $( "input[type=checkbox]" ).on( "click", countChecked );
    
    
   $( "input[name=newsletter1]" ).on( "load", function()
    {
        
        
    if ( $(this).prop('checked') ){
        $("#ok2").show('slow');
        $("input[name=ok]").attr('required',true);
    }
    else 
        {
            $("#ok2").hide('slow');
            $("input[name=ok]").attr('required',false);
        }
        

    } );
    
    $( "input[name=newsletter1]" ).on( "click", function()
    {
        
        
    if ( $(this).prop('checked') ){
        $("#ok2").show('slow');
        $("input[name=ok]").attr('required',true);
    }
    else 
        {
            $("#ok2").hide('slow');
            $("input[name=ok]").attr('required',false);
        }
        

    } );
    
    
    
    </script>
    
    <div id="ok">
        
        
    </div>
</div>

