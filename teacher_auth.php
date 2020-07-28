<?php 
session_start();
include ('includes/connection.php');
    
if (isset($_POST['adm_login'])) {
       
    //Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) {
		$str = @trim($str);
		$str = stripslashes($str);
		include ('includes/connection.php');
		return mysqli_real_escape_string($conn, $str);
	}
	
	//Sanitize the POST values
	$adm_mail = clean($_POST['email']);
	$adm_pwd = clean($_POST['pwd']);
        
	//Create query
	
	$result = $conn->prepare("SELECT * FROM t_teach WHERE t_email= ?");
	$result->bind_param('s', $adm_mail);
	$result->execute();
	$resultResult = $result->get_result();
        
	//Check whether the query was successful or not
	if($resultResult) {
		if(mysqli_num_rows($resultResult) == 1) {

			$adm_member = mysqli_fetch_assoc($resultResult);

			// Encrypting Password for Security
			//$final_pwd = md5($adm_pwd);
			
			$result->close();
			$conn->close();

			if(password_verify($adm_pwd, $adm_member['t_pwd'])){

				//Login Successful
			
				$_SESSION['TEACH_SESS_MEMBER_ID'] = $adm_member['t_email'];
				$_SESSION['TEACH_SESS_MEMBER_NAME'] = $adm_member['t_name'];
				$_SESSION['TEACH_SESS_MEMBER_LOC'] = $adm_member['t_loc'];
				
				session_regenerate_id();
				session_write_close();

				echo '<script language="javascript">';
                    echo 'alert("Login Successfull"); location.href="Teacher/index.php"';
				echo '</script>';
			} else {

				//Login failed 
				?>
				<script language="javascript">
					alert("Bad Password"); location.href="Teacher_login.php";
				</script>
				<?php
			}

		}else { 
			//Login failed 
			$result->close();
			$conn->close();
            ?>
			<script language="javascript">
                alert("Login failed"); location.href="Teacher_login.php";
            </script>
            <?php
		}

	} else {
		$result->close();
		$conn->close();
		die("Query failed");
	}

} else { 		
    ?>
	<script language="javascript">
        alert('<?php die(mysqli_error($conn)); ?>'); location.href="Teacher_login.php";
    </script>
    <?php
}

?>
 