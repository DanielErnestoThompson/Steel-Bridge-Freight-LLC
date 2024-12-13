<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrier Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php
    session_start();
    if (!isset($_SESSION['carrier_id'])) {
        header("Location: login_carrier.html");
        exit;
    }
    ?>
    <h1>Welcome, <?php echo $_SESSION['carrier_name']; ?>!</h1>
    <p>Here are the available jobs you can accept:</p>

    <table border="1">
        <thead>
            <tr>
                <th>Job ID</th>
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
            // Fetch available jobs
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "steel_bridge";

            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM jobs WHERE status = 'Open'";
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
                            <td>{$row['status']}</td>
                            <td>
                                <form action='accept_job.php' method='POST'>
                                    <input type='hidden' name='job_id' value='{$row['id']}'>
                                    <button type='submit'>Accept</button>
                                </form>
                            </td>
                          </tr>";
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
