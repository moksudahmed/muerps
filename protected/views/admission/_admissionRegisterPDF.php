  <?php                           
               
$proName='$data[\'pro_shortName\']';

$ID=array(
    'name'=>'ID',
    'header'=>'Id',
    'value'=>'$data[\'id\']',

    'htmlOptions' =>array('style'=>'padding:10px; text-align:left; font-size: 0.8em; color: #333;'),
    
);

$adm_date=array(
    'name'=>'adm_date',
    'header'=>'Date of Admission',
    'value'=>'$data[\'adm_date\']',

    'htmlOptions' =>array('style'=>'padding:10px; text-align:left; font-size: 0.8em; color: #333;'),
    
);
$wav_title=array(
    'name'=>'wav_title',
    'header'=>'Waiver',
    'value'=>'$data[\'wav_title\']',

    'htmlOptions' =>array('style'=>'padding:10px; text-align:left; font-size: 0.8em; color: #333;'),
    
);
$per_mobile=array(
    'name'=>'per_mobile',
    'header'=>'Mobile No',
    'value'=>'$data[\'per_mobile\']',

    'htmlOptions' =>array('style'=>'padding:10px; text-align:left; font-size: 0.8em; color: #333;'),
    
);
$per_presentAddress=array(
    'name'=>'per_presentAddress',
    'header'=>'Address',
    'value'=>'$data[\'per_presentAddress\']',

    'htmlOptions' =>array('style'=>'padding:10px; text-align:left; font-size: 0.8em; color: #333;'),
    
);
$per_fathersName=array(
    'name'=>'per_fathersName',
    'header'=>'Fathers Name',
    'value'=>'$data[\'per_fathersName\']',

    'htmlOptions' =>array('style'=>'padding:10px; text-align:left; font-size: 0.8em; color: #333;'),
    
);
$name=array(
    'name'=>'per_name',
    'header'=>'Name',
    'value'=>'$data[\'per_name\']',
    'htmlOptions' =>array('style'=>'padding:10px; text-align:left; font-size: 0.8em; color: #333;'),
    
);
$bloodGroup=array(
    'name'=>'per_bloodGroup',
    'header'=>'Blood Group',
    'value'=>'$data[\'per_bloodGroup\']',
    'htmlOptions' =>array('style'=>'padding:10px; text-align:left; font-size: 0.8em; color: #333;'),
    
);
$groupGridColumns = array(
'name' => 'firstLetter',
'value' => $proName,
'headerHtmlOptions' => array('style'=>'display:none'),
'htmlOptions' =>array('style'=>'display:none'),
    
);
     
$this->widget('bootstrap.widgets.TbGroupGridView', array(
        
        'id'=>'publishedResult-grid1',
        'type' => 'striped',
        'enablePagination' => true,
        'responsiveTable' => true,
	'dataProvider'=>$dataProvider,
    
	

    
    	'extraRowColumns'=> array('firstLetter'),
        'extraRowExpression' => $proName,
        'extraRowHtmlOptions' => array('style'=>'padding:10px; text-align:right; font-size: 1.5em; color: #333;'),
        
        'bulkActions' => array(
          
          
            'checkBoxColumnConfig' => array(
            'name' => 'id',
            
            ),
            
        ),
    
        
	'columns'=>array(
                          
                $groupGridColumns,                     
                $ID,
                $name,            
                $bloodGroup,
                $per_fathersName,
                $per_presentAddress,
                $per_mobile,
                $wav_title,
                $adm_date,
                //array('header'=>'','value'=>$getAdmitStatus,'htmlOptions' =>array('style'=>'text-align:left;','class'=>'span-5')),
		         
    )
    
    
));  

