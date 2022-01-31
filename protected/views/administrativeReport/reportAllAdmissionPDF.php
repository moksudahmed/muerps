 
<?php 
$modGroup=array(
    'name'=>'Total',
    
    'footer'=>'Total:'
);
$this->widget('bootstrap.widgets.TbGroupGridView', array(
	'id'=>'school-grid',
        'type' => 'striped',
        'enablePagination' => true,
        'responsiveTable' => true,
	'dataProvider'=>$dataProvider,
    
    
    	'extraRowColumns'=> array('firstLetter'),
        'extraRowExpression' => '"<b style=\"font-size: 20px; color: #333;\">".$data->Total."</b>"',
        'extraRowHtmlOptions' => array('style'=>'padding:10px'),
      
    
	'filter'=>$model,
	'columns'=>array(
		'studentID',
                'per_title',
                'per_firstName',
                'per_lastName',
		'per_name',
                'per_fathersName',
                'per_dateOfBirth',
		'per_bloodGroup' ,
                'per_mobile',
                'adm_date',
               
		
    )
    
    
)); 

?>
