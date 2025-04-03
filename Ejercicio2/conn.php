<?php
// Keren Medina Costa 03/04/2025

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clinic";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>