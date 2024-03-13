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
            background-color: #f0f0f0; /* Adding a background color for better contrast */
        }

        /* Improved header styles */
        header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Adding a subtle shadow */
        }

        .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
        }

        .menu ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
        }

        .menu ul li {
            margin-left: 20px; /* Adjusting spacing between menu items */
        }

        .menu ul li:first-child {
            margin-left: 0; /* Removing margin for the first menu item */
        }

        .menu ul li a {
            color: #fff;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .menu ul li a:hover {
            color: #ffd700; /* Change color on hover */
        }

        .login-button {
            background-color: #ffd700;
            color: #333;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .login-button:hover {
            background-color: #ffc107; /* Darken the color on hover */
        }
    </style>
    <link rel="stylesheet" href="styles.css"> <!-- If you have additional styles -->
</head>
<body>

<header>
    <div class="container">
        <div class="logo">
            <h1>Praatplaat</h1> <!-- Text instead of logo -->
        </div>
        <div class="menu">
            <ul>
                
            </ul>
        </div>
        <li><a class="login-button"href="login.php">Login</a></li>
       
    </div>
</header>

<!-- Your website content goes here -->

</body>
</html>
