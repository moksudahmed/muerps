<?php
/* @var $this TermAdmissionController */
/* @var $model TermAdmission */

$this->breadcrumbs=array(
       'Student\'s Info'=>array('admission/studentsInfo'),
	'Term Advising',
	
);

?>

<div class="title span-18">
    <h3>All in one</h3>  
    <h4>Term: <span class="label label-warning"><?php echo FormUtil::getTerm(yii::app()->session['aioTerm']); ?> </span><span class="label label-success"> <?php echo yii::app()->session['aioYear'];  ?></span></h4>
</div>
<div class="span-4" >
            <?php 
        //$backUrl = (!yii::app()->session['mreUrlFlag']?Yii::app()->controller->createUrl('person/searchEngine'):Yii::app()->controller->createUrl('varifyMarks',array('offeredID'=>yii::app()->session['mreOfmID'])));
        $backUrl = Yii::app()->controller->createUrl('admission/studentsInfo');
        $this->widget('bootstrap.widgets.TbMenu', array(
                'type'=>'pills',
                'items'=>array(
                        array('label'=>'Back', 'icon'=>'icon-arrow-left' , 'url'=>$backUrl, 'linkOptions'=>array('data-toggle'=>'tooltip','data-placement'=>'right', 'title'=>'Student\'s Info',), 'visible'=>true),	
                        //array('label'=>'password', 'icon'=>'icon-edit', 'url'=>Yii::app()->controller->createUrl('site/changePassword'),'linkOptions'=>array(), 'visible'=>true),
                        //array('label'=>'PDF', 'icon'=>'icon-print', 'url'=>Yii::app()->controller->createUrl('AcademicRecordPDF'),'linkOptions'=>array('target'=>'_blank'), 'visible'=>true),

                ),
        ));

        ?>
</div>
<div class="span-14">
    <!--h5>Examination:    <span class="label label-info">Supplementary</span></h5-->


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


<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'term-admission-form',
	'enableAjaxValidation'=>false,
        'enableClientValidation'=>true,
        'action'=>CController::createUrl('admittedTerms'),
)); ?>
	

	<div class="row">
	
            <span style="font-weight:bold;font-size:25px;">Student ID:</span>
		
                <?php 
            $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                 
                'name'=>'studentID',
               // 'source'=>array('111-115-001', '111-112-110', '111-112-100','211-115-001', '211-112-110','211-112-111', '311-112-100',),
                'source'=> Admission::searchAdmissionByDptID(yii::app()->session['MainDepartmentID']),
                'options'=>array(
                        'minLength'=>'7',
                    
                    ),
                'htmlOptions'=>array('required'=>true,'pattern'=>'([0-9][0-9][0-9]-[0-9][0-9][0-9]-[0-9][0-9][0-9])$','title'=>'ID have to be like [111-111-111]',
                    'style'=>'height:30px; font-size:25px; margin-right:10px;',   
                    
                    ),
            ));
            ?>
            
         
	
		<?php echo CHtml::submitButton('Submit' , array('class' => 'btn btn-primary btn-large','data-loading-text'=>'Loading....')); ?>
	</div>
        <div class="row" >
            <strong>Skip Check Promotion:</strong>
                <?php echo CHtml::checkBox("promotion");?>                      
	</div>
<?php $this->endWidget(); ?>

</div><!-- form -->
</div>


<div class="span-24" id="vueApp">
    <h1 v-bind:title= "message" >{{product}}</h1>
    <p>{{description}}</p>
    <p>{{count}}</p>
    <input v-model="product" />
    <p>{{gradeMsg()}}</p>
    <p v-if="pass <= product">pass</p>
    
    <p v-else-if="pass > product ">fail</p>
    <ol>
        <li v-for="grade in grades" v-bind:id="grade.marks">{{grade.grade}}</li>
    </ol>
    <button v-on:click="reverseMessage">Reverse Message</button>
</div>
<script src="./../../../js/vueMain.js"></script>
<!-- Mount App -->
<script>
    const mountedApp = app.mount("#vueApp");
</script>