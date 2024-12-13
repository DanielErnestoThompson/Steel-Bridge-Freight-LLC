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

// Handle job acceptance
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accept_job_id'])) {
    $job_id = intval($_POST['accept_job_id']);
    $carrier_id = 1; // Replace with the logged-in carrier's ID

    $sql = "UPDATE jobs SET status = 'Accepted', carrier_id = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $carrier_id, $job_id);

    if ($stmt->execute()) {
        echo "<p>Job ID {$job_id} accepted successfully!</p>";
    } else {
        echo "<p>Error accepting job: " . $stmt->error . "</p>";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Jobs</title>
    <link rel="stylesheet" href="css/style.css"> <!-- Link to your CSS -->
</head>
<body>
    <h1>Job Board</h1>
    <table border="1" cellspacing="0" cellpadding="10">
        <thead>
            <tr>
                <th>ID</th>
                <th>Pickup</th>
                <th>Dropoff</th>
                <th>Equipment</th>
                <th>Weight</th>
                <th>Dimensions</th>
                <th>Pickup Date</th>
                <th>Dropoff Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
        // Fetch jobs
        $sql = "SELECT * FROM jobs";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['pickup']}</td>
                        <td>{$row['dropoff']}</td>
                        <td>{$row['equipment']}</td>
                        <td>{$row['weight']}</td>
                        <td>{$row['dimensions']}</td>
                        <td>{$row['pickup_date']}</td>
                        <td>{$row['dropoff_date']}</td>
                        <td>{$row['status']}</td>";
                
                // Display "Accept Job" button only if the job is open
                if ($row['status'] === 'Open') {
                    echo "<td>
                            <form method='POST' action=''>
                                <input type='hidden' name='accept_job_id' value='{$row['id']}'>
                                <button type='submit'>Accept Job</button>
                            </form>
                          </td>";
                } else {
                    echo "<td>-</td>";
                }
                
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='10'>No jobs available</td></tr>";
        }

        $conn->close();
        ?>
        </tbody>
    </table>
</body>
</html>
