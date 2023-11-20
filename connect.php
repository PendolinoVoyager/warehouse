<?php
$username = "tester";
$password = "Abcd1234!";
$server = "localhost";
$database = "warehouse";
$conn = new mysqli($server, $username, $password, $database);
if ($conn->connect_error) {
    die("ERROR: Connection failed. ". $conn->connect_error);
}
?>