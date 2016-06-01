<?php
/* @var $this AdminController */
$this->pageTitle='Tổng Quan';
$this->pageTitle='Dashboard';
$this->breadcrumbs=array(
	'Tổng Quan',
);
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
<div class="row">
	<div class="col-sm-3">
		<a href="<?php echo Yii::app()->createUrl('admin/danhsachhoso');?>">
		<div class="tile-stats tile-green">
			<div class="icon"><i class="entypo-user"></i></div>
			<div class="num" data-start="0" data-end="<?php echo isset($data)?$data['student']:'0'; ?>" data-postfix="" data-duration="1500" data-delay="600"><?php echo isset($data)?$data['student']:'0'; ?></div>		
			<h3>Sinh Viên</h3>
			<p>Tổng số hồ sơ sinh viên.</p>
		</div>
		</a>	
	</div>
	<div class="col-sm-3">
		<a href="<?php echo Yii::app()->createUrl('admin/thongke');?>">
		<div class="tile-stats tile-aqua">
			<div class="icon"><i class="entypo-user-add"></i></div>
			<div class="num" data-start="0" data-end="<?php echo isset($data)?$data['noitru']:'0'; ?>" data-postfix="" data-duration="1500" data-delay="1200"><?php echo isset($data)?$data['noitru']:'0'; ?></div>		
			<h3>Nội Trú</h3>
			<p>Tổng số sinh viên đã ở nội trú.</p>
		</div>
		</a>
	</div>
	<div class="col-sm-3">
		<a href="<?php echo Yii::app()->createUrl('admin/thongke');?>">
		<div class="tile-stats tile-blue">
			<div class="icon"><i class="entypo-flow-tree"></i></div>
			<div class="num" data-start="0" data-end="<?php echo isset($data)?$data['ngoaitru']:'0'; ?>" data-postfix="" data-duration="1500" data-delay="1800"><?php echo isset($data)?$data['ngoaitru']:'0'; ?></div>
			<h3>Ngoại trú</h3>
			<p>Tổng số sinh viên đã ở ngoại trú.</p>
		</div>
		</a>
	</div>
	<div class="col-sm-3">
		<a href="<?php echo Yii::app()->createUrl('admin/user');?>">
		<div class="tile-stats tile-orange">
			<div class="icon"><i class="entypo-users"></i></div>
			<div class="num" data-start="0" data-end="<?php echo isset($data)?$data['user']['all']:'0'; ?>" data-postfix="" data-duration="1500" data-delay="0"><?php echo isset($data)?$data['user']['all']:"0"; ?></div>		
			<h3>Tài Khoản Người Dùng</h3>
			<p>Có <?php echo isset($data)?$data['user']['active']:"0"; ?> tài khoản được kích hoạt</p>
		</div>
		</a>		
	</div>
</div>
<br/>
<div class="row">

</div>
