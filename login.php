<?php require_once('./config.php') ?>
<!DOCTYPE html>
<html lang="en" class="" style="height: auto;">
 <?php require_once('inc/header.php') ?>
<body class="hold-transition login-page">
  <script>
    start_loader()
  </script>
  <style>
      body{
          /* width:calc(100%);
          height:calc(100%);
          background-image:url('<?= validate_image($_settings->info('cover')) ?>');
          background-repeat: no-repeat;
          background-size:cover; */
      }
      #logo-img{
          /* width:15em;
          height:15em; */
          object-fit:scale-down;
          object-position:center center;
      }
  </style>
<div class="login-box">
<?php $page = isset($_GET['page']) ? $_GET['page'] : 'home';  ?>
     <?php if($_settings->chk_flashdata('success')): ?>
      <script>
        alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
      </script>
    <?php endif;?>
  <!-- /.login-logo -->
  <center><img style="height: 200px;" src="<?= validate_image($_settings->info('logo')) ?>" alt="System Logo" id="logo-img"></center>
  <div class="clear-fix my-2"></div>
  <div class="card card-outline card-purple">
    <div class="card-header text-center">
      <a href="./" class="h4 text-decoration-none"><b><i class="fas fa-user-tie"></i> Панель клиентов </b></a>
    </div>
    <div class="card-body">
      

      <form id="clogin-frm" action="" method="post">
        <div class="input-group mb-3">
        <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
          <input type="email" class="form-control" name="email" placeholder=" Электронная почта ... ">
          
        </div>
        <div class="input-group mb-3">
        <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          <input type="password" class="form-control" name="password" placeholder=" Пароль ***** ">
          
        </div>
        <div class="row align-items-center">
          <div class="col-8">
            <a class="btn btn-info rounded-2" href="<?php echo base_url ?>" style="text-decoration:none;"><i class="fas fa-globe-americas"></i> Перейти на сайт </a>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary rounded-2"> Войти <i class="fas fa-sign-in-alt"></i></button>
          </div>
          <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-12 text-center p-2">
             <a class="btn btn-success rounded-2" href="<?php echo base_url.'register.php' ?>" style="text-decoration:none;"><i class="fas fa-user-plus"></i> Создать учетную запись </a>
            </div>
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