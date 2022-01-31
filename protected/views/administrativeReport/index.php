<?php
/* @var $this AdministrativeReportController */

$this->breadcrumbs=array(
   'Registry'=>array('site/registry'),
    
	'Administrative Report'=>array('index'),	
);

?>

<?php 
$this->widget('zii.widgets.jui.CJuiAccordion',array(
    'panels'=>array(  
       
       
        'Admission Reports'=>$this->renderPartial('_allAdmissionForm',null,true,true),
        'Attendance'=>$this->renderPartial('_formPrintAttendance',null,true,true),
        'Yearly Student Admission Report'=>$this->renderPartial('_formYearlyReport',null,true,true),
        'Yearly Student Admission Report Term Wise'=>$this->renderPartial('_formYearlyReportTermwise',null,true,true),
        'Term wise New Student Admission Report'=>$this->renderPartial('_formTermwiseReport',null,true,true),
        'Yearly Admission Report Graph'=>$this->renderPartial('_formYearlyReportGraph',null,true,true),
        'Yearly Program wise Admission Report Graph'=>$this->renderPartial('_formYearlyProgramwiseReportGraph',null,true,true),
        'Report By Institution'=>$this->renderPartial('_formAdmittedStudentByInstitution',null,true,true),
        'Students Consecutive CGPA 4.00'=>$this->renderPartial('_formStudentsConsecutiveCGPA',null,true,true),
        'Students Consecutive CGPA Less Than 2.00'=>$this->renderPartial('_formStudentsConsecutiveCGPALessThan2',null,true,true),
        'Copy Institute'=>$this->renderPartial('_formCpuInstitute',null,true,true),
        'Update Institute Name'=>$this->renderPartial('_formUpdateInstitute',null,true,true),
        'Batchwise Total Student List'=>$this->renderPartial('_formBatchwiseTotalStudent',null,true,true),        
        'Batchwise Student Mobile No'=>$this->renderPartial('_formGenerateMobileNo',null,true,true),
        'Khondkar Mahmudur Rahman Scholarship'=>$this->renderPartial('_formMahmudurRahmanScholarship',null,true,true),
        
    ),
    // additional javascript options for the accordion plugin
    'options'=>array(
        'animated'=>'bounceslide',
        'style'=>array('minHeight'=>'200'),
        'autoHeight'=>false,
        'icons'=>array(
            "header"=>"ui-icon-plus",//ui-icon-circle-arrow-e
            "headerSelected"=>"ui-icon-circle-arrow-s",//ui-icon-circle-arrow-s, ui-icon-minus
        ),
        
    ),
    'htmlOptions'=>array('class'=>'time_cell'),
        
    
));
?>
