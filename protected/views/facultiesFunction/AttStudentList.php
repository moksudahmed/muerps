<?php
/* @var $this AdministrationController */
/* @var $model Administration */

    $this->breadcrumbs=array(
	
    'Faculty Activities'=>array('FacultiesFunction/index'),
	
    'Print Attendance'
);



?>
<div class="title span-16">
            <h3 class="title">Print Attendance<br/>
                
            </h3>
    <h4> <?php echo FormUtil::getBatchTermHTMLspan(yii::app()->session['attSecName'],yii::app()->session['attBatName'],yii::app()->session['attProCode'] ); ?></h4>
            
      </div>

<div class="title span-6">
    <h4><strong style="letter-spacing:3px;">Selected Term </strong>
        <br/>
        <span class="label label-warning"><?php echo FormUtil::getTerm(yii::app()->session['attTerm']); ?> </span><span class="label label-success"> <?php echo yii::app()->session['attYear'];  ?></span></h4>
    <h6>Programme:<?php  echo DBhelper::getProgrammeByCode(yii::app()->session['attProCode']); ?></h6>
    <?php 


$this->widget('bootstrap.widgets.TbMenu', array(
	'type'=>'pills',
	'items'=>array(
		
	//array('label'=>'Generate 100 Mark Sheet', 'icon'=>'icon-download', 'url'=>Yii::app()->controller->createUrl('GenerateFirstHalfPDF'), 'linkOptions'=>array('target'=>'_blank'), 'visible'=>true),
        array('label'=>'Back', 'icon'=>'icon-arrow-left' , 'url'=>Yii::app()->controller->createUrl('index'), 'linkOptions'=>array('data-toggle'=>'tooltip','data-placement'=>'top', 'title'=>'Faculty Activities',), 'visible'=>true),	
	//array('label'=>'Next', 'icon'=>'icon-play-circle', 'url'=>Yii::app()->controller->createUrl('resultSheet'), 'linkOptions'=>array('data-toggle'=>'tooltip','data-placement'=>'right', 'title'=>'Get Result') , 'visible'=>true, ),	
	),
));

            
                ?>
</div>
<hr/>
<div class=" span-24">
    <?php if(count($model)!=0): ?>
    <table class="table-bordered table-striped">
        <!--thead>
            <tr>
                <th class="span-7">Course</th>
                <th class="span-6">Faculty</th>
                <th class="span-1">Batch Wise</th>
                <th class="span-1">Course Wise</th>
            </tr>
        </thead-->
        <tbody>
            
            <?php foreach($model as $item):?>
            <tr>
                <?php  yii::app()->session['course-'.$item->offeredModuleID] = $item->moduleCode.': '.$item->mod_name; 
                        yii::app()->session['faculty-'.$item->offeredModuleID] = $item->per_name;
                ?>
                <td><?php echo $item->moduleCode.': '.$item->mod_name; ?></td>
                <td><?php echo $item->per_name ?></td>
                <!--td><?php echo CHtml::link('XLS', Yii::app()->controller->createUrl('attendanceEXCEL',array('id'=>$item->offeredModuleID)), array('class'=>'btn btn-mini btn-info','icon'=>'icon-arrow-left','style'=>'font-weight:bold; font-size:15px; padding:0px 20px 0px 25px;', 'data-toggle'=>'tooltip', 'title'=>'All Admitted Students')) ?></td>
                <td><?php echo CHtml::link('XLS', Yii::app()->controller->createUrl('TermAdmittedExcel',array('id'=>$item->offeredModuleID)), array('class'=>'btn btn-mini btn-success','style'=>'font-weight:bold; font-size:15px; padding:0px 20px 0px 25px;', 'data-toggle'=>'tooltip','data-placement'=>'right', 'title'=>'Only Registered Students')) ?></td-->
                <td><?php $this->widget(
    'bootstrap.widgets.TbButtonGroup',
    array(
        'buttons' => array(
            array('label' => 'All','icon'=>'icon-print', 'url' => Yii::app()->controller->createUrl('attendanceEXCEL',array('id'=>$item->offeredModuleID)),'htmlOptions'=>array('class'=>'','icon'=>'icon-arrow-left','style'=>'', 'data-toggle'=>'tooltip', 'title'=>'Admitted students')),
            array('label' => 'Registered','icon'=>'icon-print', 'url' => Yii::app()->controller->createUrl('TermAdmittedExcel',array('id'=>$item->offeredModuleID)),'htmlOptions'=>array('class'=>'','icon'=>'icon-arrow-left','style'=>'', 'data-toggle'=>'tooltip', 'title'=>'Only for this course')),
            
        ),
    )
); ?></td>
            </tr>
            <?php            endforeach;?>
        </tbody>
    </table>
    <?php endif; ?>
</div>            
            


<br/>


