<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "private_jets";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
