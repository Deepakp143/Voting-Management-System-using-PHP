<!DOCTYPE html>
<html>
<head>
    <title>Register Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: white;
        }

        .container {
            max-width: 300px;
            left: 10%;
            margin: 150px 150px;
            padding: 50px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
        }

        .container h2 {
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input[type="text"],
        .form-group input[type="text"],
        .form-group input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-group input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            border: none;
            color: #fff;
            cursor: pointer;
            font-weight: bold;
            border-radius: 4px;
        }
    </style>
</head>
<?php
session_start();

if (isset($_SESSION['login_id'])) {
    header("location: index.php?page=home");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $name = $_POST['name'];
    $password = $_POST['password'];

    // Create a new database connection
    $host = 'localhost';
    $dbUsername = 'root';
    $dbPassword = '';
    $dbName = 'voting_db';

    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute the query to insert the registration details into 'users' table
    $stmt = $conn->prepare("INSERT INTO users (username, name, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);
    $stmt->execute();

    // Close the prepared statement and database connection
    $stmt->close();
    $conn->close();

    // Redirect to the desired page after successful registration
    header("location: index.php?page=success");
    exit;
}
?>
<!-- Your HTML registration form here -->


<body>
    <div class="container">
        <h2>Register</h2>
        <form action="register.php" method="post">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="username" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Register">
            </div>
        </form>
    </div>
</body>
</html>
