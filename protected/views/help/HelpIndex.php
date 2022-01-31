<?php
/* @var $this RegistryController */

$this->breadcrumbs=array(
        
	'Student\'s Info'=>array('studentsInfo'),
	
);

/*
$this->menu=array(
	array('label'=>'Student ', 'url'=>'#','active'=>true),

);*/
?>
<!--h1><?php echo $this->id . '/' . $this->action->id; ?></h1-->

<div class="title">
<h3>
    Student's Info
    
</h3>
</div>
<br/>

		 <?php if (Yii::app()->user->hasFlash('success')):?>
			<div class="alert in alert-block fade alert-success">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  <?php echo Yii::app()->user->getFlash('success')?>
			</div>
		<?php endif;?>
    
                <?php if (Yii::app()->user->hasFlash('warning')):?>
			<div class="alert in alert-block fade alert-danger">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  <?php echo Yii::app()->user->getFlash('warning')?>
			</div>
		<?php endif;?>



<?php 




if(yii::app()->user->getState('role')==='super-admin')
{
    $panels = array(
            'Student Informatoin'=>$this->renderPartial('_getProgrammeBatch',null,true,true),
            'Term Advising'=>$this->renderPartial('_SupAdminTermAdvising',null,true,true),
            //'Exam Registration'=>$this->renderPartial('_examRegistration',null,true,true),
            'Re-admission (Batch Transfer)'=>$this->renderPartial('_reAdmission',null,true,true),
            // panel 3 contains the content rendered by a partial view
            //'panel 3'=>$this->renderPartial('_form_1',null,true),
            'Term Admission'=>$this->renderPartial('_termAdmission',null,true,true),
            'Term Admission (Adv)'=>$this->renderPartial('_termAdmissionSuperAdv',null,true,true),
            'Retake'=>$this->renderPartial('_SupAdminHFretake',null,true,true),
            'Individual Course Registration'=>$this->renderPartial('_HFindividualCourseReg',null,true,true),
            'Section Transfer'=>$this->renderPartial('_sectionTransferAdv',null,true,true),
            'Generate & Print Admission Register'=>$this->renderPartial('_admissionRegister',null,true,true),
            'Attendance'=>$this->renderPartial('_formPrintAttendance',null,true,true),
        
     );
        
}
elseif(yii::app()->user->getState('role')==='admin')
{
    $panels = array(
            'Student Informatoin'=>$this->renderPartial('_getProgrammeBatch',null,true,true),
            'Term Advising'=>$this->renderPartial('_SupAdminTermAdvising',null,true,true),
            //'Exam Registration'=>$this->renderPartial('_examRegistration',null,true,true),
            //'Re-admission (Batch Transfer)'=>$this->renderPartial('_reAdmission',null,true,true),
            // panel 3 contains the content rendered by a partial view
            //'panel 3'=>$this->renderPartial('_form_1',null,true),
            //'Term Admission'=>$this->renderPartial('_termAdmission',null,true,true),
            //'Retake'=>$this->renderPartial('_SupAdminHFretake',null,true,true),
            //'Individual Course Registration'=>$this->renderPartial('_HFindividualCourseReg',null,true,true),
            //'Section Transfer'=>$this->renderPartial('_sectionTransferAdv',null,true,true),
            'Generate & Print Admission Register'=>$this->renderPartial('_admissionRegister',null,true,true),
            'Attendance'=>$this->renderPartial('_formPrintAttendance',null,true,true),
     );
        
}
elseif(yii::app()->user->getState('role')==='head')
{
    $panels = array(
            
            //'Term Advising'=>$this->renderPartial('_HFtermAdvising',null,true,true),
            'Term Advising'=>$this->renderPartial('_SupAdminTermAdvising',null,true,true),    
            'Student Informatoin'=>$this->renderPartial('_getProgrammeBatch',null,true,true),
            
            //'Exam Registration'=>$this->renderPartial('_examRegistration',null,true,true),
            'Re-admission (Batch Transfer)'=>$this->renderPartial('_reAdmission',null,true,true),
            

            'Term Admission'=>$this->renderPartial('_termAdmission',null,true,true),
            'Retake'=>$this->renderPartial('_SupAdminHFretake',null,true,true),
            'Section Transfer'=>$this->renderPartial('_sectionTransfer',null,true,true),
            
           // 'Generate & Print Admission Register'=>$this->renderPartial('_admissionRegister',null,true,true),
     );
        
}
elseif(yii::app()->user->getState('role')==='coordinator')
{
    $panels = array(
            'Term Advising'=>$this->renderPartial('_SupAdminTermAdvising',null,true,true),    
           // 'Term Advising'=>$this->renderPartial('_HFtermAdvising',null,true,true),
            //'Student Informatoin'=>$this->renderPartial('_getProgrammeBatch',null,true,true),
            
            //'Exam Registration'=>$this->renderPartial('_examRegistration',null,true,true),
            'Re-admission (Batch Transfer)'=>$this->renderPartial('_reAdmission',null,true,true),
            

            'Term Admission'=>$this->renderPartial('_termAdmission',null,true,true),
            //'Retake'=>$this->renderPartial('_HFretake',null,true,true),
            'Section Transfer'=>$this->renderPartial('_sectionTransfer',null,true,true),
            //'Term Advising (Adv)'=>$this->renderPartial('_SupAdminTermAdvising',null,true,true),
           // 'Generate & Print Admission Register'=>$this->renderPartial('_admissionRegister',null,true,true),
     );
        
}
elseif(yii::app()->user->getState('role')==='exam')
{
    
        $panels = array(
            'Retake'=>$this->renderPartial('_HFretake',null,true,true),
            'Term Admission'=>$this->renderPartial('_termAdmission',null,true,true),
            'Term Advising'=>$this->renderPartial('_SupAdminTermAdvising',null,true,true),            
            'Re-admission (Batch Transfer)'=>$this->renderPartial('_reAdmission',null,true,true),
           

            
            
            'Student Informatoin'=>$this->renderPartial('_getProgrammeBatch',null,true,true),
     );
        
}
elseif(yii::app()->user->getState('role')==='faculty')
{
    $panels = array(
             'Term Advising'=>$this->renderPartial('_HFtermAdvising',null,true,true),
            'Student Informatoin'=>$this->renderPartial('_getProgrammeBatch',null,true,true),
            //'Term Admission'=>$this->renderPartial('_termAdmission',null,true,true),
           
           
            
        );
        
}
elseif(yii::app()->user->getState('role')==='admission')
{
    
        $panels = array(
            'Student Informatoin'=>$this->renderPartial('_getProgrammeBatch',null,true,true),
            //'Term Advising'=>$this->renderPartial('_HFtermAdvising',null,true,true),
            'Term Advising'=>$this->renderPartial('_SupAdminTermAdvising',null,true,true),            
//'Exam Registration'=>$this->renderPartial('_examRegistration',null,true,true),
            'Re-admission (Batch Transfer)'=>$this->renderPartial('_reAdmission',null,true,true),
            // panel 3 contains the content rendered by a partial view
            //'panel 3'=>$this->renderPartial('_form_1',null,true),
            //'Section Transfer'=>$this->renderPartial('_sectionTransfer',null,true,true),

            'Term Admission'=>$this->renderPartial('_termAdmission',null,true,true),
            'Term Admission (Adv)'=>$this->renderPartial('_termAdmissionAdv',null,true,true),
            'Generate & Print Admission Register'=>$this->renderPartial('_admissionRegister',null,true,true),
			'Attendance'=>$this->renderPartial('_formPrintAttendance',null,true,true),
        );
        
}

elseif(yii::app()->user->getState('role')==='registry')
{
    
        $panels = array(
           'Student Informatoin'=>$this->renderPartial('_getProgrammeBatch',null,true,true),
            'Term Advising'=>$this->renderPartial('_SupAdminTermAdvising',null,true,true),
            //'Exam Registration'=>$this->renderPartial('_examRegistration',null,true,true),
            'Re-admission (Batch Transfer)'=>$this->renderPartial('_reAdmission',null,true,true),
            // panel 3 contains the content rendered by a partial view
            //'panel 3'=>$this->renderPartial('_form_1',null,true),
            'Term Admission'=>$this->renderPartial('_termAdmission',null,true,true),
            'Retake'=>$this->renderPartial('_SupAdminHFretake',null,true,true),
            'Individual Course Registration'=>$this->renderPartial('_HFindividualCourseReg',null,true,true),
            'Section Transfer'=>$this->renderPartial('_sectionTransferAdv',null,true,true),
            'Generate & Print Admission Register'=>$this->renderPartial('_admissionRegister',null,true,true),
		    'Attendance'=>$this->renderPartial('_formPrintAttendance',null,true,true),             
			 );
        
}
elseif(yii::app()->user->getState('role')==='deo')
{
    
        $panels = array(
            'Student Informatoin'=>$this->renderPartial('_getProgrammeBatch',null,true,true),
            //'Term Advising'=>$this->renderPartial('_HFtermAdvising',null,true,true),
            'Term Advising'=>$this->renderPartial('_SupAdminTermAdvising',null,true,true),            
            'Term Admission (Adv)'=>$this->renderPartial('_termAdmissionSuperAdv',null,true,true),
//'Exam Registration'=>$this->renderPartial('_examRegistration',null,true,true),
           'Re-admission (Batch Transfer)'=>$this->renderPartial('_reAdmission',null,true,true),
            // panel 3 contains the content rendered by a partial view
            //'panel 3'=>$this->renderPartial('_form_1',null,true),
            //'Section Transfer'=>$this->renderPartial('_sectionTransfer',null,true,true),

            'Term Admission'=>$this->renderPartial('_termAdmission',null,true,true),
         //   'Generate & Print Admission Register'=>$this->renderPartial('_admissionRegister',null,true,true),
		 'Attendance'=>$this->renderPartial('_formPrintAttendance',null,true,true),
        );
        
}
else{
    $panels=array();
}



    $this->widget('zii.widgets.jui.CJuiAccordion',array(
        'panels'=>$panels, 
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
