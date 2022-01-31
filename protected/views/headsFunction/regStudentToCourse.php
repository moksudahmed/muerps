<?php

$this->breadcrumbs=array(
	'Department Activities'=>array('headsFunction/index'),
        
        'Course Authentication'=>array('headsFunction/courseAuthentication'),
	'Registered Students'
);

?>

<div class="title span-20">
            <h3>Registered Students</h3>
            
            <h4> <?php echo FormUtil::getBatchTermHTMLspan(yii::app()->session['caSectionName'],yii::app()->session['caBatchName'],yii::app()->session['rePublishProCode'] ); ?></h4>
            
            <h4><strong>Course: </strong><span class="label label-success"><?php echo yii::app()->session['caModule']; ?></span></h4>
            <h4><strong>Faculty Name: </strong><span class="label label-info"><?php echo yii::app()->session['caFacultyName']; ?></span></h4>
           
      
</div>
<div class="title span2">
    <h4>
    
    <span class="label label-warning"><?php echo FormUtil::getTerm(yii::app()->session['caTerm']); ?> </span>
        <span class="label label-success"> <?php echo yii::app()->session['caYear'];  ?></span>
        
        <strong style="letter-spacing:3px;">Selected Term </strong></h4>
    <h6>Programme:<?php  echo DBhelper::getProgrammeByCode(yii::app()->session['rePublishProCode']); ?></h6>
    <?php
            $this->widget('bootstrap.widgets.TbMenu', array(
	'type'=>'pills',
	'items'=>array(
		
	//array('label'=>'Generate 100 Mark Sheet', 'icon'=>'icon-download', 'url'=>Yii::app()->controller->createUrl('GenerateFirstHalfPDF'), 'linkOptions'=>array('target'=>'_blank'), 'visible'=>true),
        array('label'=>'Back', 'icon'=>'icon-arrow-left' , 'url'=>Yii::app()->controller->createUrl('headsFunction/courseAuthentication'), 'linkOptions'=>array('data-toggle'=>'tooltip','data-placement'=>'top', 'title'=>'Course Authentication',), 'visible'=>true),	
	array('label'=>'Assaign', 'icon'=>'icon-arrow-right' , 'url'=>Yii::app()->controller->createUrl('headsFunction/AssaignStudentToCourse'), 'linkOptions'=>array('data-toggle'=>'tooltip','data-placement'=>'top', 'title'=>'Assagin New Student',), 'visible'=>true),	
	),
    )); ?>
</div>
<hr/>

        <h5>
		 <?php if (Yii::app()->user->hasFlash('success')):?>
			<div class="alert in alert-block fade alert-success">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  <?php echo Yii::app()->user->getFlash('success')?>
			</div>
		<?php endif;?>
	</h5>

<h5>
		 <?php if (Yii::app()->user->hasFlash('success')):?>
			<div class="alert in alert-block fade alert-success">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  <?php echo Yii::app()->user->getFlash('success')?>
			</div>
		<?php endif;?>
	</h5>
<div id="success" class="span-24">


    
    <?php


$this->widget('bootstrap.widgets.TbGroupGridView', array(
        
	'id'=>'offeredModule-grid2',
        'type' => 'striped bordered',
        'enablePagination' => false,
        'responsiveTable' => true,
	'dataProvider'=>$dataProvider,
	//'filter'=>$model,

    
      /*
        'bulkActions' => array(
            'actionButtons' => array(
            array(
                'id'=>'oo',
                'icon'=>'plus-sign white',
                'url' => array('changeSection'),
            'buttonType' => 'link',
            'type' => 'primary',
            'size' => 'large',
            'label' => 'Save Selected Modules',
            //'click' => 'js:function(values){console.log(values);}'
     // 'click' => 'js:batchActions'

                )
            ),
            // if grid doesn't have a checkbox column type, it will attach
            // one and this configuration will be part of it
            'checkBoxColumnConfig' => array(
            'name' => 'id'
            ),
        ),*/
	'columns'=>array(
           
                
		array('header'=>'Student ID','value'=>'$data[\'studentID\']','htmlOptions'=>array('class'=>'span-3')),
		array('header'=>'Name','value'=>'$data[\'per_name\']','htmlOptions'=>array('class'=>'span-6')),
		array('header'=>'Mobile','value'=>'$data[\'per_mobile\']','htmlOptions'=>array('class'=>'span-4')),
                array('header'=>'Term Admitted On','value'=>'FormUtil::getFormatedDate($data[\'tra_date\'])','htmlOptions'=>array('class'=>'span-3')),
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
        $(document).on('click','#offeredModule-grid2 a#oo',function() {
            var url=$(this).attr('href');
            //alert(url);
            
          var data = { 'offered[]' : []};
$(":checked").each(function() {
    //alert($(this).val());
    
  data['offered[]'].push($(this).val());
});

//alert(data['offered[]']);
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