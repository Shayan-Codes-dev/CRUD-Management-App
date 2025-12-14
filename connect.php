<?php
$host = "localhost";
$username = "root";
$password = null;
$database = "crud";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Error in connection" . mysqli_connect_error());
}
else{
    // echo "Connection successfull";
}

?>