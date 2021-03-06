<?php
$title ="Supplier Panel";
include 'supp_header.php';
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
                  $cnt=0;

                  function clean($str) {
                    $str = @trim($str);
                    $str = stripslashes($str);
                    include ('../includes/connection.php');
                    return mysqli_real_escape_string($conn, $str);
                  }
                  // getting Supplier's Product id
                  $id = clean($id);
                  $supp_det = $conn->prepare("SELECT p_id FROM t_product WHERE s_id= ?");
                  $supp_det->bind_param('s', $id);
                  $supp_det->execute();
                  $supp_detResult = $supp_det->get_result();

                  while ($row = mysqli_fetch_array($supp_detResult)) 
                  {
                    $s_p_id = clean($row['p_id']);
                    $order = $conn->prepare("SELECT o_id FROM t_order WHERE p_id= ?");
                    $order->bind_param('s', $s_p_id);
                    $order->execute();
                    $orderResult = $order->get_result();

                    while ($row1 = mysqli_fetch_array($orderResult)) 
                    {

                      $o_u_det = clean($row1['o_id']);
                      $order_user_det = $conn->prepare("SELECT * FROM t_order_user_det WHERE o_id = ?");
                      $order_user_det->bind_param('s', $o_u_det);

                      if($order_user_det->execute())
                      {
                        $cnt = $cnt +1;
                      }
                    }
                  }
                   
                  //$num_order = mysqli_num_rows($order_user_det);
                  ?>
                        <h3><?php echo "$cnt";?></h3>
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

                    $id = clean($id);
                    $prdt = $conn->prepare("SELECT * FROM t_product WHERE s_id = ?");
                    $prdt->bind_param('s', $id);
                    $prdt->execute();
                    $prdtResult = $prdt->get_result();
                    $num_prdt = mysqli_num_rows($prdtResult);
                    ?>
                        <h3><?php echo "$num_prdt";?></h3>
                        <p>Types of Product Remains</p>
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
            <section class="col-lg-5 connectedSortable">
                <!-- Custom Supplier-->
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add A New Product &nbsp; :: &nbsp; Supplier Panel &nbsp; :: &nbsp; My
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
                       
    $save = $conn->prepare("INSERT INTO t_product ( s_id, p_name, p_qty, p_img, p_wt, p_price, p_desc) "
    . "VALUES (?, ?, ?, ?, ?, ?, ?)");
    $save->bind_param('sssssss', $id, $name, $qty, $img, $wt, $price, $description);
                           
		if($save->execute()) 
    {
      echo '<script language="javascript">';
        echo 'alert("Record Successfully inserted"); location.href="index.php"';
      echo '</script>';
		} else {
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