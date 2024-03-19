<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elementen</title>
    <?php
    include '../db.php';
    include '../extra/header.php'
    ?>
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
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
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
            margin: 10px;
            float: left;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .board img {
            width: 100%;
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
    </style>
</head>
<body>
    <div class="container">
        <?php
        include '../db.php'; // Include your database connection file

        // Get the ID from the URL parameter
        $id = $_GET['id'];

        // Select data from the "elementen" table where the value of cat matches the ID from praatplaten
        $sql = "SELECT * FROM elementen WHERE cat = $id";
        $result = $conn->query($sql);

        // Check if there are any rows in the result
        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                // Display the element information
                echo "<div class='board'>";
                echo "<img src='data:image/jpeg;base64," . $imageData . "' alt='" . $row['NaamEN'] . "'>";
                echo "<h2>" . $row['NaamNL'] . "</h2>";
                echo "<p>" . $row['NaamFR'] . "</p>";
                echo "<p>" . $row['NaamEN'] . "</p>";
                echo "</div>";
            }
        } else {
            echo "Geen items gevonden.";
        }

        // Close the database connection
        $conn->close();
        ?>
    </div>
</body>
</html>