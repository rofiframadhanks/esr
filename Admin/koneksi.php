<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "efr";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if ($conn->connect_error){
    die("Conncection Failed: " . $conn->connect_error);
}
?>