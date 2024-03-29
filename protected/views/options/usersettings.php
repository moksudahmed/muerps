<?php
/* @var $this OptionsController */
/* @var $model Options */

$this->breadcrumbs=array(
	'Options',
);

$this->menu=array(	
        array('label'=>'Settings', 'url'=>array('inputSettings')),
        array('label'=>'User Settings', 'url'=>array('inputUserSettings')),
);
?>
<div class="title">
    <h2>User Settings</h2>   
</div>
<hr/>

<?php 

 $this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'loginID',
    'itemsCssClass' => 'table-bordered items',
    'dataProvider' => $dataProvider,
    'columns'=>array(
     
        array(
          // 'class' => 'editable.EditableColumn',
           'name' => 'loginID',
           'headerHtmlOptions' => array('style' => 'width: 110px'),
           /*'editable' => array(    //editable section
                 // 'apply'      => '$data->user_status != 4', //can't edit deleted users
                  'url'        => $this->createUrl('options/updateOptions'),
                  'placement'  => 'right',
              )               */
        ),
        array(
          // 'class' => 'editable.EditableColumn',
           'name' => 'user_name',
           'headerHtmlOptions' => array('style' => 'width: 110px'),
          /* 'editable' => array(    //editable section
                //  'apply'      => '$data->user_status != 4', //can't edit deleted users
                  'url'        => $this->createUrl('options/updateOptions'),
                  'placement'  => 'left',
              )   */
        ),
       array( 
              'class' => 'editable.EditableColumn',
              'name' => 'usr_role',
              'headerHtmlOptions' => array('style' => 'width: 100px'),
              'editable' => array(
                  'type'     => 'select',
                  'url'      => $this->createUrl('user/updateuser'),
                  'source'   => $this->createUrl('user/GetStatusList'),
                  'options'  => array(    //custom display 
                     'display' => 'js: function(value, sourceData) {
                          var selected = $.grep(sourceData, function(o){ return value == o.value; }),
                              colors = {1: "green", 2: "blue", 3: "red", 4: "gray"};
                          $(this).text(selected[0].text).css("color", colors[value]);    
                      }'
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
            'name' => 'usr_password',
            'editable' => array(
                'type'      => 'textarea',
                'url'       => $this->createUrl('user/updateuser'),
                'placement' => 'left',
            )
          ),
        /* array( 
            'class' => 'editable.EditableColumn',
            'name' => 'usr_password',
            'editable' => array(
                'type'      => 'button',
                'url'       => $this->createUrl('user/updateuser'),
                'placement' => 'left',
            )
          ),*/
          array( 
            'class' => 'editable.EditableColumn',
            'name' => 'usr_role',
            'editable' => array(
                'type'      => 'textarea',
                'url'       => $this->createUrl('user/updateuser'),
                'placement' => 'left',
            )
          ),       
         array( 
            'class' => 'editable.EditableColumn',
            'name' => 'usr_active',
            'editable' => array(
                'type'      => 'text',
                'url'       => $this->createUrl('user/updateuser'),
                'placement' => 'left',
            )
          ),           
         
    ),
)); 
 
 
?>
