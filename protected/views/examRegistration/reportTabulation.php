<?php
/* @var $this AdmissionController */
/* @var $model Admission */

$this->breadcrumbs=array(
	'Department Functions'=>array('offeredModule/index'),
	'Select Module'=>array('examRegistration/getRegisteredModule'),
        'Marks Entry'=>array('GetRegModuleMarksList'),
        'Result'
	
);

?>

<div class="title">
            <h3>Result</h3>
            <h4><strong>Exam: </strong><span class="label label-info">  <?php echo FormUtil::getTerm( yii::app()->session['mreTerm']);?></span><span class="label label-success"> <?php echo "Term Final Examination ".yii::app()->session['mreYear'];?></span></h4>
            <h4><strong>Batch: </strong><span class="label label-important"> <?php echo yii::app()->session['mreBatch'].FormUtil::getBatchNameSufix(yii::app()->session['mreBatch']); ?>  </span><strong>Section: </strong><span class="label label-warning"> <?php echo yii::app()->session['mreSection']; ?>  </span></h4>
            <h4><strong>Programme: </strong> <?php  echo DBhelper::getProgrammeByCode(yii::app()->session['mreProCode']); ?></h4>
        </div>




<?php
//$mod_title= ' $data[mod_name];
$groupGridColumns = array(
'name' => 'firstLetter',
'value' => 'formUtil::concateValues(array($data[\'moduleCode\'],$data[\'mod_name\']))',

);

?>
<?php 
$this->widget('bootstrap.widgets.TbGroupGridView', array(
	'id'=>'school-grid',
        'type' => 'striped',
        'enablePagination' => true,
        'responsiveTable' => true,
	'dataProvider'=>$dataProvider,
    'extraRowColumns'=> array('firstLetter'),
        'extraRowExpression' => '$data[\'moduleCode\'].'-'.$data[\'mod_name\']',
        'extraRowHtmlOptions' => array('style'=>'padding:10px;font-size:20px; color: #333; text-align:right;'),
	//'filter'=>$model,
	'columns'=>array(
            $groupGridColumns,
		array('header'=>'ID','value'=>'$data[\'studentID\']','htmlOptions' =>array('class'=>'span-2')),
                array('header'=>'Name','value'=>'$data[\'per_name\']','htmlOptions' =>array('class'=>'span-4')),
                array('header'=>'60','value'=>'FormUtil::removeZero($data[\'markFirstHalf\'])','htmlOptions' =>array('class'=>'span-2')),
                array('header'=>'40','value'=>'FormUtil::removeZero($data[\'markFinal\'])','htmlOptions' =>array('class'=>'span-2')),
                array('header'=>'Total','value'=>'FormUtil::removeZero($data[\'total\'])','htmlOptions' =>array('class'=>'span-2')),
                array('header'=>'Grade','value'=>'$data[\'letterGrade\']','htmlOptions' =>array('class'=>'span-2')),
          array('header'=>'Grade Point','value'=>'FormUtil::removeZero($data[\'gradePoint\'])','htmlOptions' =>array('class'=>'span-4')),      
          
               // 'exm_examTerm', 
               // 'exm_examYear',
				  
       
    )
    
    
)); 
?>

