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
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $company_name = $_POST['company_name'];

    // Check if email already exists
    $checkEmail = $conn->prepare("SELECT id FROM clients WHERE email = ?");
    $checkEmail->bind_param("s", $email);
    $checkEmail->execute();
    $checkEmail->store_result();

    if ($checkEmail->num_rows > 0) {
        echo "A client with this email already exists.";
    } else {
        // Insert new client record
        $stmt = $conn->prepare("INSERT INTO clients (name, email, phone, company_name) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $phone, $company_name);

        if ($stmt->execute()) {
            echo "Client registered successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
    $checkEmail->close();
}
$conn->close();
?>
