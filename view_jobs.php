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
                <th>Origin</th>
                <th>Destination</th>
                <th>Equipment Type</th>
                <th>Weight</th>
                <th>Dimensions</th>
                <th>Pickup Date</th>
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

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['origin']}</td>
                        <td>{$row['destination']}</td>
                        <td>{$row['equipment_type']}</td>
                        <td>{$row['weight']}</td>
                        <td>{$row['dimensions']}</td>
                        <td>{$row['pickup_date']}</td>
                        <td>{$row['status']}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='8'>No jobs available</td></tr>";
        }

        $conn->close();
        ?>
        </tbody>
    </table>
</body>
</html>
