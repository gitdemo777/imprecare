<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "JangoMoney";

// Create connection
$conn = mysql_connect($servername, $username, $password);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
mysql_select_db( $database );
?>