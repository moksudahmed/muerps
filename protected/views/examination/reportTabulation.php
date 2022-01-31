<?php
/* @var $this AdmissionController */
/* @var $model Admission */

$this->breadcrumbs=array(
	'Exam Activities'=>array('examDepartment/index'),
        
        'Results'
	
);

?>

<div class="title">
            <h3>Results</h3>
            <h4><strong>Exam: </strong><span class="label label-info">  <?php echo FormUtil::getTerm( yii::app()->session['reTerm']);?></span><span class="label label-success"> <?php echo "Term ".FormUtil::getExamType(yii::app()->session['examinationID'])." Examination ".yii::app()->session['reYear'];?></span></h4>
            <h4><strong>Batch: </strong><span class="label label-important"> <?php echo yii::app()->session['reBatName'].FormUtil::getBatchNameSufix(yii::app()->session['reBatName']); ?>  </span></h4>
            <h4><strong>Programme: </strong> <?php  echo DBhelper::getProgrammeByCode(yii::app()->session['reProCode']); ?></h4>
            <h4><strong>Academic Year: </strong><span class="label label-warning">  <?php echo FormUtil::getTerm( yii::app()->session['reAcTerm']);?></span><span class="label label-info"> <?php echo yii::app()->session['reAcYear'];?></span></h4>
        </div>


<?php 
$this->widget('bootstrap.widgets.TbMenu', array(
	'type'=>'pills',
	'items'=>array(
		array('label'=>'back', 'icon'=>'icon-arrow-left' , 'url'=>Yii::app()->controller->createUrl('examDepartment/index'), 'linkOptions'=>array('style'=>'text-weight:bold;','data-toggle'=>'tooltip','data-placement'=>'top', 'title'=>'Exam Activities',), 'visible'=>true),	
		array('label'=>'Export Result Sheet', 'icon'=>'icon-download', 'url'=>Yii::app()->controller->createUrl('ResultPDF'), 'linkOptions'=>array('target'=>'_blank'), 'visible'=>true),
		array('label'=>'Export Tabulation Sheet', 'icon'=>'icon-download', 'url'=>Yii::app()->controller->createUrl('tabulationPDF'), 'linkOptions'=>array('target'=>'_blank'), 'visible'=>true),
	),
));

?>

<?php
//$mod_title= ' $data[mod_name];
$groupGridColumns = array(
'name' => 'firstLetter',
'value' => 'formUtil::concateValues(array($data[\'moduleCode\'],$data[\'mod_name\']))',
'headerHtmlOptions' => array('style'=>'display:none'),
'htmlOptions' =>array('style'=>'display:none')
);

?>
<?php 
$this->widget('bootstrap.widgets.TbGroupGridView', array(
	'id'=>'school-grid',
        'type' => 'striped bordered',
        'enablePagination' => true,
        'responsiveTable' => true,
	'dataProvider'=>$dataProvider,
    'extraRowColumns'=> array('firstLetter'),
       // 'extraRowExpression' => '$data[\'moduleCode\'].'-'.$data[\'mod_name\']',
        'extraRowHtmlOptions' => array('style'=>'padding:10px;font-weight:bold; color: #333; text-align:right;'),
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

