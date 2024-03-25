<?php
// Start session
session_start();

// Include the appropriate header based on session status
if (isset($_SESSION['username'])) {
    include '../extra/adminheader.php'; // Include admin header if session started
} else {
    include '../extra/header.php'; // Include regular header if session hasn't started
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Praatplaat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }
        .container {
            width: 80%;
            margin: 20px auto;
            margin-top: 100px ;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-gap: 20px;
        }
        h1 {
            text-align: center;
            color: white;
        }
        p {
            line-height: 1.6;
            color: #666;
        }
    
        /* CSS for the board layout */
        .board {
            width: 200px;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }
 
        .board img {
            width: 178px;
            height: 178px;
            border-radius: 5px;
        }
 
        .board h2 {
            margin-top: 0;
            font-size: 18px;
        }
 
        .board p {
            margin: 5px 0;
            font-size: 14px;
        }
        .board:hover {
            transform: translateY(-4px);
        }

        .board a {
            color: inherit;
            text-decoration-line: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        include '../db.php'; // Include your database connection file

        // Select data from the "praatplaten" table
        $sql = "SELECT * FROM praatplaten";
        $result = $conn->query($sql);

        // Check if there are any rows in the result
        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                // Display the photo using an <img> tag with base64 encoded data
                echo "<div class='board'>";
                echo "<a href='elementen.php?id=" . $row['id'] . "' class='board-link'>";
                echo "<img src='../fotos/" . $row['foto_path'] . "' alt='" . $row['NaamEN'] . "'>";
                // Display other information
                echo "<div class='board-content'>";
                echo "<h2>" . $row['NaamNL'] . "</h2>";
                echo "<p>" . $row['NaamEN'] . "</p>";
                echo "<p>" . $row['NaamFR'] . "</p>";
                echo "</div>"; // .board-content
                echo "</a>"; // Close the <a> tag
                echo "</div>"; // .board
            }
        } else {
            echo "Geen items gevonden.";
        }

       
        $conn->close();
        ?>
    </div>
</body>
</html>
