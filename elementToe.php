<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Element Toevoegen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style class="css">
body {
  margin: 0;
  padding: 0;
  font-family: Arial, sans-serif;
  background-color: #f3f3f3;
}

.container {
  display: flex;
  justify-content: center;
  align-content: center;
  align-items: center;
  margin-top: 12rem;

}

/* .row{
    margin-top: 12rem;
} */

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
  <div class="row">
    <div class="col">
      <input class="form-control input-gap" type="text" placeholder="Naam NL" aria-label="default input example">
      <input class="form-control input-gap" type="text" placeholder="Naam FR" aria-label="default input example">
      <input class="form-control input-gap" type="text" placeholder="Naam EN" aria-label="default input example">

      <label for="formFile" class="form-label">Voeg een element toe.</label>
      <input class="form-control" type="file" id="formFile">

      <button class="btn btn-dark" type="submit">Toevoegen</button>
        </div>
  </div>
</div>


</body>
</html>