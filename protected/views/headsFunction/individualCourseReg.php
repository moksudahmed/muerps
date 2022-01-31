<?php
/* @var $this ModuleController */
/* @var $model Module */

$this->breadcrumbs=array(
    'Head Functionalities'=>array('headsfunction/index'),
    
	'Retake Course Registration'
);


?>





<div class="title span-20">
            <h3 >Retake Course Registration<br/>
                <strong>ID:</strong><span class="label label-info"><?php echo yii::app()->session['studentIDinReg']; ?> </span><br/>
                <strong>Name: </strong> <span class="label label-success "><?php  echo yii::app()->session['studentName']; ?></span>
            </h3>
            <h5><strong>Section: </strong><span class="label label-important"> <?php echo yii::app()->session['secNameinReg']; ?></span><strong>Batch: </strong><span class="label label-success"> <?php echo yii::app()->session['batNameinReg'].FormUtil::getBatchNameSufix(yii::app()->session['batNameinReg']); ?>  </span></h5>
            <h6><strong>Academic Term: </strong><span class="label label-info"><?php echo FormUtil::getTerm(yii::app()->session['acTerm']); ?> </span><span class="label label-success"> <?php echo yii::app()->session['acYear'];  ?></span></h6>        
            
</div>
<div class="title span2">
    <h4><span class="label label-warning"><?php echo FormUtil::getTerm(yii::app()->session['MainCurTerm']); ?> </span><span class="label label-success"> <?php echo yii::app()->session['MainCurYear'];  ?></span><strong style="letter-spacing:3px;">Selected Term </strong></h4>
    <h6>Programme:<?php  echo DBhelper::getProgrammeByCode(yii::app()->session['proCode']); ?></h6>
</div>
<hr/>

<h5>
		 <?php if (Yii::app()->user->hasFlash('warning')):?>
			<div class="alert in alert-block fade alert-danger">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  <?php echo Yii::app()->user->getFlash('warning')?>
			</div>
		<?php endif;?>
    
                <?php if (Yii::app()->user->hasFlash('success')):?>
			<div class="alert in alert-block fade alert-success">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  <?php echo Yii::app()->user->getFlash('success')?>
			</div>
		<?php endif;?>
</h5>

<br/>

<?php  if($flag):?>
<div class="title span-24" style="display:inline">
    
    
    
         <h4><strong>Current Term: </strong><span class="label label-warning"><?php echo FormUtil::getTerm(yii::app()->session['retakeTerm']); ?> </span><span class="label label-success"> <?php echo yii::app()->session['retakeYear'];  ?></span></h4>
        
    
    
       <?php  echo CHtml::submitButton('Create Term Admission' , array('class' => 'btn btn-info btn-large','data-loading-text'=>'Loading....','submit' => array('createTermAdmissionForRetake','data'=>true))); ?>
    
    
    
    
</div>

<?php endif; ?>
<br/>
<?php

    $this->renderPartial('_individualCourseReg',array('dataProvider'=>$dataProvider,'model'=>$model,'data'=>$data));
?>