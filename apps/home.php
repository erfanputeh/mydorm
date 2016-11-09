<?php
session_start();
date_default_timezone_set('Asia/Bangkok');
require_once('../libs/Db.php'); //ติดต่อฐานข้อมูล
if(!empty($_SESSION['user'])){

?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminDormitory</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../assets/bootstrap/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../assets/bootstrap/plugins/datatables/dataTables.bootstrap.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="../assets/bootstrap/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../assets/bootstrap/dist/css/AdminLTE.min.css">

  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../assets/bootstrap/dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>

  <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">

    <!-- Logo -->
    <a href="home.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <!-- <span class="logo-mini"><b>หอพัก</b></span> -->
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>หอพัก ม.อ.ปัตตานี</b></span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

          <li class="dropdown user user-menu">

            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="../images/admin/<?=$_SESSION['user']['picture']?>" class="user-image" alt="User Image">
              <span class="col-md-4"><b><h5><?=$_SESSION['user']['name'];?>&nbsp;<?=$_SESSION['user']['surname'];?></h5></b></span>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-chevron-down "></i>
            </a>

            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="../images/admin/<?=$_SESSION['user']['picture']?>" class="img-circle" alt="User Image">

                <p>
                  erfan puteh - Web Developer
                  <small>Member since Nov. 2016-2017</small>
                </p>
              </li>
              <!-- Menu Body -->

              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">โปรไฟล์</a>
                </div>
                <div class="pull-right">
                  <a href="logout.php" class="btn btn-default btn-flat" >ออกจากระบบ</a>
                </div>
              </li>
            </ul>
          </li>

          <!-- Control Sidebar Toggle Button -->
        </ul>
      </div>

    </nav>
  </header>
  <!--ส่วนซ้ายด้านบนสุด-->
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../images/admin/<?=$_SESSION['user']['picture']?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><h5><?=$_SESSION['user']['name']?>&nbsp;<?=$_SESSION['user']['surname'];?></h5></p>
          <a><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <br>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">

        <li class="header">เมนู</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-pencil-square-o"></i>
            <span><b>การจองหอพัก</b></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="home.php?file=booking/index"><i class="fa fa-circle-o"></i> ดูรายการจองหอพัก</a></li>
            <!-- <li><a href="home.php?file=booking/del"><i class="fa fa-circle-o"></i> Booking Success</a></li> -->
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-user"></i>
            <span><b>ข้อมูลสมาชิก</b></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="home.php?file=member/index"><i class="fa fa-circle-o"></i> ดูข้อมูลสมาชิก</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-building-o"></i> <span><b>ข้อมูลหอพัก</b></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="home.php?file=dorm/index"><i class="fa fa-circle-o"></i>ดูข้อมูลหอพัก</a></li>
            <li><a href="home.php?file=dorm/add"><i class="fa fa-circle-o"></i>เพิ่มข้อมูลหอพัก</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-university"></i> <span><b>ข้อมูลชั้น</b></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="home.php?file=floor/index"><i class="fa fa-circle-o"></i> ดูข้อมูลชั้น</a></li>
            <li><a href="home.php?file=floor/add"><i class="fa fa-circle-o"></i> ดูข้อมูลชั้น</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-bed"></i> <span><b>ข้อมูลห้องพัก</b></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="home.php?file=room/index"><i class="fa fa-circle-o"></i> ดูข้อมูลห้องพัก</a></li>
            <li><a href="home.php?file=room/add"><i class="fa fa-circle-o"></i> เพิ่มข้อมูลห้องพัก</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-shopping-cart"></i> <span><b>ข้อมูลการชำระเงิน</b></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="home.php?file=payment/index"><i class="fa fa-circle-o"></i> รายการชำระเงิน</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-gavel"></i> <span><b>ข้อมูลอุปกรณ์</b></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="home.php?file=material/index"><i class="fa fa-circle-o"></i> ดูข้อมูลอุปกรณ์</a></li>
            <li><a href="home.php?file=material/add"><i class="fa fa-circle-o"></i> เพิ่มข้อมูลอุปกรณ์</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-cogs"></i> <span><b>ข้อมูลการแจ้งซ่อม</b></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="home.php?file=repair/index"><i class="fa fa-circle-o"></i> รายการแจ้งซ่อม</a></li>
            <li><a href="home.php?file=repair/index_check_repair"><i class="fa fa-circle-o"></i> เช็คการแจ้งซ่อม</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i> <span><b>ข้อมูลกิจกรรม</b></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="home.php?file=activity/index"><i class="fa fa-circle-o"></i> ดูข้อมูลกิจกรรม</a></li>
            <li><a href="home.php?file=activity/add"><i class="fa fa-circle-o"></i> เพิ่มข้อมูลกิจกรรม</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-laptop"></i> <span><b>ข้อมูลสวัสดิการ</b></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="home.php?file=benefits/index"><i class="fa fa-circle-o"></i> ดูข้อมูลสวัสดิการ</a></li>
            <li><a href="home.php?file=benefits/add"><i class="fa fa-circle-o"></i> เพิ่มข้อมูลสวัสดิการ</a></li>
          </ul>
        </li>

        <li class="header"><b>การแจ้งเตือน</b></li>
        <li><a href="home.php?file=notifications/index"><i class="fa fa-bell-o"></i><b>การแจ้งเตือนชำระเงิน</b></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <!--ส่วนหัวตรงกลางข้างบน-->

    <section class="content-header">
      <!-- <h1>
        <b>หอพักนักศึกษา ม.อ.ปัตตานี</b>
      </h1> -->
      <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dorm</li>
      </ol> -->
      <br>
    </section>

    <!-- ส่วนหัวตรงกลาง -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <?php
          if(isset($_GET['file'])){
           $app_file = $_GET['file'].'.php';
            if(is_file($app_file)){
              include_once($app_file);
            }else{
              echo 'ไม่พบเนื้อหา 404';
            }
          }else {
            include_once('slide.php');
          }

          ?>

          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.3.6
    </div>
    <strong>Copyright &copy; 2016-2017 <a>erfan puteh</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->



    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">


        <!-- /.control-sidebar-menu -->

        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">

              </h4>


            </a>
          </li>

          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
              </h4>
            </a>
          </li>

          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
              </h4>
            </a>
          </li>

          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
              </h4>
            </a>
          </li>

        </ul>

        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->

      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
            </label>
            <p>
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
            </label>
            <p>
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
            </label>
            <p>
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>

<!--///////////// -->


  </aside>
  <div class="control-sidebar-bg"></div>
</div>

<!-- jQuery 2.2.3 -->
<script src="../assets/bootstrap/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../assets/bootstrap/bootstrap/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="../assets/bootstrap/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../assets/bootstrap/dist/js/app.min.js"></script>
<!-- Sparkline -->
<script src="../assets/bootstrap/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="../assets/bootstrap/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="../assets/bootstrap/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="../assets/bootstrap/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS 1.0.1 -->
<script src="../assets/bootstrap/plugins/chartjs/Chart.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../assets/bootstrap/dist/js/pages/dashboard2.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../assets/bootstrap/dist/js/demo.js"></script>
<!-- DataTables -->
<script src="../assets/bootstrap/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../assets/bootstrap/plugins/datatables/dataTables.bootstrap.min.js"></script>


<!-- page script -->
<script>
  $(function () {
    $("#Datatable1").DataTable();
    $('#Datatable2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>


<script>
var myIndex = 0;
carousel();

function carousel() {
    var i;
    var x = document.getElementsByClassName("mySlides");
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";
    }
    myIndex++;
    if (myIndex > x.length) {myIndex = 1}
    x[myIndex-1].style.display = "block";
    setTimeout(carousel, 4000);
}
</script>


</body>
</html>

<?php
 } else{
   header('location: ../index.php');
}?>
