<?php
/* @var $this TermAdmissionController */
/* @var $model TermAdmission */

$this->breadcrumbs=array(
    'Student\'s Info'=>array('admission/studentsInfo'),
	'Term Admission'=>array('termAdmission/index'),
	'Admitted Terms',
);


$today= date('Y-m-d');
//echo $today;

?>

	
<div class="title span-18" >
            <h3 class="title">Admitted Terms<br/>
                <strong>ID:</strong><span class="label label-info"><?php echo yii::app()->session['studentID']; ?> </span><br/>
                <strong>Name: </strong> <span class="label label-success"><?php  echo yii::app()->session['studentName']; ?></span>
            </h3>
            <h4><strong>Section: </strong><span class="label label-important"> <?php echo yii::app()->session['secName']; ?></span><strong>Batch: </strong><span class="label label-success"> <?php echo yii::app()->session['batName'].FormUtil::getBatchNameSufix(yii::app()->session['batName']); ?>  </span></h4>
            <h4><strong>Academic Term: </strong><span class="label label-info"><?php echo FormUtil::getTerm(yii::app()->session['acTerm']); ?> </span><span class="label label-success"> <?php echo yii::app()->session['acYear'];  ?></span></h4>        
            
</div>
<div class="title span-4">
    <h4><span class="label label-warning"><?php echo FormUtil::getTerm(yii::app()->session['traTerm']); ?> </span><span class="label label-success"> <?php echo yii::app()->session['traYear'];  ?></span><strong style="letter-spacing:3px;">Selected Term </strong></h4>
    <h6>Programme:<?php  echo DBhelper::getProgrammeByCode(yii::app()->session['proCode']); ?></h6>
</div>
    
<hr/>

<h5>
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
        
    
    
       <?php  echo CHtml::submitButton('Create Term Admission' , array('class' => 'btn btn-info btn-large','data-loading-text'=>'Loading....','submit' => array('create','data'=>$data))); ?>
    
    <?php endif; ?>
    
    
</div>
<?php
    $term='FormUtil::getTerm($data->tra_term)';
    $name='$data->batchName';
    $nameSufix='FormUtil::getBatchNameSufix($data->batchName)';
    $year='$data->tra_year';
    
$groupGridColumns = array(
'name' => 'firstLetter',
'value' => '$data->tra_year',
'headerHtmlOptions' => array('style'=>'display:none'),
'htmlOptions' =>array('style'=>'display:none')
);    
    
$batchNameColumn = array(
'name' => 'batchName',
'value' => "{$name}.{$nameSufix}",
        
'htmlOptions' =>array('style'=>'text-align:left')

);    

$TermColumn = array(
'name' => 'tra_term',
'value' => "{$term}",
        
'htmlOptions' =>array('style'=>'text-align:left')

);
?>
<?php $this->widget('bootstrap.widgets.TbGroupGridView', array(
	'id'=>'school-grid',
        'type' => 'striped',
        //'enablePagination' => false,
        'responsiveTable' => true,
	'dataProvider'=>$model->searchAdmittedTerms($data['studentID'], $data['sectionName'], $data['batchName'], $data['programmeCode']),
	
    	'extraRowColumns'=> array('firstLetter'),
        'extraRowExpression' => $year,
        'extraRowHtmlOptions' => array('style'=>'padding:10px;font-size:20px;letter-spacing:2px; text-align:right; '),
	'columns'=>array(
            $groupGridColumns,
		array('header' => 'Date','value' => 'FormUtil::getFormatedDate($data->tra_date)','htmlOptions' =>array('class'=>'span-3')),
                $TermColumn,
		'tra_year',
                'sectionName',
                $batchNameColumn,
                
                

		 array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{ModuleRegistration} {Delete}',
            'buttons'=>array
            (
               
                'ModuleRegistration' => array
                (
                    'label'=>'Registared Modules',
                    'icon'=>'search white',
                    'url'=>'Yii::app()->createUrl("moduleRegistration/index", array("id"=>$data->termAdmissionID))',
                    'options'=>array(
                        'class'=>'btn btn-mini btn-success',
                        'data-toggle'=>'tooltip',
                        
                    ),
                ),
                'Delete' => array
                (
                    'label'=>'Cancel Term Admission',
                    'icon'=>'remove white',
                    'url'=>'Yii::app()->createUrl("termAdmission/delete2", array("id"=>$data->termAdmissionID))',
                    'options'=>array(
                        'class'=>'btn btn-mini btn-danger',
                        'data-toggle'=>'tooltip',
                        'rel'=>'$data->tra_date',
                        'style'=>'display:none'
                        

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