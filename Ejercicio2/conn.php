<?php
// Keren Medina Costa 03/04/2025

$servername = "db";
$username = "keren";
$password = "keren1234";
$dbname = "clinic";

// create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// check connection
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>