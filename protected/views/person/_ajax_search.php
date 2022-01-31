<a href="<?php Yii::app()->controller->createUrl('Person/searchEngine')?>" class="btn btn-primary btn-lg " role="button">Export to PDF</a>
<?php 

   /* foreach ($results as $row)
    {
    echo "<br>";
    echo "First Name: ".$row['per_firstName']."   ";
    echo "Last Name: ".$row['per_lastName']."   ";
    echo "Blood Group".$row['per_bloodGroup']."   ";
   // echo "Date of Birth".$row['per_dateofBirth']."   ";
    }*/
 /* $this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $results,
    'columns' => array('per_firstName', 'per_lastName','per_bloodGroup'),
));*/
    /* $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'job-grid',
    'dataProvider'=>$jobs->search(),
    'filter'=>$jobs,
     ...)); 
/*
$models =$results->getData();

foreach($models as $model)
{
 echo $model->per_firstName;
}
exit();*/
$id=array(
    'name'=>'id',
    'header'=>'ID',
    'value'=>'$data[\'id\']',
    'htmlOptions' =>array('style'=>'padding:10px; text-align:left; font-size: 1em; color: #333;'),
    
);
$per_firstName=array(
    'name'=>'per_firstName',
    'header'=>'First Name',
    'value'=>'$data[\'per_firstName\']',
    'htmlOptions' =>array('style'=>'padding:10px; text-align:left; font-size: 1em; color: #333;'),
    
);
$per_lastName=array(
    'name'=>'per_lastName',
    'header'=>'Last Name',
    'value'=>'$data[\'per_lastName\']',
    'htmlOptions' =>array('style'=>'padding:10px; text-align:left; font-size: 1em; color: #333;'),
    
);
$per_bloodGroup=array(
    'name'=>'per_bloodGroup',
    'header'=>'Blood Group',
    'value'=>'$data[\'per_bloodGroup\']',
    'htmlOptions' =>array('style'=>'padding:10px; text-align:left; font-size: 1em; color: #333;'),
    
);
$per_presentAddress=array(
    'name'=>'per_presentAddress',
    'header'=>'Address',
    'value'=>'$data[\'per_presentAddress\']',
    'htmlOptions' =>array('style'=>'padding:10px; text-align:left; font-size: 1em; color: #333;'),
    
);
$per_mobile=array(
    'name'=>'per_mobile',
    'header'=>'Mobile No',
    'value'=>'$data[\'per_mobile\']',
    'htmlOptions' =>array('style'=>'padding:10px; text-align:left; font-size: 1em; color: #333;'),
    
);
$this->widget('bootstrap.widgets.TbGroupGridView', array(
        
        'id'=>'publishedResult-grid1',
        'type' => 'striped bordered',
        'enablePagination' => true,
        'responsiveTable' => true,
	'dataProvider'=>$results,
    
	

    
    	//'extraRowColumns'=> array('firstLetter'),
        //'extraRowExpression' => $proName,
        //'extraRowHtmlOptions' => array('style'=>'padding:10px; text-align:right; font-size: 1.5em; color: #333;'),
        
        'bulkActions' => array(
          
          
         /*   'checkBoxColumnConfig' => array(
            'name' => 'id',
            
            ),
           */ 
        ),
    
        
	'columns'=>array(                         
                $id,
                $per_firstName,
                $per_lastName,            
                $per_bloodGroup,
                $per_presentAddress,                
                $per_mobile,
                //array('header'=>'','value'=>$getAdmitStatus,'htmlOptions' =>array('style'=>'text-align:left;','class'=>'span-5')),
		         
    )
    
    
));  
?>