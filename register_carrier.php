<?php
// Database connection
$host = 'localhost';
$db = 'your_database_name';
$user = 'your_database_user';
$pass = 'your_database_password';

$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect form data
$carrier_name = $_POST['carrier_name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$license_plate = $_POST['license_plate'];
$dot_number = $_POST['dot_number'];
$mc_number = $_POST['mc_number'];
$company_name = $_POST['company_name'];

// Insert data into the database
$sql = "INSERT INTO carriers (carrier_name, email, phone, license_plate, dot_number, mc_number, company_name)
        VALUES ('$carrier_name', '$email', '$phone', '$license_plate', '$dot_number', '$mc_number', '$company_name')";

if ($conn->query($sql) === TRUE) {
    echo "Carrier registered successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$conn->close();
?>
