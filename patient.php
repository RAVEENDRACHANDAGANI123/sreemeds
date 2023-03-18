<?php
$serverName = "tcp:sreemeds.database.windows.net,1433";
$connectionOptions = array(
    "Database" => "patient_db",
    "Uid" => "CloudSAef56091e",
    "PWD" => "{your_password}",
    "Encrypt" => "yes"
);
$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}

if (isset($_POST['Location']) && isset($_POST['Phone']) && isset($_POST['Email']) && isset($_POST['Text']) && isset($_POST['Time'])) {
    $location = $_POST['Location'];
    $phone = $_POST['Phone'];
    $email = $_POST['Email'];
    $date = $_POST['Text'];
    $time = $_POST['Time'];

    $sql = "INSERT INTO patient_db (location, phone, email, date, time) VALUES (?, ?, ?, ?, ?)";
    $params = array($location, $phone, $email, $date, $time);
    $stmt = sqlsrv_prepare($conn, $sql, $params);

    if (sqlsrv_execute($stmt) === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    echo "Appointment booked successfully!";
}

sqlsrv_close($conn);
?>
