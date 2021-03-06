<?php 
 session_start();
    include ('../includes/connection.php');
  
  if(!isset($_SESSION['SUPP_SESS_MEMBER_ID']) || (trim($_SESSION['SUPP_SESS_MEMBER_ID']) == '')) 
      {
        echo '<script language="javascript">';
        echo 'alert("Not Authorised"); location.href="../Supp_login.php"';
        echo '</script>';
      } 
     $id = $_SESSION['SUPP_SESS_MEMBER_ID'];
     $supp_name= $_SESSION['SUPP_SESS_MEMBER_NAME']  ;
    $supp_email =$_SESSION['SUPP_SESS_MEMBER_EMAIL']; 
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo "$title :: My Office";?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../Admin/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../Admin/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../Admin/dist/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../Admin/plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="../Admin/plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="../Admin/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="../Admin/plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../Admin/plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="../Admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="index.php" class="logo">
          
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>My &nbsp;</b>Office</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="../Admin/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?php echo"$supp_name"; ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="../Admin/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                    <p>
                      <?php echo"$id"; ?>
                      <small><?php echo"$supp_email"; ?></small>
                    </p>
                  </li>
                  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                        <?php echo "<a href=\"supp_profile.php?supp_id=$id\"class='btn btn-default btn-flat'>Profile</a>";                        ?>
                    </div>
                    <div class="pull-right">
                        <a href="signout.php" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
              
            </ul>
          </div>
        </nav>
      </header>
        
          <!-- Left side column. contains the logo and sidebar --> 
        <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->

          <!-- sidebar menu: : style can be found in sidebar.less -->
<?php           
        echo"<ul class='sidebar-menu'>";
            
            echo"<li><a href='index.php'><i class='fa fa-dashboard'></i><span>Dashboard</span></a></li>";
            echo"<li><a href=\"data.php?order\" target='_blank'><i class='fa fa-circle-o text-red'></i> <span>Today's Order</span></a></li>";
            echo"<li><a href=\"data.php?product\" target='_blank'><i class='fa fa-circle-o text-yellow'></i> <span>Product Status</span></a></li>";
            echo"<li><a href=\"#\" target='_blank'><i class='fa fa-circle-o text-aqua'></i> <span>Information</span></a></li>";
        echo"</ul>";
?>
        </section>
        <!-- /.sidebar -->
      </aside>
