<?php

/**
 * This is the model class for table "srm_noitru".
 *
 * The followings are the available columns in table 'srm_noitru':
 * @property integer $SVID
 * @property string $SoThe
 * @property string $SoNha
 * @property string $SoPhong
 * @property string $NgayDK
 * @property string $NgayKT
 */
class Noitru extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'srm_noitru';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('SVID, SoThe', 'required'),
			array('SVID', 'numerical', 'integerOnly'=>true),
			array('SoThe, SoNha', 'length', 'max'=>20),
			array('SoPhong, NgayDK, NgayKT', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('SVID, SoThe, SoNha, SoPhong, NgayDK, NgayKT', 'safe', 'on'=>'search'),
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
			'SVID' => 'Svid',
			'SoThe' => 'So The',
			'SoNha' => 'So Nha',
			'SoPhong' => 'So Phong',
			'NgayDK' => 'Ngay Dk',
			'NgayKT' => 'Ngay Kt',
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

		$criteria->compare('SVID',$this->SVID);
		$criteria->compare('SoThe',$this->SoThe,true);
		$criteria->compare('SoNha',$this->SoNha,true);
		$criteria->compare('SoPhong',$this->SoPhong,true);
		$criteria->compare('NgayDK',$this->NgayDK,true);
		$criteria->compare('NgayKT',$this->NgayKT,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Noitru the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
