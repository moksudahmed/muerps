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
                            <th colspan=\"4\">Metropolitan University, Sylhet, Bangladesh </th>

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
    $sql= "select * from vw_transcript  where \"studentID\"='{$sid}' ORDER BY
            tra_year,tra_term,\"moduleCode\";"; 
       
    
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
    
    $result = FormUtil::CheckRetakeSupplyResult($result,$resultRetake);
    
    yii::app()->session['term'] = $result[1]['tra_term'];
    yii::app()->session['year'] = $result[1]['tra_year'];
    yii::app()->session['semesterResult'] = 0;
    $start =1;
    $limit = 3;
    
    $total = count($result); 
    $sql = "SELECT DISTINCT tra_term,tra_year FROM vw_transcript WHERE "
            . "vw_transcript.\"studentID\" = '{$sid}';";
    $countTerm = Yii::app()->db->createCommand($sql)->queryAll();
    
    //$completedCredit = FormUtil::countCompletedCredit($result);
    
     $sum = 0;
            for($i = 1; $i <= count($result); $i++)
                  {
                    if ($result[$i]['markFirstHalf'] >=23.5 && $result[$i]["emr_mark"]>=15.5)      // ascending order simply changes to <
                        { 
                            
                            
                            $sum = $sum + $result[$i]["mod_creditHour"];
                                                      
                                                      
                        }
                      
                  }
       $completedCredit =$sum;    
    if(count($countTerm)<3)
    {
         $limit =count($countTerm);
         $totalPage = 1;
    }
    else
    {
        $totalPage = floor(count($countTerm) / 3);
        if(count($countTerm) %3 !=0)
        {
            $totalPage = $totalPage + 1;

        }
    } 
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

    $left_column= "[The Official Transcript Prefixes MU Grading System which forms an integral part of the process of assessment]";
    $pdf->writeHTMLCell(200, '', 5, 249, $left_column, 0, 1, 1, true, 'C', true); 

    $left_column= "This document is not valid unless it is embossed with the official seal of Metropolitan University";
    $pdf->writeHTMLCell(200, '', 5, 253, $left_column, 0, 1, 1, true, 'C', true);          

    $pdf->AddPage();
    $html = $this->renderPartial('_transcriptGradingPage', array(
                    'pdf'=>$pdf,'model'=>$model,'data'=>$data,
        ), true);
    $pdf->writeHTML($html, true, false, false, false, '');
    $left_column= "Page 1 of ".($totalPage+1);
    $pdf->writeHTMLCell(200, '', 5, 265, $left_column, 0, 1, 1, true, 'C', true); 
 
    
     ?>
    <div>
        <span style="min-width: 600px; float: left;"><strong><?php //echo $group['mod_group'] ?></strong></span>

        <div style="min-width: 600px; float: left;">
            
            <?php 


              for($i=1;$i<=$totalPage; $i++)
              {
                $pdf->AddPage();  
                
                if($i==0)
                {
                    $html = $this->renderPartial('_transcriptHeaderPage1', array(
                        'pdf'=>$pdf,'model'=>$model,'data'=>$data,'headerData'=>$headerData,
                        ), true);
                    $pdf->writeHTML($html, true, false, false, false, '');
                 }
                 else
                 {
                     $html = $this->renderPartial('_transcriptHeaderPage2', array(
                        'pdf'=>$pdf,'model'=>$model,'data'=>$data,'headerData'=>$headerData,
                        ), true);
                    $pdf->writeHTML($html, true, false, false, false, '');
                 }
                
                $view = $this->renderPartial('_transcriptMainPage',array('pdf'=>$pdf,'model'=>$model,'result'=>$result,'start'=>$start,'end'=>$end,'total'=>$total,'headerData'=>$headerData,),true);
                $pdf->writeHTML($view, true, false, false, false, '');
               
                if($end ==count($countTerm))// && $headerData[0]['sum']>=$headerData[0]['syl_maxCreditHour'])
                {
                    
                    $sql= "select sum(\"cgpa\") as gp, sum(\"mod_creditHour\") as credit from vw_transcript  where \"studentID\"='{$sid}'";                     
                    $data = Yii::app()->db->createCommand($sql)->queryAll();
                    $CGPA =   round($data[0]['gp']/$data[0]['credit'],2);
                    $page = $this->renderPartial('_transcriptCGPA',array('pdf'=>$pdf,'model'=>$model,'data'=>$data,'start'=>$start,'end'=>$end,'headerData'=>$headerData,'CGPA'=>$CGPA,'completedCredit'=>$completedCredit,),true);
                    $pdf->writeHTML($page, true, false, false, false, '');
                }
                else
                {
                //    $pdf->writeHTML($fotter_table, true, false, false, false, '');
                }
                //$pdf->writeHTML("[The Official Transcript Prefixes MU Grading System which forms an integral part of the process of assessment]", true, false, false, false, '');

                $pdf->SetTextColor(0, 0, 0);
                $pdf->SetFillColor(255, 255, 255);
                $pdf->SetLineWidth(0.1);

                $left_column= "[The Official Transcript Prefixes MU Grading System which forms an integral part of the process of assessment]";
                $pdf->writeHTMLCell(200, '', 5, 249, $left_column, 0, 1, 1, true, 'C', true); 

                $left_column= "This document is not valid unless it is embossed with the official seal of Metropolitan University";
                $pdf->writeHTMLCell(200, '', 5, 253, $left_column, 0, 1, 1, true, 'C', true); 
                
                $left_column= "Page ".($i+1)." of ".($totalPage+1);
                $pdf->writeHTMLCell(200, '', 5, 265, $left_column, 0, 1, 1, true, 'C', true); 
                
                $start = $end+1;
                $end = $end + $limit;
                if($end>count($countTerm)) $end = count($countTerm);
                
                // Print Backpage Instruction //////////
                //$pdf->AddPage();
                /*$html = $this->renderPartial('_transcriptBackPage', array(
                                'pdf'=>$pdf,
                    ), true);
                $pdf->writeHTML($html, true, false, false, false, '');*/
                ///////////////////////////////////////////////////////////////    

              }
              


            ?>
        </div>
    </div>
        <?php 

        ?>






