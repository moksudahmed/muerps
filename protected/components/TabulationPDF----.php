<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TabulationPDF
 *
 * @author ron
 */
require_once(Yii::app()->params['tcpdf']);
require_once(Yii::app()->params['tcpdfConf']);
// Extend the TCPDF class to create custom Header and Footer
class TabulationPDF extends TCPDF {
        
    public function Header() 
    {
            // Logo
            $image_file = K_PATH_IMAGES.'demo.jpg';
            $this->Image($image_file, 10, 5, 50, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
            // Set font
            $this->SetFont('helvetica', 'B', 20);
            // Title
           // $this->Cell(0, 15, 'Tabulation Sheet', 0, false, 'L', 0, '', 0, false, 'M', 'M');
            //$this->Cell(0, 10, 'Summer Term Final Exam', 0, false, 'R', 0, '', 0, false, 'M', 'M');
            $txt = 'Tabulation Sheet';
            // Multicell test
            $this->MultiCell(100, 10, $txt, 0, 'L', 0, 1, 70,10, true);
            $this->SetFont('helvetica', 'B', 10);
            $this->MultiCell(180, 0, FormUtil::getTerm(yii::app()->session['reTerm']).' '.' Term '.FormUtil::getExamType(yii::app()->session['examinationID']).' Examination'.'-'.' '.yii::app()->session['reYear'], 0, 'L', 0, 1, 140, 5, true);
            $this->MultiCell(180, 10, 'Programme: '.DBhelper::getProgrammeNameById(yii::app()->session['reProCode']), 0, 'L', 0, 1, 140, 10, true);
            $this->MultiCell(180, 10, FormUtil::getTermNumberWithSufix(yii::app()->session['reBatName'], yii::app()->session['reProCode'], yii::app()->session['reTerm'], yii::app()->session['reYear']) , 0, 'L', 0, 1, 140,15, true);
            $this->MultiCell(100, 10, 'Batch No: '.yii::app()->session['reBatName'].FormUtil::getBatchNameSufix(yii::app()->session['reBatName']).'          '.'Academic Year: '.FormUtil::getTerm(yii::app()->session['reAcTerm']).' '.yii::app()->session['reAcYear'], 0, 'L', 0, 1, 140,20,true);
           // $this->MultiCell(100, 10, 'Academic Year: '.FormUtil::getTerm(yii::app()->session['reAcTerm']).' '.yii::app()->session['reAcYear'], 0, 'L', 0, 1, 140,25,true);       
            ;
                    
    }
    // Page footer
     public function Footer() 
     {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
     }
}



?>
