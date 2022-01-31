<?php
/* @var $this AdministrationController */
/* @var $model Administration */
/* @var $form CActiveForm */
?>

<?php
$this->breadcrumbs=array(
	'Student\'s Info'=>array('admission/StudentsInfo'),

	'Section Transfer',
);


    
    

?>
    <div class="title">
    
                <h3>Section Transfer</h3>
                <h4><strong >Selected Term: </strong><span class="label label-info"><?php echo FormUtil::getTerm(yii::app()->session['stfTerm']); ?> </span><span class="label label-success"> <?php echo yii::app()->session['stfYear'];  ?></span></h4>
                <h4 ><strong>Batch: </strong><span class="label label-warning"> <?php echo yii::app()->session['stfBatName'].FormUtil::getBatchNameSufix(yii::app()->session['stfBatName']); ?>  </span><strong>Section: </strong><span class="label label-important"> <?php echo yii::app()->session['stfSecName']; ?></span> To <span class="label label-success">  <?php echo yii::app()->session['stfNewSecName']; ?></span></h4>
                <h4 ><strong>Programme: </strong><span class="label label-info"> <?php echo DBhelper::getProgrammeByCode( yii::app()->session['stfProCode']); ?>  </span></h4>
                
     
    
    
     </div>
    <div>
        <?php 
            $this->widget('bootstrap.widgets.TbMenu', array(
                    'type'=>'pills',
                    'items'=>array(

                            //array('label'=>'Back', 'icon'=>'icon-left-arrow', 'url'=>Yii::app()->controller->createUrl('invoicePDF'), 'linkOptions'=>array('target'=>'_blank'), 'visible'=>true),
                            array('label'=>'Back', 'icon'=>'icon-arrow-left' , 'url'=>Yii::app()->controller->createUrl('studentsInfo'), 'linkOptions'=>array('data-toggle'=>'tooltip','data-placement'=>'top', 'title'=>'Student Info',), 'visible'=>true),	
                    ),
            ));

     ?>
        
    </div>

<hr/>


        <h5>
		 <?php if (Yii::app()->user->hasFlash('success')):?>
			<div class="alert in alert-block fade alert-success">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  <?php echo Yii::app()->user->getFlash('success')?>
			</div>
		<?php endif;?>
	</h5>

<?php
$this->renderPartial('_sectionTransferForm2',array(
                    'dataProvider'=>$dataProvider
                    ));?>