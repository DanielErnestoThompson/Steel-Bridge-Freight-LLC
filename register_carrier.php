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

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $truck_type = $_POST['truck_type'];
    $availability = $_POST['availability'];
    $rate = $_POST['rate'];

    $sql = "INSERT INTO carriers (name, truck_type, availability, rate) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssd", $name, $truck_type, $availability, $rate);

    if ($stmt->execute()) {
        echo "New carrier registered successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register Carrier</title>
</head>
<body>
    <h2>Register a New Carrier</h2>
    <form method="POST" action="register_carrier.php">
        <label for="name">Name:</label>
        <input type="text" name="name" required><br>

        <label for="truck_type">Truck Type:</label>
        <input type="text" name="truck_type"><br>

        <label for="availability">Availability (YYYY-MM-DD):</label>
        <input type="date" name="availability"><br>

        <label for="rate">Rate:</label>
        <input type="number" step="0.01" name="rate"><br>

        <button type="submit">Register</button>
    </form>
</body>
</html>
