<?php
/* @var $this RegistryController */

$this->breadcrumbs=array(
        
	'Faculty Activities'
	
);


?>
<!--h1><?php echo $this->id . '/' . $this->action->id; ?></h1-->

<div class="span-24">
        <div class="title span-16">
            <h3>
                Faculty Activities

            </h3>
            <h4 ><strong style="padding-right: 10px;">Faculty:</strong><span class="label label-info"><?php echo yii::app()->session['MainFacultyName']; ?></span></h4>
        </div>
        <div class="span-6" >
            <?php 
        //$backUrl = (!yii::app()->session['mreUrlFlag']?Yii::app()->controller->createUrl('person/searchEngine'):Yii::app()->controller->createUrl('varifyMarks',array('offeredID'=>yii::app()->session['mreOfmID'])));
       $backUrl = Yii::app()->controller->createUrl('headsFunction/GetRegisteredModuleForBatch');
        $this->widget('bootstrap.widgets.TbMenu', array(
                'type'=>'pills',
                'items'=>array(
                        array('label'=>'Back', 'icon'=>'icon-arrow-left' , 'url'=>$backUrl, 'linkOptions'=>array('data-toggle'=>'tooltip','data-placement'=>'right', 'title'=>'Home',), 'visible'=>true),	
                        array('label'=>'Change your password', 'icon'=>'icon-edit', 'url'=>Yii::app()->controller->createUrl('site/changePassword'),'linkOptions'=>array(), 'visible'=>true),
                        //array('label'=>'PDF', 'icon'=>'icon-print', 'url'=>Yii::app()->controller->createUrl('AcademicRecordPDF'),'linkOptions'=>array('target'=>'_blank'), 'visible'=>true),

                ),
        ));

        ?>
        </div>
    
        
        <div class="span-24">

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

        if(yii::app()->user->getState('role')==='super-admin')
        {
            $panels = array(

                'Marks Entry'=>$this->renderPartial('_FacultyMarksEntry',array('ofmModule'=>$ofmModule),true,true),
                'Supplementary Makrs Entry'=>$this->renderPartial('_SuppleMarksEntry-SA',null,true,true),
                'Marks Entry (Thesis/Interniship/Viva)'=>$this->renderPartial('_HFmarksEntryTotalBatch',null,true,true),
                'Print Attendance All '=>$this->renderPartial('_attProgrammeBatchForm',null,true,true),
                
            );
        }
        elseif(yii::app()->user->getState('role')==='deo')
        {
            $panels = array(

             //   'Marks Entry'=>$this->renderPartial('_FacultyMarksEntry',array('ofmModule'=>$ofmModule),true,true),
                'Supplementary Makrs Entry'=>$this->renderPartial('_SuppleMarksEntry-SA',null,true,true),
             //   'Marks Entry (Thesis/Interniship/Viva)'=>$this->renderPartial('_HFmarksEntryTotalBatch',null,true,true),
              //  'Print Attendance All '=>$this->renderPartial('_attProgrammeBatchForm',null,true,true),
                
            );
        }
        elseif(yii::app()->user->getState('role')==='head')
        {
            $panels = array(

                'Marks Entry'=>$this->renderPartial('_FacultyMarksEntry',array('ofmModule'=>$ofmModule),true,true),
                'Supplementary Makrs Entry'=>$this->renderPartial('_SuppleMarksEntry-SA',null,true,true),
                'Marks Entry (Thesis/Interniship/Viva)'=>$this->renderPartial('_HFmarksEntryTotalBatch',null,true,true),
                //'Sectoin Transfer'=>$this->renderPartial('_FFsectionTransfer',null,true,true),
                'Print Attendance'=>$this->renderPartial('_attProgrammeBatchForm',null,true,true),

            );
        }
        elseif(yii::app()->user->getState('role')==='coordinator')
        {
            $panels = array(


                'Marks Entry'=>$this->renderPartial('_FacultyMarksEntry',array('ofmModule'=>$ofmModule),true,true),
                'Supplementary Makrs Entry'=>$this->renderPartial('_SuppleMarksEntry-SA',null,true,true),
                'Marks Entry (Thesis/Interniship/Viva)'=>$this->renderPartial('_HFmarksEntryTotalBatch',null,true,true),
                //'Sectoin Transfer'=>$this->renderPartial('_FFsectionTransfer',null,true,true),
                'Print Attendance'=>$this->renderPartial('_attProgrammeBatchForm',null,true,true),
                    );
        }/*
        elseif(yii::app()->user->getState('role')==='faculty')
        {
            $panels = array(

                'Marks Entry'=>$this->renderPartial('_FFmarksEntry',array('ofmModule'=>$ofmModule),true,true),
                
                'Marks Entry (Thesis/Interniship/Viva)'=>$this->renderPartial('_HFmarksEntryTotalBatch',null,true,true),
                //'Sectoin Transfer'=>$this->renderPartial('_FFsectionTransfer',null,true,true),
                'Print Attendance'=>$this->renderPartial('_attProgrammeBatchForm',null,true,true),

                    );
        }
        
         */
        else
        {
            $panels = array(

                'Marks Entry'=>$this->renderPartial('_FacultyMarksEntry',array('ofmModule'=>$ofmModule),true,true),
                'Supplementary Makrs Entry'=>$this->renderPartial('_SuppleMarksEntry',null,true,true),
                'Marks Entry (Thesis/Interniship/Viva)'=>$this->renderPartial('_HFmarksEntryTotalBatch',null,true,true),
                'Print Attendance'=>$this->renderPartial('_attProgrammeBatchForm',null,true,true),

            );
        }
       
        

    $this->widget('zii.widgets.jui.CJuiAccordion',array(
        'panels'=>$panels,
        // additional javascript options for the accordion plugin
        'options'=>array(
            'animated'=>'bounceslide',
            'style'=>array('minHeight'=>'200'),
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