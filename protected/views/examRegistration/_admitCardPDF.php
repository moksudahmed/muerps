<?php
  $count = count($model);
  $page = 1;
  if($count)
  {
  foreach($model as $row):
      if($page<=$count)
      {
          
         $pdf->AddPage();
         $html = $this->renderPartial('_admitCardStudentPartPDF', array(
                                        'pdf'=>$pdf,'model'=>$model,'proCode'=>$proCode,'batName'=>$batName,'exmTerm'=>$exmTerm,'exmYear'=>$exmYear,'exmType'=>$exmType,'row'=>$row,
                                ), true);
         $pdf->writeHTML($html, true, false, true, false, '');

         $html = $this->renderPartial('_admitCardCounterPartPDF', array(
                                        'pdf'=>$pdf,'model'=>$model,'proCode'=>$proCode,'batName'=>$batName,'exmTerm'=>$exmTerm,'exmYear'=>$exmYear,'exmType'=>$exmType,'row'=>$row,
                                ), true);
         $pdf->writeHTML($html, true, false, true, false, '');

        
      }
         $page++;
  endforeach; 
  }
     else
      {
          echo 'Admit card and Signature sheet has not generated yet for this batch.';
          exit();
      }
   
  ?>
