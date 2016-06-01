<?php 
/**
* Anh Production
*/
class AUForm extends CFormModel
{
	public $Username;
	public $Email;
	public $Password;
    public $DisplayName;

	public function rules()
    {
        return array(
            array('Username, Password, DisplayName', 'required', 'message' => "<br/><div class=\"label label-danger\">Chưa nhập {attribute}!</div>"),
            array('Username', 'checkUser'),
            array('Email', 'checkEmail'),
            array('Email', 'email', 'message'=> "<br/><div class=\"label label-danger\">{attribute} không hợp lệ!</div>"),
            array('Password', 'length', 'min'=>6, 'max'=>40, 'tooShort'=>"<br/><div class=\"label label-danger\">Độ dài {attribute} phải lớn hơn 6 ký tự.</div>", 'tooLong'=>"<br/><div class=\"label label-danger\">Độ dài {attribute} phải nhỏ hơn 40 ký tự.</div>"),
            array('DisplayName', 'length', 'min'=>2, 'max'=>32, 'tooShort'=>"<br/><div class=\"label label-danger\">Độ dài {attribute} phải lớn hơn 2 ký tự.</div>", 'tooLong'=>"<br/><div class=\"label label-danger\">Độ dài {attribute} phải nhỏ hơn 32 ký tự.</div>"),
        );
    }

    public function checkCurrentPwd($attribute,$params)
    {
    	$_User = Account::model()->findByAttributes(array('ID' =>  Yii::app()->user->id));
    	if(md5($this->currentPwd) !== $_User->Password){
    		$this->addError($attribute,'<br/><div class="label label-danger">Mật khẩu hiện tại không đúng!</div>');
    	}
    }

    public function checkUser($attribute,$params)
    {
        $All = Account::model()->findAll("Username=:U", array(':U'=> $this->Username));
        if(count($All)){
            $this->addError($attribute,"<br/><div class=\"label label-danger\">Username này đã được sử dụng bởi người dùng khác!</div>");
        }
    }

    public function checkEmail($attribute,$params)
    {
        $All = Account::model()->findAll("Email=:Email", array(':Email'=> $this->Email));
        if(count($All)){
            $this->addError($attribute,"<br/><div class=\"label label-danger\">Địa chỉ email này đã được sử dụng bởi người dùng khác!</div>");
        }
    }

	public function attributeLabels()
	{
		return array(
			'Username'=>'Username',
			'Email'=>'Địa chỉ email',
			'Password'=>'Mật khẩu',
            'DisplayName'=>'Tên hiển thị'
		);
	}
}

?>