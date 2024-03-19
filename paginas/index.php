<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Praatplaat</title>
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
            width: 200px;
            height:140px;
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

        // Select data from the "praatplaten" table
        $sql = "SELECT * FROM praatplaten";
        $result = $conn->query($sql);

        // Check if there are any rows in the result
        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                // Convert the BLOB data to base64 encoding
                $imageData = base64_encode($row['Foto']);
                // Display the photo using an <img> tag with base64 encoded data
                echo "<div class='board'>";
                echo "<img src='data:image/jpeg;base64," . $imageData . "' alt='" . $row['NaamEN'] . "'>";
                // Display other information
                echo "<h2>" . $row['NaamNL'] . "</h2>";
                echo "<p>" . $row['NaamEN'] . "</p>";
                echo "<p>" . $row['NaamFR'] . "</p>";
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
