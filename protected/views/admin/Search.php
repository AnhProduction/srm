<?php
/* @var $this AdminController */
$this->pageTitle='Tìm Kiếm';
$this->breadcrumbs=array(
	'Xử Lý Dữ Liệu'=>array('/admin/search'),
	'Tìm Kiếm',
);
?>
<section class="search-results-env">
	<style>
		@media print{
			@media print {
			  a[href]:after {
			    content: none !important;
			  }
			}
		}
	</style>
	<div class="row">
		<div class="col-md-12">
			<!-- Search categories tabs -->
			<ul class="nav nav-tabs right-aligned">
				<li class="tab-title pull-left">
					<?php
						if(isset($data)){
							echo "<div class=\"search-string\">Tìm thấy ".count($data)." kết quả phù hợp</strong></div>";
						}
					?>
				</li>
				
				<li class="active">
					<a href="#pages">
						Tìm Kiếm
					</a>
				</li>
			</ul>
			
			<!-- Search search form -->
			<form method="get" class="search-bar" action="">
				<div class="row">
					<div class="col-md-4">
						<input type="text" name="keyword" class="form-control" placeholder="Nhập từ khóa(Mã SV, Họ Tên)...">
					</div>
					<div class="col-md-3">
						<select name="txtLop[]" id="txtLop" class="select2" multiple data-placeholder="Tìm theo lớp...">
							<optgroup label="Lớp Học">Lớp Học</optgroup>
							<?php
								$dataLop = Lop::model()->findAll();
								foreach ($dataLop as $key => $value) {
									echo "<option value=\"{$value->MaLop}\">{$value->TenLop}</option>";
								}
							?>
						</select>
					</div>
					<div class="col-md-3">
						<select name="txtNganh[]" id="txtNganh" class="select2" multiple data-placeholder="Tìm theo ngành...">
							<optgroup label="Ngành Học">Ngành Học</optgroup>
							<?php
								$dataLNganh = Nganh::model()->findAll();
								foreach ($dataLNganh as $key => $value) {
									echo "<option value=\"{$value->MaNganh}\">{$value->TenNganh}</option>";
								}
							?>
						</select>
					</div>
					<div class="col-md-2" style="text-align: right">
						<button class="btn btn-default" style="text-align: right" name="btnSearch">Tìm Kiếm</button>
					</div>
				</div>
			</form>
			<!-- Search search form -->
			<div class="search-results-panes">
				<div class="search-results-pane active" id="pages">
					<ul class="search-results">
					<?php
						if (isset($data)&&count($data)) {
					?>
	<div id="" class="dataTables_wrapper form-inline" role="grid">
		<table class="table table-bordered table-striped datatable dataTable" id="tableResult" aria-describedby="table-2_info">
		<thead>
			<tr role="row">
				<th>STT</th>
				<th>Mã SV</th>
				<th>Họ Tên</th>
				<th>Ngày Sinh</th>
				<th>Giới Tính</th>
				<th>Lớp</th>
				<th>Ngành</th>
				<th>Khóa</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody role="alert" aria-live="polite" aria-relevant="all">
		<?php
			$i = 1;
			foreach ($data as $key => $value) {
				$value = CHtml::encodeArray($value); // Encode HTML view HTML code is TEXT
		?>
				<tr class="<?php ($i%2==0)?"odd":"even" ?>">
					<td><?php echo $i; ?></td>
					<td><?php echo $value['MaSV']; ?></td>
					<td><?php echo $value['HoDem']." ".$value['Ten']; ?></td>
					<td><?php echo $value['NgaySinh']; ?></td>
					<td><?php echo (isset($value['GioiTinh'])&&$value['GioiTinh']==1)?"Nam":"Nữ"; ?></td>
					<td><?php echo $value['TenLop']; ?></td>
					<td><?php echo $value['TenNganh']; ?></td>
					<td><?php echo $value['TenNienKhoa']; ?></td>
					<td>
						<a href="<?php echo Yii::app()->createUrl('admin/suahoso?id='.$value['SID']);?>" class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Chỉnh Sửa">
							<i class="entypo-pencil"></i>
						</a>
						<a href="<?php echo Yii::app()->createUrl('admin/XoaHS?id='.$value['SID']);?>" onclick="return confirm('Bạn có chắc muốn xóa hồ sơ này không?')" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Xóa">
							<i class="entypo-cancel"></i>
						</a>
						<a href="javascript:;" onclick="jQuery('#info-<?php echo $value['SID']; ?>').modal('show');" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Xem thông tin chi tiết">
							<i class="entypo-info"></i>
						</a>
						<?php 
							$this->footer .= "<div class=\"modal fade custom-width animated fadeInDown\" id=\"info-".$value['SID']."\">";
							$this->footer .= "<div class=\"modal-content\">";
							$this->footer .= "<div class=\"modal-header\">";
							$this->footer .= "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>";
							$this->footer .= "<h4 class=\"modal-title\">".$value['MaSV']." - ".$value['HoDem']." ".$value['Ten']."</h4>";
							$this->footer .= "</div>";
							$this->footer .= "<div class=\"modal-body\">";
							//More information
							$this->footer .= '<div class="row">
												<div class="col-md-3 col-sm-4 col-xs-6">
													<div class="form-group">
														<label class="control-label">Mã Sinh Viên</label>
														<div class="form-control input-sm">'.$value['MaSV'].'</div>
													</div>
												</div>
												<div class="col-md-3 col-sm-4 col-xs-6">
													<div class="form-group">
														<label class="control-label">Họ Tên</label>
														<div class="form-control input-sm">'.$value['HoDem'].' '.$value['Ten'].'</div>
													</div>	
												</div>
												<div class="col-md-3 col-sm-4 col-xs-6">
													<div class="form-group">
														<label class="control-label">Ngày Sinh</label>
														<div class="form-control input-sm">'.$value['MaSV'].'</div>
													</div>	
												</div>
												<div class="col-md-3 col-sm-4 col-xs-6">
													<div class="form-group">
														<label class="control-label">Giới Tính</label>
														<div class="form-control input-sm">'.((isset($value['GioiTinh'])&&$value['GioiTinh']==1)?'Nam':'Nữ').'</div>
													</div>
												</div>
												<div class="col-md-3 col-sm-4 col-xs-6">
													<div class="form-group">
														<label class="control-label">Lớp</label>
														<div class="form-control input-sm">'.$value['TenLop'].'</div>
													</div>
												</div>
												<div class="col-md-3 col-sm-4 col-xs-6">
													<div class="form-group">
														<label class="control-label">Ngành Học</label>
														<div class="form-control input-sm">'.$value['TenNganh'].'</div>
													</div>
												</div>
												<div class="col-md-3 col-sm-4 col-xs-6">
													<div class="form-group">
														<label class="control-label">Niên Khóa</label>
														<div class="form-control input-sm">'.$value['TenNienKhoa'].'</div>
													</div>
												</div>
												<div class="col-md-3 col-sm-4 col-xs-6">
													<div class="form-group">
														<label class="control-label">Hệ Đào Tạo</label>
														<div class="form-control input-sm">'.( (isset($value['HeDaoTao'])&&$value['HeDaoTao']=='DHCQ')?"Đại Học Chính Quy":(((isset($value['HeDaoTao'])&&$value['HeDaoTao']=='DHLT')?"Đại Học Liên Thông":(((isset($value['HeDaoTao'])&&$value['HeDaoTao']=='CDCQ')?"Cao Đẳng Chính Quy":"Không xác định"))) )).'</div>
													</div>
												</div>
												<div class="col-md-3 col-sm-4 col-xs-6">
													<div class="form-group">
														<label class="control-label">Nơi Sinh</label>
														<div class="form-control input-sm">'.$value['NoiSinh'].'</div>
													</div>
												</div>
												<div class="col-md-3 col-sm-4 col-xs-6">
													<div class="form-group">
														<label class="control-label">Hộ Khẩu Thường Trú</label>
														<div class="form-control input-sm">'.$value['TenXa']." - ".$value['TenHuyen']." - ".$value['TenTinh'].'</div>
													</div>
												</div>
												<div class="col-md-3 col-sm-4 col-xs-6">
													<div class="form-group">
														<label class="control-label">Dân Tộc</label>
														<div class="form-control input-sm">'.$value['DanToc'].'</div>
													</div>
												</div>
												<div class="col-md-3 col-sm-4 col-xs-6">
													<div class="form-group">
														<label class="control-label">Tôn Giáo</label>
														<div class="form-control input-sm">'.$value['TonGiao'].'</div>
													</div>
												</div>
												<div class="col-md-3 col-sm-4 col-xs-6">
													<div class="form-group">
														<label class="control-label">Ngày Vào Đoàn</label>
														<div class="form-control input-sm">'.$value['NgayVaoDoan'].'</div>
													</div>
												</div>
												<div class="col-md-3 col-sm-4 col-xs-6">
													<div class="form-group">
														<label class="control-label">Ngày Vào Đảng</label>
														<div class="form-control input-sm">'.$value['NgayVaoDang'].'</div>
													</div>
												</div>
												<div class="col-md-3 col-sm-4 col-xs-6">
													<div class="form-group">
														<label class="control-label">CMND</label>
														<div class="form-control input-sm">'.$value['CMND'].'</div>
													</div>
												</div>
												<div class="col-md-3 col-sm-4 col-xs-6">
													<div class="form-group">
														<label class="control-label">Ngày Cấp CMND</label>
														<div class="form-control input-sm">'.$value['CMNDNgayCap'].'</div>
													</div>
												</div>
												<div class="col-md-3 col-sm-4 col-xs-6">
													<div class="form-group">
														<label class="control-label">Nơi Cấp CMND</label>
														<div class="form-control input-sm">'.$value['CMNDNoiCap'].'</div>
													</div>
												</div>
												<div class="col-md-3 col-sm-4 col-xs-6">
													<div class="form-group">
														<label class="control-label">Số Điện Thoại</label>
														<div class="form-control input-sm">'.$value['SDT'].'</div>
													</div>
												</div>';
							$this->footer .= (isset($value['SoThe'])?'<div class="col-md-3 col-sm-4 col-xs-6">
													<div class="form-group">
														<label class="control-label">Số Thẻ <span class="badge">Nội trú</span></label>
														<div class="form-control input-sm">'.$value['SoThe'].'</div>
													</div>
												</div>
												<div class="col-md-3 col-sm-4 col-xs-6">
													<div class="form-group">
														<label class="control-label">Số Nhà <span class="badge">Nội trú</span></label>
														<div class="form-control input-sm">'.$value['SoNha'].'</div>
													</div>
												</div>
												<div class="col-md-3 col-sm-4 col-xs-6">
													<div class="form-group">
														<label class="control-label">Số Phòng <span class="badge">Nội trú</span></label>
														<div class="form-control input-sm">'.$value['SoPhong'].'</div>
													</div>
												</div>
												<div class="col-md-3 col-sm-4 col-xs-6">
													<div class="form-group">
														<label class="control-label">Ngày Đăng Ký <span class="badge">Nội trú</span></label>
														<div class="form-control input-sm">'.$value['NgayDK'].'</div>
													</div>
												</div>
												<div class="col-md-3 col-sm-4 col-xs-6">
													<div class="form-group">
														<label class="control-label">Ngày Kết Thúc <span class="badge">Nội trú</span></label>
														<div class="form-control input-sm">'.$value['NgayKT'].'</div>
													</div>
												</div>':"");//Noi Tru
							$this->footer .= (isset($value['DiaChiCuTru'])?'<div class="col-md-3 col-sm-4 col-xs-6">
													<div class="form-group">
														<label class="control-label">Địa Chỉ Ngoại Trú <span class="badge badge-info">Ngoại trú</span></label>
														<div class="form-control input-sm">'.$value['DiaChiCuTru'].'</div>
													</div>
												</div>
												<div class="col-md-3 col-sm-4 col-xs-6">
													<div class="form-group">
														<label class="control-label">Tên Chủ Trọ <span class="badge badge-info">Ngoại trú</span></label>
														<div class="form-control input-sm">'.$value['TenChuTro'].'</div>
													</div>
												</div>
												<div class="col-md-3 col-sm-4 col-xs-6">
													<div class="form-group">
														<label class="control-label">Số ĐT Chủ Trọ <span class="badge badge-info">Ngoại trú</span></label>
														<div class="form-control input-sm">'.$value['SDTChuTro'].'</div>
													</div>
												</div>
												<div class="col-md-3 col-sm-4 col-xs-6">
													<div class="form-group">
														<label class="control-label">Ngày Đăng Ký Trọ <span class="badge badge-info">Ngoại trú</span></label>
														<div class="form-control input-sm">'.$value['NgayDKTro'].'</div>
													</div>
												</div>':'');//Ngoai Tru
							$this->footer .= '	<div class="col-md-3 col-sm-4 col-xs-6">
													<div class="form-group">
														<label class="control-label">Họ Tên Bố</label>
														<div class="form-control input-sm">'.$value['HoTenBo'].'</div>
													</div>
												</div>
												<div class="col-md-3 col-sm-4 col-xs-6">
													<div class="form-group">
														<label class="control-label">Nghề Nghiệp Bố</label>
														<div class="form-control input-sm">'.$value['NgheBo'].'</div>
													</div>
												</div>
												<div class="col-md-3 col-sm-4 col-xs-6">
													<div class="form-group">
														<label class="control-label">Số ĐT Bố</label>
														<div class="form-control input-sm">'.$value['SDTBo'].'</div>
													</div>
												</div>
												<div class="col-md-3 col-sm-4 col-xs-6">
													<div class="form-group">
														<label class="control-label">Họ Tên Mẹ</label>
														<div class="form-control input-sm">'.$value['HoTenMe'].'</div>
													</div>
												</div>
												<div class="col-md-3 col-sm-4 col-xs-6">
													<div class="form-group">
														<label class="control-label">Nghề Nghiệp Mẹ</label>
														<div class="form-control input-sm">'.$value['NgheMe'].'</div>
													</div>
												</div>
												<div class="col-md-3 col-sm-4 col-xs-6">
													<div class="form-group">
														<label class="control-label">Số ĐT Mẹ</label>
														<div class="form-control input-sm">'.$value['SDTMe'].'</div>
													</div>
												</div>
											</div>';
							//End more information
							$this->footer .= "</div>";
							$this->footer .= "<div class=\"modal-footer\">";
							$this->footer .= "<a href=\"".Yii::app()->createUrl('admin/suahoso?id='.$value['SID'])."\" class=\"btn btn-default\"><i class=\"entypo-pencil\"></i> Sửa</a>";
							$this->footer .= "<a href=\"".Yii::app()->createUrl('admin/XoaHS?id='.$value['SID'])."\" onclick=\"return confirm('Bạn có chắc muốn xóa hồ sơ này không?')\" class=\"btn btn-danger\"><i class=\"entypo-cancel\"></i> Xóa</a>";
							$this->footer .= "<button type=\"button\" class=\"btn btn-primary\" data-dismiss=\"modal\">Đóng</button>";
							$this->footer .= "</div>";
							$this->footer .= "</div>";
							$this->footer .= "</div>";
						?>
					</td>
				</tr>
		<?php
				$i++;
			}
		?>
		</tbody>
		</table>
		<div class="row">
			<div class="col-xs-6 col-left">
				<div class="dataTables_info" id="table-2_info">
					<!-- Showing 1 to 8 of 12 entries -->
				</div>
			</div>
			<div class="col-xs-6 col-right">
				<div class="dataTables_paginate paging_bootstrap">
					<ul class="pagination pagination-sm">
						<li class="prev disabled">
							<a href="#"><i class="entypo-left-open"></i></a>
						</li>
						<li class="active"><a href="#">1</a>
						</li>
						<!-- <li><a href="#">2</a>
						</li> -->
						<li class="next">
							<a href="#"><i class="entypo-right-open"></i></a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
					<?php } ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/select2/select2.css">
<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/select2/select2.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/select2/select2_locale_vi.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/printThis.js"></script>
<script>
	
</script>