<?php

class InstallController extends Controller
{
	public $layout = 'install';
	public $defaultAction = 'index';
	protected function beforeAction($event)
    {
        if(file_exists(dirname(__FILE__)."/install")&&file_get_contents(dirname(__FILE__)."/install") == 'installed')
        {
	        $this->ReInstall();
	        return false;
    	} else return true;
    }
	public function actionIndex()
	{
		$fileDB = dirname(__FILE__).'/../config/database.php';
		$fileMain = dirname(__FILE__).'/../config/main.php';
		$fileSQL = dirname(__FILE__).'/../data/srm.sql';
		$msg = array();
		$model = new InstallForm();
		if(isset($_POST['InstallForm'])){
			$model->attributes = $_POST['InstallForm'];
			if($model->validate()){
				$db = file_get_contents($fileDB);
				$db = preg_replace("/\"mysql:host=(.*);dbname=(.*)\"/u", "\"mysql:host={$model->HostName};dbname={$model->Database}\"", $db);
				$db = preg_replace("/'username' => '(.*)'/u", "'username' => '{$model->UsernameDB}'", $db);
				$db = preg_replace("/'password' => '(.*)'/u", "'password' => '{$model->PasswordDB}'", $db);
				if(file_put_contents($fileDB, $db)){
					try
					{
						$connection=new CDbConnection("mysql:host={$model->HostName};dbname={$model->Database}",$model->UsernameDB,$model->PasswordDB);
						$connection->active=true;
						try{
							$connection->createCommand(file_get_contents($fileSQL))->execute();
							$connection->createCommand("TRUNCATE `account`")->execute();
							$connection->createCommand("INSERT INTO `account` (`ID`, `Username`, `Password`, `Email`, `DisplayName`, `Avatar`, `RegisterDate`, `LastVisited`, `isActive`, `Role`) VALUES ('1', '{$model->Username}', '".md5($model->Password)."', '{$model->Email}', 'Administrator', 'noavatar.jpg', '', '', 1, 'S-A-C-R-U-D')")->execute();
							$connection->createCommand("ALTER TABLE `account` CHANGE `ID` `ID` INT(11) NOT NULL AUTO_INCREMENT")->execute();
							$msg[] = array('success'=>"Thiết lập thành công!");
							$f = fopen(dirname(__FILE__)."/install", 'w');
							fwrite($f, "installed");
							fclose($f);
							$fp = fopen(dirname(__FILE__)."/password", 'w');
							fwrite($fp, md5(($model->PasswordReInstall)));
							fclose($fp);
	            			Yii::app()->user->setFlash('Installed', "Thiết lập phần mềm thành công!<br/>Bây giờ bạn có thể sử dụng chương trình");
	            			$this->redirect(Yii::app()->createUrl('authentication/'));
						} catch(Exception $e){
							$msg[] = array('danger'=>"Lỗi không xác định!<br>Message: ".$e->getMessage());
						}
						// $msg[] = array('success'=>"Thiết lập thành công!");
					}
					catch (CDbException $e)
					{
					  if($e->getCode()==2002){
					  	$msg[] = array('danger'=>"Lỗi kết nối với <code>Host Name</code>!<br>Message: ".$e->getMessage());
					  } elseif ($e->getCode()==1044) {
					  	$msg[] = array('danger'=>"Lỗi kết nối với <code>Tài Khoản DB</code>!<br>Message: ".$e->getMessage());
					  } elseif ($e->getCode()==1045) {
					  	$msg[] = array('danger'=>"Lỗi kết nối với <code>Mật Khẩu DB</code>!<br>Message: ".$e->getMessage());
					  } elseif ($e->getCode()==1049) {
					  	$msg[] = array('danger'=>"Lỗi kết nối với <code>Database</code>!<br>Message: ".$e->getMessage());
					  } else {
					  	$msg[] = array('danger'=>"Lỗi kết nối không xác định!");
					  }
					}
				}
			}
		}
		$this->render('index', array('model'=>$model, 'msg'=>$msg));
	}

	private function ReInstall()
	{
		$msg = array();
		if(isset($_POST['btnReInstall'])&&isset($_POST['Pwd'])){
			if(file_exists(dirname(__FILE__)."/password")&&file_get_contents(dirname(__FILE__)."/password") == md5($_POST['Pwd']))
	        {
				$f = fopen(dirname(__FILE__)."/install", 'w');
				fwrite($f, "install");
				fclose($f);
				$this->refresh();
	    	} else {
	    		$msg[] = array('danger'=>"Mật Khẩu Không Đúng");
	    	}
		}
		$this->render('reinstall', array('msg'=>$msg));
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