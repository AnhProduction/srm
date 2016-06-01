<?php
/* @var $this AdminController */
$this->pageTitle='Báo Cáo';
$this->breadcrumbs=array(
	'Thống Kê - Báo Cáo'=>array('admin/thongke'),
	'Báo Cáo',
);
?>
<?php
	if(isset($data)){
?>
<div class="panel panel-primary">
	<div class="panel-heading">
		<div class="panel-title"><i class="entypo-export"></i> Tải xuống báo cáo Excel</div>
	</div>
	<div class="panel-body">
		<strong>File báo cáo đang được tải xuống...</strong>
		<br/>
		<br/>
		<div style="text-align:center">
		Thời gian còn lại<br/>
		<strong id="ShowTime" style="font-size: 50px;">5s</strong>
		</div>
		<br/>
		<br/>
		<div class="">
			<div class="progress progress-striped active">
				<div class="progress-bar progress-bar-danger" id="progressbar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
				</div>
			</div>
		<script>
		var x = 0;
		a = setInterval(function(e){
			x++;
			if(x==500) {
				clearInterval(a);
				window.location = "export?<?php echo base64_encode('type='.$data['type'].'&name='.$data['name'].'&end');?>";
				$("<br/>Nếu file không tự động tải xuống <a href=\"export?<?php echo base64_encode('type='.$data['type'].'&name='.$data['name'].'&end');?>\">click vào đây</a>.").insertAfter("#ShowTime");
			}
			$('#ShowTime').html(Math.round((500-x)/100)+'s');
			$('#ShowTime').css('color','rgb('+x%255+','+x%125+','+x%100+')');
			$('#progressbar').width((x/5)+'%');
		}, 10);
		</script>
		</div>
	</div>
</div>
<?php
	} else {		
?>
<div class="panel panel-primary">
	<div class="panel-heading">
		<div class="panel-title"><i class="entypo-export"></i> Tạo Báo Cáo TT Tất Cả Sinh Viên</div>
	</div>
	<div class="panel-body">
		<br/>
		<div style="text-align:center">
		<a href="<?php echo Yii::app()->createUrl('admin/baocao?type=3');?>" class="btn btn-lg btn-info"><i class="entypo-export"></i> Export</a>
		</div>
		<br/>
	</div>
</div>
<?php
	}
?>