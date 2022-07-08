<?php
$servername = "localhost";
$username   = "moneymon_277088_mytutor_db";
$password   = "573#VRG(5LKR";
$dbname     = "moneymon_277088_mytutor_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>