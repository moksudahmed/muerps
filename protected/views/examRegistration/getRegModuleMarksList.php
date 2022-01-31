<?php
/* @var $this ModuleController */
/* @var $model Module */

$this->breadcrumbs=array(
    'Department Functions'=>array('offeredModule/index'),
	'Select Module'=>array('examRegistration/getRegisteredModule'),
    'Marks Entry'
);

$this->menu=array(
    array('label'=>'Create Module', 'url'=>array('create')),

	
);

?>
<?php 
    $markingScheme = MarkingScheme::model()->findByPk($moduleReg[0]['markingSchemeID']?$moduleReg[0]['markingSchemeID']:1);
    $firstHalfMarks = $markingScheme->mrs_attendance+ $markingScheme->mrs_classTest+$markingScheme->mrs_midterm; 

    
    
    ?>


    <div class="title ">
        <div class="span-16">
            <h3 >Marks Verification: [Mark: <?php echo $firstHalfMarks; ?>] </h3>
            <h4><strong>Term: </strong><span class="label label-warning"> <?php echo FormUtil::getTerm(yii::app()->session['mreTerm']); ?>  </span><strong>Year: </strong><span class="label label-info"> <?php echo yii::app()->session['mreYear']; ?></span></h4>
            <h4><strong>Course:</strong><span class="label label-success"><?php echo yii::app()->session['mreModule']; ?></span></h4>
            
            
            
              
        </div>
        <div class="span-7">
            <h4><strong>Batch: </strong><span class="label label-success"> <?php echo yii::app()->session['mreBatch'].FormUtil::getBatchNameSufix(yii::app()->session['mreBatch']); ?>  </span><strong>Section: </strong><span class="label label-important"> <?php echo yii::app()->session['mreSection']; ?></span></h4>
            <h6>Programme:  <?php  echo DBhelper::getProgrammeByCode(yii::app()->session['mreProCode']); ?></h6>
<?php 
$this->widget('bootstrap.widgets.TbMenu', array(
	'type'=>'pills',
	'items'=>array(
		
		array('label'=>'Export to PDF', 'icon'=>'icon-download', 'url'=>Yii::app()->controller->createUrl('GenerateFirstHalfPDF'), 'linkOptions'=>array('target'=>'_blank'), 'visible'=>true),
		
	),
));

?>
        </div>
    </div>
<div class="span-24">
    <?php  if ($moduleReg !== null):?>
<table class="table table-bordered">
    <thead>
	<tr>
                <th class="span-2">
		      Student ID		
                </th>
		<th >
		      Name	
                </th>
 		<th  >
                    <span style="padding: 0px 3px 0px 65px;"> ( Attendance<sup><?php echo $markingScheme->mrs_attendance; ?></sup> - Class Test<sup><?php echo $markingScheme->mrs_classTest; ?></sup> - Midterm<sup><?php echo $markingScheme->mrs_midterm; ?></sup> )</span>
                    <span style="font-size: 15px"> out of <?php echo $firstHalfMarks; ?></span>
                </th>
 	</tr>
    </thead>
    <tbody>
	<?php $i=1; foreach($moduleReg as $row): ?>
	<tr>
        		<td style="font-weight:bold;">
			<?php echo $row['studentID']; ?>
		</td>
       		<td>
			<?php echo $row['per_name']; ?>
		</td>
                
                <td>
                    <?php $reg= ModuleRegistration::model()->findByPk($row['moduleRegistrationID']); ?>
                    <div id="form-<?php echo $i; ?>" class="span-12">
                       <?php $this->renderPartial('_formFirstHalf',array('reg'=>$reg,'i'=>$i)); ?>
                    </div> 
                    
                </td>
       	</tr>
    </tbody>
     <?php $i++; endforeach; ?>
</table>
<?php endif; ?>
    
</div>



