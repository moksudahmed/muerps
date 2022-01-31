<?php
/* @var $this TermAdmissionController */
/* @var $model TermAdmission */

$this->breadcrumbs=array(
       'Student\'s Info'=>array('admission/studentsInfo'),
	'Admit Card',
	
);

?>

<div class="title span-18">
    <h3>Generate Admit Card</h3>  
    <h4>Term: <span class="label label-warning"><?php echo FormUtil::getTerm(yii::app()->session['aciTerm']); ?> </span><span class="label label-success"> <?php echo yii::app()->session['aciYear'];  ?></span></h4>
</div>

<div class="span-14">
    <!--h5>Examination:    <span class="label label-info">Supplementary</span></h5-->


	<h5>
		 <?php if(Yii::app()->user->hasFlash('warning')):?>
			<div class="alert in alert-block fade alert-danger">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  <?php echo Yii::app()->user->getFlash('warning')?>
			</div>
		<?php endif;?>
    
                <?php if(Yii::app()->user->hasFlash('success')):?>
			<div class="alert in alert-block fade alert-success">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  <?php echo Yii::app()->user->getFlash('success')?>
			</div>
		<?php endif;?>
        </h5>


</div>

<div class="span-14" >
            <?php 
        //$backUrl = (!yii::app()->session['mreUrlFlag']?Yii::app()->controller->createUrl('person/searchEngine'):Yii::app()->controller->createUrl('varifyMarks',array('offeredID'=>yii::app()->session['mreOfmID'])));
        $backUrl = Yii::app()->controller->createUrl('examRegistration/individualAdmitCardIssue');
        $this->widget('bootstrap.widgets.TbMenu', array(
                'type'=>'pills',
                'items'=>array(
                        array('label'=>'Issue Another', 'icon'=>'icon-arrow-left' , 'url'=>$backUrl, 'linkOptions'=>array('data-toggle'=>'tooltip','data-placement'=>'right', 'title'=>'Exam Registration',), 'visible'=>true),	
                        array('label'=>'Print Admit Card', 'icon'=>'icon-print', 'url'=>Yii::app()->controller->createUrl('examRegistration/generateAdmitCardPDF',array('traID'=>$termID)), 'linkOptions'=>array('target'=>'_blank'), 'visible'=>true),
                        //array('label'=>'PDF', 'icon'=>'icon-print', 'url'=>Yii::app()->controller->createUrl('AcademicRecordPDF'),'linkOptions'=>array('target'=>'_blank'), 'visible'=>true),

                ),
        ));

        ?>
</div>

<div class="span-14" >
     <h3>Course of Examination</h3>  
<?php
 


$this->widget('bootstrap.widgets.TbExtendedGridView', array(
  //  'filter'=>$person,
    'type'=>'striped bordered',
    'dataProvider' => $dataProvider,
    'template' => "{items}\n{extendedSummary}",
    'columns' => array(
                   
                    array('name' => 'moduleCode','header' => 'Course Code'),                                                                          
                    array('name' => 'mod_name','header' => 'Course Name'),                                                                          
                    array('name' => 'batchName','header' => 'Batch'),       
                     array('name' => 'sectionName','header' => 'Section'),       
      /*   array(
            'name'=>'mod_name',
            'header'=>'mod_name',             
            'class'=>'bootstrap.widgets.TbTotalSumColumn'
             
        ),*/
         
                ),
    /*'extendedSummary' => array(
        'title' => 'Total Students',
        'columns' => array(
            'total' => array('label'=>'Total students', 'class'=>'TbSumOperation')
        )
    ),*/
   /* 'extendedSummaryOptions' => array(
        'class' => 'well pull-right',
        'style' => 'width:300px'
    ),*/
));
?>
</div>