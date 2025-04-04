<?php
// Keren Medina Costa 03/04/2025

include 'conn.php';

// get form data
$name = $_POST['name'];
$dni = strtoupper($_POST['dni']);
$phone = $_POST['phone'];
$email = $_POST['email'];
$appointment_type = $_POST['appointment_type'];

//check if patient exists
$sql = "SELECT id FROM patients WHERE dni = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $dni);
$stmt->execute();
$result = $stmt->get_result();

//insert patient if not exists
if ($result->num_rows == 0) {
    $insertPatient = "INSERT INTO patients (name, dni, phone, email) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($insertPatient);
    $stmt->bind_param("ssss", $name, $dni, $phone, $email);
    $stmt->execute();
}

// get the first free date and hour
function getDateTime($conn)
{
    $initTime = date("H:i:s", mktime(10, 0, 0));
    $endTime = date("H:i:s", mktime(22, 0, 0)); 
    $currentDate = date("Y-m-d");
    $currentTime = date("H") . ":00:00";

    // select the last appointment in the ddbb
    $sql = "SELECT date_appointment, time_appointment FROM appointment ORDER BY date_appointment DESC, time_appointment DESC LIMIT 1 for update";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        //last appointment
        $lastDate = $row['date_appointment'];
        $lastHour = $row['time_appointment'];

        //set the next hour
        $newTimeStamp = strtotime("+1 hour", strtotime($lastHour));
        $newTime = date("H:i:s", $newTimeStamp);

        if ($newTime > $endTime) {
            // If it is over 10:00 PM assign the next day at 10:00 AM.
            $newDate = date("Y-m-d", strtotime("+1 day", strtotime($lastDate)));
            $newTime = $initTime;
        } else {

            $newDate = $lastDate;
        }
    } else {
        // not appointments before (first appointment)
        if ($currentTime < $initTime) {
            // if current hour is before 10:00 assing current day 10:00
            $newDate = $currentDate;
            $newTime = $initTime;
        } elseif ($currentTime > $endTime) {
            // if current date is after 22:00 assing next day 10:00
            $newDate = date("Y-m-d", strtotime("+1 day", strtotime($currentDate)));
            $newTime = $initTime;
        } else {
            $newDate = $currentDate;
            $newTime = $currentTime;
        }
    }

    return [$newDate, $newTime];
}

$new = getDateTime($conn);

$appointmentDate = $new[0];
$appointmentTime = $new[1];


$sqlApp = "INSERT INTO appointment (id_patient, appointment_type, date_appointment, time_appointment) 
                  VALUES ((SELECT id FROM patients WHERE dni = ?), ?, ?, ?)";
$stmt = $conn->prepare($sqlApp);
$stmt->bind_param("ssss", $dni, $appointment_type, $appointmentDate, $appointmentTime);
$stmt->execute();


echo json_encode(array(
    'success' => true,
    'appointmentDate' => $appointmentDate,
    'appointmentTime' => $appointmentTime
));

$stmt->close();
$conn->close();
?>