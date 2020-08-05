<?php 
$title ="Data List";
include 'teach_header.php';
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

                <!-- Getting Customers Deatils -->

                <?php 
            if(isset($_REQUEST['action']))
            {
                $prdt_table = $conn->prepare("SELECT * FROM t_product WHERE p_id = ?");
                $prdt_table->bind_param('i', $_POST['p_id']);
                $prdt_table->execute();
                $prdt_tableResult = $prdt_table->get_result();
                ?>
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Edit Product</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Product Id</th>
                                    <th>Product Image</th>
                                    <th>Name</th>
                                    <th>Quantity remaining</th>
                                    <th>Weight</th>
                                    <th>Price</th>
                                    <!--<th>Description</th>-->
                                    <th>Commit</th>
                                    <th>Cancel</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                        while ($row = mysqli_fetch_array($prdt_tableResult)) 
                        {
                            echo "<tr>";
                                echo"<td>{$row['p_id']}</td>";

                                echo"<td><img src='../{$row['p_img']}' width='50' height='50'></td>";

                                echo"<form action=\"commit.php\" method=\"post\">";

                                    echo"<td><input type=\"text\" name=\"p_name\" value=\"{$row['p_name']}\"></td>";

                                    echo"<td><input type=\"number\" name=\"p_qty\" value=\"{$row['p_qty']}\"></td>";

                                    echo"<td><input type=\"number\" name=\"p_wt\" value=\"{$row['p_wt']}\"></td>";

                                    echo"<td><input type=\"number\" name=\"p_price\" value=\"{$row['p_price']}\"></td>";

                                    //echo"<td><input type=\"number\" name=\"p_desc\" value=\"{$row['p_desc']}\"></td>";

                                    echo"<input type=\"hidden\" name=\"commit\" value=\"submit\" />";
                                    echo"<td><button name=\"p_id\" type=\"submit\" value=\"{$row['p_id']}\">Commit</button></td>";
                                echo"</form>";

                                echo"<td><a href=\"data.php?product\" style='text-decoration:none'>Cancel</a></td>";
                           
                            echo"</tr>";
                        }
                      
                       ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Product Id</th>
                                    <th>Product Image</th>
                                    <th>Name</th>
                                    <th>Quantity remaining</th>
                                    <th>Weight</th>
                                    <th>Price</th>
                                    <!--<th>Description</th>-->
                                    <th>Commit</th>
                                    <th>Cancel</th>
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