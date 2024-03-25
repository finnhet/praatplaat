<?php
// Start session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // If not logged in, redirect to the login page
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elementen Bewerken</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <?php include '../extra/adminheader.php'; ?>
    <style>
    body {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
        background-color: #f3f3f3;
        display: grid;
        justify-content: center;
        align-items: center;
        height: 105vh;
    }

    .container {
        margin-top: 2rem;
    }

    .btn-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-bottom: 1rem;
    }

    .btn-container .btn {
        margin: 5px;
        width: 200px; /* Adjust button width */
    }

    .input-gap {
        margin-bottom: 1rem; 
    }

    .btn-dark {
        margin-top: 1rem;
    }

    .card-body {
        padding: 1.25rem;
    }

    .multi-collapse {
        margin-top: 1rem; /* Adjust the margin to move the collapse elements higher up */
    }

    </style>
</head>
<body>
<div class="container">
    <div class="btn-container">
        <div class="row">
            <div class="col">
                <a class="btn btn-dark" data-bs-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Praatplaat Toevoegen</a>
            </div>
            <div class="col">
                <a class="btn btn-dark" data-bs-toggle="collapse" href="#multiCollapseExample2" role="button" aria-expanded="false" aria-controls="multiCollapseExample2">Praatplaat Wijzigen</a>
            </div>
            <div class="col">
                <a class="btn btn-dark" data-bs-toggle="collapse" href="#multiCollapseExample3" role="button" aria-expanded="false" aria-controls="multiCollapseExample3">Praatplaat Verwijderen</a>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="col">
        <div class="collapse multi-collapse" id="multiCollapseExample1">
            <div class="card">
                <div class="card-body">
                    <form action="praatplaattvg.php" method="post" enctype="multipart/form-data">
                        <input class="form-control input-gap" type="text" name="naam_nl" placeholder="Naam Nederlands" aria-label="default input example">
                        <input class="form-control input-gap" type="text" name="naam_fr" placeholder="Naam Fries" aria-label="default input example">
                        <input class="form-control input-gap" type="text" name="naam_en" placeholder="Naam Engels" aria-label="default input example">
                        <input class="form-control input-gap" type="file" name="foto" id="formFile">
                        <input type="submit" class="btn btn-dark" name="add_submit" value="Toevoegen">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="collapse multi-collapse" id="multiCollapseExample2">
            <div class="card">
                <div class="card-body">
                    <form action="wijzigpraatplaat.php" method="post" enctype="multipart/form-data">
                        <select class="form-select input-gap" name="plaatplaat_id" aria-label="Default select example">
                            <option selected>Selecteer een praatplaat</option>
                            <?php
                            include '../db.php';
                            $sql = "SELECT id, NaamNL FROM praatplaten";
                            $result = $conn->query($sql);
                            
                          
                            if (!$result) {
                            
                                echo "Error bij het ophalen van praatplaten: " . $conn->error;
                            } else {
                             
                                if ($result->num_rows > 0) {
                                   
                                    while ($row = $result->fetch_assoc()) {
                                      
                                        echo "<option value='" . $row["id"] . "'>" . $row["NaamNL"] . "</option>";
                                    }
                                } else {
                              
                                    echo "<option disabled>Geen praatplaten gevonden</option>";
                                }
                            }
                            ?>
                        </select>
                        <input class="form-control input-gap" type="text" name="naam_nl" placeholder="Nieuwe Naam NL" aria-label="default input example">
                        <input class="form-control input-gap" type="text" name="naam_fr" placeholder="Nieuwe Naam FR" aria-label="default input example">
                        <input class="form-control input-gap" type="text" name="naam_en" placeholder="Nieuwe Naam EN" aria-label="default input example">
                        <input class="form-control input-gap" type="file" name="foto" id="formFile">
                        <input type="submit" class="btn btn-dark" name="edit_submit" value="Bewerken">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col">
    <div class="collapse multi-collapse" id="multiCollapseExample3">
      <div class="card card-body">
        


      <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Naam</th>
                    <th>Actie</th>
                </tr>
            </thead>
            <tbody>
              
                <?php
                include '../db.php';
                $sql = "SELECT id, NaamNL FROM praatplaten";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["NaamNL"] . "</td>";
                     
                        echo "<td>";
                        echo "<form action='../extra/vwdpraatplaat.php' method='post'>";
                        echo "<input type='hidden' name='praatplaat_id' value='" . $row["id"] . "'>";
                        echo "<button type='submit' class='btn btn-danger'>Verwijderen</button>";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>Geen praatplaten gevonden</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

  


    </div>
</body>
</html>
