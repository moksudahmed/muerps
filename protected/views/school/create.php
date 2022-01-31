<?php
/* @var $this SchoolController */
/* @var $model School */

$this->breadcrumbs=array(
    'Registry'=>array('site/registry'),
	'Schools'=>array('index'),
	'Create',
);

$this->menu=array(
    array('label'=>'List School', 'url'=>array('index')),
    array('label'=>'Create School', 'url'=>'#','active'=>'true'),
	
	
);
?>

<div class="title">
    <h3>Create School</h3>
    
            
        
</div>
<hr/>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>