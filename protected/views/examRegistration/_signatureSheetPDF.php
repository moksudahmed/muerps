

<?php
  $count = count($model);
  $page = 1;
  
  foreach($model as $row):
      if($page<=$count)
      {
          
           $pdf->AddPage();
         $html = $this->renderPartial('_signatureSheetStudentDetailsPDF', array(
                                        'pdf'=>$pdf,'model'=>$model,'proCode'=>$proCode,'batName'=>$batName,'secName'=>$secName,'exmTerm'=>$exmTerm,'exmYear'=>$exmYear,'exmType'=>$exmType,'row'=>$row,
                                ), true);
         $pdf->writeHTML($html, true, false, true, false, '');

         $html = $this->renderPartial('_signatureSheetCourseDetailsPDF', array(
                                        'pdf'=>$pdf,'model'=>$model,'proCode'=>$proCode,'batName'=>$batName,'secName'=>$secName,'exmTerm'=>$exmTerm,'exmYear'=>$exmYear,'exmType'=>$exmType,'row'=>$row,
                                ), true);
         $pdf->writeHTML($html, true, false, true, false, '');

        
      }
         $page++;
  endforeach; ?>
