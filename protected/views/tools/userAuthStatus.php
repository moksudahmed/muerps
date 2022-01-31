<?php
/* @var $this AdministrativeReportController */

$this->breadcrumbs=array(
   'Registry'=>array('site/registry'),
    
	'Tools'=>array('tools/index'),
    'User Authentication Status'
);

?>
<div class="span-24">
<div class="title span-23">
    <h3>User Authentication Status</h3>
      
</div>
    
<div class="span-10 left">
<h5 ><strong style="padding-right: 10px;">Department:</strong><span class="label label-success"><?php echo FormUtil::getDepartmentByID(yii::app()->session['usrDptID'],(yii::app()->session['usrType']==1?'f':'e')); ?></span></h5>
</div>
<div class="span-4 right">

<?php 

//echo 'Bismillah Hir Rahmanir Rahim';
//exit();
    $backUrl=Yii::app()->controller->createUrl('tools/index');
    $backTitle='Tools';


//$backUrl = (!yii::app()->session['mreUrlFlag']?Yii::app()->controller->createUrl('index') : Yii::app()->controller->createUrl('headsFunction/courseAuthentication'));
//$backTitle = (!yii::app()->session['mreUrlFlag']?'Faculty Activities' : 'Result Authentication');


$this->widget('bootstrap.widgets.TbMenu', array(
	'type'=>'pills',
	'items'=>array(
		
	//array('label'=>'Generate 100 Mark Sheet', 'icon'=>'icon-download', 'url'=>Yii::app()->controller->createUrl('GenerateFirstHalfPDF'), 'linkOptions'=>array('target'=>'_blank'), 'visible'=>true),
        array('label'=>'Back', 'icon'=>'icon-arrow-left' , 'url'=>$backUrl, 'linkOptions'=>array('data-toggle'=>'tooltip','data-placement'=>'top', 'title'=>$backTitle,), 'visible'=>true),	
	//array('label'=>'Next', 'icon'=>'icon-play-circle', 'url'=>Yii::app()->controller->createUrl('resultSheet'), 'linkOptions'=>array('data-toggle'=>'tooltip','data-placement'=>'right', 'title'=>'Get Result') , 'visible'=>true, ),	
	),
));

            
                ?>
    
</div>
<div class="span-24">  
    
<h5 class="span-16">
		 <?php if (Yii::app()->user->hasFlash('success')):?>
			<div class="alert in alert-block fade alert-success">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  <?php echo Yii::app()->user->getFlash('success')?>
			</div>
		<?php endif;?>
                <?php if (Yii::app()->user->hasFlash('warning')):?>
			<div class="alert in alert-block fade alert-danger">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  <?php echo Yii::app()->user->getFlash('warning')?>
			</div>
		<?php endif;?>
</h5>

<?php

$editableColumn1 =  array(
'name' => 'usr_role',
'header' => 'Access To',
'class' => 'bootstrap.widgets.TbEditableColumn',
'headerHtmlOptions' => array('style' => 'width:80px'),
    'htmlOptions'=>array('class'=>'span-2'),
'editable' => array(
    'type' => 'select',
    'url' => Yii::app()->createUrl("tools/editable", array("id"=>'$data->personID')),
    'htmlOptions'=>array('style'=>'font-weight:bold; border-bottom: 0px solid'),
    'source' =>CHtml::listData(FormUtil::getAccessRole($userType), 'id', 'text','group')
    )
);

$userType1 = (yii::app()->session['usrType']==0?'employee':'faculty');
if(yii::app()->session['usrType']==0)
{

    $userType = array(
        'label'=>'User Profile',
        'icon'=>'search',                  
        'url'=>'Yii::app()->createUrl("employee/view", array("id"=>$data[\'personID\']))',                    
        'options'=>array(
            'class'=>'btn btn-small btn-info',
            'data-toggle'=>'tooltip',
            'target'=>'_blank'
        ),
    );

}
else
{

    $userType = array(
        'label'=>'User Profile',
        'icon'=>'search',                  
        'url'=>'Yii::app()->createUrl("faculty/view", array("id"=>$data[\'personID\']))',                    
        'options'=>array(
            'class'=>'btn btn-small btn-info',
            'data-toggle'=>'tooltip',
            'target'=>'_blank'
        ),
    );

}




$this->widget('bootstrap.widgets.TbGridView', array(
    'id'=>'customer-grid',
    'type'=>'striped bordered condensed',
    'dataProvider'=>$dataProvider,
   // 'filter'=>$model,
    'columns'=>array(
        array(
                    'header'=>'User Name',
                    'value'=>'$data[\'per_name\']',
                    'htmlOptions' =>array('class'=>'span-5','style'=>'font-weight:bold;',),
                    ),
         array(
                    'header'=>'Login Id',
                    'value'=>'$data[\'loginID\']',
                    'htmlOptions' =>array('class'=>'span-3','style'=>'font-weight:bold;',),
                    ),
       /*  array(
                    'header'=>'User Role',
                    'value'=>'$data[\'usr_role\']',
                    'htmlOptions' =>array('class'=>'span-3','style'=>'font-weight:bold;',),
                    ),
        */
        
        array(
                    'header'=>'Active',
                    'value'=>'$data[\'usr_active\']',
                    'htmlOptions' =>array('class'=>'span-1','style'=>'font-weight:bold;','rel'=>'active'),
                    ),         
        $editableColumn1,
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{reset} {active} {profile} {delete}',
            'buttons'=>array
            (
               
                'reset' => array
                (
                    'label'=>'Reset Password',
                    'icon'=>' icon-repeat',
                    'url'=>'Yii::app()->createUrl("tools/resetPassword", array("id"=>$data[\'loginID\']))',
                    'options'=>array(
                        'class'=>'btn btn-small btn-success',
                        'data-toggle'=>'tooltip',
                    ),
                ),
                'active' => array
                (
                    'label'=>'Active/Deactive',
                    'icon'=>'icon-ok-circle',                  
                    'url'=>'Yii::app()->createUrl("tools/userActivation", array("id"=>$data[\'personID\'],"loginID"=>$data[\'loginID\'],"status"=>$data[\'usr_active\']))',                    
                    'options'=>array(
                        'class'=>'btn btn-small btn-warning',
                        'data-toggle'=>'tooltip',
                    ),
                ),
                'profile' => $userType,
                'delete' => array
                (
                    'label'=>'Remove User',
                    'icon'=>'icon-remove icon-white',                  
                    'url'=>'Yii::app()->createUrl("tools/deleteEmployeeRecord", array("id"=>$data[\'personID\']))',                    
                    'options'=>array(
                        'class'=>'btn btn-small btn-danger',
                        'data-toggle'=>'tooltip',
                    ),
                ),
                
            ),
            'htmlOptions'=>array(
                'class'=>'span-4',
                
            ),
        ) 
    ),
));
?>

</div>
    
    
<script type="text/javascript">
    
    $(()=>{
        
        $(window).load(function () {
        
            $("td[rel='active']").each(function() {
                //alert($(this).val());

                    var ch = $(this).text(); 


                    //alert('gp +'+ch);

                    if(ch==1)
                    {        
                        $(this).html("<span class=\"badge badge-info\" style=\" padding:5px 5px 5px 5px;\"><a href=\"#\" data-toggle=\"tooltip\" title=\"Active User\"><i class=\"icon-ok icon-white\"></i></a></span>")
                    }
                    //else $(this).html("<span class=\"label label-danger\">No <i class=\"icon-remove\"></i></span>")
            });         
        
        
  
    });
        
        
    });
    
    
</script>