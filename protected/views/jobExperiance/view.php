<?php
/* @var $this JobExperianceController */
/* @var $model JobExperiance */

$person =  Person::model()->findByPk($model->personID);
if($person->ex_per_ref=='e')$type='Employee';
elseif($person->ex_per_ref=='s')$type='Student';
elseif($person->ex_per_ref=='f')$type='Faculty';


if($type=='Student')
{
    $this->breadcrumbs=array(
    'Student List'=>array('admission/index','sid'=>yii::app()->session['secName'],'bid'=>yii::app()->session['batName'],'pid'=>yii::app()->session['proCode']),
	'Job Experiances'=>array('index','id'=>$model->personID),
    'Detailed View',
);
}
elseif($type=='Employee')
{
    $this->breadcrumbs=array(
    'Registry'=>array('site/registry'),
    'Employees'=>array('employee/index'),
        'Job Experiances'=>array('index','id'=>$model->personID),
        'Detailed View',
    );
}
elseif($type=='Faculty')
{
    $this->breadcrumbs=array(
    'Registry'=>array('site/registry'),
    'Faculty'=>array('faculty/index'),
        'Job Experiances'=>array('index','id'=>$model->personID),
	'Detailed View',
	
    );
}




$this->menu=array(
	array('label'=>'List JobExperiance', 'url'=>array('index')),
	array('label'=>'Create JobExperiance', 'url'=>array('create')),
        array('label'=>'Detailed view', 'url'=>'#','active'=>true),
	array('label'=>'Edit JobExperiance', 'url'=>array('update', 'id'=>$model->jobExperianceID)),
	array('label'=>'Delete JobExperiance', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->jobExperianceID),'confirm'=>'Are you sure you want to delete this item?')),
	
);
?>


<div class="title">
    <h3>Detailed View </h3>
<h4><strong><?php echo $type; ?> Name: </strong> <span  class="label label-success" > <?php  echo $person->per_title.' '.$person->per_firstName.' '.$person->per_lastName; ?></span></h4>
<?php
if($person->ex_per_ref=='s')
{?>
    
    <h4><strong>Batch: </strong><span class="label label-success "> <?php echo yii::app()->session['batName'].FormUtil::getBatchNameSufix(yii::app()->session['batName']); ?>  </span><strong>Section: </strong><span class="label label-important"> <?php echo yii::app()->session['secName']; ?></span></h4>
    <h4><strong>Academic Year: </strong><span class="label label-info"><?php  echo FormUtil::getTerm(Batch::model()->findByPk(array('batchName'=>yii::app()->session['batName'],'programmeCode'=>yii::app()->session['proCode']))->bat_term)." ".Batch::model()->findByPk(array('batchName'=>yii::app()->session['batName'],'programmeCode'=>yii::app()->session['proCode']))->bat_year ;  ?></span></h4>
    <h4><strong>Programme: </strong> <span class="label label-info"><?php  echo DBhelper::getProgrammeByCode(yii::app()->session['proCode']); ?></span></h4>
<?php
}
elseif($person->ex_per_ref=='e')
{?>
    <h4><strong>Administrative Department: </strong> <span  class="label label-info" ><?php  echo Administration::model()->findByPk(yii::app()->session['adminCode'])->adm_name; ?></span></h4>
    
<?php
}
elseif($person->ex_per_ref=='f')
{
?>
    <h4><strong>Department: </strong><span  class="label label-info" > <?php  echo Department::model()->findByPk(yii::app()->session['dptID'])->dpt_name; ?></span></h4>
    
<?php
} 
?>
</div>
<hr/>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		
		'joe_employer',
		'joe_address',
		'joe_position',
		'joe_startDate',
		'joe_endDate',
		'joe_contact',
		
	),
)); ?>
