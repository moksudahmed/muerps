
<div id="success" class="span-24"> 

	
    
<div class="span-16">

<?php  
$this->widget('bootstrap.widgets.TbButtonGroup', array(
    'buttons'=>array(
                
                array('label'=>'Advised Terms',  'url'=>array('admittedTerms','flag'=>1),'htmlOptions'=>array('class'=>'btn btn-medium ',)),
                array('label'=>'Course Advising', 'url'=>array('modulesToBeAdvisied'),'htmlOptions'=>array('class'=>'btn btn-medium ',)),
                array('label'=>'Advisied Courses'.' ('.yii::app()->session['totalCourse'].')', 'url'=>array('SelectedCourses'),'htmlOptions'=>array('class'=>'btn btn-medium ',)),
                array('label'=>'Special Retake',  'url'=>'#','htmlOptions'=>array('class'=>'btn btn-medium btn-danger',)),
                array('label'=>'Sepcial Course',  'url'=>array('SpecialCourse'),'htmlOptions'=>array('class'=>'btn btn-medium ',)),                
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
                    'id'=>'SpecilaRetake',
                    'enableAjaxValidation'=>true,
                //'action'=>CController::createUrl('TermAdvising/SuppleModuleMarksList'),
            )); ?>



                    <?php 

                    //$models = Programme::model()->findAll();



                    ?>


                    

                    <div class="row">
                    <strong>Retake Course:</strong><br/>
                            <?php  echo CHtml::dropDownList('retakeCourse',null, $dataProvider, 
                                array('prompt' => '--Please Select --',
                                    'value' => '0',
                                    'class'=>'span-20',
                                   'style'=>'font-size:20px; height:40px;',
                                    ));  ?>
                    </div>
                    <div class="row">
                    <strong><?php echo CHtml::encode("Supervisory Mode:"); ?></strong>
                        <?php echo CHtml::checkBox('previousOfferedModuleID',null, array('value'=>1, 'uncheckValue'=>0)); ?>

                    </div>
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
                                'url'=>CController::createUrl('getSepcialRetakeCourse'), //url to call.
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
            $( "#previousOfferedModuleID").on( "click", function()
            {


            if ( $(this).prop('checked') ){
                $("#newModule").hide('slow');
                $("#programmeCode").attr('required',false);
                $("#programmeCode").val('');
                $("#offeredModuleID").attr('required',false);
                $("#offeredModuleID").val('');
            }
            else 
                {
                    $("#newModule").show('slow');
                    $("#programmeCode").attr('required',true);
                    $("#offeredModuleID").attr('required',true);
                }


            } );
   </script>