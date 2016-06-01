<?php
/* @var $this AccountController */
$this->pageTitle='Cập Nhật Thông Tin';
$this->breadcrumbs=array(
	'Thông Tin Cá Nhân'=>array('/account'),
	'Cập Nhật Thông Tin',
);
?>
<div class="row">
	<style>
		img.img-avt{
			object-fit: cover;
			width: 200px;
			height: 200px;
			cursor: pointer;
			border: 5px solid #f5f5f5;
			transition: all .3s;
		}
		img.img-avt:hover{
			opacity: .7;
			transform: scale(.95);
		}
		.hover-avt{
			display: none;
		}
		img.img-avt:hover ~ .hover-avt{
			display: block;
		}
	</style>
	<div class="col-md-12">
		<?php
			if(isset($msg)&&!empty($msg)){
				foreach ($msg as $key => $value) {
					foreach ($value as $type => $text) {
						echo "<div class='alert alert-{$type}'><strong>Thông báo: </strong>{$text}</div>";
					}
				}
			}
		?>
		<div class="panel panel-primary" data-collapsed="0">
			<div class="panel-heading">
				<div class="panel-title">
					<i class="entypo-feather"></i> Chỉnh Sửa Thông Tin Cá Nhân
				</div>
			</div>
			<div class="panel-body">
				<?php $form=$this->beginWidget('CActiveForm', array(
			        'id'                     => 'form_changeInfo',
			        'method'                 => 'post',
			        'enableClientValidation' => true,
			        'clientOptions'          => array(
											        'validateOnSubmit'       => true,
											        'validateOnChange'       => true,
											    ),
			        'htmlOptions'            => array('role'  => 'form', 'class'=>'form-horizontal form-groups-bordered', 'enctype'=>'multipart/form-data')
			    )); ?>
					<div class="form-group" style="margin-top: -15px; background-color: #0F334B;"> <!-- Avatar -->
						<center>
							<img src="<?php echo Yii::app()->homeUrl?>/assets/images/avatar/<?php echo isset(Yii::app()->user->avatar)?Yii::app()->user->avatar:"noavatar.jpg"; ?>" class="img-responsive img-circle img-avt" id="avatar-src">
							<span class="hover-avt"><i class="entypo-camera" style="font-size: 30px;"></i> Click để chọn AVATAR</span>
							<?php echo $form->fileField($model,'avatar', array('class'=>'hidden', 'accept'=>'image/*')); ?>
							<div id="remove_avt" class="hidden">
								<br/>
								<button type="button" id="btn_remove_avt" class="btn btn-red btn-icon icon-left btn-xs">
									Xóa ảnh<i class="entypo-cancel"></i>
								</button>
							</div>
							<?php echo $form->error($model,'avatar', array('style'=>'color:red')); ?>
							<script>
					            w = $('.img-avatar').width();
					            h = $('.img-avatar').height();
								var urlAvt = "<?php echo Yii::app()->homeUrl?>/assets/images/avatar/<?php echo isset(Yii::app()->user->avatar)?Yii::app()->user->avatar:"noavatar.jpg"; ?>";
								$('#avatar-src').click(function(event) {
									$("#ChangeInfoForm_avatar").trigger('click');
									$("#ChangeInfoForm_avatar").change(function(e) {
										var input = e.target;
										var reader = new FileReader();
										reader.onload = function(){
										  var dataURL = reader.result;
										  var output = document.getElementById('avatar-src');
										  output.src = dataURL;
										  $('#remove_avt').removeClass('hidden');
										};
										reader.readAsDataURL(input.files[0]);
									});
								  });
								$('#btn_remove_avt').click(function(e) {
									$('#ChangeInfoForm_avatar').replaceWith($('#ChangeInfoForm_avatar').clone());
									$('#avatar-src').attr('src', urlAvt);
									$('#remove_avt').addClass('hidden');
								})
							</script>
						</center>
					</div> <!-- End Avatar -->
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label">Tên Hiển Thị:</label>
						<div class="col-sm-5">
							<?php echo $form->textField($model,'newName', array('class'=>'form-control', 'placeholder'=>'Nhập tên hiển thị...', 'value'=>Yii::app()->user->displayname)); ?>
							<?php echo $form->error($model,'newName', array('style'=>'color:red')); ?>
						</div>
					</div>
					<div class="form-group">
						<label for="field-3" class="col-sm-3 control-label">Email:</label>
						<div class="col-sm-5">
							<?php echo $form->emailField($model,'newEmail', array('class'=>'form-control', 'placeholder'=>'Nhập địa chỉ email...', 'value'=>Yii::app()->user->email)); ?>
							<?php echo $form->error($model,'newEmail', array('style'=>'color:red')); ?>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-default">Cập Nhật</button>
						</div>
					</div>
				<?php $this->endWidget(); ?>
			</div>
		</div>
	</div>
</div>