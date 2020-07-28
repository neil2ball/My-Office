<?php
$title ="Teacher Panel";
include 'teach_header.php';
?>
<?php ?>
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
    </ul>
  </section>

  <!-- /.sidebar -->
  </aside>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          User Profile
        </h1>
          
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

                if(isset($_GET['adm_id']))
                {

                  function clean($str) {
                    $str = @trim($str);
                    $str = stripslashes($str);
                    include ('../includes/connection.php');
                    return mysqli_real_escape_string($conn, $str);
                  }

                  $adm_id = clean($_GET['adm_id']);
                  $adm_profile = $conn->prepare("SELECT * FROM t_teach WHERE t_email= ?");
                  $adm_profile->bind_param('s', $adm_id);
                  $adm_profile->execute();
                  $adm_profileResult = $adm_profile->get_result();
  
                  while ($row = mysqli_fetch_array($adm_profileResult))
                  {
                    ?>
                    
                    <form class="form-horizontal" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                      <?php

                      echo"<div class='form-group'>";
                        echo"<label for='inputName' class='col-sm-2 control-label'>Name</label>";
                        echo"<div class='col-sm-10'>";
                          echo"<input type='text' class='form-control' id='inputName' placeholder='Name'
                              name='adm_name' value='{$row['t_name']}'>";
                        echo"</div>";
                      echo"</div>";
        
                      echo"<div class='form-group'>";
                        echo"<label for='inputEmail' class='col-sm-2 control-label'>Email</label>";
                        echo"<div class='col-sm-10'>";
                          echo"<input type='email' class='form-control' id='inputEmail' placeholder='Email'
                              name='adm_email' value='{$row['t_email']}' readonly>";
                        echo"</div>";
                      echo"</div>";
        
                      echo"<div class='form-group'>";
                        echo"<label for='inputName' class='col-sm-2 control-label'>Password</label>";
                        echo"<div class='col-sm-10'>";
                          echo"<input type='password' class='form-control' id='inputPassword3' 
                              placeholder='Enter Password for A/C Confirmation'name='adm_pwd' value=''>";
                        echo"</div>";
                      echo"</div>";
                      
                      echo"<div class='form-group'>";
                        echo"<label for='inputSkills' class='col-sm-2 control-label'>Location</label>";
                        echo"<div class='col-sm-10'>";
                          echo"<input type='text' class='form-control' id='inputLocation' placeholder='Location'
                              name='adm_loc' value='{$row['t_loc']}'>";
                        echo"</div>";
                      echo"</div>";
                      
                      echo"<div class='form-group'>";
                        echo"<div class='col-sm-offset-2 col-sm-10'>";
                          echo"<button type='submit' class='btn btn-danger' name='adm_update'>Update</button>";
                        echo"</div>";
                      echo"</div>";

                      ?>
                    </form>
                    <?php
                  }
                }
    
                ?>                
                
                <?php 
                if (isset($_POST['adm_update']))
                {
                  function clean($str) {
                    $str = @trim($str);
                    $str = stripslashes($str);
                    include ('../includes/connection.php');
                    return mysqli_real_escape_string($conn, $str);
                  }
                  
                  $adm_name = clean($_POST['adm_name']);
                  $adm_email = clean($_POST['adm_email']);
                  $adm_pwd = clean($_POST['adm_pwd']);
                  $adm_loc = clean($_POST['adm_loc']);
     
                  $adm_profile1 = $conn->prepare("SELECT * FROM t_teach WHERE t_email= ?");
                  $adm_profile1->bind_param('s', $adm_email);

                  if($adm_profile1->execute())
                  {

                    $adm_profile1Result = $adm_profile1->get_result();
                    $adm_row = mysqli_fetch_array($adm_profile1Result);

                    if(password_verify($adm_pwd, $adm_row['t_pwd']))
                    {

                      $adm_update = $conn->prepare("UPDATE t_teach SET t_name = ?, t_loc = ?");
                      $adm_update = bind_param('ss', $adm_name, $adm_loc);
         
                      if($adm_update->execute())
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

                      echo '<script language="javascript">';
                        echo 'alert("Bad password"); location.href="signout.php"';
                      echo '</script>';

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
                    if (isset($_GET['adm_id']))
                    {
                      $adm_id = clean($_GET['adm_id']);
                      $adm_profile = $conn->prepare("SELECT * FROM t_teach WHERE t_email= ?");
                      $adm_profile->bind_param('s', $adm_id);
                      $adm_profile->execute();
                      $adm_profileResult = $adm_profile->get_result();
  
                      while ($row = mysqli_fetch_array($adm_profileResult))
                      {
                        ?>
                        <form class="form-horizontal" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    
                          <?php
                        
                          echo"<div class='form-group'>";
                            echo"<label for='inputName' class='col-sm-2 control-label'>Current Password</label>";
                            echo"<div class='col-sm-10'>";
                              echo"<input type='password' class='form-control' id='inputName' 
                                  placeholder='Current Password'name='adm_pwd0'>";
                            echo"</div>";
                          echo"</div>";
        
                          echo" <div class='form-group'>";
                            echo"<label for='inputEmail' class='col-sm-2 control-label'>New Password</label>";
                            echo"<div class='col-sm-10'>";
                              echo"<input type='password' class='form-control' id='inputEmail' 
                                  placeholder='New Password' name='adm_pwd1'> ";
                            echo"</div>";
                          echo"</div>";
        
                          echo"<div class='form-group'>";
                            echo"<label for='inputName' class='col-sm-2 control-label'>Confirm Password</label>";
                            echo"<div class='col-sm-10'>";
                              echo"<input type='password' class='form-control' id='inputName'
                                placeholder='Confirm Password' name='adm_pwd2'>";
                            echo"</div>";
                          echo"</div>";
                      
                          echo"<div class='form-group'>";
                            echo"<div class='col-sm-offset-2 col-sm-10'>";
                              echo"<button type='submit' class='btn btn-danger' name='adm_pwd_update'>Update</button> ";
                            echo"</div>";
                          echo"</div>";
                          ?>   
                        </form>
                        <?php    
                      }
                    }

                    ?>
            
                    <?php 
                    if (isset($_POST['adm_pwd_update']))
                    {
                      function clean($str) {
                        $str = @trim($str);
                        $str = stripslashes($str);
                        include ('../includes/connection.php');
                        return mysqli_real_escape_string($conn, $str);
                      }
                      

                      $adm_email = clean($_POST['adm_email']);
                      $adm_pwd0  = clean($_POST['adm_pwd0']);
                      $adm_pwd1  = clean($_POST['adm_pwd1']);
                      $adm_pwd2  = clean($_POST['adm_pwd2']);

                      $adm_profile1 = $conn->prepare("SELECT * FROM t_teach WHERE t_email= ?");
                      $adm_profile1->bind_param('s', $admin_email);
                      $adm_profile1->execute();
                      $adm_profile1Result = $adm_profile1->get_result();
                      $adm_profile1Row = mysql_fetch_array($adm_profile1Result);

     
                      if($adm_pwd1 === $adm_pwd2 && password_verify($adm_pwd0, $adm_profile1Row['t_pwd']))
                      {
         
                        $adm_update = $conn->prepare("UPDATE t_teach SET t_pwd = ? WHERE t_email = ?");
                        $adm_update->bind_param('ss', $adm_pwd1, $adm_email);

                        if($adm_update->execute())
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
                            <?php 
                              echo '<script language="javascript">';
                                echo 'alert("Bad Password"); location.href="signout.php"';
                              echo '</script>';
                            ?>

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
