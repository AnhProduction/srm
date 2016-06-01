<?php 
/**
* Anh Production
*/
class DMKForm extends CFormModel
{
	public $currentPwd;
	public $newPwd;
	public $confirmPwd;

	public function rules()
    {
        return array(
            array('currentPwd, newPwd, confirmPwd', 'required', 'message' => "<br/><div class=\"label label-danger\">Chưa nhập {attribute}!</div>"),
            array('currentPwd', 'checkCurrentPwd'),
            array('confirmPwd', 'compare', 'compareAttribute'=>'newPwd', 'message'=> "<br/><div class=\"label label-danger\">Nhập lại mật khẩu không khớp!</div>"),
            array('newPwd, confirmPwd', 'length', 'min'=>6, 'max'=>40, 'tooShort'=>"<br/><div class=\"label label-danger\">Độ dài {attribute} phải lớn hơn 6 ký tự.</div>", 'tooLong'=>"<br/><div class=\"label label-danger\">Độ dài {attribute} phải nhỏ hơn 40 ký tự.</div>"),
        );
    }

    public function checkCurrentPwd($attribute,$params)
    {
    	$_User = Account::model()->findByAttributes(array('ID' =>  Yii::app()->user->id));
    	if(md5($this->currentPwd) !== $_User->Password){
    		$this->addError($attribute,'<br/><div class="label label-danger">Mật khẩu hiện tại không đúng!</div>');
    	}
    }

    public function changePwd()
    {
    	$_User = Account::model()->findByAttributes(array('ID' =>  Yii::app()->user->id));
    	$_User->Password = md5($this->newPwd);
    	if($_User->update())
    		return true;
	    return false;
    }

	public function attributeLabels()
	{
		return array(
			'currentPwd'=>'Mật khẩu hiện tại',
			'newPwd'=>'Mật khẩu mới',
			'confirmPwd'=>'Nhập lại mật khẩu',
		);
	}
}

?>