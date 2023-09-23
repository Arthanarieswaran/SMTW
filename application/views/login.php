<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sri Murugan Traders</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="icon" href="<?php echo base_url('assets/images/logo.jpeg')?>" type="image/gif" sizes="16x16">
  <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css')?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/AdminLTE.min.css')?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/iCheck/square/blue.css')?>">

 
</head>
<body class="hold-transition login-page" style="background:url(<?php echo base_url('assets/images/bg.jpg')?>);background-repeat: no-repeat; background-size: cover;height:500px !important;">
<div class="login-box text-center">
  
   

  <!-- /.login-logo -->
  <div class="login-box-body" style="background: #f7f7f7 !important;">
  <img src="<?php echo base_url('assets/images/logo.jpeg')?>" width="150" alt="">
    <p class="login-box-msg">Sign in to start your session</p>

    <form action="<?php echo base_url('auth/login') ?>" method="post">
      <div class="form-group has-feedback">
        <input type="email" class="form-control" name="email" id="email" placeholder="Email" autocomplete="off">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password" id="password" placeholder="Password" autocomplete="off">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

<div class="row">
<h6>Developed By Tamilzorous <img src="<?php echo base_url('assets/images/TZ logo.svg')?>" width="30" alt=""></h6>
</div>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url('assets/plugins/jQuery/jquery-2.2.3.min.js')?>"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
<!-- iCheck -->
<script src="<?php echo base_url('assets/plugins/iCheck/icheck.min.js')?>"></script>
<input type="hidden" id="baseUrlId" value="<?php echo base_url('Controller_lang/create') ?>" />

<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
    
    $(document).ready(function(){
      var urlBase = $('#baseUrlId').val();
      var language = 'tamil';
      $.ajax({
          url: urlBase + '/' + language,
          type: 'post',
           dataType: 'json',
           data : {language :language},
          success:function(response) {

          }
        }); 
    })
 
</script>
</body>
</html>
