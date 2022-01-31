<?php 
$pdf->AddPage();                 
$html = $this->renderPartial('_admissionDetailsPDF', array(                           
                            'admission'=>$admission,
                            'student'=> $student,                            
                            'person'=>$person,  
                            'pdf'=>$pdf,
                        ), true);
$pdf->writeHTML($html, true, false, false, false, '');
 $pdf->AddPage();                
$html = $this->renderPartial('_acdemicHistoryPDF', array(                         
                            'admission'=>$admission,
                            'student'=> $student,                            
                            'person'=>$person,  
                            'pdf'=>$pdf,
                        ), true);
 $pdf->writeHTML($html, true, false, false, false, '');

 /*$html = $this->renderPartial('_admissionOthersInfomationPDF', array(                           
                            'admission'=>$admission,
                            'student'=> $student,                            
                            'person'=>$person,  
                            'pdf'=>$pdf,
                        ), true);
$pdf->writeHTML($html, true, false, false, false, ''); */
 $html = $this->renderPartial('_referesAndAgreementPDF', array(                                                     
                            'pdf'=>$pdf,
                        ), true);
 $pdf->writeHTML($html, true, false, false, false, '');
 
?>             
