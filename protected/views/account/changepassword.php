<?php
/* @var $this AccountController */
$this->pageTitle='Đổi Mật Khẩu';
$this->breadcrumbs=array(
	'Thông Tin Cá Nhân'=>array('/account'),
	'Đổi Mật Khẩu',
);
?>
<div class="row">
	<div class="col-md-12">
		<?php
			if(isset($msg)&&!empty($msg)){
				foreach ($msg as $key => $value) {
					foreach ($value as $type => $text) {
						echo "<div class='alert alert-{$type}'><strong>Msg: </strong>$text</div>";
					}
				}
			}
		?>
		<div class="panel panel-primary" data-collapsed="0">
			<div class="panel-heading">
				<div class="panel-title">
					<i class="entypo-key"></i> Đổi Mật Khẩu
				</div>
			</div>
			<div class="panel-body">
			    <?php $form=$this->beginWidget('CActiveForm', array(
			        'id'                     => 'form_changePwd',
			        'method'                 => 'post',
			        'enableClientValidation' => true,
			        'clientOptions'          => array(
											        'validateOnSubmit'       => true,
											        'validateOnChange'       => true,
											    ),
			        'htmlOptions'            => array('role'  => 'form', 'class'=>'form-horizontal form-groups-bordered')
			    )); ?>
					<div class="form-group">
						<label class="col-sm-3 control-label">Mật Khẩu Hiện Tại:</label>
						<div class="col-sm-5">
							<div class="input-group">
								<?php echo $form->passwordField($model,'currentPwd', array('class'=>'form-control', 'placeholder'=>'Nhập mật khẩu hiện tại...')); ?>
								<span class="input-group-btn">
									<button class="btn btn-default" type="button" id="hsoldpass">&nbsp;<i class="glyphicon glyphicon-eye-close"></i>&nbsp;</button>
								</span>
							</div>
							<?php echo $form->error($model,'currentPwd', array('style'=>'color:red')); ?>
						</div>
					</div>
					<div class="form-group">
						<label for="field-3" class="col-sm-3 control-label">Mật Khẩu Mới:</label>
						<div class="col-sm-5">
							<?php echo $form->passwordField($model,'newPwd', array('class'=>'form-control', 'placeholder'=>'Nhập mật khẩu mới...')); ?>
							<?php echo $form->error($model,'newPwd', array('style'=>'color:red')); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Nhập Lại Mật Khẩu:</label>
						<div class="col-sm-5">
							<div class="input-group minimal">
								<?php echo $form->passwordField($model,'confirmPwd', array('class'=>'form-control', 'placeholder'=>'Nhập lại mật khẩu mới...')); ?>
								<span class="input-group-addon"><i class="entypo-check" id="checkrepass" style="display: none; color: red"></i></span>
							</div>
							<?php echo $form->error($model,'confirmPwd', array('style'=>'color:red')); ?>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-default" name="btnCP" id="btnDMK">Đổi Mật Khẩu</button>
						</div>
					</div>
				<?php $this->endWidget(); ?>
			</div>
		</div>
	</div>
</div>
<script>
	$('#hsoldpass').click(function (e) {
		if($('#hsoldpass > i').hasClass('glyphicon-eye-open')){
			$('#hsoldpass > i').attr('class', 'glyphicon glyphicon-eye-close');
			$('#DMKForm_currentPwd').attr('type','password');
		}
		else {
			$('#hsoldpass > i').attr('class', 'glyphicon glyphicon-eye-open');
			$('#DMKForm_currentPwd').attr('type','text');
		}
	})
	$('#DMKForm_confirmPwd').keyup(function(e) {
		var pass = $('#DMKForm_newPwd').val();
		var repass = $('#DMKForm_confirmPwd').val();
		if(pass !== repass){
			$('#checkrepass').css('display', 'none');
			$(this).closest('div.form-group').addClass('has-error');
		} else {
			$('#checkrepass').css('display', 'block');
			$(this).closest('div.form-group').removeClass('has-error');
		}
	})
</script>
