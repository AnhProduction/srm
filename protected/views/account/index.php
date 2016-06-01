<?php
/* @var $this AdminController */
$this->pageTitle='Thông Tin Cá Nhân';
$this->breadcrumbs=array(
	'Thông Tin Cá Nhân'
);
?>
<!-- <div class="row"> -->
	<div class="profile-env">
		<header class="row">
			<div class="col-sm-2">
				<a href="javascript:void(0)" class="profile-picture">
					<img src="<?php echo Yii::app()->homeUrl?>/assets/images/avatar/<?php echo isset(Yii::app()->user->avatar)?Yii::app()->user->avatar:"noavatar.jpg"; ?>" class="img-responsive img-circle" style="object-fit: cover !important;">
				</a>
				<script>
					$(window).resize(function(e){
						w = $('.profile-picture').parent().width();
						$('.profile-picture>img').width(w);
						$('.profile-picture>img').height(w);
					});
					$(document).ready(function(e){
						w = $('.profile-picture').parent().width();
						$('.profile-picture>img').width(w);
						$('.profile-picture>img').height(w);	
					})
				</script>
			</div>
			<div class="col-sm-12">
				<ul class="profile-info-sections">
					<li>
						<div class="profile-name">
							<strong>
								<?php echo Yii::app()->user->displayname; ?>
								<a href="javascript:void(0)" class="user-status is-online tooltip-primary" data-toggle="tooltip" data-placement="top" data-original-title="Online"></a>
							</strong>
							<span><?php echo Yii::app()->user->name; ?></span>
						</div>
					</li>
				</ul>
			</div>
		</header>
		<section class="profile-info-tabs">
			<div class="row">
				<div class="col-sm-offset-2 col-sm-10">
					<ul class="user-details">
						<li> <a href="javascript:void(0)"> <i class="entypo-mail"></i> Địa Chỉ Email: <?php echo Yii::app()->user->email; ?> </a> </li>
						<li> <a href="javascript:void(0)"> <i class="entypo-key"></i> Quyền: <?php echo (Yii::app()->user->role); ?> </a> </li>
						<li> <a href="javascript:void(0)"> <i class="entypo-calendar"></i> Ngày Đăng Ký: <?php echo date("d-m-Y",strtotime(Yii::app()->user->membersince)); ?></a> </li>
						<li> <a href="javascript:void(0)"> <i class="entypo-calendar"></i> Lần Đăng Nhập Cuối: <?php echo date("d-m-Y",strtotime(Yii::app()->user->lastvisited)); ?></a> </li>
					</ul> <!-- tabs for the profile links -->
					<ul class="nav nav-tabs">
						<li><a href="<?php echo Yii::app()->createUrl('account/update');?>" id="profile-edit">Cập Nhật Thông Tin</a></li>
						<li><a href="<?php echo Yii::app()->createUrl('account/changepassword');?>" id="change-password">Đổi Mật Khẩu</a></li>
					</ul>
				</div>
			</div> 
		</section>
		<section class="profile-feed" id="for-action">
		</section>
	</div>
<!-- </div> -->