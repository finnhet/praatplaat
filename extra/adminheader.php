<?php


// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}

// Logout logic
if (isset($_POST['logout'])) {
    // Unset all session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    // Redirect to login page
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <style>
        .logout-button {
            padding: 8px 16px;
            margin-top: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
            float: right;
        }
        .logout-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <header style="position: absolute; top: 0; right: 0;">
        <form method="post">
            <button class="logout-button" type="submit" name="logout">Logout</button>
        </form>
    </header>
</body>
</html>