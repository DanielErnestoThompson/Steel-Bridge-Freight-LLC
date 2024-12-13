<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "steel_bridge";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM carriers WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $carrier = $result->fetch_assoc();
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
