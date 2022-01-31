<?php
/* @var $this AdministrationController */
/* @var $model Administration */

$this->breadcrumbs=array(
	'Student Administration'=>array('StudentAdministration'),
	'List Student',
);

$this->menu=array(
    array('label'=>'Student Administration', 'url'=>array('studentAdministration')),
	array('label'=>'List Student', 'url'=>array('index'),'active'=>true),
	array('label'=>'New Admission', 'url'=>array('create','flag'=>true)),
);


?>
<div class="title span-12">
    
        <h3>List Student</h3>
        <h4 style="padding-right: 10px;"><strong>Batch: </strong><span class="label label-warning"> <?php echo yii::app()->session['batch']; ?>  </span><strong>Section: </strong><span class="label label-important"> <?php echo yii::app()->session['section']; ?></span></h4>
        <h4><strong>Academic Year: </strong><span class="label label-info"><?php  echo yii::app()->session['academicTerm'];  ?></span></h4>
        <p><?php echo FormUtil::getGenderNo(yii::app()->session['proCode'], yii::app()->session['batName']) ?></p>
    </div>
<div class="span-4"> 
    <h6 style="padding-top: 20px;"><strong>Programme: </strong> <?php  echo yii::app()->session['programme']; ?></h6>
</div>
<hr/>

<?php 
$getStatus='FormUtil::getAdmissionStatus($data->adm_status)';


?>
<?php $this->widget('bootstrap.widgets.TbExtendedGridView', array(
        
	'id'=>'admission-grid',
    'type' => 'striped',
    'responsiveTable' => true,
	'dataProvider'=>$model->search(yii::app()->session['secName'],yii::app()->session['batName'],yii::app()->session['proCode']),
	'filter'=>$model,
    
	'columns'=>array(
           
                        array('header'=>'Student ID','value'=>'$data->studentID','htmlOptions'=>array('class'=>'span-2'),),
                        
                        
                        array('header'=>'Name','value'=>'$data->per_name','htmlOptions'=>array('class'=>'span-4'),),
			
                        
                        //'per_dateOfBirth',
			array('header'=>'Blood Group','value'=>'$data->per_bloodGroup','htmlOptions'=>array('class'=>'span-2'),),
                        array('header'=>'Mobile','value'=>'$data->per_mobile','htmlOptions'=>array('class'=>'span-2'),),
                        array('value'=>$getStatus,'htmlOptions'=>array('class'=>'span-3'),),
          /*  'per_email'=>array(
            'class'=>'CLinkColumn',
            'header'=>Yii::t('ui','Email'),
            //'imageUrl'=>CHtml::imageUrl('email.png'),
            'labelExpression'=>'$data->per_email',
            'urlExpression'=>'"mailto://".$data->per_email',
            'htmlOptions'=>array('style'=>'text-align:center'),
        ),*/
  
            
            
            array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>' {view} {update} {ac} {je} {print}',
            'buttons'=>array
            (
                'ac' => array
                (
                    'label'=>'Academic History',
                    'icon'=>'certificate white',
                    'url'=>'Yii::app()->createUrl("academicHistory", array("id"=>$data->personID,"sid"=>$data->studentID))',
                    'options'=>array(
                        'class'=>'btn btn-mini btn-primary',
                        'data-toggle'=>'tooltip',
                        
                    ),
                ),
                'je' => array
                (
                    'label'=>'Job Experiance',
                    'icon'=>'tasks white',
                    'url'=>'Yii::app()->createUrl("jobExperiance", array("id"=>$data->personID,"sid"=>$data->studentID))',
                    'options'=>array(
                        'class'=>'btn btn-mini btn-info',
                        'data-toggle'=>'tooltip',
                    ),
                ),
                'view' => array
                (
                    'label'=>'View Details',
                    'icon'=>'search white',
                    'url'=>'Yii::app()->createUrl("admission/view", array("id"=>$data->studentID))',
                    'options'=>array(
                        'class'=>'btn btn-mini btn-success',
                        'data-toggle'=>'tooltip',
                        
                    ),
                ),
                'update' => array
                (
                    'label'=>'Edit Info',
                    'icon'=>'pencil white',
                    'url'=>'Yii::app()->createUrl("admission/update", array("id"=>$data->studentID,"img"=>$data->ex_per_image))',
                    'options'=>array(
                        'class'=>'btn btn-mini btn-warning',
                        'data-toggle'=>'tooltip',
                        'rel'=>'$data->ex_per_image',
                        
                        
                    ),
                ),
                'print' => array
                (
                    'label'=>'print',
                    'icon'=>'print white',
                    'url'=>'Yii::app()->createUrl("admission/admissionFormPDF", array("id"=>$data->studentID))',
                    'options'=>array(
                        'class'=>'btn btn-mini btn-warning',
                        'data-toggle'=>'tooltip',
                        'data-placement'=>'right',
                        'target'=>'blank'
                    ),
                ),
                /*'print_act' => array
                (
                    'label'=>'print',
                    'icon'=>'print',
                    'url'=>'Yii::app()->createUrl("student/printAct", array("id"=>$data->studentID))',
                    'options'=>array(
                        'class'=>'btn btn-mini',
                        'data-toggle'=>'tooltip',
                        'data-placement'=>'right'
                    ),
                ),*/
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
