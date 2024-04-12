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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <?php include 'extra/adminheader.php'; ?>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f3f3f3;
            height: 80vh; /* Set height of body to full viewport height */
            display: flex;
            justify-content: center; /* Center horizontally */
            align-items: center; /* Center vertically */
        }

        .content-wrapper {
            width: 100%;
            max-width: 600px; /* Set maximum width for content */
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 1rem;
        }

        .col {
            flex: 0 0 auto;
            width: 300px; /* Set width for each column */
        }

        .btn-container {
            display: flex;
            justify-content: center;
            align-items: center; /* Align buttons vertically */
            margin-bottom: 5rem; /* Adjust margin-bottom to position the buttons above the center */
        }

        .btn-container .col {
            flex: 0 0 auto;
            margin: 5px;
        }

        .btn-container .btn {
            margin: 5px;
            width: 100%; /* Make buttons fill the entire width of the container */
            padding: 0.5rem 1rem; /* Adjust button padding */
        }

        .input-gap {
            margin-bottom: 1rem;
        }

        .card-body {
            padding: 1.25rem;
        }

        .multi-collapse {
            margin-top: 1rem;
        }

        .collapse-title {
            cursor: pointer;
        }

        .collapse-content {
            max-height: 0; /* Start collapsed */
            overflow: hidden; /* Hide the content */
            transition: max-height 0.3s ease; /* Smooth transition animation */
        }
    </style>
</head>
<body>
    <div class="content-wrapper">
        <?php include 'extra/adminheader.php'; ?>

        <div class="container">
            <div class="btn-container">
                <div class="col">
                    <div class="collapse-title" data-bs-toggle="collapse" href="#multiCollapseExample1" aria-expanded="false" aria-controls="multiCollapseExample1">
                        <a class="btn btn-dark">Praatplaat Toevoegen</a>
                    </div>
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
                    <div class="collapse-title" data-bs-toggle="collapse" href="#multiCollapseExample2" aria-expanded="false" aria-controls="multiCollapseExample2">
                        <a class="btn btn-dark">Praatplaat Wijzigen</a>
                    </div>
                    <div class="collapse multi-collapse" id="multiCollapseExample2">
                        <div class="card">
                            <div class="card-body">
                                <form action="wijzigpraatplaat.php" method="post" enctype="multipart/form-data">
                                    <select class="form-select input-gap" name="plaatplaat_id" id="plaatplaat_id" aria-label="Default select example">
                                        <option selected>Selecteer een praatplaat</option>
                                        <?php
                                        include 'db.php';
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
                <div class="col">
                    <div class="collapse-title" data-bs-toggle="collapse" href="#multiCollapseExample3" aria-expanded="false" aria-controls="multiCollapseExample3">
                        <a class="btn btn-dark">Praatplaat Verwijderen</a>
                    </div>
                    <div class="collapse multi-collapse" id="multiCollapseExample3">
                        <div class="card">
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Naam</th>
                                            <th>Actie</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include 'db.php';
                                        $sql = "SELECT id, NaamNL FROM praatplaten";
                                        $result = $conn->query($sql);

                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<tr>";
                                                echo "<td>" . $row["id"] . "</td>";
                                                echo "<td>" . $row["NaamNL"] . "</td>";
                                                echo "<td>";
                                                echo "<form action='extra/vwdpraatplaat.php' method='post'>";
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
                    </div>
                </div>
                <div class="col">
                    <form action="index.php" method="post">
                        <button type="submit" class="btn btn-dark">Terug</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var collapseButtons = document.querySelectorAll('.collapse-title');
            collapseButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var target = this.getAttribute('href');
                    var targetCollapse = document.querySelector(target);

                    if (!targetCollapse.classList.contains('show')) {
                        var allCollapses = document.querySelectorAll('.collapse.multi-collapse.show');
                        allCollapses.forEach(function(collapse) {
                            var bsCollapse = new bootstrap.Collapse(collapse);
                            bsCollapse.hide();
                        });
                    }
                });
            });
        });
    </script>
</body>
</html>