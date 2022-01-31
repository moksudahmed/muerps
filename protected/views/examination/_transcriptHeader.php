<table border="0"  style="font-size:30px; text-align: left;">
    <thead>   
    <?php if($i == 1){  ?>
    <tr>
        <th colspan ="3"><strong><i>Office of the Controller of Examinations</i></strong></th>
    </tr>
     
    <tr>
        <th width="15%"><strong>Date</strong></th>
        <th width="85%"><strong><?php echo ": ".date("F j, Y");?></strong></th>
        
    </tr>
    <tr >
         <th width="15%"><strong>Serial No</strong></th>
         <th width="85%"><strong><?php echo ': '.str_replace(".", '', $headerData[0]['pro_shortName']).' - '.$headerData[0]['batchName'].' / '.substr($headerData[0]['studentID'], 8, 9); ; ?></strong></th>
         
    </tr>
   <tr>    
            <th colspan ="2" align ="center"><strong>Academic Transcripts</strong></th>
            
    </tr>
    <?php }?>
    <tr>
        <th width="15%"><strong>Name</strong></th>
        <th width="85%"><strong><?php echo ': '.$headerData[0]['name'] ?></strong></th>
    </tr>
    <tr>
        <th width="15%"><strong>ID No</strong></th>
        <th width="85%"><strong><?php echo ': '.$headerData[0]['studentID'] ?></strong></th>
    </tr>
    <tr >
          <th width="15%"><strong>Programme</strong></th>
          <th width="85%"><strong><?php echo ': '.$headerData[0]['pro_officialName'] ?></strong></th>
    </tr>
    <tr >
           <th width="15%"><strong>Batch</strong></th>
           <th width="85%"><strong><?php echo ': '.$headerData[0]['batchName'].FormUtil::getBatchNameSufix($headerData[0]['batchName']).' Batch'.', '.FormUtil::getMonthNameFromAcademicTerm($headerData[0]['stu_academicTerm']).' '.$headerData[0]['stu_academicYear']; ?></strong></th>
    </tr>
    
    </thead>
</table>
