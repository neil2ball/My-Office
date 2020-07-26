<?php
$title ="User Panel";
include 'header.php';
?>
<?php 

?>
 
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
                    if(isset($_GET['usr_id']))
                    {

                        function clean($str) 
                        {
                            include ('../includes/connection.php');
                            $str = @trim($str);
                            $str = stripslashes($str);
		                    return mysqli_real_escape_string($conn, $str);
                        }

                        $usr_id = clean($_GET['usr_id']);
                        $usr_profile = $conn->prepare("SELECT * FROM t_user WHERE u_id=?");
                        $usr_profile->bind_param('s', $usr_id);
                        $usr_profile->execute();
                        $usr_profileResult = $usr_profile->get_result();
  
                        while ($row = mysqli_fetch_array($usr_profileResult))
                        { 
                            ?>
                    
                            <form class="form-horizontal" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                            <?php  
                            echo"<div class='form-group'>";
                                echo"<label for='inputName' class='col-sm-2 control-label'>Name</label>";
                                echo"<div class='col-sm-10'>";
                                    echo"<input type='text' class='form-control' id='inputName' placeholder='Name'
                                        name='usr_name' value='{$row['u_name']}'>";
                                echo"</div>";
                            echo"</div>";
        
                            echo"<div class='form-group'>";
                                echo"<label for='inputEmail' class='col-sm-2 control-label'>Email</label>";
                                echo"<div class='col-sm-10'>";
                                    echo"<input type='email' class='form-control' id='inputEmail' placeholder='Email'
                                 name='usr_email' value='{$row['u_email']}' readonly>";
                                echo"</div>";
                            echo" </div>";
        
                            echo"<div class='form-group'>";
                                echo"<label for='inputName' class='col-sm-2 control-label'>Password</label>";
                                echo"<div class='col-sm-10'>";
                                    echo"<input type='password' class='form-control' id='inputPassword3' 
                                        placeholder='Enter Password for A/C Confirmation'name='usr_pwd' value=''>";
                                echo"</div>";
                            echo"</div>";
                      
                            echo"<div class='form-group'>";
                                echo"<label for='inputSkills' class='col-sm-2 control-label'>Mobile</label>";
                                echo"<div class='col-sm-10'>";
                                    echo"<input type='number' class='form-control' id='inputLocation' placeholder='Location'
                                        name='usr_loc' value='{$row['u_mob']}'>";
                                echo"</div>";
                            echo"</div>";
        
                            echo"<div class='form-group'>";
                                echo"<label for='inputName' class='col-sm-2 control-label'>City</label>";
                                echo"<div class='col-sm-10'>";
                                    echo"<input type='text' class='form-control' id='inputName' placeholder='City'
                                        name='usr_name' value='{$row['u_city']}'>";
                                echo"</div>";
                            echo"</div>";
        
                            echo"<div class='form-group'>";
                                echo"<label for='inputEmail' class='col-sm-2 control-label'>Landmark</label>";
                                echo"<div class='col-sm-10'>";
                                    echo"<input type='text' class='form-control' id='inputEmail' placeholder='Landmark'
                                        name='usr_email' value='{$row['u_land']}'>";
                                echo"</div>";
                            echo" </div>";
                
                            echo"<div class='form-group'>";
                                echo"<label for='inputSkills' class='col-sm-2 control-label'>State</label>";
                                echo"<div class='col-sm-10'>";
                                    echo"<input type='text' class='form-control' id='inputLocation' placeholder='Enter State'
                                        name='usr_loc' value='{$row['u_state']}'>";
                                echo"</div>";
                            echo"</div>";
        
                            echo"<div class='form-group'>";
                                echo"<label for='inputSkills' class='col-sm-2 control-label'>Address</label>";
                                echo"<div class='col-sm-10'>";
                                    echo"<input type='text' class='form-control' id='inputLocation' 
                                        placeholder='Enter Address'name='usr_loc' value='{$row['u_add']}'>";
                                echo"</div>";
                            echo"</div>";
        
                            echo"<div class='form-group'>";
                                echo"<label for='inputSkills' class='col-sm-2 control-label'>Zip</label>";
                                echo"<div class='col-sm-10'>";
                                    echo"<input type='number' class='form-control' id='inputLocation' placeholder='Pin Code'
                                        name='usr_loc' value='{$row['u_zip']}'>";
                                echo"</div>";
                            echo"</div>";
                      
                            echo"<div class='form-group'>";
                                echo"<div class='col-sm-offset-2 col-sm-10'>";
                                    echo"<button type='submit' class='btn btn-danger' name='usr_update'>Update</button>";
                                echo"</div>";
                            echo"</div>";
                            ?>
                            </form>
                            <?php
                        }

                    }
    
                    ?>                
                
                    <?php 
                    if (isset($_POST['usr_update']))
                    {
                        function clean($str) 
                        {
                            include ('../includes/connection.php');
                            $str = @trim($str);
                            $str = stripslashes($str);
		                    return mysqli_real_escape_string($conn, $str);
                        }

                        $usr_name = clean($_POST['usr_name']);
                        $usr_email = clean($_POST['usr_email']);
                        $usr_pwd = clean($_POST['usr_pwd']);
                        $usr_loc = clean($_POST['usr_loc']);
     
                        $usr_profile1 = $conn->prepare("SELECT * FROM t_user WHERE u_email= ?");
                        $usr_profile1->bind_param('ss', $usr_email);
                        $usr_profile1->execute();
                        $usr_profile1Result = $usr_profile1->get_result();
                        $row = mysql_fetch_array($usr_profile1Result);

                        if(password_verify($usr_pwd, $row['u_pwd']))
                        {
         
                            $usr_update = $conn->prepare("UPDATE t_user SET u_name = ?, u_loc = ?");
                            $usr_update->bind_param('ss', $usr_name, $usr_loc);

                            if($usr_update->execute())
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
                  
<!-- ---------------------------------------------------------------------------------------------------- -->                  
                  
            <div class="tab-pane" id="pwd_setting">
                    <!-- The Password Setting Form -->
            <?php 
            if (isset($_GET['usr_id']))
            {

                $usr_id = clean($_GET['usr_id']);
                $usr_profile = $conn->prepare("SELECT * FROM t_user WHERE u_id= ?");
                $usr_profile->bind_param('s', $usr_id);
                $usr_profile->execute();
                $usr_profileResult = $usr_profile->get_result();
  
                while ($row = mysqli_fetch_array($usr_profileResult))
                {
                    ?>
        
                    <form class="form-horizontal" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    
                    <?php   
                    echo"<div class='form-group'>";
                        echo"<label for='inputName' class='col-sm-2 control-label'>Current Password</label>";
                        echo"<div class='col-sm-10'>";
                            echo"<input type='password' class='form-control' id='inputName' 
                                placeholder='Current Password'name='usr_pwd0'>";
                        echo"</div>";
                    echo"</div>";
        
                    echo" <div class='form-group'>";
                        echo"<label for='inputEmail' class='col-sm-2 control-label'>New Password</label>";
                        echo"<div class='col-sm-10'>";
                            echo"<input type='password' class='form-control' id='inputEmail' 
                                placeholder='New Password' name='usr_pwd1'> ";
                        echo"</div>";
                    echo"</div>";
        
                    echo"<div class='form-group'>";
                        echo"<label for='inputName' class='col-sm-2 control-label'>Confirm Password</label>";
                        echo"<div class='col-sm-10'>";
                            echo"<input type='password' class='form-control' id='inputName'
                                placeholder='Confirm Password' name='usr_pwd2'>";
                        echo"</div>";
                    echo"</div>";
                      
                    echo"<div class='form-group'>";
                        echo"<div class='col-sm-offset-2 col-sm-10'>";
                            echo"<button type='submit' class='btn btn-danger' name='usr_pwd_update'>Update</button> ";
                        echo"</div>";
                    echo"</div>";
                    ?>   
                    </form>
                    <?php    
                }
            }
        
            ?>
            
            <?php 
            if (isset($_POST['usr_pwd_update']))
            {
                function clean($str) 
                {
                    include ('../includes/connection.php');
                    $str = @trim($str);
                    $str = stripslashes($str);
		            return mysqli_real_escape_string($str);
                }

                $usr_pwd0 = clean($_POST['usr_pwd0']);
                $usr_pwd1 = clean($_POST['usr_pwd1']);
                $usr_pwd2 = clean($_POST['usr_pwd2']);
     
                if($usr_pwd1 === $usr_pwd2)
                {
         
                    $usr_profile1 = $conn->prepare("SELECT * FROM t_user WHERE u_email= ?");
                    $usr_profile1->bind_param('s', $usr_email);
                    $usr_profile1->execute();
                    $usr_profileResult = $usr_profile1->get_result();
                    $row = mysql_fetch_array($usr_profileResult);
     
                    if(password_verify($usr_pwd0, $row('u_pwd')))
                    {
                        $usr_pwd1Hash = password_hash($usr_pwd1, PASSWORD_ARGON2ID);
         
                        $usr_update = $conn->prepare("UPDATE t_usrin SET a_pwd = ?");
                        $usr_update->bind_param('s', $usr_pwd1Hash);
                        if($usr_update->execute())
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
                            alert('<?php die(mysqli_error($conn)) ?>'); location.href="signout.php"
                        </script>
                    
                        <?php 
                    }

                }   else {
                    ?>
                    <script language="javascript">
                        alert('<?php die(mysqli_error($conn)) ?>'); location.href="signout.php"
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
