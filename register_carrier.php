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
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

// Insert data into the database
$sql = "INSERT INTO carriers (carrier_name, email, phone, license_plate, dot_number, mc_number, company_name, password)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "ssssssss",
    $carrier_name,
    $email,
    $phone,
    $license_plate,
    $dot_number,
    $mc_number,
    $company_name,
    $password
);

if ($stmt->execute()) {
    echo "Carrier registered successfully!";
} else {
    echo "Error: " . $stmt->error;
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
