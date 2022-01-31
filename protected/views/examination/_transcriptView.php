<?php  
    $moduleGroupSequence = array();
    $sql = "SELECT \"programmeCode\" FROM tbl_p_admission  WHERE \"studentID\" ='{$sid}' AND ex_adm_active = true;";
    $pcode = Yii::app()->db->createCommand($sql)->queryAll();

   // $moduleGroupSequence = Options::model()->getGroupWiseOptions('course_group',$pcode[0]['programmeCode']);
  
   
     
    $moduleGroupSequence = Options::model()->getGroupWiseOptions('course_group',$pcode[0]['programmeCode']);
//   echo var_dump($moduleGroupSequence);exit();

 // $moduleGroupSequence = Options::model()->getOptions('course_group',yii::app()->session['trnsProgramme']);
    $sql = "SELECT DISTINCT c_mod_group FROM generate_transcript('{$sid}') ORDER BY c_mod_group"; 
    $moduleGroup = Yii::app()->db->createCommand($sql)->queryAll();
 //   echo var_dump($moduleGroup);exit();
    /*--------------------Estimate Total Line------------------------------*/    
 
   $type = 'pdf';
   $max_line_in_a_page = yii::app()->session['lines'];   
    if($max_line_in_a_page == null)
           $max_line_in_a_page = 24;
    //echo $max_line_in_a_page; exit();
    $page = 1;
    $hl = 8;
    $fl = 8;    
    
    $sql = "SELECT count(*) FROM generate_transcript('{$sid}')";       
    $rows_count = Yii::app()->db->createCommand($sql)->queryAll();
    
    $line = (count($moduleGroup)*3) + $rows_count[0]["count"];
    //echo var_dump($moduleGroup) ;exit();
     
    
    $total_line = 0;
    //if(( $line%$max_line_in_a_page )!= 0){
    if( $line >= $max_line_in_a_page ){
        $page = ceil((int)($line) / $max_line_in_a_page);
        if(($line % $max_line_in_a_page)<7) $page = $page - 1; //It's may be 8 or 7 // 
                        
    }
  
   //  echo ceil((int)($line) / $max_line_in_a_page); exit(); 
   // echo $line % $max_line_in_a_page; exit();
    $totalPage = $page + 2;
  //$max_line_in_a_page = 26;
 /*--------------------END Estimation------------------------------*/
   $pdf->AddPage();
   $sql = "SELECT sum(c_mod_credithour) FROM generate_transcript('{$sid}')";
   $credits = Yii::app()->db->createCommand($sql)->queryAll();
    
    
   /*-----------------Transcript summary page (Fornt page) page# 1------------------------------*/
   $headerData = Examination::model()->searchTranscriptHeaderData($sid);
 //  echo var_dump($headerData); exit();
    if(yii::app()->session['passYear'] == 1){
        
        $sql ="SELECT  max(x.\"exm_examYear\") as passyear FROM  public.tbl_u_exammarks e,  public.tbl_q_termadmission t,  public.tbl_s_moduleregistration m,   public.tbl_t_examination x
        WHERE  e.\"examinationID\" = x.\"examinationID\" AND t.\"termAdmissionID\" = m.\"termAdmissionID\" AND  m.\"moduleRegistrationID\" = e.\"moduleRegistrationID\" AND
          t.\"studentID\" = '{$sid}'";
      $examDate = Yii::app()->db->createCommand($sql)->queryAll();
      $date = $examDate[0]['passyear'];
     
    }
    else{
        $sql = "SELECT max(e.emr_date) as passdate FROM  public.tbl_u_exammarks e,  public.tbl_q_termadmission t, 
      public.tbl_s_moduleregistration m WHERE t.\"termAdmissionID\" = m.\"termAdmissionID\" AND
      m.\"moduleRegistrationID\" = e.\"moduleRegistrationID\" AND
      t.\"studentID\" ='{$sid}'";
     
      $examDate = Yii::app()->db->createCommand($sql)->queryAll();
      $date = $examDate[0]['passdate'];     
    }
    
   // $date = 2020;
    //$date = DateTime::createFromFormat('j-M-Y', '15-Feb-2020');
   $sql4 ="SELECT sum (c_mod_creditHour) from generate_transcript( '{$sid}') WHERE status='Exempted'";
//   $sql4 = "SELECT sum(\"mod_creditHour\") FROM vw_transcript  WHERE \"studentID\"='{$sid}' AND reg_status='Exempted'";
   $exemption = Yii::app()->db->createCommand($sql4)->queryAll();
   $credit_exemption = $exemption[0]["sum"];
    
   $sql = "SELECT * FROM calculate_cgpa_and_gpa('{$sid}')";
   $rows = Yii::app()->db->createCommand($sql)->queryAll();
   $obtain_cgpa = $rows[0]["cgpa"];
   
   
   $html = $this->renderPartial('_transcriptSummaryPage', array(
                              'pdf'=>$pdf,'headerData'=>$headerData,'obtain_cgpa'=>$obtain_cgpa, 'credits'=>$credits,'totalPage'=>$totalPage,'credit_exemption'=>$credit_exemption,'date'=>$date,), true);
   $pdf->writeHTML($html, true, false, false, false, ''); 
   
   $pdf->SetTextColor(0, 0, 0);
   $pdf->SetFillColor(255, 255, 255);
   $pdf->SetLineWidth(0.1);
   $left_column= "1 of ".($totalPage);
   $pdf->writeHTMLCell(350, '', 5, 275, $left_column, 0, 1, 1, true, 'C', true); 
  
   
  /*-----------------Transcript grading page (next page) page# 2------------------------------*/ 
    $pdf->AddPage();
    $html = $this->renderPartial('_transcriptGradingPage', array(
                    'pdf'=>$pdf,'type'=>$type,
        ), true);
    $pdf->writeHTML($html, true, false, false, false, '');
    $left_column= "2 of ".($totalPage);
    $pdf->writeHTMLCell(350, '', 5, 275, $left_column, 0, 1, 1, true, 'C', true); 
 
 /*-----------------Transcript main page (result pages) ------------------------------*/    
    $sql = "SELECT DISTINCT * FROM generate_transcript('{$sid}') ORDER BY c_moduleCode";
    // Old version //
    //$sql = "SELECT DISTINCT * FROM generate_transcript('{$sid}') ORDER BY c_mod_group, c_moduleCode";
    $rows = Yii::app()->db->createCommand($sql)->queryAll();
   // echo var_dump($rows); exit();
    $moduleGroup = FormUtil::arrangeGroups($moduleGroupSequence, $moduleGroup);
//    echo var_dump($moduleGroup); exit();
    $rows = FormUtil::arrangeGroupItems($rows, $moduleGroup);  
    
    $total_row = $rows_count[0]["count"];
    $start = 0;
    $end = $max_line_in_a_page;
    
    $total_item = 0;
    $count_group = 0;
     
     $group_name =  $moduleGroup[0]['c_mod_group'];     
  //  echo var_dump($group_name ); exit();
   //  echo var_dump($rows); exit();
    for($i=1; $i<=$page; $i++){  
        $total_line = 0;  
        $html = $this->renderPartial('_transcriptHeader',array('pdf'=>$pdf,'headerData'=>$headerData,'i'=>$i),true); 
        $pdf->writeHTML($html, true, false, true, false, ''); 
     
            if(FormUtil::checkItemExists($group_name, $start, $end, $rows)){
              $total_item = 0;
              
              $total_item = FormUtil::checkHowManyGroupExists($group_name, $start, $end, $rows);        
            
           
              $temp = $end;
              
               for($j=0; $j<$total_item; $j++)
               { 
                   if($total_line < $max_line_in_a_page){
           
                   $end = $start + FormUtil::checkHowManyItemExists($group_name, $start, $temp, $rows);
                   
                  
                   $total_line = $total_line + 4 + ($end - $start); 
                   if($group_name !=''){
                 //      echo var_dump($group_name); 
                   $html = $this->renderPartial('_transcriptMain',array('dataProvider' => $dataProvider,
                                            'transcirptData'=>$transcirptData,'group_name'=>$group_name,
                                            'sid'=>$sid,'pdf'=>$pdf,'rows'=>$rows,'start'=>$start,
                                            'end'=>$end,),true);
                   $pdf->writeHTML($html, true, false, true, false, ''); 
                   
                   }
                   $start = $end;                    
                
                  // $group_name =  $moduleGroup[++$count_group]['c_mod_group'];
				  if(isset($rows[$start]['c_mod_group'])== TRUE)
                   $group_name =  $rows[$start]['c_mod_group'];
                   }
                   
               }
            //   exit();  
          }
          else{
               if($total_line < $max_line_in_a_page){
               if($group_name !=''){
                   $html = $this->renderPartial('_transcriptMain',array('dataProvider' => $dataProvider,
                                            'transcirptData'=>$transcirptData,'group_name'=>$group_name,
                                            'sid'=>$sid,'pdf'=>$pdf,'rows'=>$rows,'start'=>$start,
                                            'end'=>$end,),true);
                $pdf->writeHTML($html, true, false, true, false, ''); 
               }
                  $total_line = 4 + ($end - $start);  
                  if(FormUtil::checkHowManyGroupExists($group_name, $start, $end, $rows) != 0){
                      $count_group = $count_group +1;
                  } 
                
                 $start = $end;  
               }
            
          }
             
          $end = $end + $max_line_in_a_page;
          if($end > $total_row){            
                $end = $total_row;

            } 
         if($i!=$page){
       //  if($credits[0]['sum']>=$headerData[0]['syl_maxCreditHour'])
         // {
             $html = $this->renderPartial('_transcriptEnd',array('pdf'=>$pdf),true);  
             $pdf->writeHTML($html, true, false, true, false, '');   
             $left_column= ($i+2) ." of ".($totalPage);
             $pdf->writeHTMLCell(350, '', 5, 275, $left_column, 0, 1, 1, true, 'C', true); 
        //  }
       }   
    }
  
/*-----------------Transcript Final page (result summary page) ------------------------------*/    
    
    
    if (yii::app()->session['absoluteCGPA'] == 1){
        $sql = "SELECT * FROM calculate_cgpa_and_gpa_old_system('{$sid}')";      
    }
    else
    {
        $sql = "SELECT * FROM calculate_cgpa_and_gpa('{$sid}')";
    }
    $rows = Yii::app()->db->createCommand($sql)->queryAll();
    
   // $sql3 = "SELECT sum(\"mod_creditHour\") FROM vw_transcript  WHERE \"studentID\"='{$sid}' AND reg_status='Exempted'";
   // $exemption = Yii::app()->db->createCommand($sql3)->queryAll();
   // $credit_exemption = $exemption[0]["sum"];
    
    $status = 'Complete';
    if($credits[0]['sum']>=$headerData[0]['syl_maxCreditHour'])
    {  
        $html = $this->renderPartial('_transcriptCGPASummary',array('pdf'=>$pdf,'rows'=>$rows,'headerData'=>$headerData,'credits'=>$credits,'credit_exemption'=>$credit_exemption,'status'=>$status,),true);
        $pdf->writeHTML($html, true, false, false, false,'');
    
   }
   else{
        $status = 'Incomplete';
        $html = $this->renderPartial('_transcriptCGPASummary',array('pdf'=>$pdf,'rows'=>$rows,'headerData'=>$headerData,'credits'=>$credits,'credit_exemption'=>$credit_exemption,'status'=>$status,),true);
        $pdf->writeHTML($html, true, false, false, false,'');
   }
/*-----------------Signature page ------------------------------*/    

    $html = $this->renderPartial('_transcriptEnd',array('pdf'=>$pdf),true);  
    $pdf->writeHTML($html, true, false, true, false, '');       
       
    $left_column= ($i+1) ." of ".($totalPage);
    $pdf->writeHTMLCell(350, '', 5, 275, $left_column, 0, 1, 1, true, 'C', true); 

/*-----------------Transcript Back page ------------------------------*/    
/*
    $pdf->AddPage();
    $html = $this->renderPartial('_transcriptBackPage',array('pdf'=>$pdf,),true);
    $pdf->writeHTML($html, true, false, false, false,'');
    
*/
    /*-----------------Transcript End ------------------------------*/    
   
   /* $this->widget(
    'bootstrap.widgets.TbExtendedGridView',
    array(
        'fixedHeader' => true,
        'headerOffset' => 40,
        // 40px is the height of the main navigation at bootstrap
        'type' => 'striped',
        'dataProvider' => $dataProvider,
        'responsiveTable' => true,
        'template' => "{items}",
        'columns' => array(            
                    array('name' => 'c_moduleCode','header' => 'c_moduleCode', 'value' => $data->c_moduleCode),
                    array('name' => 'c_mod_group','header' => 'c_mod_group'),
                    array('name' => 'c_title','header' => 'title'),                                
                    array('name' => 'c_gradePoint','header' => 'c_gradePoint'),
                    array('name' => 'c_letterGrade','header' => 'c_letterGrade'),
                    array('name' => 'c_cgpa','header' => 'CGPA', 'footer'=>'Total'),     
                     
                   
         array(
            'name'=>'totalItemCount',
            'header'=>'No of Student',             
            'class'=>'bootstrap.widgets.TbTotalSumColumn'            
        ),
       // array('name'=>'totalGender','value' => $genderCount, 'header'=>'Total'),
        
                ),
    )
);  */
        ?>






