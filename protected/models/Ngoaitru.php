<?php

/**
 * This is the model class for table "srm_ngoaitru".
 *
 * The followings are the available columns in table 'srm_ngoaitru':
 * @property integer $SVID
 * @property string $TenChuTro
 * @property string $SDTChuTro
 * @property string $DiaChiCuTru
 * @property string $NgayDKTro
 */
class Ngoaitru extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'srm_ngoaitru';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('SVID, DiaChiCuTru', 'required'),
			array('SVID', 'numerical', 'integerOnly'=>true),
			array('TenChuTro, NgayDKTro', 'length', 'max'=>50),
			array('SDTChuTro', 'length', 'max'=>20),
			array('DiaChiCuTru', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('SVID, TenChuTro, SDTChuTro, DiaChiCuTru, NgayDKTro', 'safe', 'on'=>'search'),
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
			'TenChuTro' => 'Ten Chu Tro',
			'SDTChuTro' => 'Sdtchu Tro',
			'DiaChiCuTru' => 'Dia Chi Cu Tru',
			'NgayDKTro' => 'Ngay Dktro',
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
		$criteria->compare('TenChuTro',$this->TenChuTro,true);
		$criteria->compare('SDTChuTro',$this->SDTChuTro,true);
		$criteria->compare('DiaChiCuTru',$this->DiaChiCuTru,true);
		$criteria->compare('NgayDKTro',$this->NgayDKTro,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Ngoaitru the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
