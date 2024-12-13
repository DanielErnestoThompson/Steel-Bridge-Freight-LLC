<?php
session_start();
if (!isset($_SESSION['carrier_id'])) {
    header("Location: login_carrier.html");
    exit;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "steel_bridge";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $job_id = $_POST['job_id'];
    $carrier_id = $_SESSION['carrier_id'];

    $sql = "UPDATE jobs SET status = 'Accepted', carrier_id = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $carrier_id, $job_id);

    if ($stmt->execute()) {
        echo "Job accepted successfully!";
        header("Location: carrier_dashboard.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
