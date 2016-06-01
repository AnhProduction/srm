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
			array('username', 'required', 'message'=>'<h3>Có lỗi xảy ra</h3><p>Chưa nhập tên đăng nhập!</p>'),
			array('password', 'required', 'message'=>'<h3>Có lỗi xảy ra</h3><p>Chưa nhập mật khẩu!</p>'),
			// password needs to be authenticated
			array('password', 'authenticate'),
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
			$this->_identity=new UserIdentity($this->username,$this->password);
			if(!$this->_identity->authenticate()){
				if($this->_identity->errorCode == 3){
					$this->addError('username','<h3>Có lỗi xảy ra</h3><p>Tài khoản của bạn chưa được kích hoạt.</p>');
				}
				else if (($this->_identity->errorCode == 1) or ($this->_identity->errorCode == 2)){
					$this->addError('password','<h3>Có lỗi xảy ra</h3>Sai tên đăng nhập hoặc mật khẩu!<br/>Vui lòng kiểm tra lại.</p>');
				}
			}
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
			$this->_identity=new UserIdentity($this->username,$this->password);
			$this->_identity->authenticate();
		}
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
		{
			Yii::app()->user->login($this->_identity);
			return true;
		}
		else
			return false;
	}
	public function Logout()
	{
		Yii::app()->user->logout();
	}
}
