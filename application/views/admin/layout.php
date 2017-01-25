<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title ?></title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="shortcut icon" href="<?php echo media_url();?>/img/dp.ico">
  <link rel="stylesheet" href="<?php echo media_url();?>/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo media_url();?>/css/jquery-ui.min.css">
  <link rel="stylesheet" href="<?php echo media_url();?>/css/jquery-ui.theme.css">
  <link rel="stylesheet" href="<?php echo media_url();?>/fonts/css/font-awesome.css">
  <link rel="stylesheet" href="<?php echo media_url();?>/css/style.css">
  <link rel="stylesheet" href="<?php echo media_url();?>/css/skin-red.css">
  <link rel="stylesheet" href="<?php echo media_url();?>/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo media_url();?>/css/dataTables.bootstrap.css">
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
<body class="hold-transition skin-red fixed sidebar-mini responsive">
  <div class="wrapper">
    <header class="main-header">
      <a href="<?php echo site_url('admin/dashboard')?>" class="logo">
      <span class="logo-lg"><b>SYSTEM AKADEMIK</b></span>
      </a>
      <nav class="navbar navbar-static-top">
         <span class="sr-only">Toggle navigation</span>
       </a>
       <div class="navbar-custom-menu">
         <ul class="nav navbar-nav">
           <a href="#" class="dropdown-toggle" data-toggle="dropdown"></a>
           <ul class="dropdown-menu">
           </ul>
           <li class="dropdown user user-menu">
             <a href="#" class="dropdown-toggle" data-toggle="dropdown">
               <?php if($this->session->userdata('user_image')) { ?>
               <img src="<?php echo upload_url().'/users/'.$this->session->userdata('user_image');?>" class="User-image" alt="User Image"><?php } else {?>
               <img src="<?php echo media_url('img/avatar.png');?>" class="user-image">
               <?php } ?>
               <span class="hidden-xs"><?php echo $this->session->userdata('user_name')?></span>
             </a>
             <ul class="dropdown-menu">
               <li class="user-header">
                 <?php if ($this->session->userdata('user_image')) { ?>
                 <img src="<?php echo upload_url().'users/'.$this->session->userdata('user_image');?>" class="img-circle">
                 <?php } else { ?>
                 <img src="<?php echo media_url() ?>/img/avatar.png" class="img-circle" alt="User Image">
                 <?php } ?>

               </li>
               <p align="center">SYSTEM AKADEMIK</p>
             </li>
             <!-- Menu Footer-->
             <li class="user-footer">
              <div class="pull-left">
                <a href="<?php echo site_url('admin/profile'); ?>" class="btn btn-danger btn-flat btn-block">Profile</a>
              </div>
              <div class="pull-right">
                <a href="<?php echo site_url('admin/Auth/logout')?>" class="btn btn-danger btn-flat">Sign out</a>
              </li>
            </ul>
            <div>
            </nav>
          </header>
          <?php $this->load->view('admin/sidebar') ?>
          <div class="content-wrapper">
           <section class="content">
             <?php isset($main) ? $this->load->view($main): null ?>
           </section>
         </div>
       </div>
       </div>
       <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <strong>Copyright &copy; 2015-2016 <a href="" class="link">Abu_Cms</a>.</strong> All rights
          reserved.
        </div>
      </footer>
      <script src="<?php echo media_url();?>/js/jquery-ui.min.js"></script>
      <script>
        $.widget.bridge('uibutton', $.ui.button);
      </script>
      <script src="<?php echo media_url();?>/bootstrap/js/bootstrap.min.js"></script>
      <script src="<?php echo media_url();?>/js/select2.js"></script>
      <script src="<?php echo media_url();?>/js/app.min.js"></script>
      <script src="<?php echo media_url();?>/js/notify.js"></script>
      <script src="<?php echo media_url();?>/js/jquery.slimscroll.min.js"></script>
      <script src="<?php echo media_url();?>/js/jquery.dataTables.min.js"></script>
      <script src="<?php echo media_url();?>/js/dataTables.bootstrap.min.js"></script>
      <script src="<?php echo media_url();?>/js/icheck.js"></script>
    <?php
      if ($this->session->flashdata('success')) { ?>
      <script type="text/javascript">
        $.notify("<?php echo $this->session->flashdata('success') ?>", "success");
      </script>
    <?php } 
      if ($this->session->flashdata('failed')) {?>
      <script type="text/javascript">
        $.notify("<?php echo $this->session->flashdata('failed') ?>","failed");
        $this->load->view('admin/notification_failed', $data);
  <?php }
      ?>
      </script>
      <script>
             //Initiation dataTable
             $(function () {
              $('.dataTable_init').DataTable({
                "aaSorting": [],
                "oLanguage": {
                  "sSearch": "Pencarian :"
                },
                "aoColumnDefs": [
                {
                  'bSortable': false,
                  'aTargets': [-1]
                } //disables sorting for last column
                ],
                "sPaginationType": "full_numbers",
                                          });
            });
             $(function () {
              $(".datepicker").datepicker({
                changeMonth: true,
                changeYear: true,
                yearRange: '-55:+10',
                dateFormat: "yy-mm-dd",
              });
            });
          </script>
          <script type="text/javascript">
          $(document).ready(function(){
               //Initialize Select2 Elements
               $(".select2").select2();
             });
             </script>
          </body>
        </html>
