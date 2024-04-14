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
