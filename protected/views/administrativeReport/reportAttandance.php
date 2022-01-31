<?php
/* @var $this AdmissionController */
/* @var $model Admission */

$this->breadcrumbs=array(
	'Registry'=>array('site/registry'),
        'Administrative Report'=>array('administrativeReport/index'),
        'All Admission'
	
);

$this->menu=array(
	array('label'=>'AdmissionReport', 'url'=>'#','active'=>true),
	
);
?>

<?php  

$this->widget('bootstrap.widgets.TbButtonGroup', array(
    'buttons'=>array(
                array('label'=>'Print', 'url'=>array('administrativeReport/AttandancePDF'),'htmlOptions'=>array('target'=>'blank','class'=>'btn btn-medium btn-success',)),
                
            )
        )
     );
?>

<?php 
$this->widget('bootstrap.widgets.TbGroupGridView', array(
	'id'=>'school-grid',
        'type' => 'striped',
        'enablePagination' => true,
        'responsiveTable' => true,
	'dataProvider'=>$dataProvider,
	'filter'=>$model,
	'columns'=>array(
		
		'studentID',
                'per_title',
                'per_firstName',
                'per_lastName',
		'per_name',
                'per_fathersName',
                'per_dateOfBirth',
		'per_bloodGroup' ,
                'per_mobile',
                'adm_date',     
       
    )
    
    
)); 
?>

