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
    $secondHalfMarks= $markingScheme->mrs_final;
?>

    <div class="title span-24">
        <div class="span-14">
            <h3 >Marks Verification: [ Final ]</h3>
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
		
		array('label'=>'Result & Tabulation', 'icon'=>'icon-download', 'url'=>Yii::app()->controller->createUrl('reportTabulation'),  'visible'=>true),
		
	),
));

?>
        </div>
    </div>
<div class="span-24">
    <?php  if ($moduleReg !== null):?>
<table class="table table-bordered span-24">
    <thead>
	<tr>
                <th >
		      Student ID		
                </th>
		<th >
		      Name	
                </th>
 		<th >
		      <span style="padding: 0px 3px 0px 0px;"> ( Attendance<sup><?php echo $markingScheme->mrs_attendance; ?></sup> - Class Test<sup><?php echo $markingScheme->mrs_classTest; ?></sup> - Midterm<sup><?php echo $markingScheme->mrs_midterm; ?></sup> )</span>
                      <span style="font-size: 15px"> out of <?php echo $firstHalfMarks; ?></span>
                </th>
                <th>
                    <span style="font-size: 15px; padding: 0px 17px 0px 52px;"> Final <sup> <?php echo $secondHalfMarks; ?> </sup></span>
                   <span style="font-size: 15px; "> out of  <?php echo $secondHalfMarks+$firstHalfMarks; ?></span>
                </th>
 	</tr>
    </thead>
    <tbody>
	<?php $i=1; foreach($moduleReg as $row): ?>
	<tr>
                <td class="span-2" style="font-weight:bold;">
			<?php echo $row['studentID']; ?>
		</td >
       		<td class="span-3">
			<?php echo $row['per_name']; ?>
		</td>
                
                <td class="span-8">
                    <div >
                        <?php $form = $this->beginWidget(
                        'bootstrap.widgets.TbActiveForm',
                        array(
                        'id' => 'inlineForm',//.$moduleRegistrationID,
                        'type' => 'inline',
                        //'htmlOptions' => array('class' => 'well'),
                        )
                        ); 
                        
                        echo CHtml::numberField('attendance-'.$i, $row['reg_attendence'],array('class'=>'span-2','style'=>'font-size:16px;','disabled'=>true,'pattern'=>'([0-1][0-9])$','maxlength'=>2,'min'=>0, 'max'=>10, 'required'=>true));
                        echo CHtml::numberField('classTest-'.$i, $row['reg_classTest'],array('class'=>'span-2','style'=>'font-size:16px;','disabled'=>true,'pattern'=>'([0-9][0-9])$','maxlength'=>2,'min'=>0, 'max'=>10, 'required'=>true));
                        echo CHtml::numberField('midterm-'.$i, $row['reg_midterm'],array('class'=>'span-2','style'=>'font-size:16px;','disabled'=>true,'pattern'=>'([0-9][0-9])$','maxlength'=>2,'min'=>0, 'max'=>10, 'required'=>true));
                        echo CHtml::textField('total-'.$i, $row['total'],array('class'=>'span-2','style'=>'font-weight:bold; font-size:16px; text-align:right;','disabled'=>true,'pattern'=>'([0-9][0-9])$','maxlength'=>2,'min'=>0, 'max'=>10, 'required'=>true));
                        ?>

                        <?php
                        $this->endWidget();
                        unset($form);
                       ?>
                    </div>
                </td>
                <td class="span-7">
                    <div id="form-<?php echo $i; ?>" >
                       <?php $sql = "select * from vw_getsecondhalfmarkslist where \"moduleRegistrationID\"=:regID and \"examinationID\"=:examID ;";
                    
                    
                        $regFinal= ModuleRegistration::model()->findBySql($sql,array(':regID'=>$row['moduleRegistrationID'],':examID'=>yii::app()->session['mreExaminationID'])); 
                    
                        
                      
                        ?>
                       <?php $this->renderPartial('_formSecondHalf',array('regFinal'=>$regFinal,'i'=>$i)); ?>
                    </div> 
                    
                </td>
       	</tr>
    </tbody>
     <?php $i++; endforeach; ?>
</table>
<?php endif; ?>
    
</div>



