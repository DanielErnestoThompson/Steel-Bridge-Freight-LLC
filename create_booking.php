<?php
// Step 1: Database Connection
$servername = "localhost";
$username = "root";
$password = "2268";
$dbname = "steel_bridge";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $client_id = $_POST['client_id'];
    $carrier_id = $_POST['carrier_id'];
    $booking_date = $_POST['booking_date'];
    $status = 'Pending'; // Default status

    // Insert booking record
    $stmt = $conn->prepare("INSERT INTO bookings (client_id, carrier_id, booking_date, status) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiss", $client_id, $carrier_id, $booking_date, $status);

    if ($stmt->execute()) {
        echo "Booking created successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
$conn->close();
?>
