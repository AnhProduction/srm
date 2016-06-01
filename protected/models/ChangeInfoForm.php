<?php 
/**
* Anh Production
*/
class ChangeInfoForm extends CFormModel
{
	public $avatar;
	public $newName;
	public $newEmail;

	public function rules()
    {
        return array(
            array('avatar', 'file','types'=>'jpg, jpeg, png', 'allowEmpty'=>true, 'enableClientValidation'=>true, 'wrongType'=>"<br/><div class=\"label label-danger\">Định dạng không được hỗ trợ.(Định dạng hỗ trợ: JPG, PNG, JPEG)</div>", 'maxSize'=>'1048576', 'tooLarge'=>"<br/><div class=\"label label-danger\">Kích thước tập tin quá lớn(MaxSize: 1MB)</div>"),
            array('newEmail, newName', 'required', 'message' => "<br/><div class=\"label label-danger\">Chưa nhập {attribute}!</div>"),
            array('newEmail', 'email', 'message' => "<br/><div class=\"label label-danger\">Định dạng email không hợp lệ!</div>"),
            array('newEmail', 'checkNewEmail'),
            array('newName', 'length', 'min'=>3, 'tooShort'=>"<br/><div class=\"label label-danger\">{attribute} phải từ 3 ký tự trở lên!</div>"),
            array('newName', 'match', 'pattern' => "/^[a-zA-Z_ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s]+$/u", 'message'=>"<br/><div class=\"label label-danger\">{attribute} chứa ký tự không hợp lệ!</div>"),
        );
    }

    public function checkNewEmail($attribute,$params)
    {
        $All = Account::model()->findAll("ID<>:ID AND Email=:Email", array(':ID'=> Yii::app()->user->id, ':Email'=> $this->newEmail));
    	if(count($All)){
    		$this->addError($attribute,"<br/><div class=\"label label-danger\">Địa chỉ email này đã được sử dụng bởi người dùng khác!</div>");
    	}
    }

    public function changeInfo()
    {
        $imgInfo  = CUploadedFile::getInstance($this,'avatar');
        $pathSave = Yii::app()->basePath."/../assets/images/avatar/";
        $_User    = Account::model()->findByAttributes(array('ID' =>  Yii::app()->user->id));
        if($imgInfo) {
            $_User->Avatar = $_User->Username.".".($imgInfo->getExtensionName());
            if(file_exists($pathSave.$_User->Avatar)){
                unlink($pathSave.$_User->Avatar);
            }
            $imgInfo->saveAs($pathSave.$_User->Avatar);
        }
        $_User->DisplayName = $this->newName;
        $_User->Email       = $this->newEmail;
    	if($_User->update()){
            Yii::app()->user->setState('displayname', $_User->DisplayName);
            Yii::app()->user->setState('email', $_User->Email);
            if($imgInfo) Yii::app()->user->setState('avatar', $_User->Avatar);
    		return true;
        }
	    return false;
    }

	public function attributeLabels()
	{
		return array(
            'avatar'   => 'Ảnh đại diện',
            'newName'  => 'Tên hiển thị',
            'newEmail' => 'Địa chỉ email',
		);
	}
}

?>