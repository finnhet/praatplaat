
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elementen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <?php include '../extra/header.php'; ?>  
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .board {
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #fff;
            margin-bottom: 20px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .board:hover {
            transform: translateY(-4px);
        }

        .board img {
            width: 100%;
            height: auto;
            border-radius: 8px 8px 0 0;
        }

        .board-content {
            padding: 20px;
        }

        .board h2 {
            font-size: 18px;
            margin: 0 0 10px;
            color: #333;
        }

        .board p {
            font-size: 14px;
            margin: 0;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <?php
            include '../db.php'; // Include your database connection file

            // Check if the ID parameter is set in the URL
            if(isset($_GET['id'])) {
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
                        echo "<div class='col-md-4'>";
                        echo "<div class='board'>";
                        echo "<img src='../fotos/" . $row['foto_path'] . "' alt='" . $row['NaamEN'] . "'>";
                        echo "<div class='board-content'>";
                        echo "<h2>" . $row['NaamNL'] . "</h2>";
                        echo "<p>" . $row['NaamEN'] . "</p>";
                        echo "<p>" . $row['NaamFR'] . "</p>";
                        echo "</div>"; // .board-content
                        echo "</div>"; // .board
                        echo "</div>"; // .col-md-4
                    }
                } else {
                    echo "Geen items gevonden.";
                }
            } else {
                // If the ID parameter is not set, display an error message
                echo "Geen ID gevonden.";
            }

            // Close the database connection
            $conn->close();
            ?>
        </div> <!-- .row -->
    </div> <!-- .container -->
</body>
</html>
