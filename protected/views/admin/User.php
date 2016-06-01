<?php
/* @var $this AdminController */
$this->pageTitle='Danh Sách Tài Khoản';
$this->breadcrumbs=array(
	'Tài Khoản'=>array('/user'),
	'Danh Sách Tài Khoản',
);
$this->footer  = '
				<style>
				/*Checkbox Style*/
				input[type=checkbox]   { display:none; }
				#Checkbox-Material label, p               { padding-left:20px; }
				#Checkbox-Material 	   { position: relative; margin: 5px auto;}
				#Checkbox-Material strong				   { color: red; }
				#Checkbox-Material label                  { cursor:pointer; font-weight: normal !important;}
				#Checkbox-Material label span             { display:block; position:absolute; left:0; 
				  -webkit-transition-duration:0.3s; -moz-transition-duration:0.3s; transition-duration:0.3s;
				}
				label .box     {
				  border:2px solid #000;
				  height:20px; 
				  width:20px;
				  z-index:888;
				  -webkit-transition-delay:0.2s; -moz-transition-delay:0.2s; transition-delay:0.2s;
				}
				label .check         {
				  top: -7px;
				  left: 6px;
				  width: 12px;
				  height: 24px;
				  border:2px solid #0f9d58;  
				  border-top: none;
				  border-left: none;
				  opacity:0; 
				  z-index:888;
				  -webkit-transform:rotate(180deg); -moz-transform:rotate(180deg); transform:rotate(180deg);
				  -webkit-transition-delay:0.3s; -moz-transition-delay:0.3s; transition-delay:0.3s;
				}
				input[type=checkbox]:checked ~ label .box { 
				  opacity:0;
				  -webkit-transform   :scale(0) rotate(-180deg);
				  -moz-transform 	  :scale(0) rotate(-180deg);
				  transform 		  :scale(0) rotate(-180deg);
				}
				input[type=checkbox]:checked ~ label .check {
				  opacity:1; 
				  -webkit-transform   :scale(1) rotate(45deg);
				  -moz-transform      :scale(1) rotate(45deg);
				  transform           :scale(1) rotate(45deg);
				}
				</style>';
$this->footer .= '<div class="modal fade" id="modalSetPermission">
					<div class="modal-dialog">
						<div class="modal-content">
							<form class="form-horizontal" role="form" method="post">
							<input type="hidden" name="forID" id="forID">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title">Phân Quyền Người Dùng</h4>
							</div>
							
							<div class="modal-body">
					            <div class="col-sm-12">
							        <div class="form-group">
							        	<label class="control-label">Quyền:</label>
						        		<div class="form-group col-sm-12" id="Checkbox-Material">    
										  <input type="checkbox" id="xA" name="xA">
										  <label for="xA">
										    <span class="check"></span>
										    <span class="box"></span>
										    <strong>A</strong>dminisrator (<i>Có thể phân quyền người dùng</i>)
										  </label>
										</div>
										<div class="form-group col-sm-3" id="Checkbox-Material">    
										  <input type="checkbox" id="xC" name="xC">
										  <label for="xC">
										    <span class="check"></span>
										    <span class="box"></span>
										    <strong>C</strong>reate
										  </label>
										</div>
										<div class="form-group col-sm-3" id="Checkbox-Material">    
										  <input type="checkbox" id="xR" disabled checked>
										  <label for="xR">
										    <span class="check"></span>
										    <span class="box"></span>
										    <strong>R</strong>ead
										  </label>
										</div>
										<div class="form-group col-sm-3" id="Checkbox-Material">    
										  <input type="checkbox" id="xU" name="xU">
										  <label for="xU">
										    <span class="check"></span>
										    <span class="box"></span>
										    <strong>U</strong>pdate
										  </label>
										</div>
										<div class="form-group col-sm-3" id="Checkbox-Material">    
										  <input type="checkbox" id="xD" name="xD">
										  <label for="xD">
										    <span class="check"></span>
										    <span class="box"></span>
										    <strong>D</strong>elete
										  </label>
										</div>
									</div>
								</div>
							</div>
							
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
								<button type="submit" class="btn btn-info" name="btnSetCRUD">Thay Đổi</button>
							</div>
							</form>
						</div>
					</div>
				</div>';
?>
<?php if(Yii::app()->user->hasFlash('success')){ ?>
        <div class="alert alert-success"><strong>Thông báo: </strong><?php echo Yii::app()->user->getFlash('success');?></div>
        <script>
        	setTimeout(function(){ $('.alert').fadeOut(500); }, 5000);
        </script>
    <?php } ?>
    <?php if(Yii::app()->user->hasFlash('error')){ ?>
        <div class="alert alert-warning"><strong>Lỗi: </strong><?php echo Yii::app()->user->getFlash('error');?></div>
        <script>
        	setTimeout(function(){ $('.alert').fadeOut(500); }, 5000);
        </script>
    <?php } ?>
<?php 
		$data = Account::model()->findAll("ID<>:ID", array(':ID'=>Yii::app()->user->id));
		foreach ($data as $key => $value) {
?>
			<div class="member-entry" style="margin:5px auto;">
				<a href="javascript:;" class="member-img" style="overflow: hidden;">
					<img src="<?php echo Yii::app()->homeUrl;?>/assets/images/avatar/<?php echo !empty($value['Avatar'])?$value['Avatar']:"noavatar.jpg"; ?>" class="img-rounded" style="width: 100%; height: 100%; object-fit: cover;">
					<i class="entypo-forward"></i>
				</a>
				<div class="member-details">
					<h4>
						<a href="javascript:;"><?php echo $value['DisplayName']; ?></a>
					</h4>
					<!-- Details with Icons -->	
					<div class="row info-list">
						
						<div class="col-sm-4">
							<i class="entypo-user"></i>
							<?php echo $value['Username']; ?>
						</div>
						
						<div class="col-sm-4">
							<i class="entypo-mail"></i>
							<a href="mailto:<?php echo $value['Email']; ?>"><?php echo $value['Email']; ?></a>
						</div>
						
						<div class="col-sm-4">
							<i class="entypo-info-circled"></i>
							<a href="?status=<?php echo $value['ID'];?>"><?php echo ($value['isActive'])?"Actived":"Not Actived"; ?></a>
						</div>
						
						<div class="clear"></div>
						
						<div class="col-sm-4">
							<i class="entypo-key"></i>
							<?php echo $value['Role']; ?>
						</div>
						
						<div class="col-sm-4">
							<i class="entypo-cog"></i>
							<a href="javascript:;" class="SetPermission" data-id="<?php echo $value['ID']; ?>" data-role="<?php echo $value['Role']; ?>">Phân Quyền</a>
						</div>
						<div class="col-sm-4">
							<i class="entypo-trash"></i>
							<a href="?del=<?php echo $value['ID'];?>" onclick="return confirm('Bạn có chắc muốn xóa tài khoản này không?')">Xóa</a>
						</div>
					</div>
				</div>
			</div>
<?php
		}
?>
<script type="text/javascript">
	ID = null;
	$(".SetPermission").click(function(e) {
		$('#Checkbox-Material > input[type=checkbox]').prop('checked',false);
		$('#xR').prop('checked', true);
		ID = $(this).attr('data-id');
		Role = $(this).attr('data-role').split('-');
		$.each(Role, function(i, val){
			$('#x' + val).prop('checked', true);
		});
		$("#forID").val(ID);
		$("#modalSetPermission").modal();
	});
	$(document).ready(function(e){
		$('.member-img').height($('.member-img').width());
	});
	$(window).resize(function(e){
		$('.member-img').height($('.member-img').width());
	});
</script>