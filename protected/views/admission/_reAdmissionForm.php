<?php
/* @var $this AdministrationController */
/* @var $model Administration */
/* @var $form CActiveForm */
?>

<?php
$this->breadcrumbs=array(
	'Student\'s Info'=>array('studentsInfo'),

	'Re-admission',
);


    $programme= Programme::model()->findByPk($admission->programmeCode);
    

?>
    <div class="title">
            <div class="span-12" >
                <h3>Re-admission</h3>
                <h3><strong>ID: </strong> <span class="label label-success"> <?php echo $admission->studentID;  ?></span><br/>
                    <strong>Name: </strong><span class="label label-info"><?php echo $person->per_title." ".$person->per_firstName." ".$person->per_lastName; ?></span></h3>
                <h4 style="padding-right: 10px;"><strong>Batch: </strong><span class="label label-warning"> <?php echo $admission->batchName.FormUtil::getBatchNameSufix($admission->batchName); ?>  </span><strong>Section: </strong><span class="label label-important"> <?php echo $admission->sectionName; ?></span></h4>
                
                <h4><strong>Academic Year: </strong><span class="label label-info"><?php  echo FormUtil::getTerm($student->stu_academicTerm)." ".$student->stu_academicYear ;  ?></span></h4>
     
            </div>
            <div class="span-4">
                <div class="img-polaroid" style="float: right; width:150px; height: auto; ">
                    <?php echo CHtml::image('./photograph/'.$student->studentID.'.jpg',$person->per_title." ".$person->per_firstName." ".$person->per_lastName,array('title'=>$person->per_title." ".$person->per_firstName." ".$person->per_lastName)); ?>
                </div>    
                   <h6 style="padding-top: 20px;">Programme: <?php  echo $programme->programmeCode.": ".$programme->pro_name; ?></h6>
            </div>
     </div>

<hr/>

<h5>
		 <?php if (Yii::app()->user->hasFlash('warning')):?>
			<div class="alert in alert-block fade alert-danger">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  <?php echo Yii::app()->user->getFlash('warning')?>
			</div>
		<?php endif;?>
	</h5>
            
<h4>Personal Details:</h4>
     
     <table class="table table-hover table-bordered detail">
         <tr>
             <td>
                 Admission Date:
             </td>
             <td>
                 <span class="label label-important">
                        <?php  echo CHtml::encode($admission->adm_date!=null? $admission->adm_date : "-- N/A --"); ?>
                    </span>
             </td>
         </tr>
         <tr>
             
             <td class="detail-title">
                 Fathers Name:
             </td>
             <td class="detail-content">
                 <?php echo $person->per_fathersName; ?>
             </td>
         </tr>
         <tr>
             <td class="detail-title">
                 Mothers Name:
             </td>
             <td class="detail-content">
                 <?php echo $person->per_mothersName; ?>
             </td>
         </tr>
       
         <tr>
             <td class="detail-title">
                 Gender:
             </td>
             <td class="detail-content">
                 <?php echo $person->per_gender; ?>
             </td>
         </tr>
         <tr>
             <td class="detail-title">
                 Date of Birth:
             </td>
             <td class="detail-content">
                 <?php echo $person->per_dateOfBirth; ?>
             </td>
         </tr>
         <tr>
             <td class="detail-title">
                 Blood Group:
             </td>
             <td class="detail-content">
                 <?php echo $person->per_bloodGroup; ?>
             </td>
         </tr>
         
     </table>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'reAdmission-form',
	'enableAjaxValidation'=>true,
    'action'=>CController::createUrl('createReAdmission'),
    'htmlOptions'=>(array('autocomplete'=>'off',)),
)); ?>

	

	<?php //echo $form->errorSummary($admission); ?>

        <div class="row">
            <h4>Re-admission(Batch Transfer) Details:</h4>
            
            <hr/>
         

            <div class="row">
                Select Batch[section] to transfer:<br/>
                    <?php echo CHtml::dropDownList('newBatchName','newBatchName', CHtml::listData(FormUtil::getBatchSection($admission->programmeCode,$admission->batchName),
                       'section-batch','sectionName','group'),array(
                            'prompt' => '--Select Batch--',
                            'value' => '0',
                           'required'=>true,
                        ));?>
            </div>
            <div class="row">
                Re-admission Year:<br/>
		<?php  echo CHtml::dropDownList('startYear',  FormUtil::getYear(), FormUtil::yearForDropDown($admission->adm_startYear), 
                    array('prompt' => '--Please Select --',
                        'value' => '0','required'=>true,));  ?>
	
	
            </div>
            <div class="row">
                Re-admission Term:<br/>
		<?php echo CHtml::radioButtonList('startTerm',  FormUtil::getCurrentTerm(),  ZHtml::$Terms, array('labelOptions'=>array('style'=>'display:inline; padding-right:10px'), 'separator'=>'  ',));  ?>
	
            </div>
            <div class="row">
                Remarks:<br/>
                <?php echo CHtml::textArea('remarks', '',array('required'=>true)); ?>
            </div>
            <div class="row">
                Date of Birth (For Authentication):<br/>
                <?php $this->widget('zii.widgets.jui.CJuiDatePicker',
		array(
        'name'=>'dateOfBirth',
        //'model'=>$person,
        'options' => array(
                          'mode'=>'focus',
                          'dateFormat'=>'yy-mm-dd',
                          'showAnim' => 'slideDown',
                          ),
			'htmlOptions'=>array('size'=>10,'class'=>'date','required'=>true),
		)
		);?>
                
            </div>
            <?php 
                echo CHtml::hiddenField('studentID',$admission->studentID);
                echo CHtml::hiddenField('per_dateOfBirth',$person->per_dateOfBirth);
                echo CHtml::hiddenField('adm_status',$admission->adm_status);
                echo CHtml::hiddenField('adm_remarks',$admission->adm_remarks);
                echo CHtml::hiddenField('sectionName',$admission->sectionName);
                echo CHtml::hiddenField('batchName',$admission->batchName);
                echo CHtml::hiddenField('programmeCode',$admission->programmeCode);
                echo CHtml::hiddenField('waiverID',$admission->waiverID);
            ?>
            <div class="row buttons">
                    <?php echo CHtml::submitButton('Submit' , array('class' => 'btn btn-primary btn-large','data-loading-text'=>'Loading....',/*'confirm'=>'Are you sure you want to Transfer The Batch?'*/)); ?>
            </div>
        </div>
        
<?php $this->endWidget(); ?>

</div><!-- form -->