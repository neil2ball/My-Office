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
              $order = $conn->prepare("SELECT * FROM t_order_user_det");
              $order->execute();
              $orderResult = $order->get_result();
              $num_order = mysqli_num_rows($orderResult);
            ?>

                        <h3><?php echo "$num_order";?></h3>
                        <p>Orders</p>
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
              $user = $conn->prepare("SELECT * FROM t_product");
              $user->execute();
              $userResult = $user->get_result();
              $num_user = mysqli_num_rows($userResult);
            ?>
                        <h3><?php echo "$num_user";?></h3>
                        <p>Products</p>
                    </div>

                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>

                    <?php   
            echo "<a href=\"data.php?product\" target='_blank' class='small-box-footer'>More info <i class='fa fa-arrow-circle-right'></i></a>"; 
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
                        <p>Students</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <?php   
            echo "<a href=\"data.php?student\" target='_blank' class='small-box-footer'>More info <i class='fa fa-arrow-circle-right'></i></a>"; 
          ?>

                </div>
            </div><!-- ./col -->

            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-purple">
                    <div class="inner">
                        <?php 
              $adm = $conn->prepare("SELECT * FROM t_teach");
              $adm->execute();
              $admResult = $adm->get_result();
              $num_adm = mysqli_num_rows($admResult);
            ?>
                        <h3><?php echo "$num_adm";?></h3>

                        <p>Teachers</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <?php   
            echo "<a href=\"data.php?teacher\" target='_blank' class='small-box-footer'>More info <i class='fa fa-arrow-circle-right'></i></a>"; 
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

                        <p>Administrators</p>
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
                        <h3 class="box-title">Teacher Registration :: My Office</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form class="form-horizontal" method="post"
                        action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">

                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputName3" class="col-sm-2 control-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputName3"
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
                                <label for="inputRoom3" class="col-sm-2 control-label">Room #</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputRoom3"
                                        placeholder="Enter Room Number" name="loc">
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

                            <div class="form-group">
                                <label for="inputBal3" class="col-sm-2 control-label">Balance</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="inputBal3"
                                        placeholder="Enter Account Balance" name="bal">
                                </div>
                            </div>

                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-info " name="sup_reg">Register</button>
                            <button type="reset" class="btn btn-default pull-right">Cancel</button>
                        </div><!-- /.box-footer -->
                    </form>
                </div>
                
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
                </div><!-- /.box --> <!--Admin Registration box-->


            </section><!-- /.Left col -->

            <section class="col-lg-5 connectedSortable">

                <!-- Add or Subtract Balance-->
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add or Subtract from Balance :: My Office</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form class="form-horizontal" method="post"
                        action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">

                        <div class="box-body">

                            <div class="form-group">
                                <label for="inputEmail4" class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="inputEmail4"
                                        placeholder="Enter Email Address" name="email">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputBal4" class="col-sm-2 control-label">Balance</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="inputBal4"
                                        placeholder="Enter Account Balance" name="bal">
                                </div>
                            </div>

                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-info " name="bal_reg">Update</button>
                            <button type="reset" class="btn btn-default pull-right">Cancel</button>
                        </div><!-- /.box-footer -->
                    </form>
                </div> <!--Add or Subtract Balance-->



                <!-- Change password box -->
                <div class="box box-solid bg-light-blue-gradient">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Change Password :: My Office</h3>
                        </div><!-- /.box-header -->
                        <!-- form start -->
                        <form class="form-horizontal" method="post"
                            action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
                            <div class="box-body">

                                <div class="form-group">
                                    <label for="inputPassword4" class="col-sm-2 control-label">Old Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="inputPassword4"
                                            placeholder="Old Password" name="old_pwd">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputPassword5" class="col-sm-2 control-label">Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="inputPassword5"
                                            placeholder="New Password" name="new_pwd0">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputPassword6" class="col-sm-2 control-label">Confirm Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="inputPassword6"
                                            placeholder="Confirm New Password" name="new_pwd1">
                                    </div>
                                </div>

                            </div><!-- /.box-body -->

                            <div class="box-footer">
                                <button type="submit" class="btn btn-info " name="pwd_reg">Submit</button>
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
      $supp_loc  = clean($_POST['loc']);
      $supp_bal  = clean($_POST['bal']);


      $result = $conn->prepare("SELECT * FROM t_supplier WHERE s_email= ?");
      $result->bind_param('s', $supp_mail);
      $result->execute();
      $resultResult = $result->get_result();
      $num_rows = mysqli_num_rows($resultResult);
     
      if ($num_rows) 
      {
        ?>

        <script language="javascript">
        alert("This user already exists in the user table.");
        location.href = "index.php";
        </script>;

        <?php

      } else {

        $result = $conn->prepare("SELECT * FROM t_teach WHERE t_email= ?");
        $result->bind_param('s', $supp_mail);
        $result->execute();
        $resultResult = $result->get_result();
        $num_rows = mysqli_num_rows($resultResult);

        if ($num_rows) 
        {
          ?>
  
          <script language="javascript">
          alert("This user already exists in the teacher table.");
          location.href = "index.php";
          </script>;
  
          <?php
  
        } else {

            if ($supp_pwd0 == $supp_pwd1 && strlen($supp_pwd1) > 7)
            {  //$supp_pwd0 = md5($supp_pwd0);

                $supp_pwd0Hash = password_hash($supp_pwd0, PASSWORD_ARGON2ID);

                if (password_verify($supp_pwd0, $supp_pwd0Hash))
                {
                    $save_supp_data = $conn->prepare("INSERT INTO t_supplier "
                    . "(a_id, s_name, s_email, s_pwd, s_loc, s_bal)"
                    . "VALUES (?, ?, ?, ?, ?, ?)"
                    );

                    $save_supp_data->bind_param("sssssi", $id, $supp_name, $supp_mail, $supp_pwd0Hash, $supp_loc, $supp_bal);

                    if($save_supp_data->execute())
                    {
                        $result1 = $conn->prepare("INSERT INTO t_teach (t_name, t_email, t_pwd, t_loc) VALUES "
                        . "(?, ?, ?, ?)"
                        );

                        $result1->bind_param("ssss", $supp_name, $supp_mail, $supp_pwd0Hash, $supp_loc);

                        if($result1->execute())
                        {
                            ?>
                        <script language="javascript">
                        alert('Registration Successful');
                        location.href = "index.php";
                        </script>;
                        <?php
                        } else {
                            ?>
                            <script language="javascript">
                            alert('The teacher was not added to the teacher table.');
                            location.href = "index.php";
                            </script>;
                            <?php 
                        }
                    } else {
                        ?>
                        <script language="javascript">
                        alert('The teacher was not added to the user table.');
                        location.href = "index.php";
                        </script>;
                        <?php 
                    }
                } else {
                    ?>
                    <script language="javascript">
                    alert('Confirmation Password Not Verified');
                    location.href = "index.php";
                    </script>;
                    <?php
                }
            } else {
                ?>
                <script language="javascript">
                alert('You must have matching passwords of at least 8 characters in length.');
                location.href = "index.php";
                </script>;
                <?php
            }
        }
      }
    }
        
  ?>

</div>

<!-- Supplier Registration Ends-->

<!-- Add to Student Balance Begins-->

<div>

    <?php

    if(isset($_POST['bal_reg']))
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
      $supp_mail = clean($_POST['email']);
      $supp_bal  = clean($_POST['bal']);


        $supplier = $conn->prepare("SELECT * from t_supplier where s_email = ?");
        $supplier->bind_param("s", $supp_mail);
        $supplier->execute();
        $supplierResult = $supplier->get_result();
        $num_rows = mysqli_num_rows($supplierResult);


        if ($num_rows) 
        {

            $supplierArr = mysqli_fetch_array($supplierResult);

            $supplierId = $supplierArr['s_id'];
            $supplierName = $supplierArr['s_name'];
            $supplierEmail = $supplierArr['s_email'];
            $supplierTeachEmail = $supplierArr['a_id'];
            $supplierLoc = $supplierArr['s_loc'];

            $supplierBal = $supplierArr['s_bal'];

            $supplierBal = $supplierBal + $supp_bal;

            if($supplierBal >= 0)
            {
                $supplierTrans = $conn->prepare("UPDATE t_supplier SET s_bal= ? WHERE s_email = ?");
                $supplierTrans->bind_param('is', $supplierBal, $supp_mail);
            
                if($supplierTrans->execute())
                {

                    $admin = $conn->prepare("SELECT * from t_admin where a_mail = ?");
                    $admin->bind_param("s", $id);
                    $admin->execute();
                    $adminResult = $admin->get_result();
                    $adminArr = mysqli_fetch_array($adminResult);

                    $adminId = '0';

                    $adminName = $adminArr['a_name'];
                    $adminEmail = $adminArr['a_mail'];
                    $adminLoc = $adminArr['s_loc'];

                    $buyVer = 1;
                    $sellVer = 1;
                    $productId = 0;
                    $escrowZero = 0;

                    $stringAdd = 'Admin Funds Transfer';
                    $date_now = date('Y-m-d H:i:s');

                    $save = $conn->prepare("INSERT INTO t_order_user_det "
                    ."(p_id, p_name, p_amt, b_id, b_name, b_email, b_t_email, b_loc,"
                    ." s_id, s_name, s_email, s_t_email, s_loc, o_date, o_price, o_escrow, b_ver, s_ver) "

                    . "VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

                    $save->bind_param('isiissssisssssiiii', $productId, $stringAdd, $supp_bal, $supplierId, $supplierName, $supplierEmail, $supplierTeachEmail,
                    $supplierLoc, $adminId, $adminName, $adminEmail, $adminEmail, $adminLoc, $date_now, $supp_bal, $escrowZero, $buyVer, $sellVer);
                    
                    if($save->execute())
                    {
                        $save_supp_data->close();
                        $conn->close();
                        ?>
                        <script language="javascript">
                        alert('Funds Transfer Successful');
                        location.href = "index.php";
                        </script>;
                        <?php 
                    } else {
                        $save_supp_data->close();
                        $conn->close();
                        ?>
                        <script language="javascript">
                        alert('Something went wrong with the transaction record entry.');
                        location.href = "index.php";
                        </script>;
                        <?php 
                    }
                } else {
                    $save_supp_data->close();
                    $conn->close();
                    ?>
                    <script language="javascript">
                    alert('Something went wrong with the balance tranfer entry.');
                    location.href = "index.php";
                    </script>;
                    <?php 
                }
            } else {
                ?>
                <script language="javascript">
                alert('This transaction would result in a negative balance.');
                location.href = "index.php";
                </script>;
                <?php

            }

        } else {

            ?>
  
            <script language="javascript">
            alert("This user does not exist in the user table.");
            location.href = "index.php";
            </script>;
    
            <?php

        }
    }
        
  ?>

</div>

<!-- Add to Student Balance Ends -->


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

<!-- Change Password-->

<div>

    <?php

  if(isset($_POST['pwd_reg']))
  {

    function clean($str) {
        $str = @trim($str);
        $str = stripslashes($str);
        include ('../includes/connection.php');
        return mysqli_real_escape_string($conn, $str);
      }
                            
    $old_pwd    = clean($_POST['old_pwd']);
    $new_pwd0   = clean($_POST['new_pwd0']);
    $new_pwd1   = clean($_POST['new_pwd1']);

    if($new_pwd0 == $new_pwd1 && strlen($new_pwd1) > 7)
    {
      //Create query

      
      $result = $conn->prepare("SELECT * FROM t_admin WHERE a_mail= ?");
      $result->bind_param('s', $id);
      $result->execute();
      $resultResult = $result->get_result();
      $num_rows = mysqli_num_rows($resultResult);
     
      if ($num_rows) 
      {
        $new_pwd0Hash = password_hash($new_pwd0, PASSWORD_ARGON2ID);
        
        if(password_verify($new_pwd0, $new_pwd0Hash))
        {
          $result1 = $conn->prepare("UPDATE t_admin SET a_pwd= ? WHERE a_mail= ?");

          $result1->bind_param("ss", $new_pwd0Hash, $id);
         
          if($result1->execute())
          {
            $result1->close();
            $conn->close();

            echo '<script language="javascript">';
              echo 'alert("Password changed successfully."); location.href="index.php"';
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
     
      } else {

        ?>

        <script language="javascript">
        alert("<?php echo "
            User does not exist." ?>");
        location.href = "index.php";
        </script>;
    
        <?php
      }
    }	 else {

      echo '<script language="javascript">';
        echo 'alert("Passwords do not match."); location.href="index.php"';
      echo '</script>';
    }
            
  }
        
 ?>


</div>

<!-- Change Password-->