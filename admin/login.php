<?php require_once('../config.php') ?>
<!DOCTYPE html>
<html lang="en" class="" style="height: auto;">
 <?php require_once('inc/header.php') ?>
<body class="hold-transition login-page">
  <script>
    start_loader()
  </script>
  <style>
      body{
          width:calc(100%);
          height:calc(100%);
          background-image: linear-gradient( rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5) ), url('<?= validate_image($_settings->info('cover')) ?>');
          background-repeat: no-repeat;
          background-size:cover;  
      }
      #logo-img{
          /* width:15em;
          height:15em; */
          object-fit:scale-down;
          object-position: center center;
      }
  </style>
<div class="login-box">
<center><img src="img/logo.gif" alt="System Logo" class="img-thumbnail rounded-circle" id="logo-img" style="height: 200px;"></center>
  <div class="clear-fix my-2"></div>
  <!-- /.login-logo -->
  <div class="card card-outline card-purple">
    <div class="card-header text-center">
      <a href="./" class="h4"><b><i class="fas fa-user-shield"></i> Панель управления администратора </b></a>
    </div>
    <div class="card-body">
     

      <form id="login-frm" action="" method="post">
        <div class="input-group mb-3">
        <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user-shield"></span>
            </div>
          </div>
          <input type="text" class="form-control" name="username" placeholder="Имя администратора ...">
          
        </div>
        <div class="input-group mb-3">
        <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user-lock"></span>
            </div>
          </div>
          <input type="password" class="form-control" name="password" placeholder="Пароль от администратора *****">
          
        </div>
        <div class="row">
          <div class="col-8">
            <a class="btn btn-info rounded-2" href="<?php echo base_url ?>"><i class="fas fa-globe-americas"></i> Перейти на сайт </a>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary rounded-2"> Войти <i class="fas fa-sign-in-alt"></i></button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <!-- /.social-auth-links -->

      <!-- <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p> -->
      
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

<script>
  $(document).ready(function(){
    end_loader();
  })
</script>
</body>
</html>