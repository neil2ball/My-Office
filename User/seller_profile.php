<?php
$title ="Seller Panel";
include 'seller_header.php';
?>
 <aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
    <!-- Sidebar user panel -->
          
    <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">          
        <li><a href="index.php" class="active"><i class="fa fa-dashboard"></i> 
        <span>Dashboard</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
      <ul>
    </section>
        <!-- /.sidebar -->
  </aside>
  <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
     <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>User Profile</h1> 
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">         
          <div class="col-md-9">
            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#profile" data-toggle="tab">Profile Settings</a></li>
                <li><a href="#pwd_setting" data-toggle="tab">Password Settings</a></li>
                 
              </ul>
              <div class="tab-content">
                <div class="active tab-pane" id="profile">
                <!-- The profile Settings Form -->
                <?php 
                if(isset($_GET['supp_id']))
                {

                  function clean($str) 
                  {
                    $str = @trim($str);
                    $str = stripslashes($str);
                    include ('../includes/connection.php');
		                return mysqli_real_escape_string($str);
                  }



                  $supp_id = clean($_GET['supp_id']);
                  $supp_profile = $conn->prepare("SELECT * FROM t_supplier WHERE s_id= ?");
                  $supp_profile->bind_param('s', $supp_id);
                  $supp_profile->execute();
                  $supp_profileResult = $supp_profile->get_result();
  
                  while ($row = mysqli_fetch_array($supp_profileResult))
                  { 
                    ?>
                    
                    <form class="form-horizontal" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                    <?php  
                      echo "<div class='form-group'>";
                        echo "<label for='inputName' class='col-sm-2 control-label'>Name</label>";
                        echo "<div class='col-sm-10'>";
                          echo "<input type='text' class='form-control' id='inputName' placeholder='Name'
                                 name='supp_name' value='{$row['s_name']}'>";
                        echo "</div>";
                      echo "</div>";
        
                      echo "<div class='form-group'>";
                        echo "<label for='inputEmail' class='col-sm-2 control-label'>Email</label>";
                        echo "<div class='col-sm-10'>";
                          echo "<input type='email' class='form-control' id='inputEmail' placeholder='Email'
                                name='supp_email' value='{$row['s_email']}' readonly>";
                        echo "</div>";
                      echo "</div>";
        
                      echo "<div class='form-group'>";
                        echo "<label for='inputName' class='col-sm-2 control-label'>Password</label>";
                        echo "<div class='col-sm-10'>";
                          echo "<input type='password' class='form-control' id='inputPassword3' 
                                placeholder='Enter Password for A/C Confirmation'name='supp_pwd' value=''>";
                        echo "</div>";
                      echo "</div>";
                      
                      echo"<div class='form-group'>";
                        echo"<label for='inputSkills' class='col-sm-2 control-label'>Mobile</label>";
                        echo"<div class='col-sm-10'>";
                          echo"<input type='number' class='form-control' id='inputLocation' placeholder='Location'
                                 name='supp_loc' value='{$row['s_mob']}'>";
                        echo"</div>";
                      echo"</div>";
        
                      echo"<div class='form-group'>";
                        echo"<label for='inputName' class='col-sm-2 control-label'>City</label>";
                        echo"<div class='col-sm-10'>";
                          echo"<input type='text' class='form-control' id='inputName' placeholder='City'
                                 name='supp_name' value='{$row['s_city']}'>";
                        echo"</div>";
                      echo"</div>";
        
                      echo"<div class='form-group'>";
                        echo"<label for='inputEmail' class='col-sm-2 control-label'>Landmark</label>";
                        echo"<div class='col-sm-10'>";
                          echo"<input type='text' class='form-control' id='inputEmail' placeholder='Landmark'
                                 name='supp_email' value='{$row['s_land']}'>";
                        echo"</div>";
                      echo" </div>";
                
                      echo"<div class='form-group'>";
                        echo"<label for='inputSkills' class='col-sm-2 control-label'>State</label>";
                        echo"<div class='col-sm-10'>";
                          echo"<input type='text' class='form-control' id='inputLocation' placeholder='Enter State'
                                 name='supp_loc' value='{$row['s_state']}'>";
                        echo"</div>";
                      echo"</div>";
        
                      echo"<div class='form-group'>";
                        echo"<label for='inputSkills' class='col-sm-2 control-label'>Address</label>";
                        echo"<div class='col-sm-10'>";
                          echo"<input type='text' class='form-control' id='inputLocation' 
                                placeholder='Enter Address'name='supp_loc' value='{$row['s_add']}'>";
                        echo"</div>";
                      echo"</div>";
        
                      echo"<div class='form-group'>";
                        echo"<label for='inputSkills' class='col-sm-2 control-label'>Zip</label>";
                        echo"<div class='col-sm-10'>";
                          echo"<input type='number' class='form-control' id='inputLocation' placeholder='Pin Code'
                                 name='supp_loc' value='{$row['s_zip']}'>";
                        echo"</div>";
                      echo"</div>";
                      
                      echo"<div class='form-group'>";
                        echo"<div class='col-sm-offset-2 col-sm-10'>";
                          echo"<button type='submit' class='btn btn-danger' name='supp_update'>Update</button>";
                        echo"</div>";
                      echo"</div>";
                    ?>
                    </form>
                    <?php
                  }
                }
    
                    ?>                
                
                    <?php 
                if (isset($_POST['supp_update']))
                {
                  function clean($str) 
                  {
                    $str = @trim($str);
                    $str = stripslashes($str);
                    include ('../includes/connection.php');
		                return mysqli_real_escape_string($str);
                  }

                  $supp_name = clean($_POST['supp_name']);
                  $supp_email = clean($_POST['supp_email']);
                  $supp_pwd = clean($_POST['supp_pwd']);
                  $supp_loc = clean($_POST['supp_loc']);
     
                  $supp_profile1 = $conn->prepare("SELECT * FROM t_supplier WHERE s_email= ? AND s_pwd= ?");
                  $supp_profile1->bind_param('ss', $supp_email, $supp_pwd);

                  if($supp_profile1->execute())
                  {
         
                    $supp_update = $conn->prepare("UPDATE t_supplier SET s_name = ?");
                    $supp_update->bind_param('s', $supp_name);
         
                    if($supp_update->execute())
                    {
                      echo '<script language="javascript">';
                      echo 'alert("Record Successfully updated"); location.href="signout.php"';
                      echo '</script>';
                    } else {
                      ?>
                        <script language="javascript">
                          alert('<?php die(mysqli_error($conn)) ?>'); location.href="signout.php"
                        </script>
                      <?php 
                    }
                  } else {
                    ?>
                    <script language="javascript">
                      alert('<?php die(mysqli_error($conn)) ?>'); location.href="signout.php"
                    </script>
                    
                     <?php 
                  }
                }
    
                ?>                
                      
              </div><!-- /.tab-pane -->
                  
<!-- ---------------------------------------------------------------------------------------------------- -->                  
                  
              <div class="tab-pane" id="pwd_setting">
                <!-- The Password Setting Form -->
                <?php 
                if (isset($_GET['supp_id']))
                {
                  $supp_id = clean($_GET['supp_id']);
                  $supp_profile = $conn->prepare("SELECT * FROM t_supplier WHERE s_id= ?");
                  $supp_profile->bind_param('s', $supp_id);
                  $supp_profile->execute();
                  $supp_profileResult = $supp_profile->get_result();
  
                  while ($row = mysqli_fetch_array($supp_profileResult))
                  {
                    ?>
        
                    <form class="form-horizontal" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    
                    <?php
                    echo"<div class='form-group'>";
                      echo"<label for='inputName' class='col-sm-2 control-label'>Current Password</label>";
                      echo"<div class='col-sm-10'>";
                        echo"<input type='password' class='form-control' id='inputName' 
                            placeholder='Current Password'name='supp_pwd0'>";
                      echo"</div>";
                    echo"</div>";
        
                    echo" <div class='form-group'>";
                      echo"<label for='inputEmail' class='col-sm-2 control-label'>New Password</label>";
                      echo"<div class='col-sm-10'>";
                        echo"<input type='password' class='form-control' id='inputEmail' 
                            placeholder='New Password' name='supp_pwd1'> ";
                      echo"</div>";
                    echo"</div>";
        
                    echo"<div class='form-group'>";
                      echo"<label for='inputName' class='col-sm-2 control-label'>Confirm Password</label>";
                      echo"<div class='col-sm-10'>";
                        echo"<input type='password' class='form-control' id='inputName'
                            placeholder='Confirm Password' name='supp_pwd2'>";
                      echo"</div>";
                    echo"</div>";
                      
                    echo"<div class='form-group'>";
                      echo"<div class='col-sm-offset-2 col-sm-10'>";
                        echo"<button type='submit' class='btn btn-danger' name='supp_pwd_update'>Update</button> ";
                      echo"</div>";
                    echo"</div>";
                    ?>   
                    </form>
                    <?php    
                  }
                }
                ?>
            
                <?php 
                if (isset($_POST['supp_pwd_update']))
                {
                  function clean($str) 
                  {
		                $str = @trim($str);
                    $str = stripslashes($str);
                    include ('../includes/connection.php');
		                return mysqli_real_escape_string($str);
                  }

                  $supp_pwd0 = clean($_POST['supp_pwd0']);
                  $supp_pwd1 = clean($_POST['supp_pwd1']);
                  $supp_pwd2 = clean($_POST['supp_pwd2']);

                  $supp_profile1 = $conn->prepare("SELECT * FROM t_supplier WHERE s_email= ?");
                  $supp_profile1->bind_param('s', $supp_email);
                  $supp_profile1->execute();
                  $supp_profile1Result = $supp_profile1->get_result();
                  $row = mysqli_fetch_array($supp_profile1Result);
     
                  if($supp_pwd1 === $supp_pwd2  && password_verify($supp_pwd0, $row['s_pwd']))
                  {
                    
                    $supp_pwd1Hash = password_hash($supp_pwd1, PASSWORD_ARGON2ID);
                    $supp_update = $conn->prepare("UPDATE t_supplier SET s_pwd = ?");
                    $supp_update->bind_param('s', $supp_pwd1Hash);

                    if($supp_update->execute())
                    {
                      echo '<script language="javascript">';
                        echo 'alert("Password Successfully updated"); location.href="signout.php"';
                      echo '</script>';
                    } else {
                      ?>
                      <script language="javascript">
                        alert('<?php die(mysqli_error($conn)) ?>'); location.href="signout.php"
                      </script>
                      <?php 
                    }
                  } else {
                    ?>
                    <script language="javascript">
                      alert('<?php 
                      
                        echo '<script language="javascript">';
                          echo 'alert("Bad Password"); location.href="signout.php"';
                        echo '</script>';
                      
                      ?>'); location.href="signout.php"
                    </script>
                    
                    <?php 
                  }
                }
    
                ?>        
                    
              </div><!-- /.tab-pane -->

                  
            </div><!-- /.tab-content -->
          </div><!-- /.nav-tabs-custom -->
        </div><!-- /.col -->
      </div><!-- /.row -->

    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
      
<?php include 'footer.php'; ?>
