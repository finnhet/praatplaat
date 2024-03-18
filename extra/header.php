<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Website Title</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        header {
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
        }

        .logo h1 {
            margin: 0;
            font-size: 24px;
            color: #333;
        }

        .login-button {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;
        }

        .login-button:hover {
            background-color: #555;
        }
    </style>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<header>
    <div class="container">
        <div class="logo">
            <h1>Praatplaat</h1>
        </div>
        <nav>
            <a class="login-button" href="login.php">Login</a>
        </nav>
    </div>
</header>

</body>
</html>
