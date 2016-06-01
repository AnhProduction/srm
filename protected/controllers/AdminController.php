<?php

class AdminController extends Controller
{
	public $defaultAction = 'dashboard';
	public $footer = "";

	protected function beforeAction($event)
    {
        if(!file_exists(dirname(__FILE__)."/install")|| file_get_contents(dirname(__FILE__)."/install") != 'installed')
        {
	        $this->redirect(Yii::app()->createUrl('install/'));
	        return false;
    	} else return true;
    }
	public function actionDashboard()
	{
		$DB = new DBModel();
		$this->render('index',array('data'=>$DB->dashboard()));
	}

	public function actionDanhSachHoSo()
	{
		$DB = new DBModel();
		$this->render('danhsachhoso',array('data'=>$DB->student()));
	}

	public function actionSearch()
	{
		$DB = new DBModel();
		if(isset($_GET['btnSearch'])){
			$Keyword = isset($_GET['keyword'])?addslashes($_GET['keyword']):"";
			$Lop = isset($_GET['txtLop'])?$_GET['txtLop']:array();
			$Nganh = isset($_GET['txtNganh'])?$_GET['txtNganh']:array();
			$data = $DB->Search($Keyword, $Lop, $Nganh);
			$this->render('search',array('data'=>$data));
		}
		else $this->render('search');
	}

	public function actionNhapHoSo()
	{
		if(strpos(Yii::app()->user->role, "C")===false){
			Yii::app()->user->setFlash('error','Bạn không có quyền nhập hồ sơ!');
			$this->redirect(Yii::app()->createUrl('admin/danhsachhoso'));
		}
		$model = new SForm();
		if(isset($_POST['SForm'])){
			$model->attributes = $_POST['SForm'];
			if($model->validate()){
				$SV = new HSSV();
				$SV->attributes = $model->attributes;
				if($SV->save()){
					$SVID = $SV->getPrimaryKey();
					if(isset($_POST['SForm']['SoThe'])){
						$NT             = new Noitru();
						$NT->attributes = $model->attributes;
						$NT->SVID       = $SV->getPrimaryKey();
						$NT->save();
					}
					if(isset($_POST['SForm']['DiaChiCuTru'])){
						$NgT = new Ngoaitru();
						$NgT->attributes = $model->attributes;
						$NgT->SVID = $SV->getPrimaryKey();
						$NgT->save();
					}
					Yii::app()->user->setFlash('success','Nhập mới hồ sơ thành công!');
					$this->redirect(Yii::app()->createUrl('admin/danhsachhoso'));
				} else {
					Yii::app()->user->setFlash('error','Nhập mới hồ sơ thất bại');
					$this->redirect(Yii::app()->createUrl('admin/danhsachhoso'));
				}
			}
		}
		$this->render('hsadd', array('model'=>$model));
	}

	public function actionSuaHoSo()
	{
		if(strpos(Yii::app()->user->role, "U")===false){
			Yii::app()->user->setFlash('error','Bạn không có quyền sửa hồ sơ!');
			$this->redirect(Yii::app()->createUrl('admin/danhsachhoso'));
		}
		$ID = isset($_GET['id'])?intval($_GET['id']):null;
		if($ID&&count(HSSV::model()->findByPk($ID))){
			$model = new SEForm();
			if(isset($_POST['SEForm'])){
				$model->attributes = $_POST['SEForm'];
				if($model->validate()){
					$SV = HSSV::model()->findByPk($ID);
					$SV->attributes = $model->attributes;
					if($SV->save()){
						$SVID = $SV->getPrimaryKey();
						if(isset($_POST['SEForm']['SoThe'])){
							$NT = Noitru::model()->findByPk($SVID);
							if(!$NT) {
								$NT             = new Noitru();
								$NT->attributes = $model->attributes;
								$NT->SVID       = $SVID;
							} else {
								$NT->attributes = $model->attributes;
							}
							$NT->save();
						} else {
							Noitru::model()->deleteByPk($SVID);
						}
						if(isset($_POST['SEForm']['DiaChiCuTru'])){
							$NgT = Ngoaitru::model()->findByPk($SVID);
							if(!$NgT) {
								$NgT             = new Ngoaitru();
								$NgT->attributes = $model->attributes;
								$NgT->SVID       = $SVID;
							} else {
								$NgT->attributes = $model->attributes;
							}
							$NgT->save();
						} else {
							Ngoaitru::model()->deleteByPk($SVID);
						}
						Yii::app()->user->setFlash('success','Sửa hồ sơ thành công!');
						$this->redirect(Yii::app()->createUrl('admin/danhsachhoso'));
					} else {
						Yii::app()->user->setFlash('error','Sửa hồ sơ thất bại');
						$this->redirect(Yii::app()->createUrl('admin/danhsachhoso'));
					}
				}
			}
			$SVdata = HSSV::model()->findByPk($ID);
			$model->GioiTinh = $SVdata->GioiTinh;// Set GioiTinh is checked in view
			$this->render('hsedit', array('model'=>$model, 'SVData'=>$SVdata, 'SVNT'=>Noitru::model()->findByPk($ID), 'SVNgT'=>Ngoaitru::model()->findByPk($ID)));
		} else {
			Yii::app()->user->setFlash('error','Có lỗi xảy ra! Hồ sơ này không tồn tại');
			$this->redirect(Yii::app()->createUrl('admin/danhsachhoso'));
		}
	}

	public function actionXoaHS()
	{
		if(strpos(Yii::app()->user->role, "D")===false){
			Yii::app()->user->setFlash('error','Bạn không có quyền xóa hồ sơ!');
			$this->redirect(Yii::app()->createUrl('admin/danhsachhoso'));
		}
		$ID = isset($_GET['id'])?intval($_GET['id']):null;
		if($ID){
			HSSV::model()->deleteByPk($ID);
			Noitru::model()->deleteByPk($ID);
			Ngoaitru::model()->deleteByPk($ID);
			Yii::app()->user->setFlash('success','Xóa hồ sơ thành công!');
			$this->redirect(Yii::app()->createUrl('admin/danhsachhoso'));
		} else {
			Yii::app()->user->setFlash('error','Xóa hồ sơ thất bại!');
			$this->redirect(Yii::app()->createUrl('admin/danhsachhoso'));
		}
	}

	public function actionThongKe()
	{
		$this->render('thongke');
	}

	public function actionBaoCao()
	{
		if(isset($_GET['type'])){
			$data['type'] = (isset($_GET['type'])&&in_array(intval($_GET['type']), array(1, 2, 3, 4)))?($_GET['type']):0;
			$data['name'] = (isset($_GET['name'])&&intval($_GET['name']))?intval($_GET['name']):0;
			if(!$data['type']){
				Yii::app()->user->setFlash('error','Thông tin tạo báo cáo lỗi!');
				$this->redirect(Yii::app()->createUrl('admin/thongke'));
			}
			$this->render('baocao', array('data'=>$data));
		} else {
			$this->render('baocao');
		}
	}

	public function actionExport()
	{
		foreach ($_GET as $key => $value) {
			preg_match('/type=([1-4])\&name=(.*)\&end/', base64_decode($key), $export);
			if(is_array($export)){
				$this->Export($export[1], $export[2]);
			} else {
				Yii::app()->user->setFlash('error','Thông tin tạo báo cáo lỗi!');
				$this->redirect(Yii::app()->createUrl('admin/thongke'));
			}
		}
	}

	private function Export($type = '', $name =''){
		$DB = new DBModel();
		if(in_array(intval($type), array(1, 2, 3, 4))){
			Yii::import('ext.phpexcel.XPHPExcel');    
		    	$objPHPExcel= XPHPExcel::createPHPExcel();
		    	$objPHPExcel->getProperties()->setCreator("Anh Production")
		                             		->setLastModifiedBy("Anh Production (64DCTH01)")
		                             		->setTitle($name)
		                             		->setSubject($name)
		                             		->setDescription("Create by Anh Production")
		                            		->setKeywords("FB: fb.com/anhproduction")
		                            	 	->setCategory("Email: ndna2606@gmail.com");
				$objPHPExcel->getDefaultStyle()->getFont()->setName('Times New Roman');
			//Var Style
			$center = array(//Text center
		        'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,));
		    $vcenter = array(//Text center
		        'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,));
		    $right = array(//Text Right
		        'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,));
		    $underline = array(//Text underline
		        'font' => array('underline' => PHPExcel_Style_Font::UNDERLINE_SINGLE));
		    $bold = array(//Text underline
		        'font' => array('bold' => true));

		    $objWorkSheet = $objPHPExcel->createSheet(0); //Setting index when creating
		    $objWorkSheet->setTitle("SRM REPORT - Create by Anh");
		    $objWorkSheet->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT)
		    							 ->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4)
										 ->setFitToPage(true)
										 ->setFitToWidth(1)
										 ->setFitToHeight(1)
										 ->setHorizontalCentered(1);
		    	$objWorkSheet->setCellValue('A1', 'Student Records Management')
		    		->mergeCells('A1:D3');
		    	$objWorkSheet->getStyle('A1')->applyFromArray($bold);
		    	$objWorkSheet->getStyle('A1')->applyFromArray($vcenter);
		    	$objWorkSheet->getStyle('A1')->getFont()->setSize(15);
		    	$objWorkSheet->setCellValue('F2', "Báo Cáo")
		    		->mergeCells('F2:J2');
		    	$objWorkSheet->getStyle('F2')->applyFromArray($center);
		    $STT = 1;
		    $Row = 5;
		    //
		    if(intval($type) == 1){
		    	if(intval($name)){
		    		$ClassName = (count(Lop::model()->findAll('MaLop=:ML', array(':ML'=>intval($name)))))?(Lop::model()->find('MaLop=:ML', array(':ML'=>intval($name)))['TenLop']):"";
		    		$objWorkSheet->setCellValue('F2', "Báo Cáo TT Sinh Viên Lớp $ClassName");
		    		$objWorkSheet->getStyle("F2")->applyFromArray($bold);
		    		$objWorkSheet->setCellValue("A{$Row}", 'STT');
		    		$objWorkSheet->setCellValue("B{$Row}", 'MSV');
		    		$objWorkSheet->setCellValue("C{$Row}", 'Họ Tên')
		    		->mergeCells("C{$Row}:D{$Row}");
		    		$objWorkSheet->setCellValue("E{$Row}", 'Ngày Sinh');
		    		$objWorkSheet->setCellValue("F{$Row}", 'Giới Tính');
		    		$objWorkSheet->setCellValue("G{$Row}", 'Lớp');
		    		$objWorkSheet->setCellValue("H{$Row}", 'Ngành');
		    		$objWorkSheet->setCellValue("I{$Row}", 'Niên Khóa');
		    		$objWorkSheet->setCellValue("H{$Row}", 'Hệ Đào Tạo');
		    		$objWorkSheet->setCellValue("J{$Row}", 'Nơi Sinh');
		    		$objWorkSheet->setCellValue("K{$Row}", 'Hộ Khẩu Thường Trú');
		    		$objWorkSheet->setCellValue("L{$Row}", 'Dân Tộc');
		    		$objWorkSheet->setCellValue("M{$Row}", 'Tôn Giáo');
		    		$objWorkSheet->setCellValue("N{$Row}", 'Đối Tượng');
		    		$objWorkSheet->setCellValue("O{$Row}", 'Ngày Vào Đoàn');
		    		$objWorkSheet->setCellValue("P{$Row}", 'Ngày Vào Đảng');
		    		$objWorkSheet->setCellValue("Q{$Row}", 'Số CMND');
		    		$objWorkSheet->setCellValue("R{$Row}", 'SĐT');
		    		$objWorkSheet->getStyle("A{$Row}:R{$Row}")->applyFromArray($bold);

		    		$HSSV = $DB->Search("", array(intval($name)));
					foreach ($HSSV as $key => $value) {
						$Row++;
						$objWorkSheet->setCellValue("A{$Row}", "$STT");
			    		$objWorkSheet->setCellValue("B{$Row}", $value['MaSV']);
			    		$objWorkSheet->setCellValue("C{$Row}", $value['HoDem']." ".$value['Ten'])
			    		->mergeCells("C{$Row}:D{$Row}");
			    		$objWorkSheet->setCellValue("E{$Row}", $value['NgaySinh']);
			    		$objWorkSheet->setCellValue("F{$Row}", (isset($value['GioiTinh'])&&$value['GioiTinh']==1)?"Nam":"Nữ");
			    		$objWorkSheet->setCellValue("G{$Row}", $value['TenLop']);
			    		$objWorkSheet->setCellValue("H{$Row}", $value['TenNganh']);
			    		$objWorkSheet->setCellValue("I{$Row}", $value['TenNienKhoa']);
			    		$objWorkSheet->setCellValue("H{$Row}", ( (isset($value['HeDaoTao'])&&$value['HeDaoTao']=='DHCQ')?"Đại Học Chính Quy":(((isset($value['HeDaoTao'])&&$value['HeDaoTao']=='DHLT')?"Đại Học Liên Thông":(((isset($value['HeDaoTao'])&&$value['HeDaoTao']=='CDCQ')?"Cao Đẳng Chính Quy":"Không xác định"))) )));
			    		$objWorkSheet->setCellValue("J{$Row}", $value['NoiSinh']);
			    		$objWorkSheet->setCellValue("K{$Row}", $value['TenXa']." - ".$value['TenHuyen']." - ".$value['TenTinh']);
			    		$objWorkSheet->setCellValue("L{$Row}", $value['DanToc']);
			    		$objWorkSheet->setCellValue("M{$Row}", $value['TonGiao']);
			    		$objWorkSheet->setCellValue("N{$Row}", $value['DoiTuong']);
			    		$objWorkSheet->setCellValue("O{$Row}", $value['NgayVaoDoan']);
			    		$objWorkSheet->setCellValue("P{$Row}", $value['NgayVaoDang']);
			    		$objWorkSheet->setCellValue("Q{$Row}", $value['CMND']);
			    		$objWorkSheet->setCellValue("R{$Row}", $value['SDT']);
			    		$STT++;
					}
		    	} else {
		    		$objWorkSheet->setCellValue('F2', "Báo Cáo Số Sinh Viên Từng Lớp");
		    		$objWorkSheet->setCellValue("A{$Row}", 'STT');
		    		$objWorkSheet->setCellValue("B{$Row}", 'Lớp')
		    		->mergeCells("B{$Row}:D{$Row}");
		    		$objWorkSheet->setCellValue("E{$Row}", 'Số Sinh Viên')
		    		->mergeCells("E{$Row}:G{$Row}");
		    		$objWorkSheet->setCellValue("H{$Row}", 'Chiếm tỉ lệ')
		    		->mergeCells("H{$Row}:J{$Row}");
		    		$objWorkSheet->getStyle("A{$Row}:J{$Row}")->applyFromArray($bold);

		    		$Lop = Lop::model()->findAll();
					foreach ($Lop as $key => $value) {
						$Row++;
						$objWorkSheet->setCellValue("A{$Row}", $STT);
						$objWorkSheet->setCellValue("B{$Row}", "{$value['TenLop']}")
			    		->mergeCells("B{$Row}:D{$Row}");
			    		$objWorkSheet->setCellValue("E{$Row}", count(HSSV::model()->findAll("MaLop=:ML", array(':ML'=>$value['MaLop']))))
			    		->mergeCells("E{$Row}:G{$Row}");
			    		$objWorkSheet->setCellValue("H{$Row}", (count(HSSV::model()->findAll()))?(" ~ ".(round(count(HSSV::model()->findAll("MaLop=:ML", array(':ML'=>$value['MaLop'])))/count(HSSV::model()->findAll())*100,2))."%"):"")
			    		->mergeCells("H{$Row}:J{$Row}");
			    		$STT++;
					}
		    	}
		    } elseif ($type==2) {
		    	$objWorkSheet->setCellValue('F2', "Báo Cáo Số Sinh Viên Từng Ngành");
	    		$objWorkSheet->setCellValue("A{$Row}", 'STT');
	    		$objWorkSheet->setCellValue("B{$Row}", 'Ngành')
	    		->mergeCells("B{$Row}:F{$Row}");
	    		$objWorkSheet->setCellValue("G{$Row}", 'Số Sinh Viên')
	    		->mergeCells("G{$Row}:H{$Row}");
	    		$objWorkSheet->setCellValue("I{$Row}", 'Chiếm tỉ lệ')
	    		->mergeCells("I{$Row}:J{$Row}");
	    		$objWorkSheet->getStyle("A{$Row}:J{$Row}")->applyFromArray($bold);

	    		$Nganh = Nganh::model()->findAll();
				foreach ($Nganh as $key => $value) {
					$Row++;
					$objWorkSheet->setCellValue("A{$Row}", $STT);
					$objWorkSheet->setCellValue("B{$Row}", "{$value['TenNganh']} ({$value['MaNganh']})")
		    		->mergeCells("B{$Row}:F{$Row}");
		    		$objWorkSheet->setCellValue("G{$Row}", count(HSSV::model()->findAll("MaNganh=:ML", array(':ML'=>$value['MaNganh']))))
		    		->mergeCells("G{$Row}:H{$Row}");
		    		$objWorkSheet->setCellValue("I{$Row}", (count(HSSV::model()->findAll()))?(" ~ ".(round(count(HSSV::model()->findAll("MaNganh=:ML", array(':ML'=>$value['MaNganh'])))/count(HSSV::model()->findAll())*100,2))."%"):"")
		    		->mergeCells("I{$Row}:J{$Row}");
		    		$STT++;
				}
		    } elseif ($type==3) {
	    		$objWorkSheet->setCellValue('F2', "Báo Cáo Thông Tin Sinh Viên");
	    		$objWorkSheet->getStyle("F2")->applyFromArray($bold);
	    		$objWorkSheet->setCellValue("A{$Row}", 'STT');
	    		$objWorkSheet->setCellValue("B{$Row}", 'MSV');
	    		$objWorkSheet->setCellValue("C{$Row}", 'Họ Tên')
	    		->mergeCells("C{$Row}:D{$Row}");
	    		$objWorkSheet->setCellValue("E{$Row}", 'Ngày Sinh');
	    		$objWorkSheet->setCellValue("F{$Row}", 'Giới Tính');
	    		$objWorkSheet->setCellValue("G{$Row}", 'Lớp');
	    		$objWorkSheet->setCellValue("H{$Row}", 'Ngành');
	    		$objWorkSheet->setCellValue("I{$Row}", 'Niên Khóa');
	    		$objWorkSheet->setCellValue("H{$Row}", 'Hệ Đào Tạo');
	    		$objWorkSheet->setCellValue("J{$Row}", 'Nơi Sinh');
	    		$objWorkSheet->setCellValue("K{$Row}", 'Hộ Khẩu Thường Trú');
	    		$objWorkSheet->setCellValue("L{$Row}", 'Dân Tộc');
	    		$objWorkSheet->setCellValue("M{$Row}", 'Tôn Giáo');
	    		$objWorkSheet->setCellValue("N{$Row}", 'Đối Tượng');
	    		$objWorkSheet->setCellValue("O{$Row}", 'Ngày Vào Đoàn');
	    		$objWorkSheet->setCellValue("P{$Row}", 'Ngày Vào Đảng');
	    		$objWorkSheet->setCellValue("Q{$Row}", 'Số CMND');
	    		$objWorkSheet->setCellValue("R{$Row}", 'SĐT');
	    		$objWorkSheet->getStyle("A{$Row}:R{$Row}")->applyFromArray($bold);

	    		$HSSV = $DB->student();
				foreach ($HSSV as $key => $value) {
					$Row++;
					$objWorkSheet->setCellValue("A{$Row}", "$STT");
		    		$objWorkSheet->setCellValue("B{$Row}", $value['MaSV']);
		    		$objWorkSheet->setCellValue("C{$Row}", $value['HoDem']." ".$value['Ten'])
		    		->mergeCells("C{$Row}:D{$Row}");
		    		$objWorkSheet->setCellValue("E{$Row}", $value['NgaySinh']);
		    		$objWorkSheet->setCellValue("F{$Row}", (isset($value['GioiTinh'])&&$value['GioiTinh']==1)?"Nam":"Nữ");
		    		$objWorkSheet->setCellValue("G{$Row}", $value['TenLop']);
		    		$objWorkSheet->setCellValue("H{$Row}", $value['TenNganh']);
		    		$objWorkSheet->setCellValue("I{$Row}", $value['TenNienKhoa']);
		    		$objWorkSheet->setCellValue("H{$Row}", ( (isset($value['HeDaoTao'])&&$value['HeDaoTao']=='DHCQ')?"Đại Học Chính Quy":(((isset($value['HeDaoTao'])&&$value['HeDaoTao']=='DHLT')?"Đại Học Liên Thông":(((isset($value['HeDaoTao'])&&$value['HeDaoTao']=='CDCQ')?"Cao Đẳng Chính Quy":"Không xác định"))) )));
		    		$objWorkSheet->setCellValue("J{$Row}", $value['NoiSinh']);
		    		$objWorkSheet->setCellValue("K{$Row}", $value['TenXa']." - ".$value['TenHuyen']." - ".$value['TenTinh']);
		    		$objWorkSheet->setCellValue("L{$Row}", $value['DanToc']);
		    		$objWorkSheet->setCellValue("M{$Row}", $value['TonGiao']);
		    		$objWorkSheet->setCellValue("N{$Row}", $value['DoiTuong']);
		    		$objWorkSheet->setCellValue("O{$Row}", $value['NgayVaoDoan']);
		    		$objWorkSheet->setCellValue("P{$Row}", $value['NgayVaoDang']);
		    		$objWorkSheet->setCellValue("Q{$Row}", $value['CMND']);
		    		$objWorkSheet->setCellValue("R{$Row}", $value['SDT']);
		    		$STT++;
		    	}
		    }

		    //Thông tin header -  tải file
		    $NF = array('1'=>'Bao_Cao_Lop', '2'=>'Bao_Cao_Nganh', '3'=>'Bao_Cao_TT_SV');
		    $NameFile = $NF[intval($type)];
		    $objPHPExcel->setActiveSheetIndex(0);
	        header('Content-Type: application/vnd.ms-excel');
			header("Content-Disposition: attachment;filename=\"{$NameFile}_".date('d_m_Y').".xls\"");
			header('Cache-Control: max-age=0');
			// If you're serving to IE 9, then the following may be needed
			header('Cache-Control: max-age=1');
			 
			// If you're serving to IE over SSL, then the following may be needed
			header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
			header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
			header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
			header ('Pragma: public'); // HTTP/1.0
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			$objWriter->save('php://output');
			Yii::app()->end();
		}
	}

	public function actionUser()
	{
		if(strpos(Yii::app()->user->role, "A")===false){
			Yii::app()->user->setFlash('error','Bạn không có quyền này!');
			$this->redirect(Yii::app()->createUrl('admin/'));
		}
		if(isset($_GET['status'])&&intval($_GET['status'])){
			$UI = intval($_GET['status']);
			$noaccept = (count(Account::model()->findByPk($UI)))?(strpos(Account::model()->findByPk($UI)['Role'], "S")!==false):true;
			if(Yii::app()->user->id==$UI||$noaccept){
				Yii::app()->user->setFlash('error','Bạn không thể thay đổi tài khoản này!');
				$this->redirect(Yii::app()->createUrl('admin/user'));
			} else {
				$UX = Account::model()->findByPk($UI);
				$UX->isActive = !$UX->isActive;
				$UX->update();
				Yii::app()->user->setFlash('success','Thay đổi trạng thái tài khoản thành công!');
				$this->redirect(Yii::app()->createUrl('admin/user'));
			}
		}
		if(isset($_GET['del'])&&intval($_GET['del'])){
			$UI = intval($_GET['del']);
			$noaccept = (count(Account::model()->findByPk($UI)))?(strpos(Account::model()->findByPk($UI)['Role'], "S")!==false):true; //Tài khoản quản trị cao nhất
			if(Yii::app()->user->id==$UI||$noaccept){
				Yii::app()->user->setFlash('error','Bạn không thể xóa tài khoản này!');
				$this->redirect(Yii::app()->createUrl('admin/user'));
			} else {
				Account::model()->deleteByPk($UI);
				Yii::app()->user->setFlash('success','Xóa thành công!');
				$this->redirect(Yii::app()->createUrl('admin/user'));
			}
		}
		if(isset($_POST['btnSetCRUD'])&&isset($_POST['forID'])&&intval($_POST['forID'])){
			$ID = intval($_POST['forID']);
			$noaccept = (count(Account::model()->findByPk($ID)))?(strpos(Account::model()->findByPk($ID)['Role'], "S")!==false):true;
			if(Yii::app()->user->id==$ID||$noaccept){
				Yii::app()->user->setFlash('error','Bạn không thể thay đổi quyền của chính mình hoặc Quản trị web!');
				$this->redirect(Yii::app()->createUrl('admin/user'));
			}
			$R  = null;
			if(isset($_POST['xA'])){
				$R .= "A";
			} 
			if(isset($_POST['xC'])){
				$R .= (empty($R)?"C":"-C");
			} 
				$R .= (empty($R)?"R":"-R");
			if (isset($_POST['xU'])) {
				$R .= (empty($R)?"U":"-U");
			} 
			if (isset($_POST['xD'])) {
				$R .= (empty($R)?"D":"-D");
			}
			$U = Account::model()->find('ID=:ID', array(':ID'=>$ID));
			if(count($U)){
				$U->Role = $R;
				$U->update();
				Yii::app()->user->setFlash('success','Thay đổi quyền thành công!');
				$this->redirect(Yii::app()->createUrl('admin/user'));
			} else {
				Yii::app()->user->setFlash('error','Có lỗi xảy ra! Người dùng này không tồn tại');
				$this->redirect(Yii::app()->createUrl('admin/user'));
			}
		}
		$this->render('user');
	}

	public function actionUserAdd()
	{
		if(strpos(Yii::app()->user->role, "A")===false){
			Yii::app()->user->setFlash('error','Bạn không có quyền này!');
			$this->redirect(Yii::app()->createUrl('admin/'));
		}
		$msg = array();
		$model = new AUForm();
		if(isset($_POST['AUForm'])){
			$model->attributes = $_POST['AUForm'];
			if($model->validate()){
				$U = new Account();
				$U->attributes = $model->attributes;
				$U->Password = md5($U->Password);
				if($U->save()){
					$msg[] = array('success'=>"Thêm người dùng thành công!");
				} else $msg[] = array('error'=>"Thêm người dùng thất bại!");
			}
		}
		$this->render('useradd', array('model' => $model, 'msg'=>$msg));
	}

	public function actionAJAX()
	{
		if(isset($_GET['GetHuyen'])){
			$result = Huyen::model()->findAll('provinceid=:id ORDER BY name COLLATE utf8_vietnamese_ci', array(':id'=>(int)$_POST['T_ID']));
			$result = CHtml::listData($result,'districtid','name');
			echo CHtml::tag('option', array('value'=>''),CHtml::encode('---Chọn Quận/Huyện---'), true);
			foreach ($result as $value => $name) {
				echo CHtml::tag('option', array('value'=>$value),CHtml::encode($name), true);
			}
		} elseif(isset($_GET['GetXa'])) {
			$result = Xa::model()->findAll('districtid=:id ORDER BY name COLLATE utf8_vietnamese_ci', array(':id'=>(int)$_POST['H_ID']));
			$result = CHtml::listData($result,'wardid','name');
			echo CHtml::tag('option', array('value'=>''),CHtml::encode('---Chọn Xã/Phường---'), true);
			foreach ($result as $value => $name) {
				echo CHtml::tag('option', array('value'=>$value),CHtml::encode($name), true);
			}
		}
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
	            'controllers'=>array('admin'), //Controller for logged
	            'users'=>array('?'),// ? == anonymous users
	        ),
	    );
	}
}