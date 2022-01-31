<?php
/* @var $this SyllabusController */
/* @var $model Syllabus */

$this->breadcrumbs=array(
    'Registry'=>array('site/registry'),
	
	'Syllabus'=>array('index'),
	
);

$this->menu=array(
	array('label'=>'List Syllabus', 'url'=>array('index'),'active'=>true),
	array('label'=>'Create Syllabus', 'url'=>array('create')),
);

?>

<?php

    $pro=Programme::model()->findByPk(Yii::app()->session['programmeCode']);

?>



    
  <div class="title">
    <h3>List Syllabus</h3>  
    
    <h4><strong>Programme: </strong> <span  class="label label-success" > <?php  echo  yii::app()->session['programme']; ?></span></h4>
    <h4><strong>Department: </strong> <span  class="label label-important" > <?php  echo  yii::app()->session['department']; ?></span></h4>
   
  
</div>
<hr/>



<?php $this->widget('bootstrap.widgets.TbGroupGridView', array(
	'id'=>'school-grid',
        'type' => 'striped',
        'enablePagination' => false,
        'responsiveTable' => true,
	'dataProvider'=>$model->search($id),
	'filter'=>$model,
	'columns'=>array(
		'syllabusCode',
		'programmeCode',
		'syl_version',
                'syl_maxCreditHour',
                'syl_minMonth',
		'syl_startTerm',
		'syl_startYear',
                'syl_endTerm',
		'syl_endYear',
		
		
		
		 array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{modules} {view} {update} {print}',
            'buttons'=>array
            (
               'modules' => array
                (
                    'label'=>'Module List',
                    'icon'=>'list white',
                    'url'=>'Yii::app()->createUrl("module/index", array("id"=>$data->syllabusCode))',
                    'options'=>array(
                        'class'=>'btn btn-mini btn-info',
                        'data-toggle'=>'tooltip',
                        
                        
                        
                    ),
                ),
                'view' => array
                (
                    'label'=>'View Details',
                    'icon'=>'search white',
                    'url'=>'Yii::app()->createUrl("syllabus/view", array("id"=>$data->syllabusCode))',
                    'options'=>array(
                        'class'=>'btn btn-mini btn-success',
                        'data-toggle'=>'tooltip',
                        
                    ),
                ),
                'update' => array
                (
                    'label'=>'Edit Info',
                    'icon'=>'pencil white',
                    'url'=>'Yii::app()->createUrl("syllabus/update", array("id"=>$data->syllabusCode))',
                    'options'=>array(
                        'class'=>'btn btn-mini btn-warning',
                        'data-toggle'=>'tooltip',
                        
                        
                        
                    ),
                ),
                'print' => array
                (
                    'label'=>'print syllabus',
                    'icon'=>'print white',
                    'url'=>'Yii::app()->createUrl("syllabus/print", array("id"=>$data->syllabusCode))',
                    'options'=>array(
                        'class'=>'btn btn-mini btn-inverse',
                        'data-toggle'=>'tooltip',
                        
                        
                        
                    ),
                ),
                
            ),
            'htmlOptions'=>array(
                'style'=>'width: 220px; ',
                'class'=>'moreButtons',
                
            ),
     ),
	),
)); ?>

