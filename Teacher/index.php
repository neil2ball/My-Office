<?php
$title ="Teacher Panel";
include 'teach_header.php';
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

            <li><a href="data.php?order"><i class="fa fa-circle-o text-aqua"></i> <span>Orders</span></a></li>
            <li><a href="data.php?product"><i class="fa fa-circle-o text-green"></i> <span>Products</span></a></li>
            <li><a href="data.php?student"><i class="fa fa-circle-o text-yellow"></i> <span>Students</span></a></li>
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
              $order = $conn->prepare("SELECT * FROM t_order_user_det WHERE (b_t_email = ?) OR (s_t_email = ?)");
              $order->bind_param('ss', $id, $id);
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
              $user = $conn->prepare("SELECT * FROM t_product WHERE s_t_email= ?");
              $user->bind_param('s', $id);
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
              $supp = $conn->prepare("SELECT * FROM t_supplier WHERE a_id= ?");
              $supp->bind_param('s', $id);
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
        </div><!-- /.row -->

        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-7 connectedSortable">
                <!-- Custom Supplier-->
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Student Registration :: My Office</h3>
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


      if ($supp_pwd0 != '' && $supp_pwd0 == $supp_pwd1 && strlen($supp_pwd1) > 7)
      {  //$supp_pwd0 = md5($supp_pwd0);

        $supp_pwd0Hash = password_hash($supp_pwd0, PASSWORD_ARGON2ID);

        if (password_verify($supp_pwd0, $supp_pwd0Hash))
        {
            $teacher = $conn->prepare("SELECT s_bal from t_supplier where s_email = ?");
            $teacher->bind_param("s", $id);
            $teacher->execute();
            $teacherResult = $teacher->get_result();
            $teacherArr = mysqli_fetch_array($teacherResult);

            $teachBal = $teacherArr['s_bal'];

            if($teachBal >= $supp_bal)
            {
                $teachBal = $teachBal - $supp_bal;

                $teachWD = $conn->prepare("UPDATE t_supplier SET s_bal= ? WHERE s_email = ?");
                $teachWD->bind_param('is', $teachBal, $id);
                $teachWD->execute();

                $save_supp_data = $conn->prepare("INSERT INTO t_supplier "
                . "(a_id, s_name, s_email, s_pwd, s_loc, s_bal)"
                . "VALUES (?, ?, ?, ?, ?, ?)"
                );

                $save_supp_data->bind_param("sssssi", $id, $supp_name, $supp_mail, $supp_pwd0Hash, $supp_loc, $supp_bal);

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
                    alert('Something went wrong.');
                    location.href = "index.php";
                    </script>;
                    <?php 
                }
            } else {
                ?>
                <script language="javascript">
                alert('You lack sufficient funds for this transaction.');
                location.href = "index.php";
                </script>;
               <?php

            }
        } else
        {
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
        
  ?>

</div>

<!-- Supplier Registration Ends-->

<div>

    <?php 
  if (!isset($_FILES['image']['tmp_name']))
  {
	  echo "";
	} else {
	  $file       = $_FILES['image']['tmp_name'];
	  $image      = addslashes(file_get_contents($_FILES['image']['tmp_name']));
	  $image_name = addslashes($_FILES['image']['name']);
			
		move_uploaded_file($_FILES["image"]["tmp_name"],"Product_Image/" . $_FILES["image"]["name"]);
			
		$img         = "Product_Image/" . $_FILES["image"]["name"];
    $name        = $_POST['name'];
    $qty         = $_POST['qty'];
    $wt          = $_POST['wt'];
    $price       = $_POST['price'];
    $description = $_POST['desc'];

    $s_id = $conn->prepare("SELECT s_id FROM t_supplier WHERE s_email= ?");
    $s_id->bind_param('s', $id);
    $s_id->execute();
    $s_idResult = $s_id->get_result();
                       
    $save = $conn->prepare("INSERT INTO t_product ( s_id, p_name, p_qty, p_img, p_wt, p_price, p_desc) "
    . "VALUES (?, ?, ?, ?, ?, ?, ?)");
    $save->bind_param('issssss', $s_idResult, $name, $qty, $img, $wt, $price, $description);
                           
	if($save->execute()) 
    {
      echo '<script language="javascript">';
        echo 'alert("Record Successfully inserted"); location.href="index.php"';
      echo '</script>';
		} else {
      ?>
    <script language="javascript">
    alert("<?php echo mysqli_error($conn) ?>");
    location.href = "index.php";
    </script>;
    <?php
    }		
	}
  ?>
</div>