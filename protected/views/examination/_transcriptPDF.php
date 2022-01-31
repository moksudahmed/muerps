    <?php  
    $sid = yii::app()->session['trnsStudentID'];
    $headerData = Examination::model()->searchTranscriptHeaderData($sid);
    $table ="<table border=\"0\"  style=\"font-size:22px; text-align: left;\">
       <thead>
            <tr>    
                <th colspan =\"7\" align =\"center\"><h1>Academic Transcripts</h1></th>
            </tr>
            <tr><th colspan =\"7\"><h2>Office of the Controller of Examinations</h2></th></tr>
               <tr class=\"span-1\">
                  <th>Date</th>
                  <th colspan =\"3\">: February 10, 2013</th>
               </tr>
               <tr>	
                   <th>Serial No</th>
                   <th colspan =\"3\">: BBA-17/2013</th>
                   <th></th>
                </tr>
                
                <tr>	
                   <th>Name</th>
                   <th colspan =\"3\"><?php echo ': '.$headerData[0]['name']; ?></th>
                   <th></th>
                </tr>
                 <tr>
                    <th>Registration No</th>
                    <th colspan =\"3\">: <?php echo ':'.$sid ?></th>
                </tr>
                <tr>
                    <th>Programme</th>
                    <th colspan =\"6\"></th>
                </tr>
                <tr>

                    <th>Batch</th>
                     <th></th>
               </tr>

        </thead>

    </table>";

    $fotter_table =" <table>
           <thead>
                       <tr><th colspan=\"6\">Prepared By </th></tr>
                       <tr><th></th></tr>
                       <tr><th></th></tr>
                        <tr>
                            <th colspan=\"2\">Checked By </th>
                            <th colspan=\"4\">Controller of Examinations</th>

                        </tr>

                        <tr>
                            <th colspan=\"2\"></th>
                            <th colspan=\"4\"><?php echo getOptions('organization_name'); ?>, Sylhet, Bangladesh </th>

                        </tr>

           </thead>
           <tbody>

           </tbody>    
       </table>
    ";
    /*
     * To change this template, choose Tools | Templates
     * and open the template in the editor.
     */
    ?>


    <?php 
    $moduleGroup =array();
    $moduleGroupSequence= array();
    $moduleGroupSequence =array("General Education",
                "Foundation",
                "Science & Mathematics",
                "Core",
                "Project",
                "Finance and Banking",
                "Human Resource Management",
                "Management",
                "Marketing",
                "Management Information Systems",
                "Accounting & Information Systems",
                "Advanced",
                "Optional",
                "Optional GED",
                "Compulsory GED",
                "Power",
                "Electronics",
                "Internship/Thesis",
                 "Thesis and Viva");

    $sql= "select * from vw_transcript  where \"studentID\"='{$sid}' ORDER BY
            mod_group,\"moduleCode\";"; 
       
    
    $data = Yii::app()->db->createCommand($sql)->queryAll();

    $k=1;
    $result = array();
    foreach ($data as $row):
        $result[$k++]= $row;        
    endforeach; 
    
     $sqlReatkeSupply="SELECT vw_transcript.\"moduleCode\", max(vw_transcript.\"markFirstHalf\") as mark, max(vw_transcript.\"emr_mark\") as finalmark FROM
                    public.vw_transcript WHERE vw_transcript.\"studentID\" = '{$sid}'
                    GROUP BY vw_transcript.\"moduleCode\" ORDER BY vw_transcript.\"moduleCode\"";
         
    
    $dataRetake = Yii::app()->db->createCommand($sqlReatkeSupply)->queryAll();
   
    $k=1;
    $resultRetake = array();
    foreach ($dataRetake as $row):
        $resultRetake[$k++]=array("moduleCode"=>$row["moduleCode"],
                            "markFirstHalf"=>$row["mark"],
                            "emr_mark"=>$row["finalmark"]
                        );
    endforeach; 
    
    $sql= "select DISTINCT mod_group from vw_transcript  where \"studentID\"='{$sid}' ORDER BY
            mod_group;"; 
       
    
    $data = Yii::app()->db->createCommand($sql)->queryAll();

    $k=1;
    $i=1;
    
        for($i=0; $i<=count($moduleGroupSequence); $i++)
        {
            foreach ($data as $row):
            if($moduleGroupSequence[$i]== $row['mod_group'])
            {
                
                    $moduleGroup[$k] = $row['mod_group'];        
                   
                  $k++;  
            }
             endforeach; 
            
        }
        
   
   
    $result = FormUtil::CheckRetakeSupplyResult($result,$resultRetake);


    $pos=1;
     $temp = array();
        for($j=0; $j<count($moduleGroupSequence); $j++)
        {
            for($i = 1; $i<=count($result); $i++)
            {
            
                if($moduleGroupSequence[$j]== $result[$i]["mod_group"])
                {
                   
                       $temp[1]= $result[$pos]["moduleCode"]; 
                       
                       $temp[2] = $result[$pos]["mod_group"];                             
                       $temp[3]= $result[$pos]["mod_name"];  
                       $temp[4] = $result[$pos]["mod_creditHour"];                             
                       $temp[5] = $result[$pos]["markFirstHalf"];  
                       $temp[6] = $result[$pos]["letterGrade"];  
                       $temp[7]= $result[$pos]["gradePoint"];  
                       $temp[8] = $result[$pos]["cgpa"];  
                       $temp[9] = $result[$pos]["tra_term"];  
                       $temp[10] = $result[$pos]["tra_year"];  
                       $temp[11]= $result[$pos]["emr_mark"]; 
                                             
                       $result[$pos]["moduleCode"] = $result[$i]["moduleCode"]; 
                       $result[$pos]["mod_group"] = $result[$i]["mod_group"];                             
                       $result[$pos]["mod_name"] = $result[$i]["mod_name"];  
                       $result[$pos]["mod_creditHour"] = $result[$i]["mod_creditHour"];                             
                       $result[$pos]["markFirstHalf"] = $result[$i]["markFirstHalf"];  
                       $result[$pos]["letterGrade"] = $result[$i]["letterGrade"];  
                       $result[$pos]["gradePoint"] = $result[$i]["gradePoint"];  
                       $result[$pos]["cgpa"] = $result[$i]["cgpa"];  
                       $result[$pos]["tra_term"] = $result[$i]["tra_term"];  
                       $result[$pos]["tra_year"] = $result[$i]["tra_year"];  
                       $result[$pos]["emr_mark"] = $result[$i]["emr_mark"]; 
                       
                       $result[$i]["moduleCode"] = $temp[1]; 
                       $result[$i]["mod_group"] = $temp[2];                             
                       $result[$i]["mod_name"] = $temp[3];  
                       $result[$i]["mod_creditHour"] = $temp[4];                             
                       $result[$i]["markFirstHalf"] = $temp[5];  
                       $result[$i]["letterGrade"] = $temp[6];  
                       $result[$i]["gradePoint"] = $temp[7];  
                       $result[$i]["cgpa"] = $temp[8];  
                       $result[$i]["tra_term"] = $temp[9];  
                       $result[$i]["tra_year"] = $temp[10];  
                       $result[$i]["emr_mark"] = $temp[11]; 
                       
                  
                      $pos++;
                      
                }
            }
                         
        }
    /*for($i = 1; $i<=count($result); $i++)
            {
            echo $result[$i]["mod_group"].'</br>';
    }
    exit();*/
    yii::app()->session['term'] = $result[1]['tra_term'];
    yii::app()->session['year'] = $result[1]['tra_year'];
    yii::app()->session['group']= $moduleGroup[1];//$result[1]['mod_group'];
    yii::app()->session['semesterResult'] = 0;
    $start =1;
    $limit = 24;
    
    $total = count($result); 
    
    
    $sql = "SELECT DISTINCT tra_term,tra_year FROM vw_transcript WHERE "
            . "vw_transcript.\"studentID\" = '{$sid}';";
    $countTerm = Yii::app()->db->createCommand($sql)->queryAll();
    
    
    
     $sum = 0;
            for($i = 1; $i <= count($result); $i++)
                  {
                    if ($result[$i]['markFirstHalf'] >=23.5 && $result[$i]["emr_mark"]>=15.5)      // ascending order simply changes to <
                        { 
                            
                            
                            $sum = $sum + $result[$i]["mod_creditHour"];
                                                      
                                                      
                        }
                      
                  }
    $completedCredit =$sum;    
   
    $countTerm =3;
    $totalPage = 2;
    
    $totalPage= $totalPage + floor((count($result)/24));
    if(count($result)%24!=0)
         $totalPage= $totalPage + 1;
    
    $end = $limit;
    yii::app()->session['startingPoint'] = $start;
    yii::app()->session['semesterCGPA'] = 0;
    yii::app()->session['totalTerm'] = 0;
    $pdf->AddPage();
    
    $html = $this->renderPartial('_transcriptSummaryPage', array(
                    'pdf'=>$pdf,'model'=>$model,'data'=>$data,'headerData'=>$headerData,'totalPage'=>$totalPage,'completedCredit'=>$completedCredit,
        ), true);
    $pdf->writeHTML($html, true, false, false, false, '');  
    
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->SetLineWidth(0.1);

    $left_column= "Page 1 of ".($totalPage);
    $pdf->writeHTMLCell(200, '', 5, 265, $left_column, 0, 1, 1, true, 'C', true); 
    //$left_column= "[The Official Transcript Prefixes MU Grading System which forms an integral part of the process of assessment]";
    //$pdf->writeHTMLCell(200, '', 5, 249, $left_column, 0, 1, 1, true, 'C', true); 

   // $left_column= "This document is not valid unless it is embossed with the official seal of Metropolitan University";
   // $pdf->writeHTMLCell(200, '', 5, 253, $left_column, 0, 1, 1, true, 'C', true);          

    $pdf->AddPage();
    $html = $this->renderPartial('_transcriptGradingPage', array(
                    'pdf'=>$pdf,'model'=>$model,'data'=>$data,
        ), true);
    $pdf->writeHTML($html, true, false, false, false, '');
    $left_column= "Page 2 of ".($totalPage);
    $pdf->writeHTMLCell(200, '', 5, 265, $left_column, 0, 1, 1, true, 'C', true); 
 $start = 1;
 $end = count($result);
 yii::app()->session['groupModuleCount'] = 1;
 if($end>24) $end = 24;   
 $i=3;
 do
 {
    $pdf->AddPage();  
    $view = $this->renderPartial('_transcriptMainPage',array('pdf'=>$pdf,'model'=>$model,'moduleGroup'=>$moduleGroup,'result'=>$result,'start'=>$start,'end'=>$end,'total'=>$total,'headerData'=>$headerData,),true);
    $pdf->writeHTML($view, true, false, false, false, '');
    if($end!=count($result)){
        $left_column= "Page ".$i++." of ".($totalPage);
        $pdf->writeHTMLCell(200, '', 5, 265, $left_column, 0, 1, 1, true, 'C', true); 
    }
    $start = $end + 1;
    $end = $start + 23;
    
    if($end>=count($result))
    {
        $end = count($result);
       
    }
    
    
    
 }while($start<$end);

     ?>
    
        <?php 
        $creditHour = 0;
        $gp = 0;
        for ($j=1; $j <= count($result) ; $j++)
        {
         
              $creditHour = $creditHour + $result[$j]["mod_creditHour"];                             
              $gp = $gp + $result[$j]["cgpa"];  

         }
                    
        $CGPA =   round($gp/$creditHour,2);
             
        $page = $this->renderPartial('_transcriptCGPA',array('pdf'=>$pdf,'model'=>$model,'data'=>$data,'start'=>$start,'end'=>$end,'headerData'=>$headerData,'CGPA'=>$CGPA,'completedCredit'=>$completedCredit,),true);
        $pdf->writeHTML($page, true, false, false, false, '');
     
        $left_column= "Page ".$i++." of ".($totalPage);
        $pdf->writeHTMLCell(200, '', 5, 265, $left_column, 0, 1, 1, true, 'C', true); 
    
/*$html = $this->renderPartial('_transcriptBackPage', array(
                                'pdf'=>$pdf,
                    ), true);
                $pdf->writeHTML($html, true, false, false, false, '');*/
        ?>






