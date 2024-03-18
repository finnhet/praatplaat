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
  margin-top: 20rem;
}

.gap-1 {
  gap: 16.5rem !important;
}

.input-gap {
  margin-bottom: 20px; /* Adjust this value to increase or decrease the gap */
}

.btn{
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



      <input class="form-control input-gap" type="text" placeholder="Naam NL" aria-label="default input example">
      <input class="form-control input-gap" type="text" placeholder="Naam FR" aria-label="default input example">
      <input class="form-control input-gap" type="text" placeholder="Naam EN" aria-label="default input example">

      <label for="formFile" class="form-label">Voeg een element toe.</label>
      <input class="form-control" type="file" id="formFile">

      <button class="btn btn-dark" type="submit">Toevoegen</button>



      </div>
    </div>
  </div>

  <div class="col">
    <div class="collapse multi-collapse" id="multiCollapseExample2">
      <div class="card card-body">



        //



      </div>
    </div>
  </div>

  <div class="col">
    <div class="collapse multi-collapse" id="multiCollapseExample3">
      <div class="card card-body">
        


      ..


      
      </div>
    </div>
  </div>

</div>
</div>
</body>
</html>