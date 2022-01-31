<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class ChangePasswordForm extends CFormModel
{
	public $username;
	public $password;
      
        public $confirmPassword;
        public $resetToken;
        public $msg;

        private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('password, confirmPassword', 'required'),
			// rememberMe needs to be a boolean
			//array('rememberMe', 'boolean'),
                        array('password, confirmPassword', 'length', 'min'=>8),
			// password needs to be authenticated
			array('confirmPassword', 'authenticate'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'password'=>'New password',
                        'confirmPassword'=>'Confirm password',
		);
	}

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate()
	{ 
            
                if(!$this->hasErrors())
		{
                    if(!($this->confirmPassword === $this->password))
                    {  
                        $this->addError('confirmPassword','Confirm passwod does not match !!');
                        return FALSE;
                    }
                   
                        
                        
                    $this->_identity=new UserIdentity($this->username,$this->confirmPassword,$this->resetToken);
			$err = $this->_identity->resetPassword(); 
                        
                        if($err==1)
                        {
                            $this->addError('password','Incorrect username !!');
                            return FALSE;
                        }
                        else if($err==3)
                        {
                            $this->addError('confirmPassword','Invelid password reset token or token time expired !!');
                        
                            return FALSE;
                        }
                        else if($err==0)
                        { 
                            $this->addError('msg','Password reset Successfull, you can login now with new password.');
                           return TRUE;
                            
                        }
                        return TRUE;
		}
            return TRUE;
	}

	
}
