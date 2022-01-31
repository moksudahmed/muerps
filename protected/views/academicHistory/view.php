<?php
/* @var $this AcademicHistoryController */
/* @var $model AcademicHistory */

$person =  Person::model()->findByPk($model->personID);
if($person->ex_per_ref=='e')$type='Employee';
elseif($person->ex_per_ref=='s')$type='Student';
elseif($person->ex_per_ref=='f')$type='Faculty';

if($type=='Student')
{
    $this->breadcrumbs=array(
            'Student List'=>array('admission/index','sid'=>yii::app()->session['secName'],'bid'=>yii::app()->session['batName'],'pid'=>yii::app()->session['proCode']),
            'Academic Histories'=>array('index'),
            'Detailed View'
    );
}
elseif($type=='Employee')
{
    $this->breadcrumbs=array(
            'Employee List'=>array('employee/index'),
            'Academic Histories'=>array('index'),
            'Detailed View'
    );
}
elseif($type=='Faculty')
{
    $this->breadcrumbs=array(
            'Faculty List'=>array('faculty/index'),
            'Academic Histories'=>array('index'),
            'Detailed View'
    );
}

$this->menu=array(
	array('label'=>'List AcademicHistory', 'url'=>array('index')),
	array('label'=>'Create AcademicHistory', 'url'=>array('create')),
        array('label'=>'Detailed View','url'=>'#','active'=>true),
	array('label'=>'Edit AcademicHistory', 'url'=>array('update', 'id'=>$model->academicHistoryID)),
	array('label'=>'Delete AcademicHistory', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->academicHistoryID),'confirm'=>'Are you sure you want to delete this item?')),
	
);
?>


<div class="title">
    <h3>Detailed View</h3>
    <h4><strong>ID:</strong><span class="label label-info "> <?php echo yii::app()->session['acStudentID']; ?></span></h4>
    <h4><strong><?php echo $type; ?> Name: </strong> <span  class="label label-success" > <?php  echo $person->per_title.' '.$person->per_firstName.' '.$person->per_lastName; ?></span></h4>
<?php
if($person->ex_per_ref=='s')
{?>
    
    <h4><strong>Batch: </strong><span class="label label-success "> <?php echo yii::app()->session['batName'].FormUtil::getBatchNameSufix(yii::app()->session['batName']); ?>  </span><strong>Section: </strong><span class="label label-important"> <?php echo yii::app()->session['secName']; ?></span></h4>
    <h4><strong>Academic Year: </strong><span class="label label-warning"><?php  echo FormUtil::getTerm(Batch::model()->findByPk(array('batchName'=>yii::app()->session['batName'],'programmeCode'=>yii::app()->session['proCode']))->bat_term)." ".Batch::model()->findByPk(array('batchName'=>yii::app()->session['batName'],'programmeCode'=>yii::app()->session['proCode']))->bat_year ;  ?></span></h4>
    <h4><strong>Programme: </strong><span class="label label-info"> <?php  echo DBhelper::getProgrammeByCode(yii::app()->session['proCode']); ?></span></h4>
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
		
		'ach_degree',
		'ach_group',
		'ach_institution',
		'ach_board',
		'ach_passingYear',
		'ach_result',
		'ach_remarks',
		
	),
)); ?>
