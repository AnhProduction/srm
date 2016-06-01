<?php
/**
* 
*/
class SForm extends CFormModel
{
	public $MaSV;
	public $HoDem;
	public $Ten;
	public $NgaySinh;
	public $GioiTinh;
	public $MaLop;
	public $MaNganh;
	public $NienKhoa;
	public $HeDaoTao;
	public $NoiSinh;
	public $T;
	public $H;
	public $HKTT;
	public $DanToc;
	public $TonGiao;
	public $DoiTuong;
	public $CMND;
	public $CMNDNgayCap;
	public $CMNDNoiCap;
	public $NgayVaoDoan;
	public $NgayVaoDang;
	public $SDT;
	public $HoTenBo;
	public $SDTBo;
	public $NgheBo;
	public $HoTenMe;
	public $SDTMe;
	public $NgheMe;
	//NoiTru
	public $SoThe;
	public $SoPhong;
	public $SoNha;
	public $NgayDK;
	public $NgayKT;
	//NgoaiTru
	public $TenChuTro;
	public $SDTChuTro;
	public $DiaChiCuTru;
	public $NgayDKTro;

	public function rules()
	{
		return array(
			array('MaSV, HoDem, Ten, NgaySinh, GioiTinh, NoiSinh, MaLop, MaNganh, NienKhoa, HeDaoTao, DanToc, TonGiao, CMND, CMNDNoiCap, CMNDNgayCap, HKTT','required','message'=>"<br/><div class=\"label label-danger\">Chưa nhập {attribute}!</div>"),
			array('HoDem, Ten, HoTenBo, HoTenMe, TenChuTro, DanToc, TonGiao, DoiTuong, NgheBo, NgheMe, SoNha, SoPhong, SoThe, DiaChiCuTru','match', 'pattern' => "/^[a-zA-Z_ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s\-]+$/u", 'message'=>"<br/><div class=\"label label-danger\">{attribute} chứa ký tự không hợp lệ!</div>"),
			array('CMND, SDT, SDTBo, SDTMe, SDTChuTro', 'match', 'pattern'=>"/(\+\d{2,4})?\s?(\d{8,11})/", 'message'=>"<br/><div class=\"label label-danger\">{attribute} không hợp lệ!</div>"),
			array('HeDaoTao', 'in', 'range' => array('DHCQ', 'CDCQ', 'DHLT'), 'message'=>'<br/><div class=\"label label-danger\">{attribute} không hợp lệ!</div>'),
			array('MaSV', 'checkMSV'),
			array('NgayVaoDang, NgayVaoDoan, NgayDK, NgayKT, NgayDKTro', 'KeepValue'),
		);
	}

	public function KeepValue()
	{
		# This function using for keep value input no rule
	}

	public function checkMSV($attribute,$params)
    {
        $All = HSSV::model()->findAll("MaSV=:MSV", array(':MSV'=> $this->MaSV));
    	if(count($All)){
    		$this->addError($attribute,"<br/><div class=\"label label-danger\">Mã sinh viên ".$this->MaSV." đã tồn tại!</div>");
    	}
    }

	public function attributeLabels()
	{
		return array(
			'MaSV'=>'Mã Sinh Viên',
			'HoDem'=>'Họ và Tên Đệm',
			'Ten'=>'Tên',
			'NgaySinh'=>'Ngày Sinh',
			'GioiTinh'=>'Giới Tính',
			'MaLop'=>'Lớp',
			'MaNganh'=>'Ngành',
			'NienKhoa'=>'Niên Khóa',
			'HeDaoTao'=>'Hệ Đào Tạo',
			'NoiSinh'=>'Nơi Sinh',
			'HKTT'=>'Hộ Khẩu Thường Trú',
			'DanToc'=>'Dân Tộc',
			'TonGiao'=>'Tôn Giáo',
			'DoiTuong'=>'Đối tượng',
			'CMND'=>'CMND',
			'CMNDNgayCap'=>'Ngày Cấp CMND',
			'CMNDNoiCap'=>'Nơi Cấp CMND',
			'NgayVaoDoan'=>'Ngày Vào Đoàn',
			'NgayVaoDang'=>'Ngày Vào Đảng',
			'SDT'=>'Số Điện Thoại',
			'HoTenBo'=>'Họ Tên Bố',
			'SDTBo'=>'Số Điện Thoại Bố',
			'NgheBo'=>'Nghề Nghiệp Bố',
			'HoTenMe'=>'Họ Tên Mẹ',
			'SDTMe'=>'Số Điện Thoại Mẹ',
			'NgheMe'=>'Nghề Nghiệp Mẹ',
				//NoiTru
			'SoThe'=>'Số Thẻ',
			'SoPhong'=>'Số Phòng',
			'SoNha'=>'Số Nhà',
			'NgayDK'=>'Ngày Đăng Ký',
			'NgayKT'=>'Ngày Kết Thúc',
				//NgoaiTru
			'TenChuTro'=>'Tên Chủ Trọ',
			'SDTChuTro'=>'Số ĐT Chủ Trọ',
			'DiaChiCuTru'=>'Địa Chỉ Trọ',
			'NgayDKTro'=>'Ngày ĐK Trọ',
		);
	}
}