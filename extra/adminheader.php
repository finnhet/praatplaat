<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Panel</title>
<style>
/* CSS Styles */
body {
    margin: 0;
    font-family: Arial, sans-serif;
}

.admin-header {
    background-color: #2c3e50; /* Dark blue */
    color: #fff; /* Text color */
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.brand h1 {
    margin: 0;
    font-size: 1.5rem;
}

.admin-nav ul {
    list-style: none;
    margin: 0;
    padding: 0;
}

.admin-nav ul li {
    display: inline-block;
    margin-right: 1rem;
}

.admin-nav ul li a {
    color: #fff;
    text-decoration: none;
    font-size: 1.1rem;
    transition: color 0.3s ease;
}

.admin-nav ul li a:hover {
    color: #f39c12; /* Orange */
}

.user-profile {
    display: flex;
    align-items: center;
}

.avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    margin-right: 0.5rem;
}

.username {
    font-size: 1.1rem;
}

</style>
</head>
<body>

<!-- HTML Content -->
<header class="admin-header">
    <div class="brand">
        <h1>AdminPanel</h1>
    </div>
    <nav class="admin-nav">
        <ul>
            <li><a href="#">Praatplaten</a></li>
            <li><a href="#">Elementen</a></li>
            <li><a href="#">Uitlog</a></li>
      
            <!-- Add more navigation items as needed -->
        </ul>
    </nav>


</body>
</html>
