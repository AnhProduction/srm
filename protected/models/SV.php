<?php

/**
 * This is the model class for table "srm_hssv".
 *
 * The followings are the available columns in table 'srm_hssv':
 * @property integer $SVID
 * @property string $MaSV
 * @property string $HoDem
 * @property string $Ten
 * @property string $NgaySinh
 * @property integer $GioiTinh
 * @property string $NoiSinh
 * @property string $HKTT
 * @property string $DanToc
 * @property string $DoiTuong
 * @property string $TonGiao
 * @property string $NgayVaoDoan
 * @property string $CMND
 * @property string $MaLop
 * @property string $MaNganh
 * @property integer $NienKhoa
 * @property string $HeDaoTao
 * @property integer $NgoaiTru
 * @property integer $NoiTru
 * @property string $SDT
 * @property string $HoTenBo
 * @property string $HoTenMe
 * @property string $NgheBo
 * @property string $NgheMe
 * @property string $SDTBo
 * @property string $SDTMe
 */
class SV extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'srm_hssv';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('SVID, MaSV, HoDem, Ten, NgaySinh, GioiTinh, NoiSinh, HKTT, DanToc, DoiTuong, TonGiao, NgayVaoDoan, CMND, MaLop, MaNganh, NienKhoa, HeDaoTao, HoTenBo, HoTenMe, NgheBo, NgheMe, SDTBo, SDTMe', 'required'),
			array('SVID, GioiTinh, NienKhoa, NgoaiTru, NoiTru', 'numerical', 'integerOnly'=>true),
			array('MaSV, HoDem, Ten, NgaySinh, DanToc, DoiTuong, TonGiao, NgayVaoDoan, MaLop, MaNganh, HoTenBo, HoTenMe, NgheBo, NgheMe', 'length', 'max'=>50),
			array('NoiSinh', 'length', 'max'=>255),
			array('HKTT, HeDaoTao', 'length', 'max'=>10),
			array('CMND, SDT, SDTBo, SDTMe', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('SVID, MaSV, HoDem, Ten, NgaySinh, GioiTinh, NoiSinh, HKTT, DanToc, DoiTuong, TonGiao, NgayVaoDoan, CMND, MaLop, MaNganh, NienKhoa, HeDaoTao, NgoaiTru, NoiTru, SDT, HoTenBo, HoTenMe, NgheBo, NgheMe, SDTBo, SDTMe', 'safe', 'on'=>'search'),
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
			'MaSV' => 'Ma Sv',
			'HoDem' => 'Ho Dem',
			'Ten' => 'Ten',
			'NgaySinh' => 'Ngay Sinh',
			'GioiTinh' => 'Gioi Tinh',
			'NoiSinh' => 'Noi Sinh',
			'HKTT' => 'Hktt',
			'DanToc' => 'Dan Toc',
			'DoiTuong' => 'Doi Tuong',
			'TonGiao' => 'Ton Giao',
			'NgayVaoDoan' => 'Ngay Vao Doan',
			'CMND' => 'Cmnd',
			'MaLop' => 'Ma Lop',
			'MaNganh' => 'Ma Nganh',
			'NienKhoa' => 'Nien Khoa',
			'HeDaoTao' => 'He Dao Tao',
			'NgoaiTru' => 'Ngoai Tru',
			'NoiTru' => 'Noi Tru',
			'SDT' => 'Sdt',
			'HoTenBo' => 'Ho Ten Bo',
			'HoTenMe' => 'Ho Ten Me',
			'NgheBo' => 'Nghe Bo',
			'NgheMe' => 'Nghe Me',
			'SDTBo' => 'Sdtbo',
			'SDTMe' => 'Sdtme',
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
		$criteria->compare('MaSV',$this->MaSV,true);
		$criteria->compare('HoDem',$this->HoDem,true);
		$criteria->compare('Ten',$this->Ten,true);
		$criteria->compare('NgaySinh',$this->NgaySinh,true);
		$criteria->compare('GioiTinh',$this->GioiTinh);
		$criteria->compare('NoiSinh',$this->NoiSinh,true);
		$criteria->compare('HKTT',$this->HKTT,true);
		$criteria->compare('DanToc',$this->DanToc,true);
		$criteria->compare('DoiTuong',$this->DoiTuong,true);
		$criteria->compare('TonGiao',$this->TonGiao,true);
		$criteria->compare('NgayVaoDoan',$this->NgayVaoDoan,true);
		$criteria->compare('CMND',$this->CMND,true);
		$criteria->compare('MaLop',$this->MaLop,true);
		$criteria->compare('MaNganh',$this->MaNganh,true);
		$criteria->compare('NienKhoa',$this->NienKhoa);
		$criteria->compare('HeDaoTao',$this->HeDaoTao,true);
		$criteria->compare('NgoaiTru',$this->NgoaiTru);
		$criteria->compare('NoiTru',$this->NoiTru);
		$criteria->compare('SDT',$this->SDT,true);
		$criteria->compare('HoTenBo',$this->HoTenBo,true);
		$criteria->compare('HoTenMe',$this->HoTenMe,true);
		$criteria->compare('NgheBo',$this->NgheBo,true);
		$criteria->compare('NgheMe',$this->NgheMe,true);
		$criteria->compare('SDTBo',$this->SDTBo,true);
		$criteria->compare('SDTMe',$this->SDTMe,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SV the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
