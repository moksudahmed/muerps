
<?php 
//exit();
$getStatus='FormUtil::getAdmissionStatus($data->adm_status)';
$termYear='FormUtil::getTermYear($data[\'stu_academicTerm\'], $data[\'stu_academicYear\'])';
$regWithBatSec ='FormUtil::getRegWithBatchSection($data[\'batchName\'], $data[\'sectionName\'])';
$cgpa = 'FormUtil::getCGPA($data[\'studentID\'])';
?>
<?php $this->widget('bootstrap.widgets.TbExtendedGridView', array(
        
	'id'=>'admission-grid',
    'type' => 'striped bordered',
    'responsiveTable' => true,
    'enablePagination' => true,
	'dataProvider'=>$dataProvider,
            'htmlOptions'=>array('class'=>'span-24','style'=>'font-size:18px;'),
    
	'columns'=>array(
           
                        array('header'=>'ID','value'=>'$data[\'studentID\']','htmlOptions'=>array('class'=>'span-5','style'=>'font-weight:bold;'),),
                        
                        
                        array('header'=>'Name','value'=>'$data[\'per_name\']','htmlOptions'=>array('class'=>'span-6'),),
			array('header'=>'Gender','value'=>'$data[\'per_gender\']','htmlOptions'=>array('class'=>'span-2'),),
                        
                        //'per_dateOfBirth',
			array('header'=>'CGPA',
                            'value'=>$cgpa,
                            'htmlOptions'=>array('class'=>'span-1'),),
                        array('header'=>'Mobile','value'=>'$data[\'per_mobile\']','htmlOptions'=>array('class'=>'span-2'),),
                        array('header'=>'G\'s Mobile','value'=>'$data[\'stu_guardiansMobile\']','htmlOptions'=>array('class'=>'span-2'),),
                       /* array(
                        'name' => 'ACterm','header'=>'AC Term', 
                        'value' => $termYear,
                        //'headerHtmlOptions' => array('style'=>'display:none'),
                        'htmlOptions' =>array('class'=>'span-2','style'=>'font-weight:bold',),'headerHtmlOptions' => array('style'=>''),
                        ),*/
                        array('name'=>'batchName','header'=>'Batch',
                        'value' => $regWithBatSec,
                        'htmlOptions' =>array('class'=>'span-1','style'=>'font-weight:bold',),'headerHtmlOptions' => array('style'=>''),
                        ),
                        
                        //array('value'=>$getStatus,'htmlOptions'=>array('class'=>'span-3'),),
          /*  'per_email'=>array(
            'class'=>'CLinkColumn',
            'header'=>Yii::t('ui','Email'),
            //'imageUrl'=>CHtml::imageUrl('email.png'),
            'labelExpression'=>'$data->per_email',
            'urlExpression'=>'"mailto://".$data->per_email',
            'htmlOptions'=>array('style'=>'text-align:center'),
        ),*/
  
            
            
            array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'htmlOptions'=>array('class'=>'span-2',),
            'template'=>'{ac} {view} {edit} ',
            'buttons'=>array
            (
                'ac' => array
                (
                    'label'=>'Result',
                    'icon'=>'certificate white',
                    'url'=>'Yii::app()->createUrl("ExamDepartment/AcademicRecord", array("studentID"=>$data[\'studentID\']))',
                    'options'=>array(
                        'class'=>'btn btn-medium btn-primary',
                        'data-toggle'=>'tooltip',
                        
                    ),
                ),
                'ah' => array
                (
                    'label'=>'History',
                    'icon'=>'certificate white',
                    'url'=>'Yii::app()->createUrl("academicHistory", array("id"=>$data[\'studentID\']))',
                    'options'=>array(
                        'class'=>'btn btn-mini btn-primary',
                        'data-toggle'=>'tooltip',
                        
                    ),
                ),
                'je' => array
                (
                    'label'=>'Job Experiance',
                    'icon'=>'tasks white',
                    'url'=>'Yii::app()->createUrl("jobExperiance", array("id"=>$data[\'id\'],"sid"=>$data[\'studentID\']))',
                    'options'=>array(
                        'class'=>'btn btn-mini btn-info',
                        'data-toggle'=>'tooltip',
                    ),
                ),
                'view' => array
                (
                    'label'=>'Profile',
                    'icon'=>'search white',
                    'url'=>'Yii::app()->createUrl("student/studentProfile", array("id"=>$data[\'studentID\']))',
                    'options'=>array(
                        'class'=>'btn btn-medium btn-success',
                        'data-toggle'=>'tooltip',
                        
                    ),
                ),
                'edit' => array
                (
                    'label'=>'Edit',
                    'icon'=>'pencil white',
                    'url'=>'Yii::app()->createUrl("admission/updateFromSearch", array("id"=>$data[\'studentID\'],"img"=>1))',
                    'options'=>array(
                        'class'=>'btn btn-medium btn-warning',
                        'data-toggle'=>'tooltip',
                        
                    ),
                ),
                'print' => array
                (
                    'label'=>'print',
                    'icon'=>'print white',
                    'url'=>'Yii::app()->createUrl("admission/admissionFormPDF", array("id"=>$data[\'studentID\']))',
                    'options'=>array(
                        'class'=>'btn btn-mini btn-warning',
                        'data-toggle'=>'tooltip',
                        'data-placement'=>'right',
                        'target'=>'blank'
                    ),
                ),
                
            ),
            'htmlOptions'=>array(
                'style'=>'width: 260px; ',
                'class'=>'moreButtons',
                
            ),
     ),   
    )
    
    
)); 


?>

<script type="text/javascript">
    
    
    //---------------
    //---------------
    $( "a[rel=0]").attr('class','btn btn-mini btn-danger');
    $( "a[rel=0]").attr('title','Edit Info [   !! No Photograph included of this Student   ]');
       
       
       
    jQuery.fn.highlight = function (str, className) {
    var regex = new RegExp(str, "gi");
    return this.each(function () {
        $(this).contents().filter(function() {
            return this.nodeType == 3 && regex.test(this.nodeValue);
        }).replaceWith(function() {
            return (this.nodeValue || "").replace(regex, function(match) {
                return "<span class=\"" + className + "\">" + match + "</span>";
            });
        });
    });
};
    
</script>
