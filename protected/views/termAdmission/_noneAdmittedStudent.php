<div  class="span-24">
    <h5>
                     <?php if (Yii::app()->user->hasFlash('success')):?>
                            <div class="alert in alert-block fade alert-success">
                              <button type="button" class="close" data-dismiss="alert">&times;</button>
                              <?php echo Yii::app()->user->getFlash('success')?>
                            </div>
                    <?php endif;?>
            </h5>

    <h5>
                     <?php if (Yii::app()->user->hasFlash('warning')):?>
                            <div class="alert in alert-block fade alert-warning">
                              <button type="button" class="close" data-dismiss="alert">&times;</button>
                              <?php echo Yii::app()->user->getFlash('warning')?>
                            </div>
                    <?php endif;?>
    </h5>
</div>
<div id="success" class="span-24">


    
    <?php


$this->widget('bootstrap.widgets.TbGroupGridView', array(
        
	'id'=>'termAdmitted-grid',
        'type' => 'striped bordered',
        'enablePagination' => false,
        'responsiveTable' => true,
	'dataProvider'=>$dataProvider,
	//'filter'=>$model,

    
      
        'bulkActions' => array(
            'actionButtons' => array(
            array(
                'id'=>'oo',
                'icon'=>'plus-sign white',
                'url' => array('termAdmission/createBulkAdmission'),
            'buttonType' => 'link',
            'type' => 'primary',
            'size' => 'large',
            'label' => 'Save Selected Students',
            //'click' => 'js:function(values){console.log(values);}'
     // 'click' => 'js:batchActions'

                )
            ),
            // if grid doesn't have a checkbox column type, it will attach
            // one and this configuration will be part of it
            'checkBoxColumnConfig' => array(
            'name' => 'id'
            ),
        ),
	'columns'=>array(
           
                
		array('header'=>'ID','value'=>'$data[\'studentID\']','htmlOptions'=>array('class'=>'span-4')),
		array('header'=>'Name','value'=>'$data[\'per_name\']','htmlOptions'=>array('class'=>'span-6')),
		array('header'=>'Mobile','value'=>'$data[\'per_mobile\']','htmlOptions'=>array('class'=>'span-4')),
            array('header'=>'Blood Group','value'=>'$data[\'per_bloodGroup\']','htmlOptions'=>array('class'=>'span-4')),
               // array('header'=>'Term Admitted On','value'=>'FormUtil::getFormatedDate($data[\'tra_date\'])','htmlOptions'=>array('class'=>'span-3')),
              /*
                
            array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{view}',
            'buttons'=>array
            (
               
                'view' => array
                (
                    'label'=>'View Details',
                    'icon'=>'search white',
                    'url'=>'Yii::app()->createUrl("module/view", array("id"=>$data[\'moduleCode\'],"pid"=>$data[\'syllabusCode\']))',
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
     ),   */
    )
    
    
));  ?>
</div>

<script type="text/javascript">
    
    $(function(){
        // prevent the click event
        $(document).on('click','#termAdmitted-grid a#oo',function() {
            var url=$(this).attr('href');
            //alert(url);
            
          var data = { 'data[]' : []};
$(":checked").each(function() {
    //alert($(this).val());
    
  data['data[]'].push($(this).val());
});

//alert(data['data[]']);
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
    
    
    
    
    });
    
</script>