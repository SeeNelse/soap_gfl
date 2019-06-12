<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Task 1</title>
</head>
<body>
  <style>
    .country {
      display:flex;
      flex-direction:row;
    }
    .country__list {
      width: 50%;
    }
  </style>
  <div class="country">
    <div class="country__list">
      <h2>cUrl</h2>
      <?= $curlResult; ?>
    </div>
    <div class="country__list">
      <h2>Soap</h2>
      <?= $soapResult; ?>
    </div>
  </div>
  
  
</body>
</html>