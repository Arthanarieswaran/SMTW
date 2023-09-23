

<!doctype html>
<html lang="en">

    
<head>

        <meta charset="utf-8" />
        <title><?php echo $page_title; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?php echo base_url('assets/images/SMTV_logo.png') ?>">

        <!-- Bootstrap Css -->
        <link href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
         <!-- DataTables -->
         <link href="<?php echo base_url('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') ?>" rel="stylesheet" type="text/css" />

        <!-- Responsive datatable examples -->
        <link href="<?php echo base_url('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') ?>" rel="stylesheet" type="text/css" />     

        <link href="<?php echo base_url('assets/css/icons.min.css') ?>" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="<?php echo base_url('assets/css/app.min.css') ?>" id="app-style" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/font-awesome/css/font-awesome.min.css') ?>">
        <!-- jvectormap -->
        <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/jvectormap/jquery-jvectormap.css') ?>">
        <!-- Date Picker -->
        <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') ?>">
        <!-- Daterange picker -->  
        <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/bootstrap-daterangepicker/daterangepicker.css') ?>">
        <!-- bootstrap wysihtml5 - text editor -->
        <link rel="stylesheet" href="<?php echo base_url('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') ?>">
        <!-- Select2 -->
        <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/select2/dist/css/select2.min.css') ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/plugins/fileinput/fileinput.min.css') ?>">
        <!-- JAVASCRIPT -->
        <script src="<?php echo base_url('assets/libs/jquery/jquery.min.js')?>"></script>
        <script src="<?php echo base_url('assets/libs/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
        <script src="<?php echo base_url('assets/libs/metismenu/metisMenu.min.js')?>"></script>
        <script src="<?php echo base_url('assets/libs/simplebar/simplebar.min.js')?>"></script>
        <script src="<?php echo base_url('assets/libs/node-waves/waves.min.js')?>"></script>
        <script src="<?php echo base_url('assets/libs/waypoints/lib/jquery.waypoints.min.js')?>"></script>
        <script src="<?php echo base_url('assets/libs/jquery.counterup/jquery.counterup.min.js')?>"></script>
 <!-- Required datatable js -->
 <script src="<?php echo base_url('assets/libs/datatables.net/js/jquery.dataTables.min.js')?>"></script>
        <script src="<?php echo base_url('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')?>"></script>
        <!-- Buttons examples -->
        <script src="<?php echo base_url('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js')?>"></script>
        <script src="<?php echo base_url('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')?>"></script>
        <script src="<?php echo base_url('assets/libs/jszip/jszip.min.js')?>"></script>
        <script src="<?php echo base_url('assets/libs/pdfmake/build/pdfmake.min.js')?>"></script>
        <script src="<?php echo base_url('assets/libs/pdfmake/build/vfs_fonts.js')?>"></script>
        <script src="<?php echo base_url('assets/libs/datatables.net-buttons/js/buttons.html5.min.js')?>"></script>
        <script src="<?php echo base_url('assets/libs/datatables.net-buttons/js/buttons.print.min.js')?>"></script>
        <script src="<?php echo base_url('assets/libs/datatables.net-buttons/js/buttons.colVis.min.js')?>"></script>
         <!-- Responsive examples -->
         <script src="<?php echo base_url('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')?>"></script>
        <script src="<?php echo base_url('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')?>"></script>

        <!-- Datatable init js -->
        <script src="<?php echo base_url('assets/js/pages/datatables.init.js')?>"></script>
        <script src="<?php echo base_url('assets/js/moment.min.js')?>"></script>
        <!-- jvectormap -->
  <script src="<?php echo base_url('assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') ?>"></script>
  <!-- jQuery Knob Chart -->
  <script src="<?php echo base_url('assets/bower_components/jquery-knob/dist/jquery.knob.min.js') ?>"></script>
  <!-- daterangepicker -->
  <script src="<?php echo base_url('assets/bower_components/moment/min/moment.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/bower_components/bootstrap-daterangepicker/daterangepicker.js') ?>"></script>
  <!-- datepicker -->
  <script src="<?php echo base_url('assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') ?>"></script>
  <!-- Bootstrap WYSIHTML5 -->
  <script src="<?php echo base_url('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') ?>"></script>
 
  <!-- FastClick -->
  <script src="<?php echo base_url('assets/bower_components/fastclick/lib/fastclick.js') ?>"></script>
  <!-- Select2 -->
  <script src="<?php echo base_url('assets/bower_components/select2/dist/js/select2.full.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/plugins/fileinput/fileinput.min.js') ?>"></script>
    </head>

    
    <body class="sidebar-enable vertical-collpsed">

    <!-- <body data-layout="horizontal" data-topbar="colored"> -->

        <!-- Begin page -->
        <div id="layout-wrapper">

            
            <header id="page-topbar">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box">
                            <a href="index.html" class="logo logo-dark">
                                <span class="logo-sm">
                                <img src="<?php echo base_url('assets/images/logo123.png')?>" width="50"> SMTW
                                </span>
                                <span class="logo-lg">
                                <img src="<?php echo base_url('assets/images/logo123.png')?>" width="50"> SMTW
                                </span>
                            </a>

                            <a href="index.html" class="logo logo-light">
                                <span class="logo-sm">
                                <img src="<?php echo base_url('assets/images/logo123.png')?>" width="50"> SMTW
                                </span>
                                <span class="logo-lg">
                                <img src="<?php echo base_url('assets/images/logo123.png')?>" width="50"> SMTW
                                </span>
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
                            <i class="fa fa-fw fa-bars"></i>
                        </button>

                        <!-- App Search-->
                        <!-- <form class="app-search d-none d-lg-block">
                            <div class="position-relative">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="uil-search"></span>
                            </div>
                        </form> -->
                    </div>

                    <div class="d-flex">

                    <select class="form-control" id="language" style="width: 100%;" onchange="updateLanguage()" name="language">
      <option value="tamil">தமிழ்</option>
      <option value="english">English</option>
      </select>  
      <input type="hidden" id="baseUrlId" value="<?php echo base_url('Controller_lang/create') ?>" />
      <input type="hidden" id="baseUrlIdIndex" value="<?php echo base_url('Controller_lang/index') ?>" />

                        <!-- <div class="dropdown d-inline-block language-switch">
                            <button type="button" class="btn header-item waves-effect"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="<?php echo base_url('assets/images/flags/us.jpg')?>" alt="Header Language" height="16">
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                    
                               
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <img src="<?php echo base_url('assets/images/flags/spain.jpg')?>" alt="user-image" class="mr-1" height="12"> <span class="align-middle">Spanish</span>
                                </a>

                               
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <img src="<?php echo base_url('assets/images/flags/germany.jpg')?>" alt="user-image" class="mr-1" height="12"> <span class="align-middle">German</span>
                                </a>
                            </div>
                        </div> -->
            
                    </div>
                </div>
            </header>
            <script>
      function updateLanguage(){
        var urlBase = $('#baseUrlId').val();
      var language = $('#language').val();
      $.ajax({
          url: urlBase + '/' + language,
          type: 'get',
           dataType: 'json',
           data : {language :language},
          success:function(response) {
            window.location.reload();
          }
        }); 
      }

      $(document).ready(function(){
        var urlBase = $('#baseUrlIdIndex').val();
      $.ajax({
          url: urlBase ,
          type: 'get',
           dataType: 'json',
          success:function(response) {
            if(response.length > 0){
              $('#language').val(response[0].language);
            }
          }
        }); 
      })
    </script>
