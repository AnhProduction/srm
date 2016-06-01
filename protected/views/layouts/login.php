<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Admin Panel" />
  <meta name="author" content="" />
  <title>Đăng Nhập Hệ Thống</title>
  <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
  <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/font-icons/entypo/css/entypo.css">
  <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
  <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/bootstrap.css">
  <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/neon-core.css">
  <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/neon-theme.css">
  <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/neon-forms.css">
  <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/custom.css">
  <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/jquery.validate.min.js"></script>
  <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/neon-login.js"></script>

  <!--[if lt IE 9]><script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<body class="page-body login-page login-form-fall" data-url="">
<!-- This is needed when you send requests via Ajax -->
  <script type="text/javascript">
    var baseurl = '';
  </script>
  <div class="login-container">
    <div class="login-header login-caret">
      <div class="login-content">
        <a href="index.html" class="logo">
          <img src="<?php echo Yii::app()->request->baseUrl; ?>/assets/images/logo@2x.png" width="120" alt="" />
        </a>
        <p class="description">Đăng nhập vào hệ thống!</p>
        <!-- progress bar indicator -->
        <div class="login-progressbar-indicator">
          <h3>43%</h3>
          <span>logging in...</span>
        </div>
      </div>
    </div>
    <div class="login-progressbar">
      <div></div>
    </div>
    <?php echo $content;?>
  </div>
  <!-- Bottom Scripts -->
  <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/toastr.js"></script>
    <?php if(Yii::app()->user->hasFlash('Installed')){?>
        <script>
            toastr.info("<?php echo Yii::app()->user->getFlash('Installed');?>");
        </script>
    <?php } ?>
</body>
</html>