<?php
/* @var $this RegistryController */

$this->breadcrumbs=array(
        
	'Department Activities',
	
);


?>
<!--h1><?php echo $this->id . '/' . $this->action->id; ?></h1-->
<div class="span-24"> 
    <div class="title span-18">
    <h3>
        Department Activities 

    </h3>
        <h4><strong style="padding-right: 10px;">Faculty</strong><span class="label label-info"><?php echo yii::app()->session['MainFacultyName']; ?></span></h4>
    </div>
    <div class="span-4" >
            <?php 
        //$backUrl = (!yii::app()->session['mreUrlFlag']?Yii::app()->controller->createUrl('person/searchEngine'):Yii::app()->controller->createUrl('varifyMarks',array('offeredID'=>yii::app()->session['mreOfmID'])));
        $backUrl = Yii::app()->controller->createUrl('site/index');
        $this->widget('bootstrap.widgets.TbMenu', array(
                'type'=>'pills',
                'items'=>array(
                        array('label'=>'Back', 'icon'=>'icon-arrow-left' , 'url'=>$backUrl, 'linkOptions'=>array('data-toggle'=>'tooltip','data-placement'=>'right', 'title'=>'Home',), 'visible'=>true),	
                        array('label'=>'password', 'icon'=>'icon-edit', 'url'=>Yii::app()->controller->createUrl('site/changePassword'),'linkOptions'=>array(), 'visible'=>true),
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


                        //'Checking Marks'=>$this->renderPartial('_formMarksEntry',array('ofmModule'=>$ofmModule),true,true),

                         'Offer Course'=>$this->renderPartial('_HFofferedModule',null,true,true),
                         'Course Offered List'=>$this->renderPartial('_courseOfferedListForm',null,true,true),
                         'Result Authentication'=>$this->renderPartial('_resultAuthentication-SA',null,true,true),
                         'Lock Previous Results'=>$this->renderPartial('_lockAllResult',null,true,true),
                         'Routine Management'=>$this->renderPartial('_HFroutineManagement',null,true,true),




                       //'Result'=>$this->renderPartial('_HFresultIndex',null,true,true),

                       'Transcript'=>$this->renderPartial('_HFtranscriptIndex',array('data'=>$data),true,true),

                         'Marks Entry (Total Batch)'=>$this->renderPartial('_HFmarksEntryTotalBatch',null,true,true),

                        'Supplementary List'=>$this->renderPartial('_supplementaryForm',null,true,true),
                        'Special Retake Marks Entry'=>$this->renderPartial('_HFmarksEntrySupervisory',null,true,true),


                        //'Retake'=>$this->renderPartial('_HFretake',null,true,true),
                        // panel 3 contains the content rendered by a partial view
                        //'panel 3'=>$this->renderPartial('_form_1',null,true),


                    );
        }
        elseif(yii::app()->user->getState('role')==='admin')
        {
            $panels = array(


                        //'Checking Marks'=>$this->renderPartial('_formMarksEntry',array('ofmModule'=>$ofmModule),true,true),

                         //'Offer Course'=>$this->renderPartial('_HFofferedModule',null,true,true),
                         'Course Offered List'=>$this->renderPartial('_courseOfferedListForm',null,true,true),
                         //'Course Authentication'=>$this->renderPartial('_courseAuthenticationForm',null,true,true),
                       //  'Result Authentication'=>$this->renderPartial('_resultAuthentication',null,true,true),
                         //'Routine Management'=>$this->renderPartial('_HFroutineManagement',null,true,true),

                         //'Marks Entry (Total Batch)'=>$this->renderPartial('_HFmarksEntryTotalBatch',null,true,true),

               //        'Supplementary List'=>$this->renderPartial('_supplementaryForm',null,true,true),


                    );
        }
        elseif(yii::app()->user->getState('role')==='exam')
        {
            $panels = array(


                        //'Checking Marks'=>$this->renderPartial('_formMarksEntry',array('ofmModule'=>$ofmModule),true,true),

                         'Offer Course'=>$this->renderPartial('_HFofferedModule',null,true,true),
                         'Course Offered List'=>$this->renderPartial('_courseOfferedListForm',null,true,true),
                         //'Course Authentication'=>$this->renderPartial('_courseAuthenticationForm',null,true,true),
                      //   'Result Authentication'=>$this->renderPartial('_resultAuthentication',null,true,true),
                         //'Routine Management'=>$this->renderPartial('_HFroutineManagement',null,true,true),

                         //'Marks Entry (Total Batch)'=>$this->renderPartial('_HFmarksEntryTotalBatch',null,true,true),

               //        'Supplementary List'=>$this->renderPartial('_supplementaryForm',null,true,true),


                    );
        }
        elseif(yii::app()->user->getState('role')==='head')
        {
            $panels = array(


                        //'Checking Marks'=>$this->renderPartial('_formMarksEntry',array('ofmModule'=>$ofmModule),true,true),

                         'Offer Course'=>$this->renderPartial('_HFofferedModule',null,true,true),
                         'Course Offered List'=>$this->renderPartial('_courseOfferedListForm',null,true,true),
                         //'Course Authentication'=>$this->renderPartial('_courseAuthenticationForm',null,true,true),
                         'Result Authentication'=>$this->renderPartial('_resultAuthentication-SA',null,true,true),
                         'Routine Management'=>$this->renderPartial('_HFroutineManagement',null,true,true),

                         'Marks Entry (Total Batch)'=>$this->renderPartial('_HFmarksEntryTotalBatch',null,true,true),
                        // 'Secial Retake Marks Entry'=>$this->renderPartial('_HFmarksEntrySupervisory',null,true,true),
               //        'Supplementary List'=>$this->renderPartial('_supplementaryForm',null,true,true),
                        'Special Retake Marks Entry'=>$this->renderPartial('_HFmarksEntrySupervisory',null,true,true),

                    );
        }
        elseif(yii::app()->user->getState('role')==='coordinator')
        {
            $panels = array(


                        //'Checking Marks'=>$this->renderPartial('_formMarksEntry',array('ofmModule'=>$ofmModule),true,true),

                         'Offer Course'=>$this->renderPartial('_HFofferedModule',null,true,true),
                         'Course Offered List'=>$this->renderPartial('_courseOfferedListForm',null,true,true),
                         'Result Authentication'=>$this->renderPartial('_resultAuthentication',null,true,true),
                         'Routine Management'=>$this->renderPartial('_HFroutineManagement',null,true,true),
                         'Special Retake Marks Entry'=>$this->renderPartial('_HFmarksEntrySupervisory',null,true,true),
                         

                


                    );
        }
        elseif(yii::app()->user->getState('role')==='faculty')
        {
            $panels = array(

                         //'Offer Course'=>$this->renderPartial('_HFofferedModule',null,true,true),
                         'Course Offered List'=>$this->renderPartial('_courseOfferedListForm',null,true,true),
                         //'Course Authentication'=>$this->renderPartial('_courseAuthenticationForm',null,true,true),
                         //'Course Authentication'=>$this->renderPartial('_courseAuthenticationFormADV',null,true,true),
                         //'Routine Management'=>$this->renderPartial('_HFroutineManagement',null,true,true),

                         //'Marks Entry (Total Batch)'=>$this->renderPartial('_HFmarksEntryTotalBatch',null,true,true),

                //        'Supplementary List'=>$this->renderPartial('_supplementaryForm',null,true,true),

                    );
        }
        elseif(yii::app()->user->getState('role')==='deo')
        {
            $panels = array(

                        //'Checking Marks'=>$this->renderPartial('_formMarksEntry',array('ofmModule'=>$ofmModule),true,true),

                        'Offer Course'=>$this->renderPartial('_HFofferedModule',null,true,true),
                        'Course Offered List'=>$this->renderPartial('_courseOfferedListForm',null,true,true),
                        //'Course Authentication'=>$this->renderPartial('_courseAuthenticationForm',null,true,true),
                       // 'Result Authentication'=>$this->renderPartial('_resultAuthentication',null,true,true),
                       'Result Authentication'=>$this->renderPartial('_resultAuthentication-SA',null,true,true), 
                       'Routine Management'=>$this->renderPartial('_HFroutineManagement',null,true,true),

                   //     'Marks Entry (Total Batch)'=>$this->renderPartial('_HFmarksEntryTotalBatch',null,true,true),
                    // 'Secial Retake Marks Entry'=>$this->renderPartial('_HFmarksEntrySupervisory',null,true,true),
                //        'Supplementary List'=>$this->renderPartial('_supplementaryForm',null,true,true),
                    'Special Retake Marks Entry'=>$this->renderPartial('_HFmarksEntrySupervisory',null,true,true),

                
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