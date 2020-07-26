<?php
//Include database connection details
include 'includes/connection.php';
        
//Start session
session_start();
	 
	
if(isset($_POST['user_reg']))
{
   
    
  //Function to sanitize placeholders received from the form. Prevents SQL injection
  function clean($str) {
	  $str = @trim($str);
    $str = stripslashes($str);

    include ('includes/connection.php');
    
		return mysqli_real_escape_string($conn, $str);
	}
  
  //Sanitize the POST placeholders  
  $usr_name  = clean($_POST['name']);
  $usr_mail  = clean($_POST['e_mail']);
  $usr_pwd0  = clean($_POST['pwd0']);
  $usr_pwd1  = clean($_POST['pwd1']);
  $usr_mobe  = clean($_POST['mob']);
  $usr_state = clean($_POST['state']);
  $usr_add   = clean($_POST['add']);
  $usr_land  = clean($_POST['land']);
  $usr_city  = clean($_POST['city']);
  $usr_zip   = clean($_POST['zip']);  
  
  if (strcasecmp($usr_pwd0, $usr_pwd1)==0)
  {  //$usr_pwd0 = md5($usr_pwd0);
        
    $usr_pwd0Hash = password_hash($usr_pwd0, PASSWORD_ARGON2ID);
       
    if (strlen($usr_mobe)==10 && password_verify($usr_pwd0, $usr_pwd0Hash))
    {
        
      $save_user_date = $conn->prepare("INSERT INTO t_user "
        . "(u_name, u_email, u_pwd, u_mob, u_city, u_land, u_state, u_add, u_zip)"
        . "VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)"
      );

      $save_user_date->bind_param("sssssssss", $usr_name, $usr_mail, $usr_pwd0Hash, $usr_mobe, $usr_city, $usr_land,$usr_state,$usr_add, $usr_zip);

      if($save_user_date->execute())
      {

        $save_user_date->close();
        $conn->close();

        ?>
        <script language="javascript">
          alert('Registration Successfull'); location.href="login.php";
        </script>;

        <?php 
      } else {
        ?>

        <script language="javascript">
          alert("<?php die(mysqli_error($conn)) ?>"); location.href="register.php";
        </script>;
        
        <?php

        $save_user_date->close();
        $conn->close();
      }
            
    } else {

        ?>
      <script language="javascript">
        alert('Mobile no. should be of 10 digits '); location.href="register.php";
      </script>;

    <?php
    }
  } else { 
    ?>
    <script language="javascript">
      alert('Confirmation Password Not Matched '); location.href="register.php";
    </script>;

    <?php
  }

}
    

?>
