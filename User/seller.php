<?php
$title ="Seller Panel";
include 'seller_header.php';
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small>Control panel</small>
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

                  function clean($str) {
                    $str = @trim($str);
                    $str = stripslashes($str);
                    include ('../includes/connection.php');
                    return mysqli_real_escape_string($conn, $str);
                  }
                  // getting Supplier's Product id
                  $id = clean($id);

                  $order_user_det = $conn->prepare("SELECT * FROM t_order_user_det WHERE (b_id= ?) OR (s_id= ?)");
                  $order_user_det->bind_param('ii', $id, $id);
                  $order_user_det->execute();
                  $orderResult = $order_user_det->get_result();

                  $cnt = mysqli_num_rows($orderResult);
                   
                  //$num_order = mysqli_num_rows($order_user_det);
                  ?>
                        <h3><?php echo "$cnt";?></h3>
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

                    $id = clean($id);
                    $prdt = $conn->prepare("SELECT * FROM t_product WHERE s_id = ?");
                    $prdt->bind_param('s', $id);
                    $prdt->execute();
                    $prdtResult = $prdt->get_result();
                    $num_prdt = mysqli_num_rows($prdtResult);
                    ?>
                        <h3><?php echo "$num_prdt";?></h3>
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

            <div class="col-lg-1 col-xs-1">

            </div>

            <section class="col-lg-7 connectedSortable"> <!--Left column-->
                <!-- Custom Supplier-->
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add A New Product &nbsp; :: &nbsp; Seller Panel &nbsp; :: &nbsp; My
                            Office</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form class="form-horizontal" method="post" enctype="multipart/form-data"
                        action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputName3" class="col-sm-2 control-label">Product Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputEmail3"
                                        placeholder="Enter Product Name" name="name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputQuantity3" class="col-sm-2 control-label">Quantity</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="inputQuantity3"
                                        placeholder="Enter Product Quantity" name="qty">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputWeight3" class="col-sm-2 control-label">Weight</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="inputWeight3"
                                        placeholder="Enter Product Weight" name="wt">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputPrice3" class="col-sm-2 control-label">Price</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="inputPrice3"
                                        placeholder="Enter Product Price" name="price">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputDescription3" class="col-sm-2 control-label"> Description</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="inputDescciption3"
                                        placeholder="Product Description" name="desc"> </textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputImage3" class="col-sm-2 control-label"> Image</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" id="inputImage3"
                                        placeholder="Upload Product Image" name="image">
                                </div>
                            </div>

                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-info " name="prdt_upload">Upload</button>
                            <button type="reset" class="btn btn-default pull-right">Cancel</button>

                        </div><!-- /.box-footer -->
                    </form>
                </div>

            </section> <!--Left Column-->
            <section class="col-lg-5 connectedSortable">


                <!-- Change Password box -->
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
                </div><!-- /.box --><!--Change password box-->
            </section>
        </div><!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<?php include 'footer.php'; ?>


<!-- Supplier Registration-->

<div>

    <?php 
  if (!isset($_FILES['image']['tmp_name']))
  {
	  echo "";
  } else 
  {
	  $file       = $_FILES['image']['tmp_name'];
	  $image      = addslashes(file_get_contents($_FILES['image']['tmp_name']));
	  $image_name = addslashes($_FILES['image']['name']);
			
		move_uploaded_file($_FILES["image"]["tmp_name"],"../Product_Image/" . $_FILES["image"]["name"]);
			
		$img         = "Product_Image/" . $_FILES["image"]["name"];
    $name        = $_POST['name'];
    $qty         = $_POST['qty'];
    $wt          = $_POST['wt'];
    $price       = $_POST['price'];
    $description = $_POST['desc'];

    $s_t = $conn->prepare("SELECT a_id FROM t_supplier WHERE s_id= ?");
    $s_t->bind_param('i', $id);
    $s_t->execute();
    $s_tResult = $s_t->get_result();
    $s_t_Array = mysqli_fetch_array($s_tResult);

    $s_t_email = $s_t_Array['a_id'];
    echo $s_t_email;
    $save = $conn->prepare("INSERT INTO t_product ( s_id, p_name, s_t_email, p_qty, p_img, p_wt, p_price, p_desc) "
    . "VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $save->bind_param('issisiis', $id, $name, $s_t_email, $qty, $img, $wt, $price, $description);
                           
	if($save->execute()) 
    {
      echo '<script language="javascript">';
        echo 'alert("Record Successfully inserted"); location.href="index.php"';
      echo '</script>';
    } else 
    {
    ?>
        <script language="javascript">
            alert("<?php die(mysqli_error($conn)) ?>");
                location.href = "index.php";
        </script>;
    <?php
    }		
  }
  ?>
</div>

<!-- Change Password-->

<div>

    <?php

  if(isset($_POST['pwd_reg']))
  {
                            
    $old_pwd    = clean($_POST['old_pwd']);
    $new_pwd0   = clean($_POST['new_pwd0']);
    $new_pwd1   = clean($_POST['new_pwd1']);

    if($new_pwd0 == $new_pwd1 && strlen($new_pwd1) > 7)
    {
      //Create query

      
      $result = $conn->prepare("SELECT * FROM t_supplier WHERE s_id= ?");
      $result->bind_param('s', $id);
      $result->execute();
      $resultResult = $result->get_result();
      $num_rows = mysqli_num_rows($resultResult);
     
      if ($num_rows) 
      {
        $new_pwd0Hash = password_hash($new_pwd0, PASSWORD_ARGON2ID);
        
        if(password_verify($new_pwd0, $new_pwd0Hash))
        {
          $result1 = $conn->prepare("UPDATE t_supplier SET s_pwd= ? WHERE s_id= ?");

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