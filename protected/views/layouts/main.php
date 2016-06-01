<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/jquery-1.11.0.min.js"></script> <!-- Thêm trên đầu -> Tránh lỗi yiiactiveform -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Admin Panel" />
    <meta name="author" content="Team AHKTQNV" />
    
    <title><?php echo CHtml::encode($this->pageTitle); ?> | Student Management</title>
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/font-icons/entypo/css/entypo.css">
    <!-- <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic"> -->
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/neon-core.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/neon-theme.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/neon-forms.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/custom.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/animate.css">
    <!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="page-body skin-white page-fade">
    <div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
        <div class="sidebar-menu">
            <header class="logo-env">
                <!-- logo -->
                <div class="logo">
                    <a href="<?php echo Yii::app()->createUrl('admin/');?>">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/assets/images/logo@2x.png" width="120" alt="" />
                    </a>
                </div>
                <!-- logo collapse icon -->
                <div class="sidebar-collapse">
                    <a href="#" class="sidebar-collapse-icon with-animation"><!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
                        <i class="entypo-menu"></i>
                    </a>
                </div>
                <!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
                <div class="sidebar-mobile-menu visible-xs">
                    <a href="#" class="with-animation"><!-- add class "with-animation" to support animation -->
                        <i class="entypo-menu"></i>
                    </a>
                </div>
            </header>
                
                <?php $this->widget('zii.widgets.CMenu', array(
                    'encodeLabel'=>false,
                    'items'=>array(
                        array('label'=>'<i class="entypo-gauge"></i> <span>Tổng Quan</span>', 'url'=>array('admin/dashboard')),
                        array('label'=>'<i class="entypo-archive"></i> <span>Quản Lý Hồ Sơ</span>', 'url'=>'javascript:void(0)', 'items'=>array(
                            array('label'=>'<i class="entypo-list"></i> <span>Danh Sách Hồ Sơ</span>', 'url'=>array('admin/danhsachhoso')),
                            array('label'=>'<i class="entypo-list-add"></i> <span>Nhập Hồ Sơ</span>', 'url'=>array('admin/nhaphoso')),
                            array('label'=>'<i class="entypo-pencil"></i> <span>Sửa Hồ Sơ</span>', 'url'=>array('admin/suahoso')),
                        )),
                        array('label'=>'<i class="entypo-flash"></i> <span>Xử Lý Dữ Liệu</span>', 'url'=>'javascript:void(0)', 'items'=>array(
                            array('label'=>'<i class="entypo-search"></i> <span>Tìm Kiếm</span>', 'url'=>array('admin/search')),
                        )),
                        array('label'=>'<i class="entypo-chart-line"></i> <span>Thống Kê - Báo Cáo</span>', 'url'=>'javascript:void(0)', 'items'=>array(
                            array('label'=>'<i class="entypo-chart-bar"></i> <span>Thống Kê</span>', 'url'=>array('admin/thongke')),
                            array('label'=>'<i class="entypo-export"></i> <span>Báo Cáo</span>', 'url'=>array('admin/baocao')),
                        )),
                        array('label'=>'<i class="entypo-users"></i> <span>Quản Lý Người Dùng</span>', 'url'=>'javascript:void(0)', 'items'=>array(
                            array('label'=>'<i class="entypo-list"></i> <span>Danh Sách Người Dùng</span>', 'url'=>array('admin/user')),
                            array('label'=>'<i class="entypo-list-add"></i> <span>Thêm Người Dùng</span>', 'url'=>array('admin/useradd')),
                        ), 'visible'=>((!Yii::app()->user->isGuest))),
                        array('label'=>'<i class="entypo-user"></i> <span>Thông Tin Cá Nhân</span>', 'url'=>'javascript:void(0)', 'items'=>array(
                            array('label'=>'<i class="entypo-info"></i> <span>Xem Thông Tin</span>', 'url'=>array('/account/info')),
                            array('label'=>'<i class="entypo-feather"></i> <span>Cập Nhật Thông Tin</span>', 'url'=>array('account/update')),
                            array('label'=>'<i class="entypo-key"></i> <span>Đổi Mật Khẩu</span>', 'url'=>array('account/changepassword')),
                        ), 'visible'=>(!Yii::app()->user->isGuest)),
                        array('label'=>'<i class="entypo-logout"></i> <span>Đăng Xuất</span>', 'url'=>array('authentication/logout'), 'visible'=>!Yii::app()->user->isGuest),
                    ),
                    'htmlOptions'=>array('id'=>'main-menu')
                )); ?>

        </div>
<div class="main-content">
    <div class="row">
        <!-- Profile Info and Notifications -->
        <div class="col-md-6 col-sm-8 clearfix">
            <ul class="user-info pull-left pull-none-xsm">
                <!-- Profile Info -->
                <li class="profile-info dropdown"><!-- add class "pull-right" if you want to place this from right -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/assets/images/avatar/<?php echo isset(Yii::app()->user->avatar)?Yii::app()->user->avatar:"noavatar.jpg"; ?>" alt="" class="img-circle img-avatar" width="44" height="44" style="object-fit: cover;"/>
                        <?php echo isset(Yii::app()->user->displayname)?Yii::app()->user->displayname:"Guest"; ?>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="caret"></li>
                        <li>
                            <a href="<?php echo Yii::app()->createUrl('account/update');?>">
                                <i class="entypo-user"></i> Edit Profile
                            </a>
                        </li>
                        <li>
                            <a href="#"><i class="entypo-calendar"></i> Member Since: <?php echo isset(Yii::app()->user->membersince)?date("d-m-Y",strtotime(Yii::app()->user->membersince)):"--/--/---"; ?></a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- Raw Links -->
        <div class="col-md-6 col-sm-4 clearfix hidden-xs">
            <ul class="list-inline links-list pull-right">
                <li>
                    <a href="<?php echo Yii::app()->createUrl('authentication/logout');?>">
                        Đăng Xuất <i class="entypo-logout right"></i>
                    </a>
                </li>
            </ul>
        </div>
        
    </div>
    <hr/>
    <?php if(isset($this->breadcrumbs)):?>
        <?php $this->widget('zii.widgets.CBreadcrumbs', array(
            'links'=>$this->breadcrumbs,
            'htmlOptions'=>array('class'=>'breadcrumb'),
            'tagName'=>'ol',
            'homeLink'=>'<li><a href="'.Yii::app()->homeUrl.'"><i class="entypo-folder"></i> Home</a></li>',
            'activeLinkTemplate'=>'<li><a href="{url}">{label}</a></li>',
            'inactiveLinkTemplate'=>'<li class="active">{label}</li>',
            'separator'=>' '
        )); ?><!-- breadcrumbs -->
    <?php endif?>
    <!-- <div class="main-content"> -->
        <?php echo $content; ?>
    <!-- </div> -->
    <!-- Footer -->
    <footer class="main">   
        &copy; <?=date('Y');?> - <strong><?php echo Yii::app()->name;?></strong> - Make with <i class="entypo-heart" style="color: red"></i> by <a href="https://www.facebook.com/messages/conversation-461339704070305">Team ATQKNV</a>
    </footer>
</div>
    <?php echo (isset($this->footer)?($this->footer):""); ?>
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/jvectormap/jquery-jvectormap-1.2.2.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/rickshaw/rickshaw.min.css">
    <!-- Bottom Scripts -->
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/gsap/main-gsap.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/bootstrap.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/joinable.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/resizeable.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/neon-api.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/jquery.bootstrap.wizard.min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/bootstrap-switch.min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/jquery.validate.min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/jquery.sparkline.min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/rickshaw/vendor/d3.v3.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/rickshaw/rickshaw.min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/raphael-min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/morris.min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/toastr.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/neon-custom.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/neon-demo.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/fileinput.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/icheck/icheck.min.js"></script>
    <?php if(Yii::app()->user->hasFlash('WelcomeBack')):?>
        <script>
            toastr.info('Welcome back <b style="color:#BDBDBD"><?php echo Yii::app()->user->displayname;?></b>!<br/>How are you?');
        </script>
    <?php endif; ?>
    <script type="text/javascript">
        $(window).ready(function(){
            $("li.root-level li.active").closest("li.root-level").addClass('opened')
            $("li.root-level li.active").closest("li.root-level ul").addClass('visible');
            show_loading_bar(100);
        });
    </script>
</body>
</html>