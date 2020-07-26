<?php
$title ="Admin Panel";
include 'adm_header.php';
?>

<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li><a href="index.php" class="active"><i class="fa fa-dashboard"></i>
                    <span>Dashboard</span></a></li>

            <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Today's Order</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-green"></i> <span>Customers</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Suppliers</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Admin</span></a></li>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard <small>Admin panel</small>
        </h1>

    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <?php 
              $order = $conn->prepare("SELECT * FROM t_order_user_det WHERE o_date = ?");
              $date = date('Y-m-d H:i:s');
              $order->bind_param('d', $date);
              $order->execute();
              $orderResult = $order->get_result();
              $num_order = mysqli_num_rows($orderResult);
            ?>

                        <h3><?php echo "$num_order";?></h3>
                        <p>Order for <?php echo date("D- d/M/Y"); ?></p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>

                    <?php   
          echo "<a href=\"data.php?order\" target='_blank' class='small-box-footer'>More info <i class='fa fa-arrow-circle-right'></i></a>"; 
          ?>

                </div>
            </div><!-- ./col -->

            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <?php 
              $user = $conn->prepare("SELECT * FROM t_user");
              $user->execute();
              $userResult = $user->get_result();
              $num_user = mysqli_num_rows($userResult);
            ?>
                        <h3><?php echo "$num_user";?></h3>
                        <p>Customers Registerd</p>
                    </div>

                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>

                    <?php   
            echo "<a href=\"data.php?customer\" target='_blank' class='small-box-footer'>More info <i class='fa fa-arrow-circle-right'></i></a>"; 
          ?>

                </div>
            </div><!-- ./col -->

            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <?php 
              $supp = $conn->prepare("SELECT * FROM t_supplier");
              $supp->execute();
              $suppResult = $supp->get_result();
              $num_supp = mysqli_num_rows($suppResult);
            ?>

                        <h3><?php echo "$num_supp";?></h3>
                        <p>Suppliers Registerd</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <?php   
            echo "<a href=\"data.php?supplier\" target='_blank' class='small-box-footer'>More info <i class='fa fa-arrow-circle-right'></i></a>"; 
          ?>

                </div>
            </div><!-- ./col -->

            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <?php 
              $adm = $conn->prepare("SELECT * FROM t_admin");
              $adm->execute();
              $admResult = $adm->get_result();
              $num_adm = mysqli_num_rows($admResult);
            ?>
                        <h3><?php echo "$num_adm";?></h3>

                        <p>Admin Registerd</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <?php   
            echo "<a href=\"data.php?admin\" target='_blank' class='small-box-footer'>More info <i class='fa fa-arrow-circle-right'></i></a>"; 
          ?>

                </div>
            </div><!-- ./col -->
        </div><!-- /.row -->

        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-7 connectedSortable">
                <!-- Custom Supplier-->
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Supplier Registration :: My Office</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form class="form-horizontal" method="post"
                        action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">

                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputName3" class="col-sm-2 control-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputEmail3"
                                        placeholder="Enter Supplier Name" name="name">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="inputEmail3"
                                        placeholder="Enter Email Address" name="email">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputMobile3" class="col-sm-2 control-label">Mobile</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="inputEmail3"
                                        placeholder="Enter Mobile Number" name="mob">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="inputPassword3"
                                        placeholder="Enter Password" name="pwd0">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label"> Confirm Password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="inputPassword3"
                                        placeholder="Confirm Password" name="pwd1">
                                </div>
                            </div>

                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-info " name="sup_reg">Register</button>
                            <button type="reset" class="btn btn-default pull-right">Cancel</button>
                        </div><!-- /.box-footer -->
                    </form>
                </div>

            </section><!-- /.Left col -->

            <section class="col-lg-5 connectedSortable">

                <!-- Admin registration box -->
                <div class="box box-solid bg-light-blue-gradient">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Admin Registration :: My Office</h3>
                        </div><!-- /.box-header -->
                        <!-- form start -->
                        <form class="form-horizontal" method="post"
                            action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="inputName3" class="col-sm-2 control-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputEmail3" placeholder="Name"
                                            name="adm_name">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="inputEmail3" placeholder="Email"
                                            name="adm_email">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="inputPassword3"
                                            placeholder="Password" name="adm_pwd0">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">Confirm Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="inputPassword3"
                                            placeholder="Confirm Password" name="adm_pwd1">
                                    </div>
                                </div>

                            </div><!-- /.box-body -->

                            <div class="box-footer">
                                <button type="submit" class="btn btn-info " name="adm_reg">Register</button>
                                <button type="reset" class="btn btn-default pull-right">Cancel</button>

                            </div><!-- /.box-footer -->

                        </form>

                    </div>
                </div><!-- /.box -->

            </section><!-- right col -->

        </div><!-- /.row (main row) -->

    </section><!-- /.content -->

</div><!-- /.content-wrapper -->

<?php include 'footer.php'; ?>


<!-- Supplier Registration-->

<div>

    <?php

    if(isset($_POST['sup_reg']))
    {


      //Function to sanitize placeholders received from the form. Prevents SQL injection
      function clean($str) {
        $str = @trim($str);
        $str = stripslashes($str);
        include ('../includes/connection.php');
        return mysqli_real_escape_string($conn, $str);
      }

      //Sanitize the POST placeholders
      $id        = clean($id);
      $supp_name = clean($_POST['name']);
      $supp_mail = clean($_POST['email']);
      $supp_pwd0 = clean($_POST['pwd0']);
      $supp_pwd1 = clean($_POST['pwd1']);
      $supp_mob  = clean($_POST['mob']);


      if (strcasecmp($supp_pwd0, $supp_pwd1)==0)
      {  //$supp_pwd0 = md5($supp_pwd0);

        $supp_pwd0Hash = password_hash($supp_pwd0, PASSWORD_ARGON2ID);

        if (strlen($supp_mob)==10 && password_verify($supp_pwd0, $supp_pwd0Hash))
        {

          $save_supp_data = $conn->prepare("INSERT INTO t_supplier "
          . "(a_id, s_name, s_email, s_pwd, s_mob)"
          . "VALUES (?, ?, ?, ?, ?)"
          );

          $save_supp_data->bind_param("sssss", $id, $supp_name, $supp_mail, $supp_pwd0Hash, $supp_mob);

          if($save_supp_data->execute())
          {
            $save_supp_data->close();
            $conn->close();
            ?>
    <script language="javascript">
    alert('Registration Successfull');
    location.href = "index.php";
    </script>;
    <?php 
          } else {
            $save_supp_data->close();
            $conn->close();
            ?>
    <script language="javascript">
    alert('Something Goes wrong !!!');
    location.href = "index.php";
    </script>;
    <?php 
          }
        } else {
          ?>
    <script language="javascript">
    alert('Mobile no. should be of 10 digits ');
    location.href = "index.php";
    </script>;
    <?php
        }
      } else {
        ?>
    <script language="javascript">
    alert('Confirmation Password Not Matched ');
    location.href = "index.php";
    </script>;
    <?php
      }
    }
        
  ?>

</div>

<!-- Supplier Registration Ends-->


<!-- Admin Registration-->

<div>

    <?php

  if(isset($_POST['adm_reg']))
  {
    //Function to sanitize placeholders received from the form. Prevents SQL injection
    function clean($str) {
      $str = @trim($str);
      $str = stripslashes($str);
      include ('../includes/connection.php');
      return mysqli_real_escape_string($conn, $str);
    }
                            
    $adm_name   = clean($_POST['adm_name']);
    $adm_email  = clean($_POST['adm_email']);
    $adm_pwd0   = clean($_POST['adm_pwd0']);
    $adm_pwd1   = clean($_POST['adm_pwd1']);
    $adm_loc    = clean('Location');
                          
    if(strcasecmp($adm_pwd0, $adm_pwd1)==0)
    {
      //Create query

      
      $result = $conn->prepare("SELECT * FROM t_admin WHERE a_mail= ?");
      $result->bind_param('s', $adm_email);
      $result->execute();
      $resultResult = $result->get_result();
      $num_rows = mysqli_num_rows($resultResult);
     
      if ($num_rows) 
      {
        ?>

    <script language="javascript">
    alert("<?php echo "
        User name exist!!" ?>");
    location.href = "index.php";
    </script>;

    <?php
     
      } else {

        $adm_pwd0Hash = password_hash($adm_pwd0, PASSWORD_ARGON2ID);
        
        if(password_verify($adm_pwd0, $adm_pwd0Hash)) {
          $result1 = $conn->prepare("INSERT INTO t_admin (a_name, a_mail, a_pwd, a_loc) VALUES "
                                   . "(?, ?, ?, ?)"
          );

          $result1->bind_param("ssss", $adm_name, $adm_email, $adm_pwd0Hash, $adm_loc);
         
          if($result1->execute())
          {
            $result1->close();
            $conn->close();

            echo '<script language="javascript">';
              echo 'alert("Registered"); location.href="index.php"';
            echo '</script>';
          } else {
     
            ?>

    <script language="javascript">
    alert("<?php echo mysqli_error($conn) ?>");
    location.href = "index.php";
    </script>;

    <?php
              $result1->close();
              $conn->close();
          }
        } else {
          echo '<script language="javascript">';
            echo 'alert("Password Not Verified"); location.href="index.php"';
          echo '</script>';
        }
      }
    }	 else {

      echo '<script language="javascript">';
        echo 'alert("Password Not Match"); location.href="index.php"';
      echo '</script>';
    }
            
  }
        
 ?>


</div>

<!-- Admin Registration Ends-->