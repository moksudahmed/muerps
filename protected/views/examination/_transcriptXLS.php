<?php  
     $moduleGroupSequence =array("Compulsory GED",
                                "General Education",
                                "Foundation",
                                "Science & Mathematics",
                                "Core",
                                "Project",
                                "Finance and Banking",
                                "Human Resource Management",
                                "Management",
                                "Marketing",
                                "Management Information Systems",
                                "Accounting & Information Systems",
                                "Advanced",
                                "Optional",
                                "Optional GED",                
                                "Power",
                                "Electronics",
                                "Internship/Thesis",
                                "Thesis and Viva",
                                "Civil Law Courses",
                                "Criminial Law Courses",
                                "Other Law Courses");
     
     
    $sql = "SELECT DISTINCT c_mod_group FROM generate_transcript('{$sid}') ORDER BY c_mod_group"; 
    $moduleGroup = Yii::app()->db->createCommand($sql)->queryAll();
   
    /*--------------------Estimate Total Line------------------------------*/    
    
   
   $max_line_in_a_page = yii::app()->session['lines'];   
    
    $page = 1;
    $hl = 8;
    $fl = 8;    
    
    $sql = "SELECT count(*) FROM generate_transcript('{$sid}')";       
    $rows_count = Yii::app()->db->createCommand($sql)->queryAll();
    
    $line = (count($moduleGroup)*3) + $rows_count[0]["count"];
    //echo $line ;exit();
    
    
    $total_line = 0;
    if(( $line%$max_line_in_a_page )!= 0){
        $page = ceil((int)($line) / $max_line_in_a_page);
        if(($line % $max_line_in_a_page)<8) $page = $page - 1;       
    }
     //echo $line; exit();
    $totalPage = $page + 2;
  
 /*--------------------END Estimation------------------------------*/
   
   $sql = "SELECT sum(c_mod_credithour) FROM generate_transcript('{$sid}')";
   $credits = Yii::app()->db->createCommand($sql)->queryAll();
    
   
   /*-----------------Transcript summary page (Fornt page) page# 1------------------------------*/
   $headerData = Examination::model()->searchTranscriptHeaderData($sid);
    
      $sql = "SELECT max(e.emr_date) as passdate FROM  public.tbl_u_exammarks e,  public.tbl_q_termadmission t, 
      public.tbl_s_moduleregistration m WHERE t.\"termAdmissionID\" = m.\"termAdmissionID\" AND
      m.\"moduleRegistrationID\" = e.\"moduleRegistrationID\" AND
      t.\"studentID\" ='{$sid}'";
    $examDate = Yii::app()->db->createCommand($sql)->queryAll();
    $date = $examDate[0]['passdate'];
    //$date = DateTime::createFromFormat('j-M-Y', '15-Feb-2009');
   
   
   
   
 /*-----------------Transcript main page (result pages) ------------------------------*/    
    $sql = "SELECT * FROM generate_transcript('{$sid}') ORDER BY c_mod_group, c_moduleCode";
    $rows = Yii::app()->db->createCommand($sql)->queryAll();
     
    $moduleGroup = FormUtil::arrangeGroups($moduleGroupSequence, $moduleGroup);
    $rows = FormUtil::arrangeGroupItems($rows, $moduleGroup);  
   
    $total_row = $rows_count[0]["count"];
    $start = 0;
    $end = $max_line_in_a_page;
    
    $total_item = 0;
    $count_group = 0;
     
     $group_name =  $moduleGroup[0]['c_mod_group'];     
    
     $editGroupName = array(
            'name' => 'c_mod_group',
            'header' => 'Group Name',
            'class' => 'bootstrap.widgets.TbEditableColumn',
            'headerHtmlOptions' => array('style' => 'width:80px'),
                'htmlOptions'=>array('class'=>'span-10'),
            'editable' => array(
                'type' => 'select',
              //  'url' => Yii::app()->createUrl("offeredModule/editable", array("id"=>'$data->offeredModuleID')),
                'htmlOptions'=>array('style'=>'font-weight:bold; border-bottom: 0px solid'),
                'source' =>CHtml::listData($moduleGroup, 'id', 'text','group')
                )
            );
  /*  $this->widget('bootstrap.widgets.TbExtendedGridView', array(
        //'filter'=>$person,
        'type'=>'striped bordered',
        'dataProvider' => $dataProvider,
        'template' => "{items}",
        'columns' =>array(
          //  array('name'=>'id', 'header'=>'#', 'htmlOptions'=>array('style'=>'width: 60px')),
            array('name'=>'c_modulecode', 'header'=>'Module Code', 'htmlOptions'=>array('style'=>'width: 120px')),            
            array('name'=>'c_title', 'header'=>'Module Title'),  
            $editGroupName,
            //array('name'=>'c_mod_group', 'header'=>'Module Group'),    
            array('name'=>'c_mod_credithour', 'header'=>'Credit Hour'),    
            array('name'=>'c_lettergrade', 'header'=>'Letter Grade'),    
            
            
            
            array(
                'htmlOptions' => array('nowrap'=>'nowrap'),
                'class'=>'bootstrap.widgets.TbButtonColumn',
                'viewButtonUrl'=>null,
                'updateButtonUrl'=>null,
                'deleteButtonUrl'=>null,
            )
        ),
    ));
            
    
    
 /*   
    
    $this->widget('bootstrap.widgets.TbGroupGridView', array(
        
	'id'=>'resultPublish-grid',
        'type'=>'striped bordered',
        'enablePagination' => true,
        'responsiveTable' => true,
	'dataProvider'=> $dataProvider,
	//'filter'=>$model,

    
    //	'extraRowColumns'=> array('firstLetter'),
    //    'extraRowExpression' => $getRegWith,
    //    'extraRowHtmlOptions' => array('style'=>'padding-right:10px; text-align:right; font-weight:bold ; font-size:16px; color: #333;'),
/*
        'bulkActions' => array(
            'actionButtons' => array(
            array(
                'id'=>'oo',
                'icon'=>'plus-sign white',
                'url' => array('headsfunction/updatePublishResult'),
            'buttonType' => 'link',
            'type' => 'warning',
            'size' => 'large',
            'label' => 'Publish Result',
            //'click' => 'js:function(values){console.log(values);}'
     // 'click' => 'js:batchActions'

                )
            ),
            // if grid doesn't have a checkbox column type, it will attach
            // one and this configuration will be part of it
            'checkBoxColumnConfig' => array(
            'name' => 'offeredModuleID',
            'checked'=>'false',
               
            )
        ),*/
/*	'columns'=>array(
                      array('name'=>'c_modulecode', 'header'=>'Module Code', 'htmlOptions'=>array('style'=>'width: 120px')),            
            array('name'=>'c_title', 'header'=>'Module Title'),  
            $editGroupName,
            //array('name'=>'c_mod_group', 'header'=>'Module Group'),    
            array('name'=>'c_mod_credithour', 'header'=>'Credit Hour'),    
            array('name'=>'c_lettergrade', 'header'=>'Letter Grade'),    
            
                 
             //   $groupGridColumns,                     
           //     array('header'=>'Completed Course','name'=>'id','value'=>'$data[\'moduleCode\']." - ".$data[\'mod_name\']','htmlOptions'=>array('class'=>'span-18')),
            //'offeredModuleID',
             //   $offeredModuleID,
	//	$moduleCode,
		//$moduleName,
             //   array(   'name'=>'mod_creditHour','header'=>'','htmlOptions' =>array('class'=>'span-1',)),
            //    $editableColumn4,    
           //     array(   'name'=>'ofm_approval','header'=>'','htmlOptions' =>array('class'=>'span-2','rel'=>'entry',)),
            //    $editableColumn2,
               // $sectionName,
                //$facultyName,
              //  $editableColumn3,
                
              //  $editableColumn1,
            
            //    array(   'name'=>'per_email','header'=>'','htmlOptions' =>array('class'=>'span-2',)),
             //   array(   'name'=>'per_mobile','header'=>'','htmlOptions' =>array('class'=>'span-2',)),
                

		
      //      array('header'=>'Batch Name','value'=>'$data[\'batchName\']','htmlOptions' =>array('class'=>'span-2'),),
               // array('header'=>'Offered To','value'=>$getRegWith,'htmlOptions' =>array('class'=>'span-2'),),
                
                //'mod_group',
               

		 array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{marksEntry} {regStudent}',
            'buttons'=>array
            (
               
                'marksEntry' => array
                (
                    'label'=>'Marks Entry',
                    'icon'=>'search ',
                    'url'=>'Yii::app()->createUrl("facultiesFunction/varifyMarks", array("offeredID"=>$data[\'offeredModuleID\']))',
                    'options'=>array(
                        'class'=>'btn btn-mini btn-info',
                        'data-toggle'=>'tooltip',
                        
                    ),
                ),
                'regStudent' => array
                (
                    'label'=>'Registered Students',
                    'icon'=>'user ',
                    'url'=>'Yii::app()->createUrl("headsFunction/regStudentToCourse", array("offeredModuleID"=>$data[\'offeredModuleID\']))',
                    'options'=>array(
                        'class'=>'btn btn-mini btn-success',
                        'data-toggle'=>'tooltip',
                        
                    ),
                ),
                
            ),
            'htmlOptions'=>array(
                'style'=>'width: 220px; ',
                'class'=>'moreButtons',
                
            ),
                     
     ),
         
    ),
    'mergeColumns' => array('per_email','per_mobile')
    
)); */
        
         $this->widget('bootstrap.widgets.TbGridView', array(
        'id' => 'usergrid',
        'itemsCssClass' => 'table-bordered items',
        'dataProvider' => $dataProvider,
        'columns'=>array(
            array(
               'class' => 'editable.EditableColumn',
               'name' => 'c_modulecode',
               'headerHtmlOptions' => array('style' => 'width: 110px'),
                          
            ),
             array( 
                  'class' => 'editable.EditableColumn',
                  'name'  => 'c_title',
                  'headerHtmlOptions' => array('style' => 'width: 100px'),
                  
             ), 
             array( 
              'class' => 'editable.EditableColumn',
              'name' => 'c_mod_group',
              'headerHtmlOptions' => array('style' => 'width: 100px'),
              'editable' => array(
                  'type'     => 'select',
                  'url'      => $this->createUrl('site/updateUser'),
                  'source' => array('Core'=>'core','General Education'=>'tew'),
                  'options'  => array(    //custom display 
                     /*'display' => 'js: function(value, sourceData) {
                          var selected = $.grep(sourceData, function(o){ return value == o.value; }),
                              colors = {1: "green", 2: "blue", 3: "red", 4: "gray"};
                          $(this).text(selected[0].text).css("color", colors[value]);    
                      }'*/
                  ),
                 //onsave event handler 
                 'onSave' => 'js: function(e, params) {
                      console && console.log("saved value: "+params.newValue);
                 }',
                 //source url can depend on some parameters, then use js function:
                 /*
                 'source' => 'js: function() {
                      var dob = $(this).closest("td").next().find(".editable").text();
                      var username = $(this).data("username");
                      return "?r=site/getStatuses&user="+username+"&dob="+dob;
                 }',
                 'htmlOptions' => array(
                     'data-username' => '$data->user_name'
                 )
                 */
              )
         ),
          
            
             
             array( 
                'class' => 'editable.EditableColumn',
                'name' => 'c_mod_credithour',
                
              ),  
             
             //editable related attribute with sorting.
             //see http://www.yiiframework.com/wiki/281/searching-and-sorting-by-related-model-in-cgridview  
             array( 
                'class' => 'editable.EditableColumn',
                'name' => 'c_lettergrade',
                
            ), 
        ),
    )); 
    ?>   
