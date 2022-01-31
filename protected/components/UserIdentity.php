<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
    const ERROR_OTP_INVALID=3;
    const ERROR_OTP_FAILD=4;
   
   
    private $title;
    private $otp;
    
    // private $_id;
    
    
    /**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
        public function __construct($username, $password, $otp) {
            parent::__construct($username, $password);
            $this->otp = $otp;
        }
        
        

        public function authenticateInit()
        {
        
    
                $sql="select * from sp_user_authentication('{$this->username}');";
                // echo $this->username;exit();

                $record=User::model()->findBySql($sql);
                 
               
		if(!$record)
                    $this->errorCode=self::ERROR_USERNAME_INVALID;
                //elseif($users[$this->username]!==md5($this->password))
                else if(!CPasswordHelper::verifyPassword($this->password,$record->u_password))
                    $this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
                {
                        //--------
                        //yii::app()->session['loginID'] = $this->username;
                        //yii::app()->session['password'] = $this->password;
                        yii::app()->session['MainEmail'] = $record->u_email;
                        //--------
                        
                        yii::app()->session['MainUserType']= $record->u_type;
                        yii::app()->session['MainDepartmentID']= $record->u_dptID;
                        yii::app()->session['MainFacultyID'] = $record->uPersonID;
                        yii::app()->session['MainFacultyName'] = $record->u_name;
                        
                      /*
                       * $uni = University::model()->findByPk('MetroUni');
                       *   yii::app()->session['MainCurTerm']= $uni->uni_currentTerm;//Options::getOptions('current_term');
                        yii::app()->session['MainCurYear']= $uni->uni_currentYear;//Options::getOptions('current_year');
                        yii::app()->session['MainAdmTerm']=$uni->uni_admTerm;
                        yii::app()->session['MainAdmYear']=$uni->uni_admYear;
                        */
                        yii::app()->session['MainCurTerm']= Options::getOptions('current_term');
                        yii::app()->session['MainCurYear']= Options::getOptions('current_year');
                        yii::app()->session['MainAdmTerm']= Options::getOptions('current_admission_term');//$uni->uni_admTerm;
                        yii::app()->session['MainAdmYear']= Options::getOptions('current_admission_year');//$uni->uni_admYear;
                        
                        if(!($record->u_otpExpire>time()?1:0))
                        {
                            if( self::sendOTP($this->username, $record->u_email))
                            {
                                $this->errorCode=self::ERROR_NONE;
                            }
                            else
                            {
                                $this->errorCode=self::ERROR_OTP_FAILD;
                            }
                        }
                        else
                        {
                            $this->errorCode=self::ERROR_NONE;
                        }
                }
                //echo $record->u_active;
               // echo $this->errorCode;
               // exit();
		return $this->errorCode;
	}
        
        public function authenticate()
        {

		$sql="select * from sp_user_authentication('{$this->username}');";
                // echo $this->username;exit();

                $record=User::model()->findBySql($sql);
              
               
		if(!$record)
                    $this->errorCode=self::ERROR_USERNAME_INVALID;
		//elseif($users[$this->username]!==md5($this->password))
                else if(!CPasswordHelper::verifyPassword($this->password,$record->u_password))
                     $this->errorCode=self::ERROR_PASSWORD_INVALID;
                else if (!CPasswordHelper::verifyPassword($this->otp,$record->u_otp) || !($record->u_otpExpire>time()?1:0))
                     $this->errorCode=self::ERROR_OTP_INVALID;
		else
                {
                     
                        $this->setState('role', $record->u_role);
			$this->errorCode=self::ERROR_NONE;
                }
                
                //echo $this->errorCode;
                //exit();
		return $this->errorCode;
	}
        
        public function resetPassword()
        {

		$sql="select * from sp_user_authentication('{$this->username}');";
                // echo $this->username;exit();

                $record=User::model()->findBySql($sql);
              
                
               // echo $record->u_resetToken.'<br/>';
             // echo $this->otp;
              // exit();
               
               
		if(!$record)
                    $this->errorCode=self::ERROR_USERNAME_INVALID;
		else if (!CPasswordHelper::verifyPassword($this->otp,$record->u_resetToken) && !($record->u_resetTokenExpire>time()?1:0))
                     $this->errorCode=self::ERROR_OTP_INVALID;
		else
                {
                        
                    $pass = CPasswordHelper::hashPassword($this->password, 15);
                        
                    $usr =  User::model()->updateByPk($record->uPersonID,array('usr_resetToken'=>null,'usr_resetTokenExpire'=>0,'usr_otp'=>null,'usr_otpExpire'=>0,'usr_password'=>$pass));
                   // echo $usr;
                     //       exit();
                     //$usr =  User::model()->updateByPk($record->uPersonID,array('usr_otp'=>$record->uPersonID,'usr_password'=>$pass));
                     if($usr)
                     {
                        $this->errorCode=self::ERROR_NONE;    
                     }
                         //$this->errorCode=self::ERROR_NONE;
                }
                
		return $this->errorCode;
	}
        
        public function getTitle()
        {
            return $this->title;
        }
        
        public static function sendOTP($loginID,$senderEmail)
        {
            $otp = rand(100000, 999999);
            
            $token = CPasswordHelper::hashPassword($otp, 15); // a random 6 digit number
            $expTime = time()+300;
            //$link = "http://localhost/index.php?r=site/changePasswordToken&id={$id}&token={$token}";
            
            //$user = User::model()->findByPk($id);
            $user = User::model()->findByAttributes(array('loginID'=>$loginID));
            //echo $user->personID;
            //exit();
            
            $to=$senderEmail;
            //$to='fahmed@metrouni.edu.bd';
            $from='noreply@metrouni.edu.bd';
            
            $fromName='MUERP';
            $subject='MUERP Login OTP';
            $message ="<div> Dear Sir/Madam,"
                    ."<p>The 6 digits 'One Time Password' is {$otp} .<br/>"
                    
                    ."<p>This OTP will expire after 5 minutes. If you delete this email, you have to wait 5 minutes to regenerate another OTP.</p>"
                    ."<p>Thank you,<p/>"
                    ."<p>Administrator, <br/>MUERP</p>"
                    ."</div>";
            
            $ip = FormUtil::getIpAddress();    $mac = FormUtil::getMacAddress();    
            if($user->updateByPk($user->personID,array('usr_otp'=>$token,'usr_otpExpire'=>$expTime,'usr_lastLoginIP'=>$ip, 'usr_lastLoginMac'=>$mac)))
            {
                if($msg = FormUtil::sendMail($to, $from,$fromName, $subject, $message))
                {
                    ($msg==true? Yii::app()->user->setFlash('success','OTP sent successfull.  '):Yii::app()->user->setFlash('warning',$msg));
                
                    return TRUE;
                }
                
            }
            else
            {
                    Yii::app()->user->setFlash('warning','OTP sent fail !!!');
            
                    return FALSE;
            }
            
            
        }
}