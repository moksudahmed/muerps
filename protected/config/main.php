<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
Yii::setPathOfAlias('editable', dirname(__FILE__).'/../extensions/x-editable');

  
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    
	'name'=> 'MU ERP(Version 9.0)',

	// preloading 'log' component
	'preload'=>array('log','bootstrap'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
                'application.extensions.OpenFlashChart2Widget.OpenFlashChart2Loader',
                'application.extensions.qrcode.QRCodeGenerator',
                'application.extensions.chartjs',
                'editable.*', //easy include of editable classes
            
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
	
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'success.com',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
                    'ipFilters'=>array('127.0.0.1','192.168.1.146'),                    
                   'generatorPaths' => array('ext.giiplus'
                        //'bootstrap.gii'
                        ),
		),
	
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
                        'authTimeout' => 60*30,
		),
            
		// uncomment the following to enable URLs in path-format
		/*
		'urlManager'=>array(
			'urlFormat'=>'path',
			/*'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),*/
		
		/*'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),*/
              'db'=>array(
                        'tablePrefix'=>'tbl_',
                        'connectionString' => 'pgsql:host=localhost;port=8085;dbname=db_muERPv8p0',
                        'username'=>'postgres',
                        'password'=>'success8085.com',
                        'charset'=>'UTF8',
                ),
            'editable' => array(
                    'class'     => 'editable.EditableConfig',
                    'form'      => 'bootstrap',        //form style: 'bootstrap', 'jqueryui', 'plain' 
                    'mode'      => 'popup',            //mode: 'popup' or 'inline'  
                    'defaults'  => array(              //default settings for all editable elements
                       'emptytext' => 'Click to edit'
                    )
                ), 
		// uncomment the following to use a MySQL database
		/*
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=testdrive',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),
		*/
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages

			/*	

				array(
					'class'=>'CWebLogRoute',
				),
            -------------------------------------------------------- */              
				
			),
		),
            
             'bootstrap' => array(
	    'class' => 'ext.bootstrap.components.Bootstrap',
	    'responsiveCss' => true,
                
                ),
             'fusioncharts' => array(
                    'class' => 'ext.fusioncharts.components.fusionCharts',
                    
            ),
          
             'dynamicConnString'=>array(
                        'class'=>'application.extensions.DynamicConnectionString'
                ),
            
            
            'Smtpmail'=>array(
                'class'=>'application.extensions.smtpmail.PHPMailer',
                'Host'=>"smtp.gmail.com",
               
             
                'Username'=>'noreply@metrouni.edu.bd',
                'Password'=>'80851214',
                
                'Mailer'=>'smtp',
                'Port'=>587,
                'SMTPAuth'=>true,
                'SMTPSecure' => 'tls',
            ),
            
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
                //code of abir
            'fusioncharts'=>dirname(__FILE__).'\..\extensions\fusioncharts\fusioncharts\fusionCharts.php',
           
            
                'tcpdf'=>dirname(__FILE__).'\..\extensions\tcpdf\tcpdf.php',
                'tcpdfConf'=>dirname(__FILE__).'\..\extensions\tcpdf\config\lang\eng.php',
                'editable'=>dirname(__FILE__).'\..\extensions\x-editable\EditableColumn.php',
                'editable'=>dirname(__FILE__).'\..\extensions\x-editable\EditableColumn.php',
                
                //============================
            
	),
);

