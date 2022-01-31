          <script type="text/javascript">
    
    
                    function gradePoint(totalmark){
                        
        if(totalmark>=80 && totalmark<=100){ return 'A+';}
	else if(totalmark>=75 && totalmark<80){return 'A';}
	else if (totalmark>=70 && totalmark<75){ 
		return 'A-';}
	else if (totalmark>=65 && totalmark<70) {
		return 'B+';}
	else if (totalmark>=60 && totalmark<65) {
		return 'B';}
	else if (totalmark>=55 && totalmark<60) {
		return 'B-';}
	else if (totalmark>=50 && totalmark<55) {
		return 'C+';}
	else if (totalmark>=45 && totalmark<50) {
		return 'C';}
	else if (totalmark>=40 && totalmark<45) {
		return 'D';}
	else { return 'F*';}

                    }
    
        $(function(){
    
    
        
        $(document).on('keypress','#final-<?php echo $i; ?>',function() {
            var final = $("#final-<?php echo $i; ?>").val();
            var total =$("#total-<?php echo $i; ?>").val();
            
            var grandTotal = parseFloat(final) +parseFloat(total);
            
            //alert(gradePoint(total));
            $("#grandTotal-<?php echo $i; ?>").val(grandTotal);
            $("#grandPoint-<?php echo $i; ?>").val(gradePoint(grandTotal));
            $("#grandPoint-<?php echo $i; ?>").css('');
        });
        
        
        $(document).on('keyup','#final-<?php echo $i; ?>',function() {
            var range = parseFloat($("#final-<?php echo $i; ?>").val());
            
            if(range><?php echo $range04; ?> || range<0)
            {
             
            //$("#final-<?php echo $i; ?>").attr('disabled','true');
                $("#save").attr('disabled','true');
                       $("#absent-<?php echo $i; ?>").attr('disabled','true');
                $("#error-<?php echo $i; ?>").html('out of range');
            }
            else 
            {
            //$("#final-<?php echo $i; ?>").removeAttr('disabled');
                $("#save").removeAttr('disabled');
                       $("#absent-<?php echo $i; ?>").removeAttr('disabled');
                $("#error-<?php echo $i; ?>").html('');
            }
            
            
            
            
        });
        
    
    $( "#absent-<?php echo $i; ?>").on( "click", function()
    {
        
        
        if ( $(this).prop('checked') ){
            $("#fi-<?php echo $i; ?>").val(0);
            $("#grandTotal-<?php echo $i; ?>").val('AB');
            $("#fi-<?php echo $i; ?>").attr('disabled','true');
        }
        else 
        {
            $("#grandTotal-<?php echo $i; ?>").val($("#total-<?php echo $i; ?>").val());
            $("#fi-<?php echo $i; ?>").removeAttr('disabled');
        }
        

    } );
        
    $( "#passFinal").on( "click", function()
    {
        
        
        if ( $(this).prop('checked') ){
            
            $("#save").removeAttr('disabled');
            $("#absent-<?php echo $i; ?>").removeAttr('disabled');
           
            $("#fi-<?php echo $i; ?>").removeAttr('disabled');
           
            $("#passFinal-<?php echo $i; ?>").attr('checked','true');
        }
        else 
        {
            $("#save").attr('disabled','true');
            $("#absent-<?php echo $i; ?>").attr('disabled','true');
            $("#fi-<?php echo $i; ?>").attr('disabled','true');
            $("#passFinal-<?php echo $i; ?>").removeAttr('checked');
        }
        

    } );
        
    $( "#passFinal-<?php echo $i; ?>").on( "click", function()
    {
        
        
        if ( $(this).prop('checked') ){
            
            $("#save").removeAttr('disabled');
            $("#absent-<?php echo $i; ?>").removeAttr('disabled');
            $("#fi-<?php echo $i; ?>").removeAttr('disabled');
            $("#passFinal-<?php echo $i; ?>").attr('checked','true');
        }
        else 
        {
            $("#save").attr('disabled','true');
            $("#absent-<?php echo $i; ?>").attr('disabled','true');
            $("#fi-<?php echo $i; ?>").attr('disabled','true');
            $("#passFinal-<?php echo $i; ?>").removeAttr('checked');
        }
        

    } );
    
    $( "#save").on( "click", function()
                            {


                                    $("#fi-<?php echo $i; ?>").removeAttr('disabled');
                                    
                                    $("#absent-<?php echo $i; ?>").removeAttr('disabled');
                                

                            } );
    });
    
</script>