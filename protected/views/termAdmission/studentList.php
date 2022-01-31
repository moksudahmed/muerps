<?php
/* @var $this AdministrationController */
/* @var $model Administration */

$this->breadcrumbs=array(
	'Registry'=>array('site/registry'),
	
    
     'Batch'=>array('Batch/index'),
    'Sections'=>array('Section/index'),
    'Admitted Terms'=>array('termAdmission/termsBySection'),
	'List Student',
);

$this->menu=array(
    array('label'=>'Student Administration', 'url'=>array('studentAdministration')),
	array('label'=>'List Student', 'url'=>array('index'),'active'=>true),
	array('label'=>'New Admission', 'url'=>array('create','flag'=>true)),
);


?>
<div class="title span5">
            <h3 class="title">Admitted Student List:<br/>
                
            </h3>
            <h4><strong>Section: </strong><span class="label label-important"> <?php echo yii::app()->session['secName']; ?></span><strong>Batch: </strong><span class="label label-success"> <?php echo yii::app()->session['batName'].FormUtil::getBatchNameSufix(yii::app()->session['batName']); ?>  </span></h4>
                    
            
</div>
<div class="title span2">
    <h4><span class="label label-warning"><?php echo FormUtil::getTerm(yii::app()->session['traTerm']); ?> </span><span class="label label-success"> <?php echo yii::app()->session['traYear'];  ?></span><strong style="letter-spacing:3px;">Selected Term </strong></h4>
    <h6>Programme:<?php  echo DBhelper::getProgrammeByCode(yii::app()->session['proCode']); ?></h6>
</div>
<hr/>

<?php $this->widget('bootstrap.widgets.TbExtendedGridView', array(
        
	'id'=>'admission-grid',
    'type' => 'striped',
    'responsiveTable' => true,
	'dataProvider'=>$dataProvider,
	'filter'=>$model,
    
	'columns'=>array(
           
                        'studentID',
                        //'per_title',
                         //'per_firstName',
                        //'per_lastName',
			'per_name',
                        'per_fathersName',
                        'per_gender',
                        //'per_dateOfBirth',
			'per_bloodGroup' ,
                        'per_mobile',
                        'tra_date',
           /* 'per_email'=>array(
            'class'=>'CLinkColumn',
            'header'=>Yii::t('ui','Email'),
            //'imageUrl'=>CHtml::imageUrl('email.png'),
            'labelExpression'=>'$data->per_email',
            'urlExpression'=>'"mailto://".$data->per_email',
            'htmlOptions'=>array('style'=>'text-align:center'),
        ),*/
  
            
            
            array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{view}',
            'buttons'=>array
            (
                
                'view' => array
                (
                    'label'=>'View Details',
                    'icon'=>'search white',
                    'url'=>'Yii::app()->createUrl("moduleRegistration/index", array("id"=>$data[\'termAdmissionID\']))',
                    'options'=>array(
                        'class'=>'btn btn-mini btn-success',
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
    
    
)); 


?>

<script type="text/javascript">
    
    
    //---------------
    //---------------
    $( "a[rel=0]").attr('class','btn btn-mini btn-danger');
    $( "a[rel=0]").attr('title','Edit Info [   !! No Photograph included of this Student   ]');
        
    
    
</script>
