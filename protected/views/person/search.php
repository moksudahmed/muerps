<?php
/* @var $this AdministrationController */
/* @var $model Administration */

$this->breadcrumbs=array(
	//'Student Administration'=>array('StudentAdministration'),
	'Search Result',
);

$this->menu=array(
    array('label'=>'Student Administration', 'url'=>array('studentAdministration')),
	array('label'=>'List Student', 'url'=>array('index'),'active'=>true),
	array('label'=>'New Admission', 'url'=>array('create','flag'=>true)),
);


?>

<div id="search" class="span-24">
        
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'term-admission-form',
	'enableAjaxValidation'=>false,
        'enableClientValidation'=>true,
        'action'=>CController::createUrl('person/searchEngine'),
)); ?>

	

	

	<div  class="span-16">
            
        
		
                <?php 
            $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                 
                'name'=>'studentID',
               // 'source'=>array('111-115-001', '111-112-110', '111-112-100','211-115-001', '211-112-110','211-112-111', '311-112-100',),
                'source'=> Admission::searchStudent(),
                'options'=>array(
                        'minLength'=>'7',
                    'htmlOptions'=>array('style'=>'font-size:25px;'),
                    ),
                //'htmlOptions'=>array('style'=>'width:700px;','required'=>true,'pattern'=>'([0-9][0-9][0-9]-[0-9][0-9][0-9]-[0-9][0-9][0-9])$','title'=>'ID have to be like [111-111-111] ',
                     'htmlOptions'=>array('class'=>'','style'=>'height:35px; width:600px; font-size:25px;','required'=>true,//'title'=>'ID have to be like [111-111-111] ',
                       ),
            ));
            ?>
        </div>
        <div class="span-3">
	
		<?php echo CHtml::ajaxButton('Search', CController::createUrl('person/searchEngineAjax'), array(
                    'type'=>'POST', //request type
                    
                    //Style: CController::createUrl('currentController/methodToCall')
                    'update'=>'#success',
                    
                    ) , array('style'=>'width:200px;','class' => 'btn  btn-large','data-loading-text'=>'Loading....')); ?>
                
	</div>
        <div class="row">
            <?php if (Yii::app()->user->hasFlash('warning')):?>
			<div class="alert in alert-block fade alert-danger">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  <?php echo Yii::app()->user->getFlash('warning')?>
			</div>
		<?php endif;?>
        </div>
	

<?php $this->endWidget(); ?>
    
        
    </div>

<div class="title span-14">
    
        <h3>Search Result</h3>

    
</div>
<div class="">
    
    <?php 
$backUrl = (!yii::app()->session['mreUrlFlag']?Yii::app()->controller->createUrl('person/searchEngine'):Yii::app()->controller->createUrl('varifyMarks',array('offeredID'=>yii::app()->session['mreOfmID'])));
$this->widget('bootstrap.widgets.TbMenu', array(
	'type'=>'pills',
	'items'=>array(
                array('label'=>'Back', 'icon'=>'icon-arrow-left' , 'url'=>Yii::app()->controller->createUrl('site/index'), 'linkOptions'=>array('data-toggle'=>'tooltip','data-placement'=>'top', 'title'=>'Home',), 'visible'=>true),	
		//array('label'=>'XLS', 'icon'=>'icon-print', 'url'=>Yii::app()->controller->createUrl('AcademicRecordXLS'),'linkOptions'=>array('target'=>'_blank'), 'visible'=>true),
		//array('label'=>'Transcript', 'icon'=>'icon-print', 'url'=>Yii::app()->controller->createUrl('transcriptPDF'), 'linkOptions'=>array('target'=>'_blank','data-toggle'=>'tooltip','data-placement'=>'right', 'title'=>'PDF',), 'visible'=>true),
		
	),
));

?>
</div>

<div id="success" class="span-24">
<?php echo $this->renderPartial('_search', array('dataProvider'=>$dataProvider)); ?>
</div>