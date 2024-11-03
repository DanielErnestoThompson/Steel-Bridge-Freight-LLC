<?php
// Step 1: Database Connection
$servername = "localhost";  // Replace with your server details
$username = "root";         // Replace with your MySQL username
$password = "2268";         // Replace with your MySQL password
$dbname = "steel_bridge";   // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Step 2: Handle Form Submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $truck_type = $_POST['truck_type'];
    $availability = $_POST['availability'];
    $rate = $_POST['rate'];

    // Basic input validation
    if (empty($name) || empty($truck_type) || empty($availability) || !is_numeric($rate)) {
        echo "Please fill in all fields and ensure the rate is a number.";
    } else {
        // Use a prepared statement to insert data
        $stmt = $conn->prepare("INSERT INTO carriers (name, truck_type, availability, rate) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $truck_type, $availability, $rate);

        if ($stmt->execute()) {
            echo "Carrier registered successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }
}

// Close the connection
$conn->close();
?>

<!-- Step 3: HTML Form -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register as Carrier</title>
</head>
<body>
    <h2>Carrier Registration</h2>
    <form method="POST" action="register_carrier.php">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required><br><br>

        <label for="truck_type">Truck Type:</label>
        <input type="text" name="truck_type" id="truck_type" required><br><br>

        <label for="availability">Availability (e.g., dates):</label>
        <input type="text" name="availability" id="availability" required><br><br>

        <label for="rate">Rate:</label>
        <input type="text" name="rate" id="rate" required><br><br>

        <button type="submit">Register</button>
    </form>
</body>
</html>
