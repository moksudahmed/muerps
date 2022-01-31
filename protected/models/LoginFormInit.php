<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginFormInit extends CFormModel
{
	public $username;
	public $password;
      
        public $rememberMe;

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
			array('username, password,', 'required'),
			// rememberMe needs to be a boolean
			array('rememberMe', 'boolean'),
                        
			// password needs to be authenticated
			array('password', 'authenticate'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'rememberMe'=>'Remember me next time',
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
			$this->_identity=new UserIdentity($this->username,$this->password,NULL);
			$err = $this->_identity->authenticateInit(); 
                        
                        if($err==1) $this->addError('password','Incorrect username or password !!');
                        else if($err==2)
				$this->addError('password','Incorrect username or password !!');
                        else if($err==4)
				$this->addError('password','OTP send failed !!');
                        else if($err==0)
                            return TRUE;
                        
		}
            
	}

	
}
