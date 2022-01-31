<?php
/* @var $this EmployeeController */
/* @var $model Employee */

$this->breadcrumbs=array(
    'Registry'=>array('site/registry'),
    'Faculty'=>array('index'),
	
);

$this->menu=array(
	array('label'=>'List Faculty', 'url'=>array('index','id'=>yii::app()->session['dptID']),'active'=>true),
	array('label'=>'Create Faculty', 'url'=>array('create','flag'=>1)),
);


?>

<div class="title">
    <h3>Faculty List</h3>
    <h4><strong>Department: </strong> <span  class="label label-info" > <?php  echo yii::app()->session['department']; ?></span></h4>
</div>
<hr/>


<?php $this->widget('bootstrap.widgets.TbExtendedGridView', array(
        
	'id'=>'employee-grid',
    'type' => 'striped',
    'responsiveTable' => true,
	'dataProvider'=>$model->search(yii::app()->session['dptID']),
	'filter'=>$model,
    
	'columns'=>array(
                        //'per_title',
                        //'per_firstName',
                        //'per_lastName',
                        array(
'name' => 'per_name',
'value' => '$data->per_name',
//'headerHtmlOptions' => array('style'=>'display:none'),
'htmlOptions' =>array('class'=>'span-8')
),
                        'fac_designation',
    
			'per_bloodGroup' ,
                        'per_mobile',
            'per_email'=>array(
            'class'=>'CLinkColumn',
            'header'=>Yii::t('ui','Email'),
            //'imageUrl'=>CHtml::imageUrl('email.png'),
            'labelExpression'=>'$data->per_email',
            'urlExpression'=>'"mailto://".$data->per_email',
            'htmlOptions'=>array('style'=>'text-align:center'),
        ),
            
  
            
            
            array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{ac} {je} {view} {update} {print_act}',
            'buttons'=>array
            (
                'ac' => array
                (
                    'label'=>'Academic History',
                    'icon'=>'certificate white',
                    'url'=>'Yii::app()->createUrl("academicHistory", array("id"=>$data->personID))',
                    'options'=>array(
                        'class'=>'btn btn-mini btn-primary',
                        'data-toggle'=>'tooltip',
                        'data-placement'=>'left'
                    ),
                ),
                'je' => array
                (
                    'label'=>'Job Experiance',
                    'icon'=>'tasks white',
                    'url'=>'Yii::app()->createUrl("jobExperiance", array("id"=>$data->personID))',
                    'options'=>array(
                        'class'=>'btn btn-mini btn-info',
                        'data-toggle'=>'tooltip',
                    ),
                ),
                'view' => array
                (
                    'label'=>'View Details',
                    'icon'=>'search white',
                    'url'=>'Yii::app()->createUrl("faculty/view", array("id"=>$data->facultyID))',
                    'options'=>array(
                        'class'=>'btn btn-mini btn-success',
                        'data-toggle'=>'tooltip',
                        
                    ),
                ),
                'update' => array
                (
                    'label'=>'Edit Info',
                    'icon'=>'pencil white',
                    'url'=>'Yii::app()->createUrl("faculty/update", array("id"=>$data->facultyID,"img"=>$data->ex_per_image))',
                    'options'=>array(
                        'class'=>'btn btn-mini btn-warning',
                        'data-toggle'=>'tooltip',
                        'rel'=>'$data->ex_per_image',
                        
                        
                    ),
                ),
                'print_act' => array
                (
                    'label'=>'print',
                    'icon'=>'print',
                    'url'=>'Yii::app()->createUrl("faculty/printAct", array("id"=>$data->facultyID))',
                    'options'=>array(
                        'class'=>'btn btn-mini',
                        'data-toggle'=>'tooltip',
                        'data-placement'=>'right'
                    ),
                ),
            ),
            'htmlOptions'=>array(
                'style'=>'width: 220px; ',
                'class'=>'moreButtons',
                
            ),
     ),   
    )
    
    
)); 


?>

<script type="text/javascript">
    
    
    //---------------
    //---------------
    $( "a[rel=0]").attr('class','btn btn-mini btn-danger');
    $( "a[rel=0]").attr('title','Edit Info [   !! No Photograph included of this Student   ]');
        
    
</script>
