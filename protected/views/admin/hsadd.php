<?php /* @var $this AdminController */
$this->pageTitle='Nhập Hồ Sơ';
$this->breadcrumbs=array(
	'Quản Lý Hồ Sơ'=>array('/danhsachhoso'),
	'Nhập Hồ Sơ',
);
?>
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'                     => 'form_AR',
    'method'                 => 'post',
    'enableClientValidation' => true,
    'clientOptions'          => array(
							        'validateOnSubmit'       => true,
							        'validateOnChange'       => true,
							    ),
    'htmlOptions'            => array('role'  => 'form', 'class'=>'form-wizard validate')
)); ?>
	<div class="steps-progress">
		<div class="progress-indicator"></div>
	</div>
	<style>
		span.validate-has-error{
			display: none !important;
		}
	</style>
	<ul>
		<li class="active">
			<a href="#tab-TTCN" data-toggle="tab"><span>1</span>Thông Tin Sinh Viên</a>
		</li>
		<li>
			<a href="#tab-NT" data-toggle="tab"><span>2</span>Nội Trú</a>
		</li>
		<li>
			<a href="#tab-NGT" data-toggle="tab"><span>3</span>Ngoại Trú</a>
		</li>
		<li>
			<a href="#tab-BM" data-toggle="tab"><span>4</span>Thông Tin Bố Mẹ</a>
		</li>
	</ul>
	
	<div class="tab-content">
		<div class="tab-pane active" id="tab-TTCN">
			<strong>Thông Tin Sinh Viên</strong>
			<br />
			<br />
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label" >Họ Đệm</label>
						<?php echo $form->textField($model,'HoDem', array('class'=>'form-control', 'placeholder'=>'Nhập họ và tên đệm...', 'data-validate'=>'required')); ?>
						<?php echo $form->error($model,'HoDem', array('style'=>'color:red')); ?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label">Tên</label>
						<?php echo $form->textField($model,'Ten', array('class'=>'form-control', 'placeholder'=>'Nhập Tên...', 'data-validate'=>'required')); ?>
						<?php echo $form->error($model,'Ten', array('style'=>'color:red')); ?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label">Ngày Sinh</label>
						<?php echo $form->dateField($model,'NgaySinh', array('class'=>'form-control', 'placeholder'=>'Ngày Sinh', 'data-validate'=>'required')); ?>
						<?php echo $form->error($model,'NgaySinh', array('style'=>'color:red')); ?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label">Giới Tính</label>
						<br/>
						<?php echo $form->radioButtonList($model,'GioiTinh', array('1'=>'Nam', '0'=>'Nữ'),array('template'=>'<div class="radio radio-replace" style="display:inline-block">{input}{label}</div>', 'data-validate'=>'required', 'separator'=>" ")); ?>
						<?php echo $form->error($model,'GioiTinh', array('style'=>'color:red')); ?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label">Mã SV</label>
						<?php echo $form->textField($model,'MaSV', array('class'=>'form-control', 'placeholder'=>'Mã Sinh Viên', 'data-validate'=>'required')); ?>
						<?php echo $form->error($model,'MaSV', array('style'=>'color:red')); ?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label">SĐT</label>
						<?php echo $form->textField($model,'SDT', array('class'=>'form-control', 'placeholder'=>'Số điện thoại', 'data-validate'=>'required')); ?>
						<?php echo $form->error($model,'SDT', array('style'=>'color:red')); ?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
				Hộ Khẩu Thường Trú
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<?php
							$result = Tinh::model()->findAll("1 ORDER BY name COLLATE utf8_vietnamese_ci");
							$raw = array();
							foreach ($result as $key => $value) {
								$raw[$value['provinceid']] = $value['name']; 
							}
							echo $form->dropDownList($model,'T', $raw,array('class'=>'form-control', 'data-validate'=>'required', 'prompt'=>'---Chọn Tỉnh/TP---', 'ajax'=>array(
									'type'=>'POST',
									'url'=>$this->createUrl('admin/AJAX?GetHuyen'),
									'update'=>'#'.CHtml::activeId($model, 'H'),
									'data'=>array('T_ID'=>'js:this.value'),
								)));
						?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<?php echo $form->dropDownList($model,'H', array(),array('class'=>'form-control', 'prompt'=>'---Chọn Quận/Huyện---', 'data-validate'=>'required', 'ajax'=>array(
									'type'=>'POST',
									'url'=>$this->createUrl('admin/AJAX?GetXa'),
									'update'=>'#'.CHtml::activeId($model, 'HKTT'),
									'data'=>array('H_ID'=>'js:this.value'),
								))); ?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<?php echo $form->dropDownList($model,'HKTT', array(),array('class'=>'form-control', 'prompt'=>'---Chọn Xã/Phường---', 'data-validate'=>'required')); ?>
						<?php echo $form->error($model,'HKTT', array('style'=>'color:red')); ?>
					</div>
				</div>
				<script>
					$('#SForm_T').change(function (e) {
						$('#SForm_HKTT').html('<option value>---Chọn Xã/Phường---</option>')
					});
				</script>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label">Nơi Sinh</label>
						<?php echo $form->textField($model,'NoiSinh', array('class'=>'form-control', 'placeholder'=>'Nơi Sinh', 'data-validate'=>'required, minlength[6]')); ?>
						<?php echo $form->error($model,'NoiSinh', array('style'=>'color:red')); ?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label">Ngày Vào Đoàn</label>
						<?php echo $form->dateField($model,'NgayVaoDoan', array('class'=>'form-control', 'placeholder'=>'Ngày Vào Đoàn', 'data-validate'=>'required')); ?>
						<?php echo $form->error($model,'NgayVaoDoan', array('style'=>'color:red')); ?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label">Ngày Vào Đảng</label>
						<?php echo $form->dateField($model,'NgayVaoDang', array('class'=>'form-control', 'placeholder'=>'Ngày vào Đảng', 'data-validate'=>'')); ?>
						<?php echo $form->error($model,'NgayVaoDang', array('style'=>'color:red')); ?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label">Số CMND</label>
						<?php echo $form->textField($model,'CMND', array('class'=>'form-control', 'placeholder'=>'Số CMND', 'data-validate'=>'required')); ?>
						<?php echo $form->error($model,'CMND', array('style'=>'color:red')); ?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label">Ngày Cấp</label>
						<?php echo $form->dateField($model,'CMNDNgayCap', array('class'=>'form-control', 'placeholder'=>'Ngày Cấp', 'data-validate'=>'required')); ?>
						<?php echo $form->error($model,'CMNDNgayCap', array('style'=>'color:red')); ?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label">Nơi Cấp</label>
						<?php echo $form->textField($model,'CMNDNoiCap', array('class'=>'form-control', 'placeholder'=>'Nơi cấp', 'data-validate'=>'required')); ?>
						<?php echo $form->error($model,'CMNDNoiCap', array('style'=>'color:red')); ?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<label class="control-label">Lớp</label>
						<?php
							$result = Lop::model()->findAll();
							$raw = array();
							foreach ($result as $key => $value) {
								$raw[$value['MaLop']] = $value['TenLop']; 
							}
							echo $form->dropDownList($model,'MaLop', $raw, array('class'=>'form-control', 'prompt'=>'---Chọn Lớp---', 'data-validate'=>'required'));
						?>
						<?php echo $form->error($model,'MaLop', array('style'=>'color:red')); ?>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label class="control-label">Ngành</label>
						<?php
							$result = Nganh::model()->findAll();
							$raw = array();
							foreach ($result as $key => $value) {
								$raw[$value['MaNganh']] = $value['TenNganh']; 
							}
							echo $form->dropDownList($model,'MaNganh', $raw,array('class'=>'form-control', 'prompt'=>'---Chọn Ngành---', 'data-validate'=>'required'));
						?>
						<?php echo $form->error($model,'MaNganh', array('style'=>'color:red')); ?>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label class="control-label">Niên Khóa</label>
						<?php
							$result = NienKhoa::model()->findAll();
							$raw = array();
							foreach ($result as $key => $value) {
								$raw[$value['NienKhoa']] = $value['TenNienKhoa']; 
							}
							echo $form->dropDownList($model,'NienKhoa', $raw,array('class'=>'form-control', 'prompt'=>'---Chọn Niên Khóa---', 'data-validate'=>'required'));
						?>
						<?php echo $form->error($model,'NienKhoa', array('style'=>'color:red')); ?>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label class="control-label">Hệ Đào Tạo</label>
						<?php echo $form->dropDownList($model,'HeDaoTao', array('DHCQ'=>"Đại Học Chính Quy", 'DHLT'=>"Đại Học Liên Thông", 'CDCQ'=>"Cao Đẳng"), array('class'=>'form-control', 'placeholder'=>'Hệ đào tạo', 'data-validate'=>'required')); ?>
						<?php echo $form->error($model,'HeDaoTao', array('style'=>'color:red')); ?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label">Dân Tộc</label>
						<?php echo $form->textField($model,'DanToc', array('class'=>'form-control', 'placeholder'=>'Dân tộc', 'data-validate'=>'required')); ?>
						<?php echo $form->error($model,'DanToc', array('style'=>'color:red')); ?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label">Tôn Giáo</label>
						<?php echo $form->textField($model,'TonGiao', array('class'=>'form-control', 'placeholder'=>'Tôn giáo', 'data-validate'=>'required')); ?>
						<?php echo $form->error($model,'TonGiao', array('style'=>'color:red')); ?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label">Đối Tượng</label>
						<?php echo $form->textField($model,'DoiTuong', array('class'=>'form-control', 'placeholder'=>'Đối tượng', 'data-validate'=>'')); ?>
						<?php echo $form->error($model,'DoiTuong', array('style'=>'color:red')); ?>
					</div>
				</div>
			</div>
		</div>
		<div class="tab-pane" id="tab-NT">
			<strong>Thông Tin Nội Trú</strong>
			<br />
			<br />
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label">Số Thẻ</label>
						<?php echo $form->textField($model,'SoThe', array('class'=>'form-control', 'placeholder'=>'Số thẻ', 'data-validate'=>'')); ?>
						<?php echo $form->error($model,'SoThe', array('style'=>'color:red')); ?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label" >Số Phòng</label>
						<?php echo $form->textField($model,'SoPhong', array('class'=>'form-control', 'placeholder'=>'Số phòng', 'data-validate'=>'')); ?>
						<?php echo $form->error($model,'SoPhong', array('style'=>'color:red')); ?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label" >Số Nhà</label>
						<?php echo $form->textField($model,'SoNha', array('class'=>'form-control', 'placeholder'=>'Số nhà', 'data-validate'=>'')); ?>
						<?php echo $form->error($model,'SoNha', array('style'=>'color:red')); ?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label">Ngày ĐK</label>
						<?php echo $form->dateField($model,'NgayDK', array('class'=>'form-control', 'placeholder'=>'Ngày Đăng Ký', 'data-validate'=>'')); ?>
						<?php echo $form->error($model,'NgayDK', array('style'=>'color:red')); ?>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label" >Ngày KT</label>
						<?php echo $form->dateField($model,'NgayKT', array('class'=>'form-control', 'placeholder'=>'Ngày Kết Thúc', 'data-validate'=>'')); ?>
						<?php echo $form->error($model,'NgayKT', array('style'=>'color:red')); ?>
					</div>
				</div>
			</div>
		</div>
		<div class="tab-pane" id="tab-NGT">
			<strong>Thông Tin Ngoại Trú</strong>
			<br />
			<br />
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label">Địa Chỉ</label>
						<?php echo $form->textField($model,'DiaChiCuTru', array('class'=>'form-control', 'placeholder'=>'Địa chỉ nơi trọ', 'data-validate'=>'')); ?>
						<?php echo $form->error($model,'DiaChiCuTru', array('style'=>'color:red')); ?>
					</div>
				</div>
				
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label">Ngày ĐK</label>
						<?php echo $form->dateField($model,'NgayDKTro', array('class'=>'form-control', 'placeholder'=>'Ngày đăng ký', 'data-validate'=>'')); ?>
						<?php echo $form->error($model,'NgayDKTro', array('style'=>'color:red')); ?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label">Tên Chủ Trọ</label>
						<?php echo $form->textField($model,'TenChuTro', array('class'=>'form-control', 'placeholder'=>'Họ tên chủ nhà trọ', 'data-validate'=>'')); ?>
						<?php echo $form->error($model,'TenChuTro', array('style'=>'color:red')); ?>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label">SĐT Chủ Trọ</label>
						<?php echo $form->textField($model,'SDTChuTro', array('class'=>'form-control', 'placeholder'=>'Số điện thoại chủ trọ', 'data-validate'=>'')); ?>
						<?php echo $form->error($model,'SDTChuTro', array('style'=>'color:red')); ?>
					</div>
				</div>
			</div>
		</div>
		<div class="tab-pane" id="tab-BM">
			<strong>Thông Tin Bố Mẹ</strong>
			<br />
			<br />
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label">Họ Tên Bố</label>
						<?php echo $form->textField($model,'HoTenBo', array('class'=>'form-control', 'placeholder'=>'Họ và tên bố', 'data-validate'=>'')); ?>
						<?php echo $form->error($model,'HoTenBo', array('style'=>'color:red')); ?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label">Nghề Nghiệp Bố</label>
						<?php echo $form->textField($model,'NgheBo', array('class'=>'form-control', 'placeholder'=>'Nghề nghiệp bố', 'data-validate'=>'')); ?>
						<?php echo $form->error($model,'NgheBo', array('style'=>'color:red')); ?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label">SĐT Bố</label>
						<?php echo $form->textField($model,'SDTBo', array('class'=>'form-control', 'placeholder'=>'SĐT bố', 'data-validate'=>'')); ?>
						<?php echo $form->error($model,'SDTBo', array('style'=>'color:red')); ?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label">Họ Tên Mẹ</label>
						<?php echo $form->textField($model,'HoTenMe', array('class'=>'form-control', 'placeholder'=>'Họ và tên mẹ', 'data-validate'=>'')); ?>
						<?php echo $form->error($model,'HoTenMe', array('style'=>'color:red')); ?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label">Nghề Nghiệp Mẹ</label>
						<?php echo $form->textField($model,'NgheMe', array('class'=>'form-control', 'placeholder'=>'Nghề nghiệp mẹ', 'data-validate'=>'')); ?>
						<?php echo $form->error($model,'NgheMe', array('style'=>'color:red')); ?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label">SĐT Mẹ</label>
						<?php echo $form->textField($model,'SDTMe', array('class'=>'form-control', 'placeholder'=>'SĐT Mẹ', 'data-validate'=>'')); ?>
						<?php echo $form->error($model,'SDTMe', array('style'=>'color:red')); ?>
					</div>
				</div>
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary">Nhập Hồ Sơ</button>
			</div>
		</div>
		<ul class="pager wizard">
			<li class="previous">
				<a href="javascript:;"><i class="entypo-left-open"></i> Quay lại</a>
			</li>
			<li class="next">
				<a href="javascript:;">Tiếp tục <i class="entypo-right-open"></i></a>
			</li>
		</ul>
	</div>
<?php $this->endWidget(); ?><!-- Footer -->