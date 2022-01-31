<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
    // public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	/*public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}
        */
        
    public function accessRules()
	{   
            if(yii::app()->user->getState('role')==='super-admin')
            {
            
            	return array(
			
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','Registry','help','helpAdvice','helpBatchTransfer','SearchEngine','helpStudentInfo','helpFacultyActivities','helpDeptActivities','helpExamActivities'),
				'users'=>array(yii::app()->user->id),
			),
                        array('deny',  // deny all users
				'users'=>array('*'),
			),
			
		);
            }
            elseif(yii::app()->user->getState('role')==='admin')
            {
            
            		return array(
			
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','Registry','help','helpAdvice','helpBatchTransfer'),
				'users'=>array(yii::app()->user->id),
			),
			
		);
            }
            elseif(yii::app()->user->getState('role')==='deo')
            {
            
            		return array(
			
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','Registry','help','helpAdvice','helpBatchTransfer'),
				'users'=>array(yii::app()->user->id),
			),
			
		);
			}
			elseif(yii::app()->user->getState('role')==='basic-user')
            {
            
            		return array(
			array('deny',  // deny all users
			'users'=>array('*'),
		),
			
		);
            }
            else
            { 
                return array(
			array('deny',  // deny all users
                            'actions'=>array('index','Registry','help','helpAdvice','helpBatchTransfer','SearchEngine','helpStudentInfo','helpFacultyActivities','helpDeptActivities','helpExamActivities','resetPassword','userActivation'),
				'users'=>array('*'),
			),
		);
            }
                
	}

	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
                
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
                
		$this->render('index');
               
	}
        
        public function actionHelp()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
                                
		$this->render('help');
	}
         public function actionHelpStudentInfo()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
                                
		$this->render('helpStudentInfo');
	}
         public function actionHelpFacultyActivities()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
                                
		$this->render('helpFacultyActivities');
	}
         public function actionHelpExamActivities()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
                                
		$this->render('helpExamActivities');
	}
        public function actionHelpDeptActivities()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
                                
		$this->render('helpDeptActivities');
	}
        
        public function actionHelpAdvice()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
                                
	          $this->render('helpAdvice');
	}
        public function actionHelpBatchTransfer()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
                                
	          $this->render('helpBatchTransfer');
	}
        
        public function actionHelpCourseOffer()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
                                
		$this->render('helpCourseOffer');
	}

        public function actionRegistry()
	{
           
		$this->render('registry');
           
	}
        
        public function actionExam()
	{
		$this->render('exam');
	}
        
        public function actionHRM()
	{
		$this->render('HRM');
	}
        
        public function actionAdministration()
	{
		$this->render('Administration');
	}
        
        
        public function actionJavaScriptTest()
	{
		$this->render('JavaScriptTest');
	}
        
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

       
        
        public function actionChangePassword()
	{
			//yii::app()->user->id;
			//echo User::getIpAddress();
			//exit();
            //$model = User::model()->findByPk(yii::app()->user->id);
            $model = User::model()->findByAttributes(array('loginID'=>yii::app()->user->id));
            $model->usr_password='';
            $this->render('changePassword',array('modelf'=>$model));
	}
        
        public function actionSavePassword()
        {
            $model = new User();
            $model->attributes = $_REQUEST['User'];
            
            if(!CPasswordHelper::verifyPassword($model->usr_password,yii::app()->session['MainPass']))
            {
                Yii::app()->user->setFlash('warning','password does not match !');
                $this->redirect(array('changePassword'));
            }
            if($model->usr_newPassword!=$model->confirmPassword)
            {
                Yii::app()->user->setFlash('warning','Confirm password does not match !');
                $this->redirect(array('changePassword'));   
            }
            
            
            $pass = CPasswordHelper::hashPassword($model->confirmPassword, 15);
              
            //   $pass= md5($model->confirmPassword);
            
           
            $id=yii::app()->session['MainFacultyID'];
            
           // $sql= "UPDATE tbl_y_user SET usr_password='{$pass}'
             //   WHERE \"personID\"={$id} ";
            
                
                if($model->updateAll(array('usr_password'=>$pass),"\"personID\"=:id",array(':id'=>$id)))
                {
                    Yii::app()->user->setFlash('success','Password reset successfull! Please login again, Thanks');
                    //$this->redirect(array('changePassword'));
                    Yii::app()->user->logout();
                    $this->redirect(Yii::app()->homeUrl);
                }
                else
                {
                    Yii::app()->user->setFlash('warning','Password reset Fail !');
                     $this->redirect(array('changePassword'));   
                }
        }

        
        
        /**
	 * Displays the contact page
	 */
        
        
        
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

        public function actionChangePasswordToken($loginID,$token)
	{
               
                $model=new ChangePasswordForm();
                $model->username = $loginID;
                $model->resetToken = $token;
                
                if(isset($_POST['ajax']) && $_POST['ajax']==='ChangePasswordForm')
		{
                    
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		
              
                if(isset($_POST['ChangePasswordForm']))
		{
                    $model->attributes=$_POST['ChangePasswordForm'];
                        
                        if($model->validate() && $model->authenticate())
                        {
                            //echo 'Bismillah';
                            $this->redirect(array('site/login'));
                        }
                }
                
            $this->render('formChangePassword',array('model'=>$model));
	}
        
	/**
	 * Displays the login page
	 */
        
        public function actionLogin()
	{
            //echo 'Bismillah Hir Rahmanir Rahim11'. 'Allahu-Akber'; 
            //exit();
            $model=new LoginFormInit();
            
            if(isset($_POST['ajax']) && $_POST['ajax']==='LoginFormInit')
		{
                    
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		
              
                if(isset($_POST['LoginFormInit']))
		{
                    //   echo "Bismillah Hir Rhamanir Rahim !!";
                     //  exit();
			$model->attributes=$_POST['LoginFormInit'];
                        
                        if($model->validate() && $model->authenticate())
                        {
                            //echo 'ta'.CPasswordHelper::verifyPassword('12345678',yii::app()->session['MainPass']); exit();
							//if(yii::app()->session['MainPass']==CPass('12345678'))
                            
                                
                               // $this->redirect(array('site/loginOtp'));
                                $model2=new LoginForm;
                                $model2->addError('msg','An 6 digits One Time Password has been sent to above email address. ');
                                // if it is ajax validation request
                                if(isset($_POST['ajax']) && $_POST['ajax']==='LoginForm')
                                {

                                        echo CActiveForm::validate($model2);
                                        Yii::app()->end();
                                }

                                $model2->username=$model->username;
                                $model2->password=$model->password;
                                $this->render('loginOtp',array('model'=>$model2));
                            
                        }
                            
            
                            //$this->redirect(array('site/index'));
		}
		// display the login form
		$this->render('login',array('model'=>$model));
                
	}
        
	public function actionLoginOtp()
	{
                if(!isset(yii::app()->session['MainEmail']))
                {
                    $this->redirect(array('site/login'));
                }
                
                if(!isset($_POST['otp_username']))
                {
                    $this->redirect(array('site/logout'));
                }
                
                
		$model=new LoginForm;
                
                
                
                $model->addError('msg','An 6 digits One Time Password has been sent to above email address. ');
                
                // if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='loginForm')
		{
                    
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
                    
			$model->attributes=$_POST['LoginForm'];
                        
                        $model->username = $_POST['otp_username'];
                        $model->password = $_POST['otp_password'];
                   // exit();
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
                        {
                            //echo 'ta'.CPasswordHelper::verifyPassword('12345678',yii::app()->session['MainPass']); exit();
							//if(yii::app()->session['MainPass']==CPass('12345678'))
                            
                                
                                $this->redirect(Yii::app()->user->returnUrl);
                                
                            
                        }
                            //$this->redirect(array('site/index'));
		}
		// display the login form
		$this->render('loginOtp',array('model'=>$model));
	}
        
        

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
        
        
        

        
}