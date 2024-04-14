<?php
// Start session
session_start();

// Include the appropriate header based on session status
if (isset($_SESSION['username'])) {
    include 'extra/adminheader.php'; // Include admin header if session started
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
            margin-top: 100px;
        }
        .board {
     width: 75%;
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease-in-out;
    height: 100%;
    display: flex;
    flex-direction: column;
    align-items: center; /* Center horizontally */
    justify-content: center; /* Center vertically */
}

        .board img {
            max-width: 100%;
            max-height: 150px; 
            width: auto;
            height: auto; 
            align-self: center;

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
        <div class="row">
            <?php
            include 'db.php'; // Include your database connection file

            // Select data from the "praatplaten" table
            $sql = "SELECT * FROM praatplaten";
            $result = $conn->query($sql);

            // Check if there are any rows in the result
            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    // Use Bootstrap grid classes to create columns
                    echo "<div class='col-sm-6 col-md-3'>"; // For small screens, each column takes up 6 out of 12 grid units. For medium screens and above, each column takes up 3 out of 12 grid units.
                    echo "<div class='board'>";
                    echo "<a href='elementen.php?id=" . $row['id'] . "' class='board-link'>";
                    echo "<img src='fotos/" . $row['foto_path'] . "' alt='" . $row['NaamEN'] . "' class='img-fluid'>"; // Use Bootstrap's responsive image class
                    // Display other information
                    echo "<div class='board-content'>";
                    echo "<h2>" . $row['NaamNL'] . "</h2>";
                    echo "<p>" . $row['NaamEN'] . "</p>";
                    echo "<p>" . $row['NaamFR'] . "</p>";
                    echo "</div>"; // .board-content
                    echo "</a>"; // Close the <a> tag
                    echo "</div>"; // .board
                    echo "</div>"; // .col
                }
            } else {
                echo "Geen items gevonden.";
            }

            $conn->close();
            ?>
             <?php if(isset($_SESSION['username'])): ?> <!-- Only show if logged in -->
                <div class='col-sm-6 col-md-3'>
                   <div style="background-color: #32cd32; color: white" class='board'>
                   <a href="praatplaat.php" class='board-link'>
                   <img src= "fotos/plusplus.png" class='img-fluid'>
                  
                    <div class='board-content'>
                    <h2>Nieuw</h2>  
                    <h2>New</h2>
                  <h2>Nij</h2>
                    </div>
                  </a>
                    </div>
                    </div>
        <?php endif; ?>
        </div>
        
    </div>
</body>
</html>
