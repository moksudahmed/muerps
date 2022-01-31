<?php
/* @var $this TermAdmissionController */
/* @var $model TermAdmission */

$this->breadcrumbs=array(
        'Student\'s Info'=>array('admission/studentsInfo'),
	'Term Advising'=>array('termAdvising/examption'),
	'Exameption',
);

$this->menu=array(
	array('label'=>'List TermAdmission', 'url'=>array('index')),
	array('label'=>'Manage TermAdmission', 'url'=>array('admin')),
);

$today= date('Y-m-d');
//echo $today;

?>

	
<div class="title span-18" >
            <h3 class="title">Advised Terms</h3>
                <h4><strong>ID: </strong><span class="label label-info"><?php echo yii::app()->session['studentID']; ?> </span><br/></h4>
            <h4>    <strong>Name: </strong> <span class="label label-success "><?php  echo yii::app()->session['studentName']; ?></span></h4>
    <h4> <?php echo FormUtil::getBatchTermHTMLspan(yii::app()->session['secName'], yii::app()->session['batName'], yii::app()->session['proCode'])  ?></h4>
            <!--h4><strong>Section: </strong><span class="label label-important"> <?php echo yii::app()->session['secName']; ?></span><strong>Batch: </strong><span class="label label-success"> <?php echo yii::app()->session['batName'].FormUtil::getBatchNameSufix(yii::app()->session['batName']); ?>  </span></h4-->
            
            
</div>
<div class="title span-5">
    <h4><span class="label label-warning"><?php echo FormUtil::getTerm(yii::app()->session['traTerm']); ?> </span><span class="label label-success"> <?php echo yii::app()->session['traYear'];  ?></span><strong style="letter-spacing:3px;">Selected Term </strong></h4>
    <h6>Programme:<?php  echo DBhelper::getProgrammeByCode(yii::app()->session['proCode']); ?></h6>
    <?php 
            $this->widget('bootstrap.widgets.TbMenu', array(
                    'type'=>'pills',
                    'items'=>array(

                            //array('label'=>'Back', 'icon'=>'icon-left-arrow', 'url'=>Yii::app()->controller->createUrl('invoicePDF'), 'linkOptions'=>array('target'=>'_blank'), 'visible'=>true),
                            array('label'=>'Back', 'icon'=>'icon-arrow-left' , 'url'=>Yii::app()->controller->createUrl('termAdvising/index'), 'linkOptions'=>array('data-toggle'=>'tooltip','data-placement'=>'top', 'title'=>'Term Advising',), 'visible'=>true),	
                    ),
            ));

     ?>
</div>
    
<hr/>

<h5 class="span-16">
		 <?php if (Yii::app()->user->hasFlash('success')):?>
			<div class="alert in alert-block fade alert-success">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  <?php echo Yii::app()->user->getFlash('success')?>
			</div>
		<?php endif;?>
                <?php if (Yii::app()->user->hasFlash('warning')):?>
			<div class="alert in alert-block fade alert-danger">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  <?php echo Yii::app()->user->getFlash('warning')?>
			</div>
		<?php endif;?>
	</h5>

<div class="title span-18" style="display:<?php echo $flag; ?>">
    
    <?php  if($flag=='inline' && $flagOfm==true):?>
    
         <h4><strong>Current Term: </strong><span class="label label-warning"><?php echo FormUtil::getTerm(yii::app()->session['traTerm']); ?> </span><span class="label label-success"> <?php echo yii::app()->session['traYear'];  ?></span></h4>
        
    
    
       <?php  echo CHtml::submitButton('Create Term Admission' , array('class' => 'btn btn-info btn-large','data-loading-text'=>'Loading....','submit' => array('termAdvising/create','data'=>$data))); ?>
    
    <?php endif; ?>
    
    
</div>
<div class="span-16"> 

<?php
    $term='FormUtil::getTerm($data->tra_term)';
    $name='$data->batchName';
    $batchSection='$data->batchName.FormUtil::getBatchNameSufix($data->batchName).\'(\'.$data->sectionName.\')\'';
    $year='$data->tra_year';
    $acYear='FormUtil::getAcademicYear($data->batchName,$data->programmeCode)';
    
$groupGridColumns = array(
'name' => 'firstLetter',
'value' => '$data->tra_year',
'headerHtmlOptions' => array('style'=>'display:none'),
'htmlOptions' =>array('style'=>'display:none')
);    
    



?>
<?php $this->widget('bootstrap.widgets.TbGroupGridView', array(
	'id'=>'school-grid',
        'type' => 'striped bordered',
        'enablePagination' => true,
        'responsiveTable' => true,
	'dataProvider'=>$model->searchAdmittedTerms($data['studentID'], $data['sectionName'], $data['batchName'], $data['programmeCode']),
	
    	'extraRowColumns'=> array('firstLetter'),
        'extraRowExpression' => $year,
        'extraRowHtmlOptions' => array('style'=>'padding:10px;font-size:20px;letter-spacing:2px; text-align:left; '),
	'columns'=>array(
            $groupGridColumns,
            array('header' => 'Advised (Terms','value' => "{$term}",'htmlOptions' =>array('style'=>'text-align:right;font-weight:bold;', 'class'=>'span-3')),    
            array('header'=>'By', 'name'=>'per_name','htmlOptions' =>array('class'=>'span-6','style'=>'text-align:right')),
            array('header' => 'Date','value' => 'FormUtil::getFormatedDate($data->tra_date)','htmlOptions' =>array('class'=>'span-4','style'=>'text-align:right')),
            
            array('header'=>'with)', 'value' => $batchSection,'htmlOptions' =>array('class'=>'span-2', 'style'=>'text-align:left')),
            
                

		 array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{ModuleRegistration}',
            'buttons'=>array
            (
               
                'ModuleRegistration' => array
                (
                    'label'=>'Registared Modules',
                    'icon'=>'search white',
                    'url'=>'Yii::app()->createUrl("termAdvising/modulesToBeExmaption", array("id"=>$data->termAdmissionID))',
                    'options'=>array(
                        'class'=>'btn btn-mini btn-success',
                        'data-toggle'=>'tooltip',
                        
                    ),
                ),
               /* 'Delete' => array
                (
                    'label'=>'Cancel Term Admission',
                    'icon'=>'remove white',
                    'url'=>'Yii::app()->createUrl("termAdvising/delete2", array("id"=>$data->termAdmissionID))',
                    'options'=>array(
                        'class'=>'btn btn-mini btn-danger',
                        'data-toggle'=>'tooltip',
                        'rel'=>'$data->tra_date',
                        'style'=>'display:inline-block'
                        

                    ),
                    
                ),*/
            ),
            'htmlOptions'=>array(
                'style'=>'width: 220px; ',
                'class'=>'moreButtons',
                
            ),
                     
     ),
	),
)); ?>
</div>
<script type="text/javascript" >
    
    
        // prevent the click event
       
    
    $(window).load(function () {
        /*
        $( "td:contains('Spring')").addClass('label label-success span1');
        $( "td:contains('Summer')").addClass('label label-warning span1');
        $( "td:contains('Autumn')").addClass('label label-info span1');
         */
        
        
        
        $("a[rel='<?php echo $today; ?>']").css('display','inline-block');
      
    });
    
</script>