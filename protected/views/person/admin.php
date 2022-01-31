<?php
/* @var $this PersonController */
/* @var $model Person */

$this->breadcrumbs=array(
	'people'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Person', 'url'=>array('index')),
	array('label'=>'Create Person', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('person-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage people</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'person-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'personID',
		'per_title',
		'per_firstName',
		'per_lastName',
		'per_gender',
		'per_dateofBirth',
		/*
		'per_bloodGroup',
		'per_nationality',
		'per_fathersName',
		'per_mothersName',
		'per_husbandsName',
		'per_parmanentAddress',
		'per_postCode',
		'per_telephone',
		'per_mobile',
		'per_email',
		'per_presentAddress',
		'per_maritulStatus',
		'per_englishLanguageProficiency',
		'per_computerLiteracy',
		'per_otherActivities',
		'per_personalStatment',
		'per_criminalConviction',
		'per_convictionDetails',
		'per_refereeOneName',
		'per_refereeOneOccupation',
		'per_refereeOneAddress',
		'per_refereeOneEmail',
		'per_refereeOneMobile',
		'per_refereeTwoName',
		'per_refereeTwoOccupation',
		'per_refereeTwoAddress',
		'per_refereeTwoEmail',
		'per_refereeTwoMobile',
		'per_entryDate',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
