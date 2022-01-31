<?php
/* @var $this AdministrativeReportController */

$this->breadcrumbs=array(
   'Registry'=>array('site/registry'),
    
	'Tools'=>array('index'),	
);



$this->widget('bootstrap.widgets.TbExtendedGridView', array(
    'id'=>'moduleRegistration-grid',
    'type' => 'striped bordered',
    'dataProvider' => $dataProvider,
    'template' => "{items}",
    'selectableRows' => 2,
    'bulkActions' => array(
    'actionButtons' => array(
      /*  array(
                'id'=>'oo',
                'icon'=>'plus-sign white',
                'url' => array('deleteStudentModuleRegistration'),
            'buttonType' => 'link',
            'type' => 'primary',
            'size' => 'large',
            'label' => 'Delete Records',
       //     'click' => 'js:function(values){console.log(values);}',
     //'click' => 'js:batchActions'

                )*/
        array(
            'id'=>'oo',
                'icon'=>'plus-sign white',
                'url' => array('deleteStudentModuleRegistration'),
            'buttonType' => 'button',
            'context' => 'primary',
            'size' => 'small',
            'label' => 'Testing Primary Bulk Actions',
            'click' => 'js:function(values){console.log(values);}'
            )
        ),
        // if grid doesn't have a checkbox column type, it will attach
        // one and this configuration will be part of it
        'checkBoxColumnConfig' => array(
            'name' => 'studentID'
        ),
    ),
    'columns' => array(
           
               // $groupGridColumns,
            
            //'offeredModuleID',
                array(
                    'header'=>'Student Id',
                    'value'=>'$data[\'studentID\']',
                    'htmlOptions' =>array('class'=>'span-1','style'=>'font-weight:bold;',),
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
                    'htmlOptions' =>array('id'=>'modName','class'=>'span-5',),
                    ),
	
             array(
               // 'name'=>'Time Slot',
                'header'=>'Mid Term',
                'value'=>'$data[\'reg_midterm\']',
                'htmlOptions' =>array('class'=>'span-5','style'=>'text-align:left'),
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
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'',
            'buttons'=>array
            (
               
              /*  'view' => array
                (
                    'label'=>'View Details',
                    'icon'=>'search red',
                    'url'=>'Yii::app()->createUrl("module/view", array("id"=>$data[\'studentID\'],"pid"=>$data[\'moduleRegistrationID\']))',
                    'options'=>array(
                        'class'=>'btn btn-mini btn-success',
                        'data-toggle'=>'tooltip',
                        
                    ),
                ),
                */

            ),
            'htmlOptions'=>array(
                'style'=>'width: 220px; ',
                'class'=>'moreButtons',
                
            ),
     ),   
    ),
));



/*

$this->widget('bootstrap.widgets.TbGroupGridView', array(
        
	'id'=>'moduleRegistration-grid',
        'type'=>'striped bordered',
        'enablePagination' => false,
        'responsiveTable' => true,
	'dataProvider'=> $dataProvider,
	//'filter'=>$model,

    
    //	'extraRowColumns'=> array('firstLetter'),
     //   'extraRowExpression' => $getRegWith,
    //    'extraRowHtmlOptions' => array('style'=>'padding:10px; text-align:right; font-weight:bold;'),
      
        'bulkActions' => array(
            'actionButtons' => array(
            array(
                'id'=>'oo',
                'icon'=>'plus-sign white',
                'url' => array('deleteStudentModuleRegistration'),
            'buttonType' => 'link',
            'type' => 'primary',
            'size' => 'large',
            'label' => 'Delete Records',
       //     'click' => 'js:function(values){console.log(values);}',
     //'click' => 'js:batchActions'

                )
            ),
            // if grid doesn't have a checkbox column type, it will attach
            // one and this configuration will be part of it
            'checkBoxColumnConfig' => array(
            'name' => 'moduleRegistrationID',
            'checked'=>'false',
             
            )
        ),
	'columns'=>array(
           
               // $groupGridColumns,
            
            //'offeredModuleID',
                array(
                    'header'=>'Student Id',
                    'value'=>'$data[\'studentID\']',
                    'htmlOptions' =>array('class'=>'span-1','style'=>'font-weight:bold;',),
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
                    'htmlOptions' =>array('id'=>'modName','class'=>'span-5',),
                    ),
	
             array(
               // 'name'=>'Time Slot',
                'header'=>'Mid Term',
                'value'=>'$data[\'reg_midterm\']',
                'htmlOptions' =>array('class'=>'span-5','style'=>'text-align:left'),
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
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'',
            'buttons'=>array
            (
               
              /*  'view' => array
                (
                    'label'=>'View Details',
                    'icon'=>'search red',
                    'url'=>'Yii::app()->createUrl("module/view", array("id"=>$data[\'studentID\'],"pid"=>$data[\'moduleRegistrationID\']))',
                    'options'=>array(
                        'class'=>'btn btn-mini btn-success',
                        'data-toggle'=>'tooltip',
                        
                    ),
                ),
                */

    /*        ),
            'htmlOptions'=>array(
                'style'=>'width: 220px; ',
                'class'=>'moreButtons',
                
            ),
     ),   
    ),
   // 'mergeColumns' => array('mod_group',)
    
)); */ ?>
<script type="text/javascript">
    
       
    $(function(){
        // prevent the click event
        $(document).on('click','#moduleRegistration-grid a#oo',function() {
            var url=$(this).attr('href');
            //alert(url);
            
          var data = { 'moduleRegistrationID[]' : []};
$(":checked").each(function() {
    //alert($(this).val());
    
  data['moduleRegistrationID[]'].push($(this).val());
});

//alert(data['moduleRegistrationID[]']);
/*
$.post('http://localhost:8082/muErpSolV1/index.php?r=offeredModule/selectModule', { name: "John", time: "2pm" });
    */
  /* if (!confirm("Do you Want of Select following Code: "+data['offered[]'])){
      return false;
    }*/
    $.ajax({url:url,
        type:'post',
        data: data,
        success:function(result){
      $("#success").html(result); url='';
    }});
    
    return true;
    });    
    
    
    $( "input[type='checkbox']").on( "click", function()
                            {


                                if ( $(this).prop('checked') ){

                                    var selector = $(this).parent().siblings("td[id='modID']").text();
                                    
                                    var flag1 = $(this).attr('value');
                                    //alert(flag1);
                                    var val='';
                                    
                                    $("td[id='modID']").each(function() {
                                        
                                        if($(this).text()==selector)
                                            {
                                                
                                                var flag2 = $(this).siblings("td[class='checkbox-column']").children('input').attr('value');
                                                if(flag1!=flag2)
                                                {
                                                    //$(this).siblings("td[class='checkbox-column']").children('input').attr('disabled','true');  //.replaceWith('<i class="icon-ok"></i>');
                                                    //$(this).siblings("td[class='checkbox-column']").children('input').removeAttr('checked');                                                
                                                  //  $(this).siblings("td[class='checkbox-column']").children('input').hide('slow');
                                                    
                                                }
                                                //val = val+ $(this).text();
                                            }
                                            
                                      
                                    });
                                    //alert(val);
                                }
                                else 
                                {
                                     var selector = $(this).parent().siblings("td[id='modID']").text();
                                        $("td[id='modID']").each(function() {
                                                if($(this).text()==selector)
                                                {
                                        
                                            //        $(this).siblings("td[class='checkbox-column']").children('input').show('slow');  //.replaceWith('<i class="icon-ok"></i>');
                                                
                                                //val = val+ $(this).text();
                                                }
                                            
                                      
                                    });
                                }


                            } );
    
    
    
    });
    
</script>