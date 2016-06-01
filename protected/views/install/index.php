<?php
/* @var $this InstallController */

$this->breadcrumbs=array(
	'Install',
);
?>
<br/>
<div class="container">
	<div class="panel panel-primary" data-collapsed="0">
		<div class="panel-heading">
			<div class="panel-title">
				<i class="entypo-install"></i> Cài Đặt Chương Trình <strong><?php echo Yii::app()->name;?></strong>
			</div>
		</div>
		<div class="panel-body">
			<?php
				if(isset($msg)&&!empty($msg)){
					foreach ($msg as $key => $value) {
						foreach ($value as $type => $text) {
							echo "<div class='alert alert-{$type}'><strong>Thông báo: </strong>{$text}</div>";
						}
					}
				}
			?>
			<?php $form=$this->beginWidget('CActiveForm', array(
		        'id'                     => 'form_Install',
		        'method'                 => 'post',
		        'enableClientValidation' => true,
		        'clientOptions'          => array(
										        'validateOnSubmit'       => true,
										        'validateOnChange'       => true,
										    ),
		        'htmlOptions'            => array('role'  => 'form', 'class'=>'')
		    )); ?>
	   		<div class="tabs-vertical-env">
				<ul class="nav tabs-vertical parent"><!-- available classes "right-aligned" -->
					<li class="active" id="step1"><a href="javascript:;" ><i class="entypo-cog"></i> Kiểm tra cấu hình</a></li>
					<li id="step2"><a href="javascript:;" ><i class="entypo-link"></i> Thiết lập kết nối Database</a></li>
					<li id="step3"><a href="javascript:;" ><i class="entypo-user-add"></i> Tạo Tài Khoản Admin</a></li>
					<li id="step4"><a href="javascript:;" ><i class="entypo-tools"></i> Cài Đặt</a></li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="v-step1">
						<ul class="list-group">
							<li class="list-group-item">
								<h4><i class="entypo-cog"></i> Kiểm tra cấu hình</h4>
							</li>
							<li class="list-group-item">
								<strong>Yêu cầu: </strong>File <code>protected/data/srm.sql</code> là <code>được phép đọc.</code>
								<?php echo (is_readable(Yii::app()->basePath."/data/srm.sql")?("<span class=\"badge badge-success\"><i class=\"entypo-check\"></i></span>"):("<span class=\"badge badge-danger\"><i class=\"entypo-cancel\"></i></span>"));?>
							</li>
							<li class="list-group-item">
								<strong>Yêu cầu: </strong>File <code>protected/config/database.php</code> là <code>được phép ghi.</code>
								<?php echo (is_writable(Yii::app()->basePath."/config/database.php")?("<span class=\"badge badge-success\"><i class=\"entypo-check\"></i></span>"):("<span class=\"badge badge-danger\"><i class=\"entypo-cancel\"></i></span>"));?>
							</li>
							<li class="list-group-item">
								<a href="javascript:;" id="to-step2">Tiếp Tục <i class="entypo-right-open"></i></a>
							</li>
						</ul>		
					</div>
					<div class="tab-pane" id="v-step2">
						<ul class="list-group">
							<li class="list-group-item">
								<h4><i class="entypo-link"></i> Thiết lập kết nối Database</h4>
							</li>
							<li class="list-group-item">
								<label><strong>Host Name</strong></label>
								<?php echo $form->textField($model,'HostName', array('class'=>'form-control', 'placeholder'=>'Nhập Host Name (VD: localhost)')); ?>
								<?php echo $form->error($model,'HostName', array('style'=>'color:red')); ?>
							</li>
							<li class="list-group-item">
								<label><strong>Username</strong></label>
								<?php echo $form->textField($model,'UsernameDB', array('class'=>'form-control', 'placeholder'=>'Nhập Username (VD: root)')); ?>
								<?php echo $form->error($model,'UsernameDB', array('style'=>'color:red')); ?>
							</li>
							<li class="list-group-item">
								<label><strong>Password</strong></label>
								<?php echo $form->passwordField($model,'PasswordDB', array('class'=>'form-control', 'placeholder'=>'Nhập Password (VD: root)', 'autocomplete'=>'false')); ?>
								<?php echo $form->error($model,'PasswordDB', array('style'=>'color:red')); ?>
							</li>
							<li class="list-group-item">
								<label><strong>Database Name(<i>Tên cơ sở dữ liệu đã được tạo</i>)</strong></label>
								<?php echo $form->textField($model,'Database', array('class'=>'form-control', 'placeholder'=>'Nhập Database (VD: SRM)')); ?>
								<?php echo $form->error($model,'Database', array('style'=>'color:red')); ?>
							</li>
							<li class="list-group-item">
								<a href="javascript:;" id="back-step1"><i class="entypo-left-open"></i> Quay Lại</a> |
								<a href="javascript:;" id="to-step3">Tiếp Tục <i class="entypo-right-open"></i></a>
							</li>
						</ul>
					</div>
					<div class="tab-pane" id="v-step3">
						<ul class="list-group">
							<li class="list-group-item">
								<h4><i class="entypo-user-add"></i> Tạo Tài Khoản Admin</a></h4>
							</li>
							<li class="list-group-item">
								<label><strong>Username</strong></label>
								<?php echo $form->textField($model,'Username', array('class'=>'form-control', 'placeholder'=>'Nhập Username (VD: admin)')); ?>
								<?php echo $form->error($model,'Username', array('style'=>'color:red')); ?>
							</li>
							<li class="list-group-item">
								<label><strong>Email</strong></label>
								<?php echo $form->textField($model,'Email', array('class'=>'form-control', 'placeholder'=>'Nhập Email...')); ?>
								<?php echo $form->error($model,'Email', array('style'=>'color:red')); ?>
							</li>
							<li class="list-group-item">
								<label><strong>Mật Khẩu</strong></label>
								<?php echo $form->passwordField($model,'Password', array('class'=>'form-control', 'placeholder'=>'Nhập Password...', 'autocomplete'=>'false')); ?>
								<?php echo $form->error($model,'Password', array('style'=>'color:red')); ?>
							</li>
							<li class="list-group-item">
								<label><strong>Mật Khẩu Để Cài Đặt Lại Chương Trình</strong></label>
								<?php echo $form->passwordField($model,'PasswordReInstall', array('class'=>'form-control', 'placeholder'=>'Nhập Password...', 'autocomplete'=>'false')); ?>
								<?php echo $form->error($model,'PasswordReInstall', array('style'=>'color:red')); ?>
							</li>
							<li class="list-group-item">
								<a href="javascript:;" id="back-step2"><i class="entypo-left-open"></i> Quay Lại</a> |
								<a href="javascript:;" id="to-step4">Tiếp Tục <i class="entypo-right-open"></i></a>
							</li>
						</ul>
					</div>
					<div class="tab-pane" id="v-step4">
						<ul class="list-group">
							<li class="list-group-item">
								<h4><i class="entypo-tools"></i> Cài Đặt</a></h4>
							</li>
							<li class="list-group-item">
								<strong>Yêu cầu: Vui lòng chắc chắc rằng thông tin vừa nhập là chính xác.</strong><br/>
								<i>Nếu không <b>Bắt Đầu Cài Đặt</b> được vui lòng quay lại kiểm tra thông tin đã điền đầy đủ chưa!</i>
							</li>
							<li class="list-group-item">
								<a href="javascript:;" id="back-step3"><i class="entypo-left-open"></i> Quay Lại</a> |
								<button class="btn btn-primary" type="submit">Bắt Đầu Cài Đặt  <i class="entypo-install"></i></button>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<?php $this->endWidget(); ?>
		</div>
	</div>
</div>
<script>
	$('#back-step1').click(function(e) {
		$(".nav.tabs-vertical.parent > li").removeClass('active');
		$('.tab-pane').removeClass('active');
		$('#step1').addClass('active');
		$('#v-step1').addClass('active');
	})
	$('#to-step2').click(function(e) {
		$(".nav.tabs-vertical.parent > li").removeClass('active');
		$('.tab-pane').removeClass('active');
		$('#step2').addClass('active');
		$('#v-step2').addClass('active');
	})
	$('#back-step2').click(function(e) {
		$(".nav.tabs-vertical.parent > li").removeClass('active');
		$('.tab-pane').removeClass('active');
		$('#step2').addClass('active');
		$('#v-step2').addClass('active');
	})
	$('#to-step3').click(function(e) {
		$(".nav.tabs-vertical.parent > li").removeClass('active');
		$('.tab-pane').removeClass('active');
		$('#step3').addClass('active');
		$('#v-step3').addClass('active');
	})
	$('#back-step3').click(function(e) {
		$(".nav.tabs-vertical.parent > li").removeClass('active');
		$('.tab-pane').removeClass('active');
		$('#step3').addClass('active');
		$('#v-step3').addClass('active');
	})
	$('#to-step4').click(function(e) {
		$(".nav.tabs-vertical.parent > li").removeClass('active');
		$('.tab-pane').removeClass('active');
		$('#step4').addClass('active');
		$('#v-step4').addClass('active');
	})
</script>