<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootsnipp.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/tree.css" />
        
        
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/js.functions.js"></script>
        <!--script lang="javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/shim.min.js"></script-->
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/xlsx.full.min.js"></script>
        <script src="https://unpkg.com/vue@next"></script>
       
            <?php Yii::app()->bootstrap->register(); ?>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<!--div id="header" >
                
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
                
               
	</div -->

        <div class="navbar" style="text-align:right;">
                    <div class="">
        
	
		<?php 
                $menuArray= array();
                
                if(yii::app()->user->getState('role')==='super-admin')
                {
                    $menuArray=array(
				array('label'=>'Home', 'url'=>array('/site/index'), 'itemOptions'=>array('class'=>'about')),
                                array('label'=>'Registry', 'url'=>array('site/registry')),
                                array('label'=>'Student\'s Info', 'url'=>array('admission/studentsInfo')),
                                
                                array('label'=>'Faculty Activities ', 'url'=>array('facultiesFunction/index')),
                                array('label'=>'Department Activities', 'url'=>array('headsFunction/index')),   
                                //array('label'=>'Dpts Functions', 'url'=>array('offeredModule/index')),
                                array('label'=>'Exam Activities', 'url'=>array('ExamDepartment/index')),
                                array('label'=>'Help', 'url'=>array('/site/help')),
                                
                               // array('label'=>'Help', 'url'=>array('Help/index'), 'linkOptions'=>array('target'=>'_blank'),),
                               // array('label'=>'Change Password', 'url'=>array('site/changePassword'), ),
                                array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest,),
                                array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest,'data-toggle'=>'tooltip', 'title'=>'first tooltip'),
			);
                }
                elseif (yii::app()->user->getState('role')==='admin')
                {
                    $menuArray=array(
				array('label'=>'Home', 'url'=>array('/site/index'), 'itemOptions'=>array('class'=>'about')),
                                array('label'=>'Registry', 'url'=>array('site/registry')),
                                array('label'=>'Student\'s Info', 'url'=>array('admission/studentsInfo')),
                                
                                //array('label'=>'Faculty Activities ', 'url'=>array('facultiesFunction/index')),
                                //array('label'=>'Department Activities', 'url'=>array('headsFunction/index')),   
                                //array('label'=>'Department Activities', 'url'=>array('offeredModule/index')),
                                array('label'=>'Exam Activities', 'url'=>array('ExamDepartment/index')),
                             //   array('label'=>'Change Password', 'url'=>array('site/changePassword'), ),
							     array('label'=>'Change Password', 'url'=>array('site/changePassword'), ),
                                array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
                                array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest,'data-toggle'=>'tooltip', 'title'=>'first tooltip'),								
							
                            			
			);
                }
                elseif (yii::app()->user->getState('role')==='head')
                {
                    $menuArray=array(
				array('label'=>'Home', 'url'=>array('/site/index'), 'itemOptions'=>array('class'=>'about')),
                                //array('label'=>'Registry', 'url'=>array('site/registry')),
                                array('label'=>'Student\'s Info', 'url'=>array('admission/studentsInfo')),
                                
                                array('label'=>'Faculty Activities ', 'url'=>array('facultiesFunction/index')),
                                array('label'=>'Department Activities', 'url'=>array('headsFunction/index')),   
                                //array('label'=>'Department Activities', 'url'=>array('offeredModule/index')),
                                array('label'=>'Exam Activities', 'url'=>array('ExamDepartment/index')),
                                array('label'=>'Help', 'url'=>array('/site/help'), 'linkOptions'=>array('target'=>'_blank'),),
                             //   array('label'=>'Change Password', 'url'=>array('site/changePassword'), ),
                                array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
                                array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest,'data-toggle'=>'tooltip', 'title'=>'first tooltip'),
			);
                }
                elseif (yii::app()->user->getState('role')==='coordinator')
                {
                    $menuArray=array(
				array('label'=>'Home', 'url'=>array('/site/index'), 'itemOptions'=>array('class'=>'about')),
                              //  array('label'=>'Registry', 'url'=>array('site/registry')),
                                array('label'=>'Student\'s Info', 'url'=>array('admission/studentsInfo')),
                                
                                array('label'=>'Faculty Activities', 'url'=>array('facultiesFunction/index')),
                                array('label'=>'Department Activities', 'url'=>array('headsFunction/index')),   
                                array('label'=>'Exam Activities', 'url'=>array('ExamDepartment/index')),
                                array('label'=>'Help', 'url'=>array('/site/help'), 'linkOptions'=>array('target'=>'_blank'),),
                              //  array('label'=>'Change Password', 'url'=>array('site/changePassword'), ),
                                array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
                                array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest,'data-toggle'=>'tooltip', 'title'=>'first tooltip'),
			);
                }
                elseif (yii::app()->user->getState('role')==='faculty')
                {
                    $menuArray=array(
				array('label'=>'Home', 'url'=>array('/site/index'), 'itemOptions'=>array('class'=>'about')),
                               // array('label'=>'Registry', 'url'=>array('site/registry')),
                                //array('label'=>'Student\'s Info', 'url'=>array('admission/studentsInfo')),
                                array('label'=>'Department Activities', 'url'=>array('headsFunction/index')),   
                                array('label'=>'Faculty Activities ', 'url'=>array('facultiesFunction/index')),
                                array('label'=>'Exam Activities', 'url'=>array('ExamDepartment/index')),
                                array('label'=>'Help', 'url'=>array('/site/help'), 'linkOptions'=>array('target'=>'_blank'),),
                                //array('label'=>'Change Password', 'url'=>array('site/changePassword'), ),
                                array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
                                array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest,'data-toggle'=>'tooltip', 'title'=>'first tooltip'),
                                
                                
			);
                }
                elseif (yii::app()->user->getState('role')==='registry')
                {
                    $menuArray=array(
				array('label'=>'Home', 'url'=>array('/site/index'), 'itemOptions'=>array('class'=>'about')),
                                array('label'=>'Registry', 'url'=>array('site/registry')),
                                array('label'=>'Student\'s Info', 'url'=>array('admission/studentsInfo')),
                               // array('label'=>'Department Activities', 'url'=>array('headsFunction/index')),   
                                //array('label'=>'Faculty Activities ', 'url'=>array('facultiesFunction/index')),
                                 
                                //array('label'=>'Department Activities', 'url'=>array('offeredModule/index')),
                                array('label'=>'Exam Activities', 'url'=>array('ExamDepartment/index')),
                                array('label'=>'Help', 'url'=>array('/site/help'), 'linkOptions'=>array('target'=>'_blank'),),
                                array('label'=>'Change Password', 'url'=>array('site/changePassword'), ),
                                array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
                                array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest,'data-toggle'=>'tooltip', 'title'=>'first tooltip'),
			);
                }
                elseif (yii::app()->user->getState('role')==='admission')
                {
                    $menuArray=array(
				array('label'=>'Home', 'url'=>array('/site/index'), 'itemOptions'=>array('class'=>'about')),
                                //array('label'=>'Registry', 'url'=>array('site/registry')),
                                array('label'=>'Student\'s Info', 'url'=>array('admission/studentsInfo')),
                                //array('label'=>'Department Activities', 'url'=>array('headsFunction/index')),   
                                //array('label'=>'Faculty Activities ', 'url'=>array('facultiesFunction/index')),
                                //array('label'=>'Examination', 'url'=>array('ExamDepartment/index')),
                                array('label'=>'Help', 'url'=>array('/site/help'), 'linkOptions'=>array('target'=>'_blank'),),
                                array('label'=>'Change Password', 'url'=>array('site/changePassword'), ),
                                array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
                                array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest,'data-toggle'=>'tooltip', 'title'=>'first tooltip'),
			);
                }
                elseif (yii::app()->user->getState('role')==='exam')
                {
                
			$menuArray=array(
			array('label'=>'Home', 'url'=>array('/site/index'), 'itemOptions'=>array('class'=>'about')),
                                //array('label'=>'Registry', 'url'=>array('site/registry')),
                                array('label'=>'Student\'s Info', 'url'=>array('admission/studentsInfo')),
                                array('label'=>'Department Activities', 'url'=>array('headsFunction/index')),   
                                //array('label'=>'Faculty Activities ', 'url'=>array('facultiesFunction/index')),
                                //array('label'=>'Department Activities', 'url'=>array('offeredModule/index')),
                                array('label'=>'Exam Activities', 'url'=>array('ExamDepartment/index')),
                                array('label'=>'Help', 'url'=>array('/site/help'), 'linkOptions'=>array('target'=>'_blank'),),
                                array('label'=>'Change Password', 'url'=>array('site/changePassword'), ),
                                array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
                                array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest,'data-toggle'=>'tooltip', 'title'=>'first tooltip'),
			);
                }
                elseif (yii::app()->user->getState('role')==='deo')
                {
                        $menuArray=array(
				array('label'=>'Home', 'url'=>array('/site/index'), 'itemOptions'=>array('class'=>'about')),
                                array('label'=>'Registry', 'url'=>array('site/registry')),
                                array('label'=>'Student\'s Info', 'url'=>array('admission/studentsInfo')),
                                array('label'=>'Department Activities', 'url'=>array('headsFunction/index')),   
                                array('label'=>'Faculty Activities ', 'url'=>array('facultiesFunction/index')),
                                 
                                //array('label'=>'Department Activities', 'url'=>array('offeredModule/index')),
                                array('label'=>'Exam Activities', 'url'=>array('ExamDepartment/index')),
                              //  array('label'=>'Help', 'url'=>array('/site/help'), 'linkOptions'=>array('target'=>'_blank'),),
                                array('label'=>'Change Password', 'url'=>array('site/changePassword'), ),
                                array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
                                array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest,'data-toggle'=>'tooltip', 'title'=>'first tooltip'),
			);
                    
                }
                elseif (yii::app()->user->getState('role')==='basic-user')
                {
                
			$menuArray=array(
			                       array('label'=>'Home', 'url'=>array('/site/index'), 'itemOptions'=>array('class'=>'about')),
                                array('label'=>'Student\'s Info', 'url'=>array('admission/studentsInfo')),
                                array('label'=>'Help', 'url'=>array('/site/help'), 'linkOptions'=>array('target'=>'_blank'),),
                                array('label'=>'Change Password', 'url'=>array('site/changePassword'), ),
                                array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
                                array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest,'data-toggle'=>'tooltip', 'title'=>'first tooltip'),
			);
                }
                else 
                {
                        $menuArray=array(
				array('label'=>'Home', 'url'=>array('/site/index'), 'itemOptions'=>array('class'=>'about')),
                                
                                array('label'=>'Student\'s Info', 'url'=>array('admission/studentsInfo')),
                                
                                array('label'=>'Help', 'url'=>array('/site/help'), 'linkOptions'=>array('target'=>'_blank'),),
                                
                                array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
                                array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest,'data-toggle'=>'tooltip', 'title'=>'first tooltip'),
			);
                    
                }
                
                
                $this->widget('zii.widgets.CMenu',array(
                    'activeCssClass'=>'active',
                    'activateParents'=>true,
			'items'=>$menuArray,
                    'htmlOptions'=>array('class'=>'nav nav-pills')
		));
                
                ?>
                <a class="brand" href="#">
                <?php 
                if(yii::app()->user->getState('role')==='super-admin')
                {
                   echo CHtml::encode('Super Admin');
                }
                elseif(yii::app()->user->getState('role')==='admin')
                {
                   echo CHtml::encode('Admin\'s Panel');
                }
                elseif(yii::app()->user->getState('role')==='head')
                {
                   echo CHtml::encode('Head\'s Panel');
                }
                elseif(yii::app()->user->getState('role')==='coordinator')
                    {
                   echo CHtml::encode('Coordinator\'s Panel');
                }
                elseif(yii::app()->user->getState('role')==='faculty')
                {
                   echo CHtml::encode('Faculty Panel');
                }
                elseif(yii::app()->user->getState('role')==='exam')
                {
                   echo CHtml::encode('Examination Panel');
                }
                elseif(yii::app()->user->getState('role')==='admission')
                {
                   echo CHtml::encode('Admission Panel');
                }
                elseif(yii::app()->user->getState('role')==='registry')
                {
                   echo CHtml::encode('Registry Panel');
                }
                elseif(yii::app()->user->getState('role')==='deo')
                {
                   echo CHtml::encode('Data Entry Op');
                }
                    ?>
                        </a>
                    </div>
        </div>
                
	<?php if(isset($this->breadcrumbs)):?>
		<!-- breadcrumbs -->
                
                    <?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
                    'links' => $this->breadcrumbs,
                    )); ?>
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear "></div>

	<div id="footer">
            <div id="logo" style="float: right; font-size: 18px;"><?php echo CHtml::encode(Yii::app()->name); ?></div>
            <div style="float: left;">
            Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
            </div>
            <?php

//$image = Yii::app()->baseUrl . '/images/metro.png';

/*echo CHtml::image($image , ' ' , array(
   'style' => 'max-height: 128px;',
));*/ ?>
	</div><!-- footer -->

</div><!-- page --> 

</body>
</html>
