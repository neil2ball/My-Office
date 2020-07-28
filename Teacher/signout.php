<?php
	//Start session
	session_start();
	
	//Unset the variables stored in session
	unset($_SESSION['TEACH_SESS_MEMBER_ID']);
	unset($_SESSION['TEACH_SESS_MEMBER_NAME']);
        unset($_SESSION['TEACH_SESS_MEMBER_LOC']);
      
       echo '<script language="javascript">';
        echo 'alert("Successfully Logout"); location.href="../Teacher_login.php"';
        echo '</script>';
?>
