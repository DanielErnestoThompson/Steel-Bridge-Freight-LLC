<?php
// Database connection
$servername = "localhost";  // Change if necessary
$username = "root";         // Default XAMPP MySQL username
$password = "";             // Default XAMPP MySQL password
$dbname = "steel_bridge";   // Database name

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Fetch carrier data
    $sql = "SELECT * FROM carriers WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $carrier = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $carrier['password'])) {
            session_start();
            $_SESSION['carrier_id'] = $carrier['id'];
            $_SESSION['carrier_name'] = $carrier['carrier_name'];
            header("Location: carrier_dashboard.php");
            exit;
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No carrier found with that email.";
    }

    $stmt->close();
}

$conn->close();
?>
