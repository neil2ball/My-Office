<?php 
session_start();
include ('includes/connection.php');

if (isset($_POST['usr_login'])){
       
    //Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) {
		$str = @trim($str);
		$str = stripslashes($str);
		include ('includes/connection.php');
		return mysqli_real_escape_string($conn, $str);
	}
	
	//Sanitize the POST values
	$usr_mail = clean($_POST['email']);
	$usr_pwd = clean($_POST['pwd']);

	//Create query
	      
	$result = $conn->prepare("SELECT * FROM t_user WHERE u_email= ?");
	$result->bind_param('s', $usr_mail);
	$result->execute();
	$resultResult = $result->get_result();
	
	//Check whether the query was successful or not
	if($resultResult) {
		if(mysqli_num_rows($resultResult) == 1) {

			$usr_member = mysqli_fetch_assoc($resultResult);
	        
    		// Encrypting Password for Security
			//$usr_pwd = md5($usr_pwd);
			
            $result->close();
			$conn->close();
			
			if(password_verify($usr_pwd, $usr_member['u_pwd'])){

				//Login Successful

				$_SESSION['USR_SESS_MEMBER_ID'] = $usr_member['u_id'];
				$_SESSION['USR_SESS_MEMBER_NAME'] = $usr_member['u_name'];
				$_SESSION['USR_SESS_MEMBER_EMAIL'] = $usr_member['u_email'];
				
				session_regenerate_id();
				session_write_close();
				
				echo '<script language="javascript">';
                        echo 'alert("Login Successfull"); location.href="User/index.php"';
				echo '</script>';
			} else {
				//Login failed 
				?>
				<script language="javascript">
					alert("Bad Password"); location.href="login.php";
				</script>
				<?php	
			}
		} else { 
			//Login failed 
			$result->close();
			$conn->close();
            ?>
			<script language="javascript">
                alert("Login failed"); location.href="login.php";
            </script>
            <?php
		}
	} else { 
		//Login failed 
		$result->close();
		$conn->close();
        ?>
		<script language="javascript">
            alert("error in Query execution"); location.href="login.php";
        </script>
        <?php
	}
} else { 	
    ?>
	<script language="javascript">
        alert("Error in connection"); location.href="login.php";
    </script>
    <?php
}

?>
