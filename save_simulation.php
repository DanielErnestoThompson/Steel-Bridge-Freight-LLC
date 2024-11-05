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
    $client_id = $_POST['client_id']; // Can be NULL if anonymous
    $input_data = $_POST['input_data']; // JSON string
    $results = $_POST['results']; // JSON string with the simulation results

    // Insert simulation record
    $stmt = $conn->prepare("INSERT INTO simulations (client_id, input_data, results) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $client_id, $input_data, $results);

    if ($stmt->execute()) {
        echo "Simulation data saved successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
$conn->close();
?>
