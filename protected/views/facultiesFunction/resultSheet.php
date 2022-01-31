<?php
/* @var $this AdmissionController */
/* @var $model Admission */


$backUrl = (!yii::app()->session['mreUrlFlag']?Yii::app()->controller->createUrl('GetRegModuleMarksList'):Yii::app()->controller->createUrl('varifyMarks',array('offeredID'=>yii::app()->session['mreOfmID'])));

if(yii::app()->session['mreUrlFlag']==1)
{
    $backUrl=Yii::app()->controller->createUrl('varifyMarks',array('offeredID'=>yii::app()->session['mreOfmID']));
    //$backTitle='Result Authentication';
}
elseif(yii::app()->session['mreUrlFlag']==2)
{
    $backUrl=Yii::app()->controller->createUrl('FacultiesFunction/GetMarksListForBatch');
    //$backTitle='Select Modules';
}
else {
    $backUrl=Yii::app()->controller->createUrl('GetRegModuleMarksList');
    //$backTitle='Faculty Activities';
}



        if(yii::app()->session['mreUrlFlag']==1)
        {
            $this->breadcrumbs=array(
                'Department\'s Activities'=>array('headsFunction/index'),
                'Result Authentication'=>array('headsFunction/courseAuthentication'),
                'Marks Entry'=>$backUrl,
                'Result'
                );
        }
        elseif(yii::app()->session['mreUrlFlag']==2)
        {
            $this->breadcrumbs=array(
                'Department\'s Activities'=>array('headsFunction/index'),
                'Marks Entry By Batch'=>array('FacultiesFunction/GetMarksListForBatch'),
                'Marks Entry'=>$backUrl,
                'Result'
                );
        }
        else
        {
            
            $this->breadcrumbs=array(
                'Faculty Activities'=>array('index'),
                'Marks Entry'=>array('GetRegModuleMarksList'),
                'Result'
                );
        }
?>

<div class="title ">
        <div class="span-16">
            <h3 >Result</h3>
            <h4> <?php echo FormUtil::getBatchTermHTMLspan(yii::app()->session['mreSection'],yii::app()->session['mreBatch'],yii::app()->session['mreProCode'] ); ?></h4>
            <!--h4><strong>Batch: </strong><span class="label label-warning"> <?php echo yii::app()->session['mreBatch'].FormUtil::getBatchNameSufix(yii::app()->session['mreBatch']); ?>  </span><strong>Section: </strong><span class="label label-important"> <?php echo yii::app()->session['mreSection']; ?></span></h4-->
            <h4><strong>Course: </strong><span class="label label-success"><?php echo yii::app()->session['mreModule']; ?></span></h4>
            <h4><strong>Faculty Name: </strong><span class="label label-info"><?php echo yii::app()->session['mreFacultyName']; ?></span></h4>
            
            
              
        </div>
        <div class="span-7">
            <h4><strong>Term: </strong><span class="label label-warning"> <?php echo FormUtil::getTerm(yii::app()->session['mreTerm']); ?>  </span><strong>Year: </strong><span class="label label-info"> <?php echo yii::app()->session['mreYear']; ?></span></h4>
            <h6>Programme:  <?php  echo DBhelper::getProgrammeByCode(yii::app()->session['mreProCode']); ?></h6>
            <h6> <?php echo FormUtil::getTerm( yii::app()->session['mreTerm']);?> <?php echo "Term Final Examination ".yii::app()->session['mreYear'];?></h6>
<?php 


    
$this->widget('bootstrap.widgets.TbMenu', array(
	'type'=>'pills',
	'items'=>array(
            array('label'=>'Back', 'icon'=>'icon-arrow-left' , 'url'=>$backUrl, 'linkOptions'=>array('data-toggle'=>'tooltip','data-placement'=>'top', 'title'=>'Marks Entry',), 'visible'=>true),	
             array('label'=>'Result Sheet', 'icon'=>'icon-print', 'url'=>Yii::app()->controller->createUrl('GenerateGradeSheet'), 'linkOptions'=>array('target'=>'_blank'), 'visible'=>true),
		array('label'=>'60 Marks', 'icon'=>'icon-print', 'url'=>Yii::app()->controller->createUrl('Generate60PDF'), 'linkOptions'=>array('target'=>'_blank'), 'visible'=>true),
                array('label'=>'100 Marks', 'icon'=>'icon-print', 'url'=>Yii::app()->controller->createUrl('Generate100PDF'), 'linkOptions'=>array('target'=>'_blank', 'data-toggle'=>'tooltip','data-placement'=>'right', 'title'=>'PDF',), 'visible'=>true),
            array('label'=>'100 Marks', 'icon'=>'icon-download', 'url'=>Yii::app()->controller->createUrl('Generate100XLS'), 'linkOptions'=>array('target'=>'_blank', 'data-toggle'=>'tooltip','data-placement'=>'right', 'title'=>'XLS',), 'visible'=>true),
               
	),
));
?>
            </div>
        
    </div>
        <strong style="font-size: 12px;">Entry:</strong>
            <?php 
           $model = Offeredmodule::model()->findByPk(yii::app()->session['mreOfmID']);
           //echo $model->publish_result;
           
            $this->widget('bootstrap.widgets.TbEditableField', array(
                'type' => 'select',
                'model' => $model,
                'attribute' => 'ofm_approval',
                'url' => Yii::app()->createUrl("facultiesFunction/saveApproval", array("id"=>$model->offeredModuleID)),
                'source' => array(1=>'Complete',0=>'Not Complete'),
                'htmlOptions'=>array('style'=>'padding:0px 0px 10px 0px; font-weight:bold; border-bottom: 0px solid ', 
                  ),
                
                'display' => 'js: function(value, sourceData) {
                        var escapedValue = $(this).text(value).html();

                        if(escapedValue==1)
                        {
                          $(this).html("<span class=\"label label-success\" style=\"height:30px; width:110px; padding:20px 10px 10px 10px; font-size:20px;\" > Complete <i class=\"icon-ok\"></i> </span>")
                        }
                        else $(this).html("<span class=\"label label-warning\" style=\"height:30px; width:120px; padding:20px 10px 10px 10px; font-size:16px;\"> Not Complete <i class=\"icon-remove\"></i></span>")

                      }'
                
                )
                    
                    );
            
            ?>    
        
<hr style=""/>

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

<script type="text/javascript">
    
    
        // prevent the click event
       
    
    $(window).load(function () {
        
        $( "td:contains('Spring')").addClass('label label-success span1');
        $( "td:contains('Summer')").addClass('label label-warning span1');
        $( "td:contains('Autumn')").addClass('label label-info span1');
         //$(this).contents().text();
        $("td:contains('modType')").replaceWith(); 
        $("td:contains('Total Credit')").css('font-weight','bold');      
    });
    
</script>
