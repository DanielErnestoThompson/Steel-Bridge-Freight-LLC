<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "steel_bridge";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pickup = $_POST['pickup'];
    $dropoff = $_POST['dropoff'];
    $equipment = $_POST['equipment'];
    $weight = $_POST['weight'];
    $dimensions = $_POST['dimensions'];
    $pickup_date = $_POST['pickup_date'];
    $dropoff_date = $_POST['dropoff_date'];
    $notes = $_POST['notes'];

    // Insert job into the jobs table with the default status 'Open'
    $sql = "INSERT INTO jobs (pickup, dropoff, equipment, weight, dimensions, pickup_date, dropoff_date, notes, status)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'Open')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssss", $pickup, $dropoff, $equipment, $weight, $dimensions, $pickup_date, $dropoff_date, $notes);

    if ($stmt->execute()) {
        echo "Job successfully posted!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
