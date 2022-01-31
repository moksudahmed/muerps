
<div id="success" class="span-24"> 

	
    
<div class="span-16">

<?php  
$this->widget('bootstrap.widgets.TbButtonGroup', array(
    'buttons'=>array(
                
                array('label'=>'Advised Terms',  'url'=>array('admittedTerms','flag'=>1),'htmlOptions'=>array('class'=>'btn btn-medium ',)),
                array('label'=>'Course Advising', 'url'=>array('modulesToBeAdvisied'),'htmlOptions'=>array('class'=>'btn btn-medium ',)),
                array('label'=>'Advisied Courses'.' ('.yii::app()->session['totalCourse'].')', 'url'=>array('SelectedCourses'),'htmlOptions'=>array('class'=>'btn btn-medium ',)),
                array('label'=>'Special Retake',  'url'=>array('SpecialRetake'),'htmlOptions'=>array('class'=>'btn btn-medium ',)),        
                array('label'=>'Special Course',  'url'=>'#','htmlOptions'=>array('class'=>'btn btn-medium btn-danger',)),
                //array('label'=>'Registered Courses', 'url'=>array('RegisteredCourse'),'htmlOptions'=>array('class'=>'btn btn-medium ',)),
               // array('label'=>'Previous Record', 'url'=>array('GetPreviousRecordOf','id'=>yii::app()->session['studentID']),'htmlOptions'=>array('class'=>'btn btn-medium ',)),
                
                //array('label'=>'Modules Need to Retake',  'url'=>array('moduleRegistration/needToRetake'),'htmlOptions'=>array('class'=>'btn btn-medium ',)),
            )
        )
     );
?>
</div>
    <div class="span-6">
            <?php 
            $this->widget('bootstrap.widgets.TbMenu', array(
                    'type'=>'pills',
                    'items'=>array(
                            array('label'=>'Back', 'icon'=>'icon-arrow-left' , 'url'=>Yii::app()->controller->createUrl('termAdvising/index'), 'linkOptions'=>array('data-toggle'=>'tooltip','data-placement'=>'top', 'title'=>'Term Advising',), 'visible'=>true),	
                            array('label'=>'Invoice', 'icon'=>'icon-download', 'url'=>Yii::app()->controller->createUrl('invoicePDF'), 'linkOptions'=>array('target'=>'_blank'), 'visible'=>true),
                            array('label'=>'Admit Card', 'icon'=>'icon-print', 'url'=>Yii::app()->controller->createUrl('examRegistration/generateAdmitCardPDF',array('traID'=>yii::app()->session['termAdmissionID'])), 'linkOptions'=>array('target'=>'_blank'), 'visible'=>true),
                            array('label'=>'Academic Record', 'icon'=>'icon-download', 'url'=>Yii::app()->controller->createUrl('ExamDepartment/AcademicRecord',array('studentID'=>yii::app()->session['studentID'])), 'linkOptions'=>array('target'=>'_blank'), 'visible'=>true),
                    ),
            ));

            ?>
        </div>
    <div class="span-24">
        <h5 >Syllabus Version:<?php echo yii::app()->session['sylCode'];  ?></h5>
            <h5>
                             <?php if (Yii::app()->user->hasFlash('success')):?>
                                    <div class="alert in alert-block fade alert-success span-20">
                                      <button type="button" class="close" data-dismiss="alert">&times;</button>
                                      <?php echo Yii::app()->user->getFlash('success')?>
                                    </div>
                            <?php endif;?>
            </h5>
                    
            
    </div>
    <div class="span-24">
        
            <div class="form">
<?php // echo var_dump($dataProvider); exit(); ?>
            <?php $form=$this->beginWidget('CActiveForm', array(
                    'id'=>'specialCourse',
                    'enableAjaxValidation'=>true,
                //'action'=>CController::createUrl('TermAdvising/SpecialCourse'),
            )); ?>




                    

                   
                <div id="newModule">
                    <div class="row">
                        <strong>Programme:</strong><br/>
                            <?php //echo $form->labelEx($admission,'programmeCode'); ?>
                            <?php echo CHtml::dropDownList('programmeCode','programmeCode', CHtml::listData(FormUtil::getProgrammeByGroupByDepartmentID(yii::app()->session['MainDepartmentID']),
                               'programmeCode','pro_name','group'),array(
                                    'prompt' => '--Select Programme--',
                                    'value' => '0',
                                   'class'=>'span-20',
                                   'style'=>'font-size:20px; height:40px;',
                                    'required'=>true,
                                'ajax' => array(
                                'type'=>'POST', //request type
                                'url'=>CController::createUrl('getSepcialCourse'), //url to call.
                                //Style: CController::createUrl('currentController/methodToCall')
                                'update'=>'#offeredModuleID', //selector to update
                                //'data'=>'js: $(this).val()' 
                                //leave out the data key to pass all form values through
                                )));?>
                            <?php //echo $form->error($admission,'programmeCode'); ?>
                    </div>


                <div class="row" >
                <strong>New Offered Course:</strong><br/>	
                            <?php echo CHtml::dropDownList('offeredModuleID','offeredModuleID',array(),array(
                                'prompt' => '--Select  Programme First--',
                                    'value' => '0',
                                'class'=>'span-20',
                                   'style'=>'font-size:20px; height:40px;',
                                    'required' => true,

                                 ));?>

                            <?php // echo $form->error($admission,'batchName'); ?>
                    </div>
                </div>
                    <div class="row buttons">
                            <?php echo CHtml::submitButton('Submit' , array('class' => 'btn btn-primary btn-large','data-loading-text'=>'Loading....')); ?>
                    </div>

            <?php $this->endWidget(); ?>


    </div>
        
        <script type="text/javascript">
    
    
            //---------------
            $( "#specialCourse").on( "submit", function()
            {

                if($("#offeredModuleID").val()==0)
                {
                    alert('Plsease Select a Course!!');
                    return false;
                }    
                else return true;


            } );
   </script>