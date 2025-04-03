<?php
// Keren Medina Costa 03/04/2025

include 'conn.php';

$dni = strtoupper($_POST['dni']);

// select the dni from the database
$sql = "SELECT * FROM patients WHERE dni = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $dni);
$stmt->execute();
$result = $stmt->get_result();

// check if the dni exists in the database
if ($result->num_rows > 0) {
    $success = true;
} else {
    $success = false;
}

// response in json
echo json_encode(array(
    'success' => $success
));


$stmt->close();
$conn->close();
?>
