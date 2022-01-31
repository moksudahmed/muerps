<?php
/* @var $this ModuleController */
/* @var $model Module */

$this->breadcrumbs=array(
    'Registry'=>array('site/registry'),
	
	'Syllabus'=>array('Syllabus/index'),
	'Modules'=>array('index','id'=>Yii::app()->session['syllabusCode']),
	
);

$this->menu=array(
    array('label'=>'List Module', 'url'=>array('index'),'active'=>true),
    array('label'=>'Create Module', 'url'=>array('create')),
    
	
	
);


?>
<div class="title">
    
    <h3>List Modules </h3>
    <h4><strong>    Syllabus: </strong> <span  class="label label-warning" > <?php  echo  yii::app()->session['syllabus']; ?></span></h4>
<h4><strong>Programme: </strong> <span  class="label label-success" > <?php  echo  yii::app()->session['programme']; ?></span></h4>
        <h4><strong>Department: </strong> <span  class="label label-important" > <?php  echo  yii::app()->session['department']; ?></span></h4>
    
  
</div>
<hr/>

<?php

//$model = new OfferedModule('search');

$groupGridColumns = array(
'name' => 'firstLetter',
'value' => '$data->mod_group',
'headerHtmlOptions' => array('style'=>'display:none'),
'htmlOptions' =>array('style'=>'display:none')
);

$editableColumn =  array(
'name' => 'mod_name',
'header' => 'Sequence',
'class' => 'bootstrap.widgets.TbEditableColumn',
'headerHtmlOptions' => array('style' => 'width:10px'),
'editable' => array(
    'type' => 'text',
    'url' => Yii::app()->createUrl("module/editable", array("id"=>'$data[moduleCode]',"pid"=>'$data[syllabusCode]'))
    
    )
);

$mod_prerequisite = array(
            'class'=>'CLinkColumn',
            'header'=>'Prerequisite',
            //'imageUrl'=>CHtml::imageUrl('email.png'),
            'labelExpression'=>'$data->mod_prerequisite',
            
            'urlExpression'=>'Yii::app()->createUrl("module/view", array("id"=>$data->mod_prerequisite,"pid"=>$data->syllabusCode))',
          
            'htmlOptions'=>array('style'=>'text-align:center'),
        );

$this->widget('bootstrap.widgets.TbGroupGridView', array(
        
	'id'=>'module-grid',
        'type' => 'striped',
        'enablePagination' => true,
        'responsiveTable' => true,
	'dataProvider'=>$dataProvider,
	//'filter'=>$model,

    
    	'extraRowColumns'=> array('firstLetter'),
        'extraRowExpression' => '"<b style=\"font-size: 20px; color: #333;\">".$data->mod_group."</b>"',
        'extraRowHtmlOptions' => array('style'=>'padding:10px'),
      
        
	'columns'=>array(
           
                $groupGridColumns,
		'moduleCode',
                'mod_shortName',
		'mod_name',
		
		'mod_type',
		'mod_labIncluded',
                //'mod_group',
                $editableColumn,
                $mod_prerequisite,     
                
            array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{view} {update} ',
            'buttons'=>array
            (
               
                'view' => array
                (
                    'label'=>'View Details',
                    'icon'=>'search white',
                    'url'=>'Yii::app()->createUrl("module/view", array("id"=>$data->moduleCode,"pid"=>$data->syllabusCode))',
                    'options'=>array(
                        'class'=>'btn btn-mini btn-success',
                        'data-toggle'=>'tooltip',
                        
                    ),
                ),
                'update' => array
                (
                    'label'=>'Edit Info',
                    'icon'=>'pencil white',
                    'url'=>'Yii::app()->createUrl("module/update", array("id"=>$data->moduleCode,"pid"=>$data->syllabusCode))',
                    'options'=>array(
                        'class'=>'btn btn-mini btn-warning',
                        'data-toggle'=>'tooltip',
                        
                        
                        
                    ),
                ),
                
            ),
            'htmlOptions'=>array(
                'style'=>'width: 220px; ',
                'class'=>'moreButtons',
                
            ),
     ),   
    )
    
    
));  ?>
