<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Header</title>
<style>
body {
    margin: 0;
    font-family: Arial, sans-serif;
}

.admin-header {
    background-color: #2c3e50; 
    color: #fff; 
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.5rem 2rem; 
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    position: fixed;
    top: 0;
    left: 0;
    width: 99%;
    z-index: 1000; 
}

.brand h1 {
    margin: 0;
    font-size: 2rem;
}

.admin-nav ul {
    list-style: none;
    margin: 0;
    padding: 0;
}

.admin-nav ul li {
    display: inline-block;
    margin-right: 1.5rem; 
}

.admin-nav ul li a {
    color: #fff;
    text-decoration: none;
    font-size: 1.2rem; 
    transition: color 0.3s ease;
}

.admin-nav ul li a:hover {
    color: #f39c12; 
}

.user-profile {
    display: flex;
    align-items: center;
}

.avatar {
    width: 3.5rem; 
    height: 3.5rem; 
    border-radius: 50%;
    margin-right: 1rem;
}

.username {
    font-size: 1.2rem;
}

body {
    padding-top: 6rem;
}

@media screen and (max-width: 768px) {
    .admin-header {
        padding: 1rem;
    }

    .brand h1 {
        font-size: 1.5rem;
    }

    .admin-nav ul li {
        margin-right: 1rem;
    }

    .admin-nav ul li a {
        font-size: 1rem;
    }

    .avatar {
        width: 3rem;
        height: 3rem;
    }

    .username {
        font-size: 1rem;
    }

    body {
        padding-top: 5rem;
    }
}

.ontlinken { 
    color: inherit;
    text-decoration-line: none;
}
</style>
</head>
<body>

<?php


if(isset($_GET['logout'])) {
    $_SESSION = array();
    session_destroy();
    header("Location: login.php");
    exit();
}
?>

<header class="admin-header">
    <div class="brand">
        <h1><a class="ontlinken" href="../paginas/index.php">Praatplaat</a></h1>
    </div>
    <nav class="admin-nav">
        <ul>
            <li><a href="../paginas/praatplaat.php">Praatplaten</a></li>
            <li><a href="../paginas/elementEdit.php">Elementen</a></li>
            <li><a class="ontlinken" href="?logout=true">Uitlog</a></li>
        </ul>
    </nav>
</header>

</body>
</html>
