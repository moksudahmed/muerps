<?php
/* @var $this ModuleRegistrationController */
/* @var $model ModuleRegistration */
if($flag)
{
$this->breadcrumbs=array(
    'Student\'s Info'=>array('admission/studentsInfo'),
	'Term Advising'=>array('termAdvising/index'),
        'Admitted Terms' =>array('termAdvising/admittedTerms'),
	'Previous Record',
	
	
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
        'Registred Course'
);


}

?>


<div class="title span-18">
            <h3 >Term Advising<br/>
                <strong>ID:</strong><span class="label label-info"><?php echo yii::app()->session['studentID']; ?> </span><br/>
                <strong>Name: </strong> <span class="label label-success "><?php  echo yii::app()->session['studentName']; ?></span>
            </h3>
            <!--h5><strong>Section: </strong><span class="label label-important"> <?php echo yii::app()->session['secName']; ?></span><strong>Batch: </strong><span class="label label-success"> <?php echo yii::app()->session['batName'].FormUtil::getBatchNameSufix(yii::app()->session['batName']); ?>  </span></h5-->
            <h6><strong>Semester: </strong><span class="label label-info"><?php echo FormUtil::getTerm(yii::app()->session['acTerm']); ?> </span><span class="label label-success"> <?php echo yii::app()->session['acYear'];  ?></span></h6>        
            
</div>
<div class="title span2">
    <h4>
        <span class="label label-info"><?php    echo     FormUtil::getTermNumberWithSufix(yii::app()->session['batName'],yii::app()->session['proCode'],yii::app()->session['traTerm'],yii::app()->session['traYear']); ?></span>
        <span class="label label-warning"><?php echo FormUtil::getTerm(yii::app()->session['traTerm']); ?> </span><span class="label label-success"> <?php echo yii::app()->session['traYear'];  ?></span><strong style="letter-spacing:3px;">Selected Term </strong></h4>
    <h6>Programme:<?php  echo DBhelper::getProgrammeByCode(yii::app()->session['proCode']); ?></h6>
</div>
<hr/>


<?php $this->renderPartial($view,array('model'=>$model,'dataProvider'=>$dataProvider,'flag'=>$flag)); ?>

