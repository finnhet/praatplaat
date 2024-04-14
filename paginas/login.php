<?php
// Start session
session_start();

// Database credentials
$servername = "localhost";
$username = "deb85590_p32k1tb";
$password = "7v5UgRa9DGXdRRtn4tGN";
$dbname = "deb85590_p32k1tb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // SQL query to fetch user from database
    $sql = "SELECT id FROM gebruikers WHERE Naam='$username' AND Wachtwoord='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Authentication successful
        // Set session variables
        $_SESSION['username'] = $username;
        // Redirect to dashboard
        header('Location: index.php');
        exit();
    } else {
        // Authentication failed
        echo "<script>alert('Invalid username or password.');</script>";
    }
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f3f3f3;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        
        .logo img {
            height: 40px;
            width: auto;
        }

        .navbar ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        .navbar ul li {
            display: inline;
            margin-right: 20px;
        }

        .navbar ul li a {
            color: #fff;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .navbar ul li a:hover {
            color: #ffd700;
        }

        .login-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 400px;
            max-width: 90%;
            text-align: center;
            margin-top: 80px; /* Adjusted to accommodate header */
        }

        h2 {
            margin-bottom: 30px;
            color: #333;
        }

        input[type="text"],
        input[type="password"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        input[type="submit"],
        .btn {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover,
        .btn:hover {
            background-color: #0056b3;
        }

        .signup-link {
            margin-top: 20px;
            font-size: 14px;
        }

        .signup-link a {
            color: #007bff;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .signup-link a:hover {
            color: #0056b3;
        }

        .back-button {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
        }

        .back-button:hover {
            background-color: #ffd700;
            color: #333;
        }
    </style>
</head>
<body>
<div class="login-container">
    <h2>Login</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="submit" value="Login">
    </form>
</div>
<a href="index.php" class="back-button">Terug</a>
</body>
</html>
