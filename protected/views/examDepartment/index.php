<?php
/* @var $this RegistryController */

$this->breadcrumbs=array(
        
	'Exam Activities',
	
);


?>
<!--h1><?php echo $this->id . '/' . $this->action->id; ?></h1-->
<div class="span-24">
<div class="title span-18">
<h3>
    Exam Activities 
    
</h3>
</div>
    <div class="span-4" >
            <?php 
        //$backUrl = (!yii::app()->session['mreUrlFlag']?Yii::app()->controller->createUrl('person/searchEngine'):Yii::app()->controller->createUrl('varifyMarks',array('offeredID'=>yii::app()->session['mreOfmID'])));
        $backUrl = Yii::app()->controller->createUrl('site/index');
        $this->widget('bootstrap.widgets.TbMenu', array(
                'type'=>'pills',
                'items'=>array(
                        array('label'=>'Back', 'icon'=>'icon-arrow-left' , 'url'=>$backUrl, 'linkOptions'=>array('data-toggle'=>'tooltip','data-placement'=>'right', 'title'=>'Home',), 'visible'=>true),	
                        //array('label'=>'password', 'icon'=>'icon-edit', 'url'=>Yii::app()->controller->createUrl('site/changePassword'),'linkOptions'=>array(), 'visible'=>true),
                        //array('label'=>'PDF', 'icon'=>'icon-print', 'url'=>Yii::app()->controller->createUrl('AcademicRecordPDF'),'linkOptions'=>array('target'=>'_blank'), 'visible'=>true),

                ),
        ));

        ?>
        </div>
    
<div class="span-24">
<br/>
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



<?php 
  //  $option = new Options;
  //  $rules = 'super-admin';
  //  $controller = 'exam_department_controller';
               
  //  $capabilities = $option->getControllerInterfaceOptions( $controller, $rules);
    if(yii::app()->user->getState('role')==='super-admin')
    {
     /* $arr = array();
      $arr['supplementary_exam_registration'] = array('Exam Rregistration'=>$this->renderPartial('_examRegistration',null,true,true));
      $arr['generate_admit_card'] = array('Admit Card & Signature Sheet'=>$this->renderPartial('_admitCardIndex',null,true,true));
      $arr['eligible_list_final'] = array('Eligible List (Final)'=>$this->renderPartial('_examEligableListForm',null,true,true));
      //$result=array_diff($arr,$capabilities);*/
      //print_r($result);exit();
      /*if(array_search('supplementary_exam_registration',$capabilities)===0)
       {
         // $panels = $result;
           $panels = array('Exam Rregistration'=>$this->renderPartial('_examRegistration',null,true,true),
           'Admit Card & Signature Sheet'=>$this->renderPartial('_admitCardIndex',null,true,true));
           
           echo var_dump($arr); exit();
       }*/
        $panels = array(
        'Exam Rregistration'=>$this->renderPartial('_examRegistration',null,true,true),
        'Admit Card & Signature Sheet Batchwise'=>$this->renderPartial('_admitCardIndex',null,true,true),
        'Admit Card'=>$this->renderPartial('_admitCardForm',null,true,true),

        'Eligible List (Final)'=>$this->renderPartial('_examEligableListForm',null,true,true),
        'Eligible List (Supplementary)'=>$this->renderPartial('_examEligableListFormSupple',null,true,true),
        //'Supplementary Makrs Entry'=>$this->renderPartial('_SuppleMarksEntry',null,true,true),            
        'Publish Result'=>$this->renderPartial('_resultPublishFinal-SA',null,true,true),
        'Publish Result (Supplementary)'=>$this->renderPartial('_resultPublishSupple-SA',null,true,true),
        'Result '=>$this->renderPartial('_resultIndex',null,true,true),
        
       // 'Academic Record (Transcript)'=>$this->renderPartial('_transcriptIndex',array('data'=>$data),true,true),
        'Transcript'=>$this->renderPartial('_transcript',array('data'=>$data),true,true),
        'Passing out report'=>$this->renderPartial('_passingOutForm',null,true,true),
       );
      
        
    }
    elseif(yii::app()->user->getState('role')==='admin')
    {
        $panels = array(
        
               'Exam Rregistration'=>$this->renderPartial('_examRegistration',null,true,true),
				'Admit Card & Signature Sheet Batchwise'=>$this->renderPartial('_admitCardIndex',null,true,true),
				'Admit Card'=>$this->renderPartial('_admitCardForm',null,true,true),

      
            );
    }
    elseif(yii::app()->user->getState('role')==='head')
    {
        $panels = array(
        
                //'Exam Rregistration'=>$this->renderPartial('_examRegistration',null,true,true),
                //'Admit Card & Signature Sheet'=>$this->renderPartial('_admitCardIndex',null,true,true),
                'Eligible List'=>$this->renderPartial('_examEligableListForm',null,true,true),
                'Eligible List (Supplementary)'=>$this->renderPartial('_examEligableListFormSupple',null,true,true),
             
              //  'Supplementary Makrs Entry'=>$this->renderPartial('_SuppleMarksEntry',null,true,true),
                'Publish Result'=>$this->renderPartial('_resultPublishFinal-SA',null,true,true),
                'Publish Result (Supplementary)'=>$this->renderPartial('_resultPublishSupple-SA',null,true,true),
                'Result'=>$this->renderPartial('_resultIndex',null,true,true),
                
                //'Academic Record (Transcript)'=>$this->renderPartial('_transcriptIndex',array('data'=>$data),true,true),
               
                
                //'Eligable List'=>$this->renderPartial('_examEligableListForm',null,true,true),
        
            );
    }
    elseif(yii::app()->user->getState('role')==='coordinator')
    {
        $panels = array(
                //'Exam Rregistration'=>$this->renderPartial('_examRegistration',null,true,true),
                //'Admit Card & Signature Sheet'=>$this->renderPartial('_admitCardIndex',null,true,true),
                //'Eligible List'=>$this->renderPartial('_examEligableListForm',null,true,true),
                'Eligible List (Supplementary)'=>$this->renderPartial('_examEligableListFormSupple',null,true,true),
                //'Supplementary Makrs Entry'=>$this->renderPartial('_SuppleMarksEntry',null,true,true),
                'Publish Result'=>$this->renderPartial('_resultPublishFinal-SA',null,true,true),
                'Publish Result (Supplementary)'=>$this->renderPartial('_resultPublishSupple-SA',null,true,true),    
                'Result'=>$this->renderPartial('_resultIndex',null,true,true),
                
                //'Academic Record (Transcript)'=>$this->renderPartial('_transcriptIndex',array('data'=>$data),true,true),
        
            );
    }
    elseif(yii::app()->user->getState('role')==='faculty')
    {
        $panels = array(
                //'Exam Rregistration'=>$this->renderPartial('_examRegistration',null,true,true),
                //'Admit Card & Signature Sheet'=>$this->renderPartial('_admitCardIndex',null,true,true),
                //'Eligible List'=>$this->renderPartial('_examEligableListForm',null,true,true),
                //'Supplementary Makrs Entry'=>$this->renderPartial('_SuppleMarksEntry',null,true,true),
               // 'Supplementary Makrs Entry'=>$this->renderPartial('_SuppleMarksEntry',null,true,true),
                'Publish Result'=>$this->renderPartial('_resultPublishFinal',null,true,true),
                //'Result'=>$this->renderPartial('_resultIndexForFac',null,true,true),
                'Publish Result (Supplementary)'=>$this->renderPartial('_resultPublishSupple',null,true,true),
                //'Academic Record (Transcript)'=>$this->renderPartial('_transcriptIndex',array('data'=>$data),true,true),
        
            );
    }
    elseif(yii::app()->user->getState('role')==='exam')
    {
        $panels = array(
            
                'Exam Rregistration'=>$this->renderPartial('_examRegistration',null,true,true),
                'Admit Card & Signature Sheet Batchwise'=>$this->renderPartial('_admitCardIndex',null,true,true),
                'Admit Card'=>$this->renderPartial('_admitCardForm',null,true,true),
        
                'Eligible List (Final)'=>$this->renderPartial('_examEligableListForm',null,true,true),
                'Eligible List (Supplementary)'=>$this->renderPartial('_examEligableListFormSupple',null,true,true),
                //'Supplementary Makrs Entry'=>$this->renderPartial('_SuppleMarksEntry',null,true,true),            
                'Publish Result'=>$this->renderPartial('_resultPublishFinal-SA',null,true,true),
                'Publish Result (Supplementary)'=>$this->renderPartial('_resultPublishSupple-SA',null,true,true),
                'Result '=>$this->renderPartial('_resultIndex',null,true,true),
                
            // 'Academic Record (Transcript)'=>$this->renderPartial('_transcriptIndex',array('data'=>$data),true,true),
                'Transcript'=>$this->renderPartial('_transcript',array('data'=>$data),true,true),
                'Passing out report'=>$this->renderPartial('_passingOutForm',null,true,true),
        );
        }
    elseif(yii::app()->user->getState('role')==='deo')
    {
        $panels = array(
        
            'Exam Rregistration'=>$this->renderPartial('_examRegistration',null,true,true),
            'Admit Card & Signature Sheet Batchwise'=>$this->renderPartial('_admitCardIndex',null,true,true),
            'Admit Card'=>$this->renderPartial('_admitCardForm',null,true,true),
    
            'Eligible List (Final)'=>$this->renderPartial('_examEligableListForm',null,true,true),
            'Eligible List (Supplementary)'=>$this->renderPartial('_examEligableListFormSupple',null,true,true),
            //'Supplementary Makrs Entry'=>$this->renderPartial('_SuppleMarksEntry',null,true,true),            
            'Publish Result'=>$this->renderPartial('_resultPublishFinal-SA',null,true,true),
            'Publish Result (Supplementary)'=>$this->renderPartial('_resultPublishSupple-SA',null,true,true),
            'Result '=>$this->renderPartial('_resultIndex',null,true,true),
            
           // 'Academic Record (Transcript)'=>$this->renderPartial('_transcriptIndex',array('data'=>$data),true,true),
            'Transcript'=>$this->renderPartial('_transcript',array('data'=>$data),true,true),
            'Passing out report'=>$this->renderPartial('_passingOutForm',null,true,true),
            );
    }
    elseif(yii::app()->user->getState('role')==='registry')
    {
        $panels = array(
        
                'Exam Rregistration'=>$this->renderPartial('_examRegistration',null,true,true),
                'Admit Card & Signature Sheet'=>$this->renderPartial('_admitCardIndex',null,true,true),
                'Eligible List (final)'=>$this->renderPartial('_examEligableListForm',null,true,true),
                'Eligible List (Supplementary)'=>$this->renderPartial('_examEligableListFormSupple',null,true,true),
            //    'Supplementary Makrs Entry'=>$this->renderPartial('_SuppleMarksEntry',null,true,true),
              //  'Publish Result'=>$this->renderPartial('_resultPublishForm',null,true,true),
              //  'Publish Result (Supplementary)'=>$this->renderPartial('_resultPublishSuppleForm',null,true,true),
             //   'Result'=>$this->renderPartial('_resultIndex',null,true,true),
                
                //'Academic Record (Transcript)'=>$this->renderPartial('_transcriptIndex',array('data'=>$data),true,true),
        
            );
    }
    else
    {
        $panels=array();
    }


$this->widget('zii.widgets.jui.CJuiAccordion',array(
    'panels'=>$panels,
    
    // additional javascript options for the accordion plugin
    'options'=>array(
        'animated'=>'bounceslide',
        'style'=>array('minHeight'=>'100','height'=>'200'),
        'autoHeight'=>false,
        'icons'=>array(
            "header"=>"ui-icon-plus",//ui-icon-circle-arrow-e
            "headerSelected"=>"ui-icon-circle-arrow-s",//ui-icon-circle-arrow-s, ui-icon-minus
        ),
        
    ),
    'htmlOptions'=>array('class'=>'time_cell'),
        
    
));
?>
</div>
</div>