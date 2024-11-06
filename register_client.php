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
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $company_name = $_POST['company_name'];

    $sql = "INSERT INTO clients (name, email, phone, company_name) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $email, $phone, $company_name);

    if ($stmt->execute()) {
        echo "New client registered successfully.";
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
    <title>Register Client</title>
</head>
<body>
    <h2>Register a New Client</h2>
    <form method="POST" action="register_client.php">
        <label for="name">Name:</label>
        <input type="text" name="name" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br>

        <label for="phone">Phone:</label>
        <input type="text" name="phone"><br>

        <label for="company_name">Company Name:</label>
        <input type="text" name="company_name"><br>

        <button type="submit">Register</button>
    </form>
</body>
</html>
