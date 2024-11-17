<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register as a Carrier</title>
    <link rel="stylesheet" href="css/style.css"> <!-- Link to your main CSS file -->
</head>
<body>
    <div class="form-container">
        <h2>Register a New Carrier</h2>
        <form action="register_carrier.php" method="POST">
            <label for="carrier_name">Carrier Name:</label>
            <input type="text" name="carrier_name" id="carrier_name" required>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>

            <label for="phone">Phone:</label>
            <input type="text" name="phone" id="phone" required>

            <label for="license_plate">License Plate:</label>
            <input type="text" name="license_plate" id="license_plate" required>

            <label for="dot_number">DOT Number:</label>
            <input type="text" name="dot_number" id="dot_number" required>

            <label for="mc_number">MC Number:</label>
            <input type="text" name="mc_number" id="mc_number" required>

            <label for="company_name">Company Name:</label>
            <input type="text" name="company_name" id="company_name" required>

            <button type="submit" class="submit-button">Register</button>
        </form>
    </div>
</body>
</html>
