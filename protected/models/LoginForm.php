<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginForm extends CFormModel
{
        public $username;
        public $password;
        public $otp;
        public $rememberMe;
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
			array('otp', 'required'),
			// rememberMe needs to be a boolean
			
                        array('otp', 'numerical', 'integerOnly'=>true),
                        array('otp', 'length', 'max'=>6),
			// password needs to be authenticated
			array('otp', 'authenticate'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'rememberMe'=>'Remember me next time',
                        'otp'=>'One Time Password',
		);
	}

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate($attribute,$params)
	{ 
		if(!$this->hasErrors())
		{
			$this->_identity=new UserIdentity($this->username, $this->password, $this->otp);
			$err = $this->_identity->authenticate(); 
                        
                        if($err==1) $this->addError('otp','Incorrect username !!');
                        else if($err==2)
				$this->addError('otp','Incorrect username or password !!');
                        else if($err==3)
				$this->addError('otp','Incorrect OTP or time expired !!');
		}
	}

	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	public function login()
	{
		if($this->_identity===null)
		{
			$this->_identity = new UserIdentity($this->username, $this->password, $this->otp);
			$this->_identity->authenticate();
		}
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
		{
			$duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
			Yii::app()->user->login($this->_identity,$duration);
			return true;
		}
		else
			return false;
	}
}
