<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
?>
<div class="login-form">
  <style type="text/css">
  .form-login-error > .errorMessage:nth-child(2) > h3{
    display: none;
  }
  .form-login-error > .errorMessage:not(only-child) ~ .errorMessage:nth-child(2) > h3{
    display: block;
  }
  </style>
  <div class="login-content">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'form_login',
        'method'=>'post',
        'enableClientValidation'=>true,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
            'validateOnChange'=>true,
        ),
        'htmlOptions'=>array('role'=>'form')
    )); ?>
      <div class="form-login-error" style="display: block; height: auto;">
          <?php echo $form->error($model,'username', array('style'=>'')); ?>
          <?php echo $form->error($model,'password', array('style'=>'')); ?>
      </div>
      <div class="form-group">
        <div class="input-group">
          <div class="input-group-addon">
            <i class="entypo-user"></i>
          </div>
          <?php echo $form->textField($model,'username', array('class'=>'form-control', 'placeholder'=>'Username')); ?>
        </div>
      </div>
      <div class="form-group">
        <div class="input-group">
          <div class="input-group-addon">
            <i class="entypo-key"></i>
          </div>
          <?php echo $form->passwordField($model,'password', array('class'=>'form-control', 'placeholder'=>'Password')); ?>
        </div>
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-primary btn-block btn-login">
          <i class="entypo-login"></i>
          Login In
        </button>
      </div>    
    <?php $this->endWidget(); ?>
    <div class="login-bottom-links">
      <!-- <a href="#" class="link">Forgot your password?</a>
      <br/> -->
      <?=date("Y")?>  - <?=Yii::app()->name;?>
    </div>
  </div>
</div>