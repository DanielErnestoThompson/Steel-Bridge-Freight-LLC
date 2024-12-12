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
                <th>Equipment Type</th>
                <th>Weight</th>
                <th>Dimensions</th>
                <th>Pickup Date</th>
                <th>Dropoff Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
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

        // Fetch jobs
        $sql = "SELECT * FROM jobs";
        $result = $conn->query($sql);

        if ($result) {
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
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='9'>No jobs available</td></tr>";
            }
        } else {
            echo "<tr><td colspan='9'>Error fetching jobs: " . $conn->error . "</td></tr>";
        }

        $conn->close();
        ?>
        </tbody>
    </table>
</body>
</html>
