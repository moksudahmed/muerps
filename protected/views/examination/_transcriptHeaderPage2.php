<table border="0"  style="font-size:25px; text-align: left;">
   <thead>
        <tr>    
            <th colspan ="3" align ="center"><strong>Academic Transcripts</strong></th>
        </tr>
        <tr colspan ="1" >
 		<th>Name</th>
                <th colspan ="2"><?php echo ': '.$headerData[0]['name'] ?></th>
         </tr>
         <tr colspan ="1" >
                <th>Registration No</th>
                <th colspan ="2"><?php echo ': '.$headerData[0]['studentID'] ?></th>
         </tr>
        <tr colspan ="1" >
                <th>Programme</th>
                <th colspan ="2" WIDTH="65%"><?php echo ': '.$headerData[0]['pro_name'] ?></th>
         </tr>
        
        <tr colspan ="1" >
                <th>Batch</th>
                <th colspan ="2"><?php echo ': '.$headerData[0]['batchName'].FormUtil::getBatchNameSufix($headerData[0]['batchName']) ?></th>
         </tr>
                     	
    </thead>
</table>

