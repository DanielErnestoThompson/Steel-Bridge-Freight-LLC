<?php
// Database connection
$servername = "localhost";  // Change if necessary
$username = "root";         // Default XAMPP MySQL username
$password = "";             // Default XAMPP MySQL password (leave blank)
$dbname = "steel_bridge";   // Database name

$conn = new mysqli($servername, $username, $password, $dbname);

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
