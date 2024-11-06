<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register as a Client</title>
    <link rel="stylesheet" href="css/style.css"> <!-- Link to your main CSS file -->
</head>
<body>
    <div class="form-container">
        <h2>Register a New Client</h2>
        <form action="register_client.php" method="POST">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" required>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>

            <label for="phone">Phone:</label>
            <input type="text" name="phone" id="phone" required>

            <label for="company_name">Company Name:</label>
            <input type="text" name="company_name" id="company_name" required>

            <button type="submit" class="submit-button">Register</button>
        </form>
    </div>
</body>
</html>
