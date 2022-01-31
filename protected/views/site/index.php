<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>
<hr/>
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
<!--h3>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h3-->
    <div id="body-content"  style="width: 100%; min-height:400px;   text-align: center;">
        <div id="logo" style="margin-top:100px">

        
        <?php echo CHtml::image('./images/'.Options::getOptions('organization_logo'), Options::getOptions('erp_name').' Logo', array('style'=>'width:269px; height:95px;')) ?>
        </div>
        <div id="search">
        
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'term-admission-form',
	'enableAjaxValidation'=>false,
        'enableClientValidation'=>true,
        'action'=>CController::createUrl('person/searchEngine'),
)); ?>

	

	

	<div class="row " style="">
            
        
		
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
                     'htmlOptions'=>array('class'=>'','style'=>'height:30px; width:700px; font-size:25px;','required'=>true,//'title'=>'ID have to be like [111-111-111] ',
                       ),
            ));
            ?>
            
	</div>
        <div class="row">
            <?php if (Yii::app()->user->hasFlash('warning')):?>
			<div class="alert in alert-block fade alert-danger">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  <?php echo Yii::app()->user->getFlash('warning')?>
			</div>
		<?php endif;?>
        </div>
	<div class="row buttons">
		<?php echo CHtml::submitButton('Search' , array('style'=>'width:200px;','class' => 'btn  btn-large','data-loading-text'=>'Loading....')); ?>
                
	</div>

<?php $this->endWidget(); ?>
    
        
    </div>
</div>