<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <title>Soap - Task 2</title>
  <link rel="stylesheet" href="./templates/style.css">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <a class="navbar-brand" href="http://localhost/soap_gfl/task2/client/">Navbar</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse d-flex justify-content-between" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <a class="nav-item nav-link active" href="/">Главная</a>
          <a class="nav-item nav-link" href="#">Заказ машины</a>
        </div>
        <form class="form-inline" action="" method="get">
          <input class="form-control mr-sm-2" type="search" name="searchCarId" placeholder="Поиск по ID" aria-label="Search">
          <button class="btn btn-primary my-2 my-sm-0" type="submit">Поиск</button>
          <a class="nav-item nav-link" href="?advancedSearch=true">Расширенный поиск</a>
        </form>
      </div>
    </div>
  </nav>
  <div class="main">
    <h3><?= $htmlHead ?></h3>
    <div class="container mt-4">
      <div class="row">
        <?= $htmlContent ?>
      </div>
    </div>
  </div>
</body>
</html>