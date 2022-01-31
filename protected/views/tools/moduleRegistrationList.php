<?php
/* @var $this AdministrativeReportController */

$this->breadcrumbs=array(
   'Registry'=>array('site/registry'),
    
	'Tools'=>array('index'),	
);

$this->widget('bootstrap.widgets.TbExtendedGridView',array(
        'type' => 'striped bordered',
        'id'=>'yiisession-grid',
        'dataProvider'=>$dataProvider,
      //  'filter'=>$model,
        'bulkActions' => array(
                'actionButtons' => array(
                        array(
                                'id'=>'delete',
                                'buttonType' => 'link', //'button',
                                'type' => 'danger',
                                'size' => 'large',
                                'label' => 'Delete Record',
                                'url' => array('studentModuleRegistration'),
                                'htmlOptions' => array(
                                        'class'=>'bulk-action'
                                ),
                                    'click' => 'js:batchActions'
                                )
                        ),
                        // if grid doesn't have a checkbox column type, it will attach
                        // one and this configuration will be part of it
                        'checkBoxColumnConfig' => array(
                                'name' => 'moduleRegistrationID'
                        ),
        ),
        'columns'=>array(
                array(
                    'header'=>'Student Id',
                    'value'=>'$data[\'studentID\']',
                    'htmlOptions' =>array('class'=>'span-2','style'=>'font-weight:bold;',),
                    ),
           
		array(
                //'name'=>'moduleCode',
                'header'=>'Attendence',
                'value'=>'$data[\'reg_attendence\']',
      //          'footer'=>'modType',
                'htmlOptions' =>array('id'=>'modID','class'=>'span-2'),
                ),
                array(
                  //  'name'=>'mod_name',
                    'header'=>'Class Test',
                    'value'=>'$data[\'reg_classTest\']',
    //                'footer'=>'Total Credit:',
                    'htmlOptions' =>array('id'=>'modName','class'=>'span-2',),
                    ),
	
             array(
               // 'name'=>'Time Slot',
                'header'=>'Mid Term',
                'value'=>'$data[\'reg_midterm\']',
                'htmlOptions' =>array('class'=>'span-2','style'=>'text-align:left'),
                //'footer'=>'modType'
               ), 
	   array('name'=>'emr_mark',
                'header'=>'Final Marks','value'=>'$data[\'emr_mark\']',
                'htmlOptions' =>array('class'=>'span-2'),),
            
            array('name'=>'moduleRegistrationID',
                'header'=>'Module Registration ID','value'=>'$data[\'moduleRegistrationID\']',
                'htmlOptions' =>array('class'=>'span-2'),),
            
            
            array('name'=>'offeredModuleID',
                'header'=>'Offered Module ID','value'=>'$data[\'offeredModuleID\']',
                'htmlOptions' =>array('class'=>'span-2'),),
            
                array(
                'htmlOptions' => array('nowrap' => 'nowrap'),
                'class' => 'bootstrap.widgets.TbButtonColumn',
                'viewButtonUrl' => 'Yii::app()->createUrl("ExamDepartment/AcademicRecord", array("studentID"=>$data[\'studentID\']))',
                'updateButtonUrl' => null,
                'deleteButtonUrl' => null,
            ),
        ),
)); ?>

<script type="text/javascript">
    // as a global variable
    var gridId = "yiisession-grid";

    $(function(){
        // prevent the click event
        $(document).on('click','#yiisession-grid a#delete',function() {
            
           // return false;
        var url=$(this).attr('href');
            //alert(url);
            
          var data = { 'grid[]' : []};
$(":checked").each(function() {
    //alert($(this).val());
    
  data['grid[]'].push($(this).val());
});
//alert(data);
    //function batchActions(values){
   /*if (!confirm("Do you Want of Select following Code: "+data['grid[]'])){
      return false;
    }*/
        $.ajax({url:url,
        type:'post',
        data: data,
        success:function(result){
          //  alert( "Data Saved: " + result);
         $("#success").html(result); url='';
      //   $.fn.yiiGridView.update(gridId);
          return true;          
    }});   
           
    });
    });
</script>