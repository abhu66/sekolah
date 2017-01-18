<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title;?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo media_url();?>/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="<?php echo media_url();?>/css/style.css">
  <link rel="stylesheet" href="<?php echo media_url();?>/fonts/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo media_url();?>/css/_all-skins.css">
  <link rel="stylesheet" href="<?php echo media_url();?>/css/jquery-ui.min.css">
  <link rel="stylesheet" href="<?php echo media_url();?>/css/jquery-ui.theme.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <script type="text/javascript">
    window.jQuery || document.write("<script src='<?php echo media_url();?>/js/jquery-2.2.3.min.js'>"+"<"+"/script>");
  </script>
  <script type="text/javascript">
    var BASEURL = '<?php echo base_url() ?>';
  </script>
</head>
<body class="hold-transition skin-red fixed sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>MSTR</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>SEKOLAH MASTER</span>
    </a>
    <!-- Hea der Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo media_url('image/abhu.jpg');?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $this->session->userdata('user_name');?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo media_url('image/abhu.jpg');?>" class="img-circle" alt="User Image">

                <p>
                  <?php echo $this->session->userdata('user_name');?>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo site_url('admin/auth/logout');?>" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->
  <?php $this->load->view('admin/sidebar');?>

  
  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
       
        <?php isset($main)? $this->load->view($main) : null ?>
    </section>
    <!-- /.content -->
  </div>
</div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.3.7
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="#">Khoerulabu</a>.</strong> All rights
    reserved.
  </footer>

<script src="<?php echo media_url();?>/js/jquery-2.2.3.min.js"></script>
<script src="<?php echo media_url();?>/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo media_url();?>/js/app.min.js"></script>
<script src="<?php echo media_url();?>/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo media_url();?>/js/jquery.slimscroll.min.js"></script>
</body>
</body>
</html>
