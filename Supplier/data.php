<?php 
$title ="Data List";
include 'supp_header.php';
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
             if(isset($_REQUEST['order']))
             {
                $cnt=0;

                function clean($str)
                {
                  $str = @trim($str);
                  $str = stripslashes($str);
                  include ('../includes/connection.php');
		              return mysqli_real_escape_string($conn, $str);
                }
                  
                $id = clean($id);
                $supp_det = $conn->prepare("SELECT p_id FROM t_product WHERE s_id = ?");
                $supp_det->bind_param('s', $id);
                $supp_det->execute();
                $supp_detResult = $supp_det->get_result();
                    
                   
                //$num_order = mysqli_num_rows($order_user_det);
                    
                 
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
                                    <th>User Id</th>
                                    <th>Order Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>City</th>
                                    <th>Landmark</th>
                                    <th>Address</th>
                                    <th>Zip</th>
                                    <th>Total Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                        while ($row = mysqli_fetch_array($supp_detResult)) 
                        {
                          // getting Supplier's Product id
                          $s_p_id = clean($row['p_id']);
                          $order = $conn->prepare("SELECT o_id FROM t_order WHERE p_id = ?");
                          $order->bind_param('s', $s_p_id);
                          $order->execute();
                          $orderResult = $order->get_result();

                          while ($row1 = mysqli_fetch_array($orderResult)) 
                          {       
                            $o_u_det = clean($row1['o_id']);
                            $order_user_det = $conn->prepare("SELECT * FROM t_order_user_det WHERE o_id = ? ORDER BY o_date DESC"); 
                            $order_user_det->bind_param('s', $o_u_det);
                            $order_user_det->execute();
                            $order_user_detResult = $order_user_det->get_result();
                            
                            $cnt = $cnt +1;
                        
                    
                            while ($row = mysqli_fetch_array($order_user_detResult)) 
                            { 
                            
                              echo "<tr>";
                                echo"<td>{$row['o_date']}</td>";
                                echo"<td>{$row['u_id']}</td>";
                                echo"<td>{$row['o_id']}</td>";
                                echo"<td>{$row['o_name']}</td>";
                                echo"<td>{$row['o_email']}</td>";
                                echo"<td>{$row['o_mob']}</td>";
                                echo"<td>{$row['o_city']}</td>";
                                echo"<td>{$row['o_land']}</td>";
                                echo"<td>{$row['o_add']}</td>";
                                echo"<td>{$row['o_zip']}</td>";
                                echo"<td>{$row['o_ttl_amt']}</td>";
                              echo"</tr>";              
                            }
                          }
                
                        }
                      
                       ?>


                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Date</th>
                                    <th>User Id</th>
                                    <th>Order Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>City</th>
                                    <th>Landmark</th>
                                    <th>Address</th>
                                    <th>Zip</th>
                                    <th>Total Amount</th>
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
                            echo"<td><img src='{$row['p_img']}' width='50' height='50'></td>";
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