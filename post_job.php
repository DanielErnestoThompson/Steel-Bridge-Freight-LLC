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
    $client_id = $_POST['client_id']; // Ensure this is provided (e.g., hidden input in the form)
    $origin = $_POST['pickup'];
    $destination = $_POST['dropoff'];
    $equipment_type = $_POST['equipment'];
    $weight = $_POST['weight'];
    $dimensions = $_POST['dimensions'];
    $date_range = $_POST['date_range'];
    $notes = $_POST['notes'];

    // Insert job into the jobs table
    $sql = "INSERT INTO jobs (client_id, origin, destination, equipment_type, weight, dimensions, pickup_date, carrier_id, status)
            VALUES (?, ?, ?, ?, ?, ?, ?, NULL, 'Open')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issssss", $client_id, $origin, $destination, $equipment_type, $weight, $dimensions, $date_range);

    if ($stmt->execute()) {
        header("Location: view_jobs.php?success=1"); // Redirect to job listing page
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
