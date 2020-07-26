<?php 
session_start();
include ('includes/connection.php');
    
if (isset($_POST['sup_login'])){

    //Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) {
		$str = @trim($str);
		$str = stripslashes($str);
		include ('includes/connection.php');
		return mysqli_real_escape_string($conn, $str);
	}
	
	//Sanitize the POST values
	$supp_mail = clean($_POST['email']);
	$supp_pwd = clean($_POST['pwd']);
        
	//Create query

	$result = $conn->prepare("SELECT * FROM t_supplier WHERE s_email= ?");
	$result->bind_param('s', $supp_mail);
	$result->execute();
	$resultResult = $result->get_result();
        
	//Check whether the query was successful or not
	if($resultResult) {
		if(mysqli_num_rows($resultResult) == 1) {
	
			$supp_member = mysqli_fetch_assoc($resultResult);

			// Encrypting Password for Security
			//$final_pwd = md5($adm_pwd);
			
			$result->close();
			$conn->close();

			if(password_verify($supp_pwd, $supp_member['s_pwd'])){

				//Login Successful

				$_SESSION['SUPP_SESS_MEMBER_ID'] = $supp_member['s_id'];
				$_SESSION['SUPP_SESS_MEMBER_NAME'] = $supp_member['s_name'];
				$_SESSION['SUPP_SESS_MEMBER_EMAIL'] = $supp_member['s_email'];
			
				session_regenerate_id();
				session_write_close();

				echo '<script language="javascript">';
                	echo 'alert("Login Successfull"); location.href="Supplier/index.php"';
				echo '</script>';

			} else {
				//Login failed 
				?>
				<script language="javascript">
					alert('<?php die(mysqli_error($conn)); ?>'); location.href="Supp_login.php";
				</script>
				<?php

			}
		} else { 
			//Login failed 
			$result->close();
			$conn->close();
            ?>
			<script language="javascript">
                alert('<?php die(mysqli_error($conn)); ?>'); location.href="Supp_login.php";
            </script>
            <?php
		}

	} else { 
		//Login failed 
		$result->close();
		$conn->close();
        ?>
		<script language="javascript">
            alert('<?php die(mysqli_error($conn)); ?>'); location.href="Supp_login.php";
        </script>
        <?php
	}
	
} else { 
			
    ?>
	<script language="javascript">
        alert('<?php die(mysqli_error($conn)); ?>'); location.href="Supp_login.php";
    </script>
    <?php
}

?>
 

