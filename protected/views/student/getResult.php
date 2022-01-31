<?php
/* @var $this ModuleRegistrationController */
/* @var $model ModuleRegistration */

$this->breadcrumbs=array(
    
	
        'Student Profile' =>array('student/profileIndex'),
	'Academic Record',
	
);



?>


<br/><br/>
    <div class="title">
            <div class="span-14">
                <h3>Academic Record:</h3>
                <h3><strong>Student ID: </strong> <span class="label label-success"> <?php echo yii::app()->session['studentID'];  ?></span></h3>
                 <h3><strong>Name: </strong> <span class="label label-info"> <?php echo yii::app()->session['studentName']; ?></span></h3>
                
                <h4><strong>Section: </strong><span class="label label-important"> <?php echo yii::app()->session['secName']; ?></span><strong>Batch: </strong><span class="label label-success"> <?php echo yii::app()->session['batName'].FormUtil::getBatchNameSufix(yii::app()->session['batName']); ?>  </span></h4>
                
                <h4><strong>Student Academic Year: </strong><span class="label label-info"><?php  echo FormUtil::getTerm(yii::app()->session['acTerm'])." ".yii::app()->session['acYear'] ;  ?></span></h4>
            
            </div>
        <div class="span-6" style="padding:105px 0px 0px 0px;">
            <h6 ><strong>Programme: </strong> <?php  echo DBhelper::getProgrammeByCode(yii::app()->session['proCode']); ?></h6>
        <div class="">
            <?php 
            $this->widget('bootstrap.widgets.TbMenu', array(
                    'type'=>'pills',
                    'items'=>array(

                            array('label'=>'Profile', 'icon'=>'icon-download', 'url'=>Yii::app()->controller->createUrl('student/profileIndex'), 'linkOptions'=>array(), 'visible'=>true),
                            //array('label'=>'Taken Courses', 'icon'=>'icon-download', 'url'=>Yii::app()->controller->createUrl('student/registeredCourse'), 'linkOptions'=>array(), 'visible'=>true),

                    ),
            ));

            ?>
        </div>
        </div>
            <div class="img-polaroid span-4" >
                <?php echo CHtml::image('./photograph/'.yii::app()->session['studentID'].'.jpg',yii::app()->session['studentName']); ?>
            </div>
                   
     </div>

<hr/>
<?php

$getRegType='FormUtil::getModuleRegistrationType($data[\'reg_type\'],$data[\'sectionName\'],$data[\'batchName\'])';
$termYear='FormUtil::getTermYearWithNumber($data[\'batchName\'],$data[\'programmeCode\'],$data[\'tra_term\'], $data[\'tra_year\'])';


$getRegWith='FormUtil::getModuleRegistrationBatchSection($data[\'batchName\'],$data[\'sectionName\'])';


//echo date('d-F-y','2013-12-31');



$groupGridColumns = array(
'name' => 'firstLetter',
'value' => '$data[\'tra_term\']',
'headerHtmlOptions' => array('style'=>'display:none'),
'htmlOptions' =>array('style'=>'display:none')
);






$this->widget('bootstrap.widgets.TbGroupGridView', array(
        
	'id'=>'offeredModule-grid3',
        'type' => 'table-hover'/*'striped'*/,
    
        'enablePagination' => true,
        'responsiveTable' => true,
	'dataProvider'=>  $dataProvider,
	//'filter'=>$model,

    
    	'extraRowColumns'=> array('firstLetter'),
        'extraRowExpression' => $termYear,
        'extraRowHtmlOptions' => array('style'=>'padding:10px;font-size:20px;letter-spacing:2px; text-align:right; '),
      
        
	'columns'=>array(
           
                $groupGridColumns,
                
		array('header'=>'Course: (Code','value'=>'$data[\'moduleCode\']','htmlOptions' =>array('class'=>'span-2'),'footer'=>'modType'),
		array('header'=>'Name','value'=>'$data[\'mod_name\']','htmlOptions' =>array('class'=>'span-7')),
                
                array('name'=>'mod_creditHour','header'=>'Credit Hour)','htmlOptions' =>array('style'=>'text-align:left;','class'=>'span-3'),'class'=>'bootstrap.widgets.TbTotalSumColumn',),
                
		
                
		
		
            
                array('header'=>'Reg: (date,','value'=>'FormUtil::getFormatedDate($data[\'reg_date\'])','htmlOptions' =>array('class'=>'span-3'),),
                array('header'=>'with)','value'=>$getRegWith,'htmlOptions' =>array('class'=>'span-2'),),
                array('header'=>'','value'=>'$data[\'reg_status\']','htmlOptions' =>array('class'=>'span-4'),),
                array('header'=>'First Half','value'=>'$data[\'markFirstHalf\']','htmlOptions' =>array('class'=>'span-2')),
                array('header'=>'Final','value'=>'$data[\'markSecondHalf\']','htmlOptions' =>array('class'=>'span-2')),
                array('header'=>'Letter Grade','value'=>'$data[\'letterGrade\']','htmlOptions' =>array('class'=>'span-2')),
                array('header'=>'Grade Point','value'=>'$data[\'gradePoint\']','htmlOptions' =>array('class'=>'span-2')),

            )
    
    
));  ?>

</div>
<script type="text/javascript">
    
    
        // prevent the click event
       
    
    $(window).load(function () {
        
        $( "td:contains('Spring')").addClass('label label-success span1');
        $( "td:contains('Summer')").addClass('label label-warning span1');
        $( "td:contains('Autumn')").addClass('label label-info span1');
         
        $("td:contains('modType')").remove(); 
        $("tfoot").remove(); 
        $("td:contains('Total Credit')").css('font-weight','bold');      
        $( "td:contains('Regular')").css('color','#fff');
        $( "td:contains('Retaken')").css('color','#fff');
    });
    
</script>

