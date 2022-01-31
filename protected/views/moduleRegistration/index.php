<?php
/* @var $this ModuleRegistrationController */
/* @var $model ModuleRegistration */
if($flag)
{
$this->breadcrumbs=array(
    'Student\'s Info'=>array('admission/studentsInfo'),
	'Term Admission'=>array('termAdmission/index'),
        'Admitted Terms' =>array('termAdmission/termAdmission'),
	'Course Registration',
	
);


}
else
{
    $this->breadcrumbs=array(
	'Registry'=>array('site/registry'),
	
    
     'Batch'=>array('Batch/index'),
    'Sections'=>array('Section/index'),
    'Admitted Terms'=>array('termAdmission/termsBySection'),
	'List Student'=>array('termAdmission/studentList'),
        'Registred Course'
);

$this->menu=array(
    array('label'=>'Student Administration', 'url'=>array('studentAdministration')),
	array('label'=>'List Student', 'url'=>array('index'),'active'=>true),
	array('label'=>'New Admission', 'url'=>array('create','flag'=>true)),
);
}

?>


<div class="title span-18">
            <h3 >Course Registration</h3>
            <h4>ID:<span class="label label-info"><?php echo yii::app()->session['studentID']; ?> </span></h4>
            <h4>    Name:  <span class="label label-success "><?php  echo yii::app()->session['studentName']; ?></span></h4>
            
            <h4> <?php echo FormUtil::getBatchTermHTMLspan(yii::app()->session['secName'], yii::app()->session['batName'], yii::app()->session['proCode'])  ?></h4>
            <h4><strong>Academic Term: </strong><span class="label label-info"><?php echo FormUtil::getTerm(yii::app()->session['acTerm']); ?> </span><span class="label label-success"> <?php echo yii::app()->session['acYear'];  ?></span></h4>        
            
</div>
<div class="title span2">
    <h4><span class="label label-warning"><?php echo FormUtil::getTerm(yii::app()->session['traTerm']); ?> </span><span class="label label-success"> <?php echo yii::app()->session['traYear'];  ?></span><strong style="letter-spacing:3px;">Selected Term </strong></h4>
    <h6>Programme:<?php  echo DBhelper::getProgrammeByCode(yii::app()->session['proCode']); ?></h6>
</div>
<div class="span-8">
            <?php 
            $this->widget('bootstrap.widgets.TbMenu', array(
                    'type'=>'pills',
                    'items'=>array(
                            array('label'=>'Back', 'icon'=>'icon-arrow-left' , 'url'=>Yii::app()->controller->createUrl('termAdmission/index'), 'linkOptions'=>array('data-toggle'=>'tooltip','data-placement'=>'top', 'title'=>'Term Admissioin',), 'visible'=>true),	
                            //array('label'=>'Admit Card', 'icon'=>'icon-download', 'url'=>Yii::app()->controller->createUrl('invoicePDF'), 'linkOptions'=>array('target'=>'_blank'), 'visible'=>true),

                           array('label'=>'Admit Card', 'icon'=>'icon-print', 'url'=>Yii::app()->controller->createUrl('examRegistration/generateAdmitCardPDF',array('traID'=>yii::app()->session['termAdmissionID'])), 'linkOptions'=>array('target'=>'_blank'), 'visible'=>true),
                    ),
            ));

            ?>
        </div>
<hr/>


<?php $this->renderPartial($view,array('model'=>$model,'dataProvider'=>$dataProvider,'flag'=>$flag)); ?>

