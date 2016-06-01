<?php

class AccountController extends Controller
{
	public $defaultAction = 'Info';
	protected function beforeAction($event)
    {
        if(!file_exists(dirname(__FILE__)."/install")|| file_get_contents(dirname(__FILE__)."/install") != 'installed')
        {
	        $this->redirect(Yii::app()->createUrl('install/'));
	        return false;
    	} else return true;
    }
	public function actionChangepassword()
	{
		$msg = array();
		$model = new DMKForm();
		if(isset($_POST['DMKForm'])){
			$model->attributes = $_POST['DMKForm'];
			if($model->validate()){
				if($model->changePwd()){
					$msg[] = array('success'=>"Đổi mật khẩu thành công!");
				}
			}
		}
		$this->render('changepassword', array('model' => $model, 'msg'=>$msg));
	}

	public function actionInfo()
	{

		$this->render('index');
	}

	public function actionUpdate()
	{
		$msg = array();
		$model = new ChangeInfoForm();
		if(isset($_POST['ChangeInfoForm'])){
			$model->attributes = $_POST['ChangeInfoForm'];
			if($model->validate()){
				if($model->changeInfo()){
					$msg[] = array('success'=>"Đổi thông tin cá nhân thành công!");
				}	
			}
		}
		$this->render('update', array('model' => $model, 'msg'=>$msg));
	}

	public function filters()
    {
        return array(
            'accessControl',
        );
    }
	//accessRules #Phân quyền cho user
	public function accessRules()
	{
	    return array(
	        array('deny',
	            'controllers'=>array('account'), //Controller for logged
	            'users'=>array('?'),// ? == anonymous users
	        ),
	    );
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}