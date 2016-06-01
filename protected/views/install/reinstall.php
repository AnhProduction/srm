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
				<i class="entypo-install"></i> Cài Đặt Lại Chương Trình <strong><?php echo Yii::app()->name;?></strong>
			</div>
		</div>
		<div class="panel-body" style="text-align: center">
		<?php
			if(isset($msg)&&!empty($msg)){
				foreach ($msg as $key => $value) {
					foreach ($value as $type => $text) {
						echo "<div class='alert alert-{$type}'><strong>Thông báo: </strong>{$text}</div>";
					}
				}
			}
		?>
			<strong><h3>Cài đặt lại chương trình mọi dữ liệu sẽ bị xóa?</h3></strong>
			<br/>
			<br/>
			<form method="post">
				<input type="password" placeholder="Nhập Mật Khẩu Để Cài Đặt Lại" class="form-control" name="Pwd"><br/>
				<button name="btnReInstall" class="btn btn-danger" onclick="return confirm('Bạn muốn tiếp tục???')">Reinstall</button>
				<a href="<?php echo Yii::app()->baseUrl;?>" class="btn btn-info">Quay Lại</a>
			</form>
		</div>
	</div>
</div>