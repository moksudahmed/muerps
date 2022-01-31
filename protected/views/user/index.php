<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List User', 'url'=>array('index'),'active'=>true),
	array('label'=>'Create User', 'url'=>array('create')),
);

?>

<div class="title">
    <h3>List Users  </h3>
    
    
            
        
</div>
<?php
$groupGridColumns = array(
'name' => 'firstLetter',
'value' => '$data[\'dpt_name\']',
'headerHtmlOptions' => array('style'=>'display:none'),
'htmlOptions' =>array('style'=>'display:none')
);
?>

<?php $this->widget('bootstrap.widgets.TbGroupGridView', array(
	'id'=>'school-grid',
        'type' => 'striped',
        'enablePagination' => true,
        'responsiveTable' => true,
	'dataProvider'=>$model->search(),
    'extraRowColumns'=> array('firstLetter'),
        'extraRowExpression' => '$data[\'dpt_name\']',
        'extraRowHtmlOptions' => array('style'=>'padding:10px;font-weight:bold; color: #333; text-align:right;'),
	'filter'=>$model,
	'columns'=>array(
            $groupGridColumns,
		'userID',
		
		array('header'=>'name','name'=>'per_name','value'=>'$data->per_name','htmlOptions'=>array('class'=>'span-7')),
		'per_email',
                'per_bloodGroup',
                'per_mobile',
		'usr_role',
		'usr_active',
		
		
		 array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{view} {update} ',
            'buttons'=>array
            (
               
                'view' => array
                (
                    'label'=>'View Details',
                    'icon'=>'search white',
                    'url'=>'Yii::app()->createUrl("user/view", array("id"=>$data->userID))',
                    'options'=>array(
                        'class'=>'btn btn-mini btn-success',
                        'data-toggle'=>'tooltip',
                        
                    ),
                ),
                'update' => array
                (
                    'label'=>'Edit Info',
                    'icon'=>'pencil white',
                    'url'=>'Yii::app()->createUrl("user/update", array("id"=>$data->userID))',
                    'options'=>array(
                        'class'=>'btn btn-mini btn-warning',
                        'data-toggle'=>'tooltip',
                        
                        
                        
                    ),
                ),
                'delete' => array
                (
                    'label'=>'delete',
                    'icon'=>'remove white',
                    'url'=>'Yii::app()->createUrl("school/delete", array("id"=>$data->userID))',
                    'options'=>array(
                        'class'=>'btn btn-mini btn-danger',
                        'data-toggle'=>'tooltip',
                        'data-placement'=>'right'
                    ),
                ),
            ),
            'htmlOptions'=>array(
                'style'=>'width: 220px; ',
                'class'=>'moreButtons',
                
            ),
     ),
	),
)); ?>

