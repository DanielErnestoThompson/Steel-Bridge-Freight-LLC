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

// Handle search request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $origin = $_POST['origin'];
    $destination = $_POST['destination'];
    $equipment = $_POST['equipment'];

    // Prepare SQL query
    $sql = "SELECT * FROM jobs WHERE pickup = ? AND dropoff = ? AND equipment = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $origin, $destination, $equipment);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "Job ID: " . $row['id'] . "<br>";
            echo "Pickup: " . $row['pickup'] . "<br>";
            echo "Dropoff: " . $row['dropoff'] . "<br>";
            echo "Equipment: " . $row['equipment'] . "<br>";
            echo "Weight: " . $row['weight'] . "<br>";
            echo "Dimensions: " . $row['dimensions'] . "<br>";
            echo "Pickup Date: " . $row['pickup_date'] . "<br>";
            echo "Dropoff Date: " . $row['dropoff_date'] . "<br>";
            echo "Status: " . $row['status'] . "<br><br>";
        }
    } else {
        echo "No jobs found matching your criteria.";
    }

    $stmt->close();
}

$conn->close();
?>
