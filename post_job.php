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
    // Retrieve form data
    $pickup = $_POST['pickup'];
    $dropoff = $_POST['dropoff'];
    $equipment = $_POST['equipment'];
    $weight = $_POST['weight'];
    $dimensions = $_POST['dimensions'];
    $pickup_date = $_POST['pickup_date'];
    $dropoff_date = $_POST['dropoff_date'];
    $notes = isset($_POST['notes']) ? $_POST['notes'] : ''; // Optional field

    // Insert job into the jobs table
    $sql = "INSERT INTO jobs (pickup, dropoff, equipment, weight, dimensions, pickup_date, dropoff_date, notes, status)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'Open')";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("ssssssss", $pickup, $dropoff, $equipment, $weight, $dimensions, $pickup_date, $dropoff_date, $notes);

    if ($stmt->execute()) {
        // Redirect to a success page or show a success message
        header("Location: view_jobs.php?success=1");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
