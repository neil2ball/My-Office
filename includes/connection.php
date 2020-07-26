<?php

$server = "localhost";
$username ="root";
$password ="password";
$database_name="my_office";

$conn = mysqli_connect($server, $username, $password);
$select_db = mysqli_select_db($conn, $database_name) or die (mysqli_error($conn));


?>
