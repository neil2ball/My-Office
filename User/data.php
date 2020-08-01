<?php 
$title ="Data List";
include 'seller_header.php';
?>

<!-- Left side column. contains the logo and sidebar -->


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Data Tables
            <small>advanced tables</small>
        </h1>

    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <!-- getting Order Details -->
                <?php 
             if(isset($_REQUEST['order'])){
                 $o_table = $conn->prepare("SELECT * FROM t_order_user_det WHERE (b_email = ?) OR (s_email = ?) ORDER BY o_date DESC");
                 $o_table->bind_param('ss', $supp_email, $supp_email);
                 $o_table->execute();
                 $o_tableResult = $o_table->get_result();
                ?> 
                 <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Order data Table</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Date</th>
                        <th>Order Id</th>
                        <th>Buy Name</th>
                        <th>Buy Teacher</th>
                        <th>Buy Room #</th>
                        <th>Sell Name</th>
                        <th>Sell Teacher</th>
                        <th>Sell Room #</th>
                        <th>Escrow</th>
                        <th>Verified</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_array($o_tableResult)) 
                            {
                        echo "<tr>";
                            echo"<td>{$row['o_date']}</td>";
                            echo"<td>{$row['o_id']}</td>";
                            echo"<td>{$row['b_name']}</td>";
                            echo"<td>{$row['b_t_email']}</td>";
                            echo"<td>{$row['b_loc']}</td>";
                            echo"<td>{$row['s_name']}</td>";
                            echo"<td>{$row['s_t_email']}</td>";
                            echo"<td>{$row['s_loc']}</td>";


                            if ($row['b_ver'] == 1 && $row['s_ver'] == 1)
                            {
                                if($row['o_escrow'] > 0)
                                {
                                    $sell = $conn->prepare("SELECT s_bal, s_id FROM t_supplier WHERE s_id= ?");
                                    $sell->bind_param('i', $row['s_id']);
                                    if($sell->execute())
                                    {
                                        $sellResult = $sell->get_result();
                                        $seller = mysqli_fetch_array($sellResult);

                                        $balance = $seller['s_bal'] + $row['o_escrow'];

                                        $update = $conn->prepare("UPDATE t_supplier SET s_bal= ? WHERE s_id= ?");
                                        $update->bind_param('ii', $balance, $seller['s_id']);

                                        if($update->execute())
                                        {
                                            $empty = $conn->prepare("UPDATE t_order_user_det SET o_escrow= 0 WHERE o_id= ?");
                                            $empty->bind_param('i', $row['o_id']);
                                            $empty->execute();
                                        }
                                    }
                                }
                                echo"<td>₩₡0</td>";
                                echo"<td>Yes</td>";
                            } elseif ($row['b_id'] == $row['s_id'])
                            {
                                if($row['b_id'] == 0)
                                {
                                    $verify = $conn->prepare("UPDATE t_order_user_det SET b_ver= 1 WHERE o_id= ?");
                                    $verify->bind_param('i', $row['o_id']);
                                    $verify->execute();
                                }
                                if($row['s_id'] == 0)
                                {
                                    $verify = $conn->prepare("UPDATE t_order_user_det SET s_ver= 1 WHERE o_id= ?");
                                    $verify->bind_param('i', $row['o_id']);
                                    $verify->execute();
                                }

                                if($row['o_escrow'] > 0)
                                {
                                    $sell = $conn->prepare("SELECT s_bal FROM t_supplier WHERE s_id= ?");
                                    $sell->bind_param('i', $row['s_id']);
                                    if($sell->execute())
                                    {
                                        $sellResult = $sell->get_result();
                                        $seller = mysqli_fetch_array($sellResult);

                                        $balance = $seller['s_bal'] + $row['o_escrow'];

                                        $update = $conn->prepare("UPDATE t_supplier SET s_bal= ? WHERE s_id= ?");
                                        $update->bind_param('ii', $balance, $seller['s_id']);

                                        if($update->execute())
                                        {
                                            $empty = $conn->prepare("UPDATE t_order_user_det SET o_escrow= 0 WHERE o_id= ?");
                                            $empty->bind_param('i', $row['o_id']);
                                            $empty->execute();
                                        }
                                    }
                                }
                                echo"<td>₩₡0</td>";
                                echo"<td>Yes</td>";
                            }
                             elseif ($row['b_ver'] == 0)
                            {
                                if($row['b_id'] == $id)
                                {
                                    echo"<td>₩₡{$row['o_escrow']}</td>";
                                    echo"<form action=\"b_ver.php\" method=\"post\">";
                                        echo"<input type=\"hidden\" name=\"action\" value=\"submit\" />";
                                        echo"<td><button name=\"o_id\" type=\"submit\" value=\"{$row['o_id']}\">Verify</button></td>";
                                    echo"</form>";
                                } else
                                {
                                    echo"<td>₩₡{$row['o_escrow']}</td>";
                                    echo"<td>Pending</td>";
                                }

                            } elseif ($row['s_ver'] == 0)
                            {
                                if($row['s_id'] == $id)
                                {
                                    echo"<td>₩₡{$row['o_escrow']}</td>";
                                    echo"<form action=\"s_ver.php\" method=\"post\">";
                                        echo"<input type=\"hidden\" name=\"action\" value=\"submit\" />";
                                        echo"<td><button name=\"o_id\" type=\"submit\" value=\"{$row['o_id']}\">Verify</button></td>";
                                    echo"</form>";
                                } else
                                {
                                    echo"<td>₩₡{$row['o_escrow']}</td>";
                                    echo"<td>Pending</td>";
                                }

                            }

                        echo"</tr>";              
                          }
                      
                       ?> 
                        
                        
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Date</th>
                        <th>Order Id</th>
                        <th>Buy Name</th>
                        <th>Buy Teacher</th>
                        <th>Buy Room #</th>
                        <th>Sell Name</th>
                        <th>Sell Teacher</th>
                        <th>Sell Room #</th>
                        <th>Escrow</th>
                        <th>Verified</th>
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div> 
             <?php
             }
             ?> 
              <!-- Order Details Ends -->

                <!-- Getting Customers Deatils -->

                <?php 
             if(isset($_REQUEST['product']))
             {
                $prdt_table = $conn->prepare("SELECT * FROM t_product WHERE s_id = ?");
                $prdt_table->bind_param('s', $id);
                $prdt_table->execute();
                $prdt_tableResult = $prdt_table->get_result();
                ?>
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Product data Table</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Product Id</th>
                                    <th>Name</th>
                                    <th>Quantity remaining</th>
                                    <th>Product Image</th>
                                    <th>Weight</th>
                                    <th>Price</th>
                                    <th>Description</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                        while ($row = mysqli_fetch_array($prdt_tableResult)) 
                        {
                          echo "<tr>";
                            echo"<td>{$row['p_id']}</td>";
                            echo"<td>{$row['p_name']}</td>";
                            echo"<td>{$row['p_qty']}</td>";
                            echo"<td><img src='../{$row['p_img']}' width='50' height='50'></td>";
                            echo"<td>{$row['p_wt']}</td>";
                            echo"<td>{$row['p_price']}</td>";
                            echo"<td>{$row['p_desc']}</td>";
                            echo"<td><a href=\"#\" style='text-decoration:none'>Edit </a></td>";
                            echo"<td><a href=\"#\" style='text-decoration:none'>Delete</a></td>";
                           
                          echo"</tr>";              
                        }
                      
                       ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Product Id</th>
                                    <th>Name</th>
                                    <th>Quantity remaining</th>
                                    <th>Product Image</th>
                                    <th>Weight</th>
                                    <th>Price</th>
                                    <th>Description</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div><!-- /.box-body -->
                </div>
                <?php
             }
             ?>
                <!-- Customers Details Ends -->



                <!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<?php include 'footer.php'; ?>

<div class="control-sidebar-bg"></div>
</div><!-- ./wrapper -->

<!-- jQuery 2.1.4 -->
<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.5 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- page script -->
<script>
$(function() {
    $("#example1").DataTable();
    $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false
    });
});
</script>
</body>

</html>