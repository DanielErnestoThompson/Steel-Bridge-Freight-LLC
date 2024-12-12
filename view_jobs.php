<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Jobs</title>
    <link rel="stylesheet" href="css/style.css"> <!-- Link to your CSS -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f8f9fa;
            color: #333;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #007bff;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #fff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        table th, table td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }
        table th {
            background-color: #007bff;
            color: #fff;
        }
        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .no-data {
            text-align: center;
            padding: 20px;
            color: #888;
        }
    </style>
</head>
<body>
    <h1>Job Board</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Pickup Location</th>
                <th>Dropoff Location</th>
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
        $sql = "SELECT id, pickup, dropoff, equipment, weight, dimensions, pickup_date, dropoff_date, status FROM jobs";
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
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='9' class='no-data'>No jobs available</td></tr>";
        }

        $conn->close();
        ?>
        </tbody>
    </table>
</body>
</html>
