<?php
/* @var $this ModuleRegistrationController */
/* @var $model ModuleRegistration */
if($flag)
{
$this->breadcrumbs=array(
    'Student Administration'=>array('admission/studentAdministration'),
	'Exam Registration'=>array('examRegistration/index'),
        
	'Registered Modules',
	
);

$this->menu=array(
	array('label'=>'List ModuleRegistration', 'url'=>array('index')),
	array('label'=>'Create ModuleRegistration', 'url'=>array('create')),
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
        'Registred Modules'
);

$this->menu=array(
    array('label'=>'Student Administration', 'url'=>array('studentAdministration')),
	array('label'=>'List Student', 'url'=>array('index'),'active'=>true),
	array('label'=>'New Admission', 'url'=>array('create','flag'=>true)),
);
}

?>


<div class="title span-22">
            <h3 class="span-12">Exam Registration<br/>
                <strong>ID:</strong><span class="label label-info"><?php echo yii::app()->session['exrStudentID']; ?> </span><br/>
                <strong>Name: </strong> <span class="label label-success "><?php  echo yii::app()->session['exrStudentName']; ?></span>
            </h3>
            <h5><strong>Section: </strong><span class="label label-important"> <?php echo yii::app()->session['exrSecName']; ?></span><strong>Batch: </strong><span class="label label-success"> <?php echo yii::app()->session['exrBatName'].FormUtil::getBatchNameSufix(yii::app()->session['exrBatName']); ?>  </span></h5>
            <h6><strong>Academic Term: </strong><span class="label label-info"><?php echo FormUtil::getTerm(yii::app()->session['exrAcTerm']); ?> </span><span class="label label-success"> <?php echo yii::app()->session['exrAcYear'];  ?></span></h6>        
            
</div>
<div class="title span-4">
    <h4><span class="label label-warning"><?php echo FormUtil::getTerm(yii::app()->session['exrTerm']); ?> </span><span class="label label-success"> <?php echo yii::app()->session['exrYear'];  ?></span><strong style="letter-spacing:3px;">Selected Term </strong></h4>
    <h6>Programme:<?php  echo DBhelper::getProgrammeByCode(yii::app()->session['exrProCode']); ?></h6>
</div>
<hr/>


<?php $this->renderPartial($view,array('model'=>$model,'dataProvider'=>$dataProvider,'flag'=>$flag)); ?>

