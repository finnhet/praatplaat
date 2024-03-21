<?php

include('../db.php');
// Fetch categories from 'praatplaten' table
$query = "SELECT * FROM praatplaten";
$result = mysqli_query($conn, $query);
$praatplaten = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elementen Bewerken</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <style class="css">
    body {
  margin: 0;
  padding: 0;   
  font-family: Arial, sans-serif;
  background-color: #f3f3f3;
}

.container {
  display: table;
  justify-content: center;
  align-content: center;
  align-items: center;
  margin-top: 16rem;
}

.gap-1 {
  gap: 16.5rem !important;
}

.input-gap {
  margin-bottom: 20px; /* Adjust this value to increase or decrease the gap */
}

.btn-dark{
    margin-top: 20px;
}

    </style>
</head>
<body>
<div class="container text-center">
<p class="d-inline-flex gap-1">
  <a class="btn btn-dark" data-bs-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">element toevoegen</a>
  <button class="btn btn-dark" type="button" data-bs-toggle="collapse" data-bs-target="#multiCollapseExample2" aria-expanded="false" aria-controls="multiCollapseExample2">element wijzigen</button>
  <button class="btn btn-dark" type="button" data-bs-toggle="collapse" data-bs-target="#multiCollapseExample3" aria-expanded="false" aria-controls="multiCollapseExample3">element verwijderen</button>
</p>

<div class="row">
  <div class="col">
    <div class="collapse multi-collapse" id="multiCollapseExample1">
      <div class="card card-body">


      <form action="uploadElement.php" method="POST" enctype="multipart/form-data">

      <input type="hidden" name="id" value="<?php htmlspecialchars($row['id']); ?>">
      <input class="form-control input-gap" type="text" name="NaamNL" placeholder="Naam NL" aria-label="default input example">
      <input class="form-control input-gap" type="text" name="NaamFR" placeholder="Naam FR" aria-label="default input example">
      <input class="form-control input-gap" type="text" name="NaamEN" placeholder="Naam EN" aria-label="default input example">

      
      <select class="form-select input-gap" name="cat" aria-label="Default select example">
  <option selected>Selecteer een categorie</option>
  <?php 
      $praatplaten = mysqli_query($conn, "SELECT * FROM praatplaten");
      while($c = mysqli_fetch_array($praatplaten)){
        ?>
      <option value="<?php echo $c['ID_Platen'];?>"><?php echo $c['NLnaam'];?>
      </option>
  <?php } ?>
</select>

    <label for="foto" class="form-label">Voeg een element toe.</label>
    <input class="form-control" type="file" name="foto" id="foto">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['foto']); ?>">

    <input type="submit" name="uploadEle" value="Upload Element">


      <button class="btn btn-dark" type="submit" name="uploadEle" value="Upload Element">Toevoegen</button>


    
      </div>
    </div>
  </div>

  <div class="col">
    <div class="collapse multi-collapse" id="multiCollapseExample2">
      <div class="card card-body">


      <select class="form-select input-gap" aria-label="Default select example">
      <option selected>Selecteer een element</option>
      <option value="1">brood</option>
      <option value="2">ei</option>
      <option value="3">kaas</option>
      </select>

      <input class="form-control input-gap" type="text" placeholder="Nieuwe Naam NL" aria-label="default input example">
      <input class="form-control input-gap" type="text" placeholder="Nieuwe Naam FR" aria-label="default input example">
      <input class="form-control input-gap" type="text" placeholder="Nieuwe Naam EN" aria-label="default input example">

      <label for="formFile" class="form-label">Voeg een element toe.</label>
      <input class="form-control" type="file" id="formFile">

      <button class="btn btn-be btn-dark" type="submit">bewerken</button>



      </div>
    </div>
  </div>

  <div class="col">
    <div class="collapse multi-collapse" id="multiCollapseExample3">
      <div class="card card-body">
        

      <?php
      $sql="SELECT * FROM `elementen`";
      $result = mysqli_query($conn, $sql);
      if($result){
      while($row = mysqli_fetch_array($result)){
     ?>

    <table class="table table-striped table-hover">
      <thead>
      <tr>
      <th >ID</th>
      <th >Naam</th>
    </tr>
  </thead>
  <tbody>  
      <tr>
      <td><?php echo htmlspecialchars($row['id']); ?></td>
      <td><?php echo htmlspecialchars($row['NaamNL']); ?></td>
      <td>  <button type="button" class="btn btn-outline-danger">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
          <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"></path>
          <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"></path>
          </svg>
        verwijder
      </button> </td>
      </tr>
    </tbody>
      </form>
    </table>
<?php }} ?>
      
      </div>
    </div>
  </div>

</div>
</div>
</body>
</html>