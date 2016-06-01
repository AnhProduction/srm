<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{

	 // Need to store the user's ID:
	 private $_id;
	 const ERROR_USERNAME_NOT_ACTIVE = 3;

	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		if(!filter_var($this->username, FILTER_VALIDATE_EMAIL) === false){
			$user = Account::model()->findByAttributes(array('Email'=>$this->username));
		} else {
			$user = Account::model()->findByAttributes(array('Username'=>$this->username));
		}

		if ($user===null) { // No user found!
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		} else if ($user->Password !== md5($this->password) ) { // Invalid password!
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		} else if ($user->isActive == 0) {
			$this->errorCode=self::ERROR_USERNAME_NOT_ACTIVE;
		} else { // Okay!
		    $this->errorCode=self::ERROR_NONE;
		    // Store the role in a session:
		    $LastVisited = round(microtime(true));
		    $this->setState('role', $user->Role);
		    $this->setState('displayname', $user->DisplayName);
		    $this->setState('email', $user->Email);
		    $this->setState('membersince', $user->RegisterDate);
		    $this->setState('lastvisited', date("d-m-Y, H:i",$LastVisited));
		    $this->setState('avatar', $user->Avatar);
			$this->_id = $user->ID;
			$user->LastVisited = date("Y-m-d H:i:s",$LastVisited);
			$user->update();
		}
		return !$this->errorCode;
	}
	
	public function getId()
	{
	 return $this->_id;
	}

	
}