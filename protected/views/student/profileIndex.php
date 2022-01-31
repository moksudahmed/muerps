<?php
/* @var $this ModuleRegistrationController */
/* @var $model ModuleRegistration */

$this->breadcrumbs=array(
    
	
        'Student Profile',
	
	
);



?>
<br/><br/>
    <div class="title">
            <div class="span-14">
                <h3>Student Profile:</h3>
                <h3><strong>Student ID: </strong> <span class="label label-success"> <?php echo $admission->studentID;  ?></span></h3>
                 <h3><strong>Name: </strong> <span class="label label-info"> <?php echo $person->per_title." ".$person->per_firstName." ".$person->per_lastName; ?></span></h3>
                
                <h4><strong>Section: </strong><span class="label label-important"> <?php echo $admission->sectionName; ?></span><strong>Batch: </strong><span class="label label-success"> <?php echo $admission->batchName.FormUtil::getBatchNameSufix($admission->batchName); ?>  </span></h4>
                
                <h4><strong>Student Academic Year: </strong><span class="label label-info"><?php  echo FormUtil::getTerm($student->stu_academicTerm)." ".$student->stu_academicYear ;  ?></span></h4>
            
            </div>
        <div class="span-6" style="padding:105px 0px 0px 0px;">
            <h6 ><strong>Programme: </strong> <?php  echo DBhelper::getProgrammeByCode($admission->programmeCode); ?></h6>
        <div class="">
            <?php 
            $this->widget('bootstrap.widgets.TbMenu', array(
                    'type'=>'pills',
                    'items'=>array(

                           // array('label'=>'Taken Courses', 'icon'=>'icon-download', 'url'=>Yii::app()->controller->createUrl('student/registeredCourse'), 'linkOptions'=>array(), 'visible'=>true),
                            array('label'=>'Academic Record', 'icon'=>'icon-download', 'url'=>Yii::app()->controller->createUrl('examDepartment/academicRecord',array('studentID'=>$admission->studentID)), 'linkOptions'=>array(), 'visible'=>true),
                            //array('label'=>'Financial Information', 'icon'=>'icon-download', 'url'=>Yii::app()->controller->createUrl('student/FinancialRecord'), 'linkOptions'=>array(), 'visible'=>true),

                    ),
            ));

            ?>
        </div>
        </div>
            <div class="img-polaroid span-4" >
                <?php echo CHtml::image('./photograph/'.$student->studentID.'.jpg',$person->per_title." ".$person->per_firstName." ".$person->per_lastName,array('title'=>$person->per_title." ".$person->per_firstName." ".$person->per_lastName)); ?>
            </div>
                   
     </div>

<hr/>
<?php 

    $this->renderPartial($view, array(
        'admission'=>  Admission::model()->findByAttributes(array('studentID'=>yii::app()->session['studentID']),"ex_adm_active=true"),
                        'student'=> $student,
                        'person'=> Person::model()->findByPk($student->personID)
        
    ))

?>