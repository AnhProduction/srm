<?php

class AuthenticationController extends Controller
{
	public $defaultAction = 'login';
	protected function beforeAction($event)
    {
        if(!file_exists(dirname(__FILE__)."/install")|| file_get_contents(dirname(__FILE__)."/install") != 'installed')
        {
	        $this->redirect(Yii::app()->createUrl('install/'));
	        return false;
    	} else return true;
    }
	public function actionLogin()
	{
		//Check if logged -> back to home
		if (!Yii::app()->user->isGuest)
	        $this->redirect(Yii::app()->homeUrl);
	 
	    $model = new LoginForm('login');
	    if (isset($_POST['LoginForm'])) {
	        $model->attributes = $_POST['LoginForm'];
	 
	        if ($model->validate('login') && $model->login()) {
	        	Yii::app()->user->setFlash('WelcomeBack', "Welcome back!<br/>How are you?");
	            $this->redirect(Yii::app()->baseUrl);
	        }
	    }
		$this->layout = 'login';
	    $this->render('login', array('model' => $model));
	}
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->baseUrl.'/authentication/login');
	}

	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
        {
        	print_r(Yii::app()->errorHandler->error);
        	$this->layout = 'error';
        	$this->render('error', $error);
        }
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