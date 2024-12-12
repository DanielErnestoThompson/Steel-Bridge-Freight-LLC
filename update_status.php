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

// Handle status update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $job_id = $_POST['job_id'];
    $new_status = $_POST['status'];

    $sql = "UPDATE jobs SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $new_status, $job_id);

    if ($stmt->execute()) {
        echo "Job status updated successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
