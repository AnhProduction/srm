<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Admin Panel" />
  <meta name="author" content="" />
  <title><?php echo CHtml::encode($this->pageTitle); ?></title>
  <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
  <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/font-icons/entypo/css/entypo.css">
  <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
  <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/bootstrap.css">
  <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/neon-core.css">
  <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/neon-theme.css">
  <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/neon-forms.css">

  <!--[if lt IE 9]><script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<body class="page-body">
<?php echo $content; ?>
</body>
</html>