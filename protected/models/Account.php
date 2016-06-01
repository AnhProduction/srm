<?php

/**
 * This is the model class for table "account".
 *
 * The followings are the available columns in table 'account':
 * @property integer $ID
 * @property string $Username
 * @property string $Password
 * @property string $Email
 * @property string $DisplayName
 * @property string $Avatar
 * @property string $RegisterDate
 * @property string $LastVisited
 * @property integer $isActive
 * @property string $Role
 */
class Account extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'account';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Username, Password, DisplayName', 'required'),
			array('isActive', 'numerical', 'integerOnly'=>true),
			array('Username, Password', 'length', 'max'=>50),
			array('Email, DisplayName', 'length', 'max'=>255),
			array('Role', 'length', 'max'=>20),
			array('Avatar, RegisterDate, LastVisited', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, Username, Password, Email, DisplayName, Avatar, RegisterDate, LastVisited, isActive, Role', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'Username' => 'Username',
			'Password' => 'Password',
			'Email' => 'Email',
			'DisplayName' => 'Display Name',
			'Avatar' => 'Avatar',
			'RegisterDate' => 'Register Date',
			'LastVisited' => 'Last Visited',
			'isActive' => 'Is Active',
			'Role' => 'Role',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('ID',$this->ID);
		$criteria->compare('Username',$this->Username,true);
		$criteria->compare('Password',$this->Password,true);
		$criteria->compare('Email',$this->Email,true);
		$criteria->compare('DisplayName',$this->DisplayName,true);
		$criteria->compare('Avatar',$this->Avatar,true);
		$criteria->compare('RegisterDate',$this->RegisterDate,true);
		$criteria->compare('LastVisited',$this->LastVisited,true);
		$criteria->compare('isActive',$this->isActive);
		$criteria->compare('Role',$this->Role,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Account the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
