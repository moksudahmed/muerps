<?php
/* @var $this AdministrativeReportController */

$this->breadcrumbs=array(
   'Registry'=>array('site/registry'),
    
	'Vue'=>array('Vue'),	
);

?>

<div class="span-24">
    <div class="title span-23">
        <h3>Vue Test </h3>

    </div>
    
    <script>
        function start(){
           console.log("Bismillah ");
        }
        
        function process(){
            console.log("Hir");
        }
        
        function end(callBack)
        {
            setTimeout(
            ()=>{ 
                console.log("Rahmanir Rahim.");
                callBack();
            }, 1000
            );
        }
        
        function now() 
        {
            console.log("Now Start");
        }
        
        start();
        end(()=>now());
        process();
        
    </script>
    <script type="text/javascript">
        
        var app = Vue.createApp({
            data() {
                return { 
                    msg:"!!! Bismillah Hir Rahmanir Rahim !!!"
                
                };
            }
        });
    
    app.mount('#vue-app');
    
    </script>
    <div class="span-4 right">

    <?php 

    //echo 'Bismillah Hir Rahmanir Rahim';
    //exit();
        $backUrl=Yii::app()->controller->createUrl('site/registry');
        $backTitle='Registry';


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

    <div id="vue-app" class="span-20">    
        {{ msg }}
    </div>
</div>