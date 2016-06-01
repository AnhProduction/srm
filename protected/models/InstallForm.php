<?php 
/**
* Anh Production
*/
class InstallForm extends CFormModel
{
	public $HostName;
	public $UsernameDB;
	public $PasswordDB;
    public $Database;
    public $Username;
    public $Password;
    public $Email;
    public $PasswordReInstall;

	public function rules()
    {
        return array(
            array('HostName, UsernameDB, Database, Username, Email, Password', 'required', 'message' => "<br/><div class=\"label label-danger\">Chưa nhập {attribute}!</div>"),
            array('Email', 'email', 'message'=> "<br/><div class=\"label label-danger\">{attribute} không hợp lệ!</div>"),
            array('Password, PasswordReInstall', 'length', 'min'=>6, 'max'=>40, 'tooShort'=>"<br/><div class=\"label label-danger\">Độ dài {attribute} phải lớn hơn 6 ký tự.</div>", 'tooLong'=>"<br/><div class=\"label label-danger\">Độ dài {attribute} phải nhỏ hơn 40 ký tự.</div>"),
            array('Username', 'match', 'pattern' => "/^[a-zA-Z0-9_-]{3,16}$/u", 'message'=>"<br/><div class=\"label label-danger\">{attribute} không hợp lệ!</div>"),
            array('PasswordDB', 'keepVal'),
            array('HostName, Database', 'match', 'pattern' => "/^[a-zA-Z0-9_-]+$/u", 'message'=>"<br/><div class=\"label label-danger\">{attribute} không hợp lệ!</div>"),
            array('PasswordDB', 'match', 'pattern' => "/[^'\"\,=>:;]+/u", 'message'=>"<br/><div class=\"label label-danger\">{attribute} không hợp lệ!</div>"),
        );
    }

    public function keepVal()
    {

    }

	public function attributeLabels()
	{
		return array(
			'Username'=>'Tài khoản quản trị',
			'Email'=>'Địa chỉ email',
			'Password'=>'Mật khẩu',
            'HostName'=>'Host Name',
            'UsernameDB'=>'Username',
            'Password'=>'Password',
            'Database'=>'Tên Database'
		);
	}
}

?>