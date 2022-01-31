<?php
/* @var $this AdministrationController */
/* @var $model Administration */

$today= date('Y-m-d');

$this->breadcrumbs=array(
	'Exam Department'=>array('ExamDepartment/index'),
	'Exam Registration'=>array('examRegistration/index'),
        'Select Student ID'=>array('examRegistration/getStudentID'),
	'Exam Registered List',
);


?>
<div class="title span-18">
            <h3 >Registered Student List: 
                
            </h3>
            <h4><strong>Term: </strong><span class="label label-info">  <?php echo FormUtil::getTerm( yii::app()->session['exrTerm']);?></span><span class="label label-success"> <?php echo FormUtil::getExamType(yii::app()->session['exrType']).yii::app()->session['exrYear'];?></span></h4>
                    
            
</div>
<div class="title span2">
    <h4><span class="label label-warning"><?php echo FormUtil::getTerm(yii::app()->session['exrTerm']); ?> </span><span class="label label-success"> <?php echo yii::app()->session['exrYear'];  ?></span><strong style="letter-spacing:3px;">Selected Term </strong></h4>
    <h6>Programme:<?php  echo DBhelper::getProgrammeByCode(yii::app()->session['exrProCode']); ?></h6>
</div>
<hr/>
<?php 
    $getRegWith='FormUtil::getModuleRegistrationBatchSection($data->batchName,$data->sectionName)';
    $rel= '$data->moduleRegistrationID-$data->reg_suppleExamRegDate';
    
    $groupGridColumns = array(
'name' => 'firstLetter',
'value' => $getRegWith,
'headerHtmlOptions' => array('style'=>'display:none'),
'htmlOptions' =>array('style'=>'display:none')
);
?>
<?php $this->widget('bootstrap.widgets.TbGroupGridView', array(
        
	'id'=>'admission-grid',
    'type' => 'striped',
    'responsiveTable' => true,
	'dataProvider'=>$dataProvider,
	'extraRowColumns'=> array('firstLetter'),
        'extraRowExpression' => $getRegWith,
        'extraRowHtmlOptions' => array('style'=>'padding:10px;font-size:20px;letter-spacing:2px; text-align:left; '),
    
	'columns'=>array(
                        $groupGridColumns,
                        'moduleRegistrationID',
                        array('header'=>'ID','value'=>'$data->studentID','htmlOptions' =>array('class'=>'span-2'),'footer'=>'modType'),
                        
                        //'per_title',
                         //'per_firstName',
                        //'per_lastName',
			array('header'=>'Name','value'=>'$data->per_name','htmlOptions' =>array('class'=>'span-8'),),
                        
                        'per_gender',
                        //'per_dateOfBirth',
                        'regTermDate'    ,
                        'per_mobile',
                
                        array('header'=>'Reg Date','value'=>'$data->tra_finalExamRegDate','htmlOptions' =>array('class'=>'span-2')),
            array('header'=>'Supple Date','value'=>'$data->reg_suppleExamRegDate','htmlOptions' =>array('class'=>'span-2'),'footer'=>'Total Registered:'),
            
            array('header'=>'Course Code','value'=>'$data->moduleCode','htmlOptions' =>array('style'=>'text-align:left;','class'=>'span-3'),),
            array('header'=>'Title','value'=>'$data->mod_name','htmlOptions' =>array('style'=>'text-align:left;','class'=>'span-6'),),
            //array('header'=>'','value'=>'$data->tra_finalAdmitPrint','htmlOptions' =>array('style'=>'text-align:left;','class'=>'span-3'),),
           /* 'per_email'=>array(
            'class'=>'CLinkColumn',
            'header'=>Yii::t('ui','Email'),
            //'imageUrl'=>CHtml::imageUrl('email.png'),
            'labelExpression'=>'$data->per_email',
            'urlExpression'=>'"mailto://".$data->per_email',
            'htmlOptions'=>array('style'=>'text-align:center'),
        ),*/
  
            
            
            array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{view} {delete}',
            'buttons'=>array
            (
                
                'view' => array
                (
                    'label'=>'View Details',
                    'icon'=>'search white',
                    'url'=>'Yii::app()->createUrl("moduleRegistration/index", array("id"=>$data->termAdmissionID))',
                    'options'=>array(
                        'class'=>'btn btn-mini btn-success',
                        'data-toggle'=>'tooltip',
                        
                    ),
                ),
                
                'delete' => array
                (
                    'label'=>'Cancel Registration',
                    'icon'=>'remove white',
                    'url'=>'Yii::app()->createUrl("examRegistration/deleteSupple", array("id"=>$data->moduleRegistrationID,"date"=>$data->reg_suppleExamRegDate))',
                    'options'=>array(
                        'class'=>'btn btn-mini btn-danger',
                        'data-toggle'=>'tooltip',
                        'style'=>'display:none',
                        'rel'=>'$data->regTermDate',
                        
                        
                    ),
                ),
                
                
            ),
            'htmlOptions'=>array(
                'style'=>'width: 220px; ',
                'class'=>'moreButtons',
                
            ),
     ),   
    )
    
    
)); 


?>

<script type="text/javascript">
    
    
    //---------------
    //---------------
    $( "a[rel=0]").attr('class','btn btn-mini btn-danger');
    $( "a[rel=0]").attr('title','Edit Info [   !! No Photograph included of this Student   ]');
        $("td:contains('modType')").remove(); 
        $("td:contains('Total Registered')").css('font-weight','bold');
    

$(window).load(function () {
        /*
        $( "td:contains('Spring')").addClass('label label-success span1');
        $( "td:contains('Summer')").addClass('label label-warning span1');
        $( "td:contains('Autumn')").addClass('label label-info span1');
         */
        
        
        
        $("a[rel='<?php echo $today; ?>']").css('display','inline-block');
      
    });

</script>
