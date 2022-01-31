<?php
/* @var $this AcademicHistoryController */
/* @var $model AcademicHistory */

$person =  Person::model()->findByPk($id);
//echo $id;

//echo $person->ex_per_ref;
//exit();
if($person->ex_per_ref=='e')$type='Employee';
elseif($person->ex_per_ref=='s')$type='Student';
elseif($person->ex_per_ref=='f')$type='Faculty';


if($type=='Student')
{
    $this->breadcrumbs=array(
            'Student List'=>array('admission/index','sid'=>yii::app()->session['secName'],'bid'=>yii::app()->session['batName'],'pid'=>yii::app()->session['proCode']),
            'Academic Histories'=>array('index'),

    );
}
elseif($type=='Employee')
{
    $this->breadcrumbs=array(
            'Employee List'=>array('employee/index'),
            'Academic Histories'=>array('index'),

    );
}
elseif($type=='Faculty')
{
    $this->breadcrumbs=array(
            'Faculty List'=>array('faculty/index'),
            'Academic Histories'=>array('index'),

    );
}

$this->menu=array(
	array('label'=>'List AcademicHistory', 'url'=>array('index'),'active'=>true),
	array('label'=>'Create AcademicHistory', 'url'=>array('create')),
);


?>

<div class="title">
    <h3>List Academic History</h3>
    <?php if($type=='Student'):?>
    
        <h4><strong>ID:</strong><span class="label label-info "> <?php echo yii::app()->session['acStudentID']; ?></span></h4>
    <?php endif?>
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


<?php $this->widget('bootstrap.widgets.TbExtendedGridView', array(
        
	'id'=>'academicHistory-grid',
    'type' => 'striped',
    'responsiveTable' => true,
	'dataProvider'=>$model->search($id),
	'filter'=>$model,
    
	'columns'=>array(
           
                
		'ach_degree',
		'ach_group',
		'ach_institution',
		'ach_board',
		'ach_passingYear',
                'ach_result',
            
            
            array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{view} {update}',
            'buttons'=>array
            (
               
                'view' => array
                (
                    'label'=>'View details',
                    'icon'=>'search white',
                    'url'=>'Yii::app()->createUrl("academicHistory/view", array("id"=>$data->academicHistoryID))',
                    'options'=>array(
                        'class'=>'btn btn-mini btn-success',
                        'data-toggle'=>'tooltip',
                        
                        
                        
                    ),
                ),
                'update' => array
                (
                    'label'=>'Edit Info',
                    'icon'=>'pencil white',
                    'url'=>'Yii::app()->createUrl("academicHistory/update", array("id"=>$data->academicHistoryID))',
                    'options'=>array(
                        'class'=>'btn btn-mini btn-warning',
                        'data-toggle'=>'tooltip',
                        
                        
                        
                    ),
                ),
                
            ),
            'htmlOptions'=>array(
                'style'=>'width: 220px; ',
                'class'=>'moreButtons',
                
            ),
     ),   
    )
    
    
)); ?>
