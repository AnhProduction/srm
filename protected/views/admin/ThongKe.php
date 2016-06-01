<?php
/* @var $this AdminController */
$this->pageTitle='Thống Kê';
$this->breadcrumbs=array(
	'Thống Kê - Báo Cáo'=>array('/admin/thongke'),
	'Thống Kê',
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
	<div class="col-md-4">
		<div class="panel panel-default" data-collapsed="0"><!-- to apply shadow add class "panel-shadow" -->
			<!-- panel head -->
			<div class="panel-heading">
				<div class="panel-title">Nội trú - Ngoại trú</div>
				<div class="panel-options">
					<!-- <a href="<?php echo Yii::app()->createUrl('admin/baocao?type=3');?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Xuất Báo Cáo"><i class="entypo-export"></i></a> -->
					<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
				</div>
			</div>
			<!-- panel body -->
			<div class="panel-body">
				<p>Thống kê tình trạng nội trú - ngoại trú sinh viên</p>
				<hr>
				<div class="row">
					<button class="btn col-md-4" style="background-color: #F89145 !important; color: #FFF;">Nội Trú: <?php echo count(Noitru::model()->findAll());?></button> 
					<button class="btn  col-md-4" style="background-color: #167AC6 !important; color: #FFF;">Ngoại Trú: <?php echo count(Ngoaitru::model()->findAll());?></button>
					<button class="btn  col-md-4">Tổng số: <?php echo count(HSSV::model()->findAll());?></button>
				</div>
				<hr>
				<div class="text-center">
					<span class="pie-large"><canvas width="150" height="150" style="display: inline-block; vertical-align: top; width: 150px; height: 150px;"></canvas></span>
				</div>
			</div>
		</div>
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="panel-title">Sinh Viên Các Lớp</div>
				<div class="panel-options">
					<a href="<?php echo Yii::app()->createUrl('admin/baocao?type=1');?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Xuất Báo Cáo"><i class="entypo-export"></i></a>
					<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
				</div>
			</div>
			<div class="panel-body with-table">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th width="70%">Tên Lớp</th>
							<th>Số Sinh Viên</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$Lop = Lop::model()->findAll();
						foreach ($Lop as $key => $value) {
					?>
						<tr>
							<td><?php echo "<strong>".$value['TenLop']."</strong>";?></td>						
							<td>
								<a class="badge badge-info badge-roundless" href="<?php echo Yii::app()->createUrl('admin/baocao?type=1&name='.$value['MaLop']);?>"><?php echo count(HSSV::model()->findAll("MaLop=:ML", array(':ML'=>$value['MaLop'])));?></a>
								<?php 
								 	if(count(HSSV::model()->findAll())) echo " ~ ".(round(count(HSSV::model()->findAll("MaLop=:ML", array(':ML'=>$value['MaLop'])))/count(HSSV::model()->findAll())*100,2))."%";
								?>
							</td>
						</tr>
					<?php
						}
					?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="col-md-8">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="panel-title">Sinh Viên Các Ngành</div>
				<div class="panel-options">
					<a href="<?php echo Yii::app()->createUrl('admin/baocao?type=2');?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Xuất Báo Cáo"><i class="entypo-export"></i></a>
					<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
				</div>
			</div>
			<div class="panel-body with-table">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th width="70%">Tên Ngành</th>
							<th>Số Sinh Viên</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$Nganh = Nganh::model()->findAll();
						foreach ($Nganh as $key => $value) {
					?>
						<tr>
							<td><?php echo $value['TenNganh']." (<strong>".$value['MaNganh']."</strong>)";?></td>						
							<td>
								<span class="badge badge-info badge-roundless"><?php echo count(HSSV::model()->findAll("MaNganh=:MN", array(':MN'=>$value['MaNganh'])));?></span>
								<?php 
								 	if(count(HSSV::model()->findAll())) echo " ~ ".(round(count(HSSV::model()->findAll("MaNganh=:MN", array(':MN'=>$value['MaNganh'])))/count(HSSV::model()->findAll())*100,2))."%";
								?>
							</td>
						</tr>
					<?php
						}
					?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function(e) {
		$(".pie-large").sparkline([<?php echo count(Noitru::model()->findAll());?>, <?php echo count(Ngoaitru::model()->findAll());?>], {
			type: 'pie',
			width: '240px',
			height: '240px',
			borderWidth: 2,
    		borderColor: '#dddddd',
			sliceColors: ['#F89145', '#167AC6']
			
		});
	})
</script>