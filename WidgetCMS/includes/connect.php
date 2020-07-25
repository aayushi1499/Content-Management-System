<?php

$conn = mysqli_connect("localhost","root","");

if (!$conn) {
    error_log("Failed to connect to MySQL: " . mysqli_error($conn));
    die('Internal server error');
}


$db_select = mysqli_select_db($conn,"cms");
if (!$db_select) {
    error_log("Database selection failed: " . mysqli_error($conn));
    die('Internal server error');
}

?>