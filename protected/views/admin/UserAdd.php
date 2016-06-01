<?php
/* @var $this AccountController */
$this->pageTitle='Thêm Người Dùng';
$this->breadcrumbs=array(
	'Quản Lý Người Dùng'=>array('/admin/user'),
	'Thêm Người Dùng',
);
?>
<div class="row">
	<div class="col-md-12">
		<?php
			if(isset($msg)&&!empty($msg)){
				foreach ($msg as $key => $value) {
					foreach ($value as $type => $text) {
						echo "<div class='alert alert-{$type}'><strong>Thông báo: </strong>$text</div>";
					}
				}
			}
		?>
		<div class="panel panel-primary" data-collapsed="0">
			<div class="panel-heading">
				<div class="panel-title">
					<i class="entypo-user-add"></i> Thêm Người Dùng
				</div>
			</div>
			<div class="panel-body">
			    <?php $form=$this->beginWidget('CActiveForm', array(
			        'id'                     => 'form_AddUser',
			        'method'                 => 'post',
			        'enableClientValidation' => true,
			        'clientOptions'          => array(
											        'validateOnSubmit'       => true,
											        'validateOnChange'       => true,
											    ),
			        'htmlOptions'            => array('role'  => 'form', 'class'=>'form-horizontal form-groups-bordered')
			    )); ?>
					<div class="form-group">
						<label class="col-sm-3 control-label">Username:</label>
						<div class="col-sm-5">
							<?php echo $form->textField($model,'Username', array('class'=>'form-control', 'placeholder'=>'Nhập tên tài khoản...')); ?>
							<?php echo $form->error($model,'Username', array('style'=>'color:red')); ?>
						</div>
					</div>
					<div class="form-group">
						<label for="field-3" class="col-sm-3 control-label">Địa Chỉ Email:</label>
						<div class="col-sm-5">
							<?php echo $form->emailField($model,'Email', array('class'=>'form-control', 'placeholder'=>'Nhập địa chỉ email...')); ?>
							<?php echo $form->error($model,'Email', array('style'=>'color:red')); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Tên Hiển Thị:</label>
						<div class="col-sm-5">
							<?php echo $form->textField($model,'DisplayName', array('class'=>'form-control', 'placeholder'=>'Nhập tên hiển thị...')); ?>
							<?php echo $form->error($model,'DisplayName', array('style'=>'color:red')); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Mật Khẩu:</label>
						<div class="col-sm-5">
							<div class="input-group">
								<?php echo $form->passwordField($model,'Password', array('class'=>'form-control', 'placeholder'=>'Nhập mật khẩu...')); ?>
								<span class="input-group-btn">
									<button class="btn btn-default" type="button" id="hspass">&nbsp;<i class="glyphicon glyphicon-eye-close"></i>&nbsp;</button>
								</span>
							</div>
							<?php echo $form->error($model,'Password', array('style'=>'color:red')); ?>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-default" name="btnAdd" id="btnAdd">Thêm Người Dùng</button>
						</div>
					</div>
				<?php $this->endWidget(); ?>
			</div>
		</div>
	</div>
</div>
<script>
	$('#hspass').click(function (e) {
		if($('#hspass > i').hasClass('glyphicon-eye-open')){
			$('#hspass > i').attr('class', 'glyphicon glyphicon-eye-close');
			$('#<?php echo CHtml::activeId($model, 'Password')?>').attr('type','password');
		}
		else {
			$('#hspass > i').attr('class', 'glyphicon glyphicon-eye-open');
			$('#<?php echo CHtml::activeId($model, 'Password')?>').attr('type','text');
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
