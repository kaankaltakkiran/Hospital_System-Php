<?php
require_once('db.php');
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tekil Doctor Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
      <div class="row">
   
   
  <?php
$sql = "SELECT * FROM doctors   WHERE doctorid = :id";
$SORGU = $DB->prepare($sql);
$SORGU->bindParam(':id',$_GET['id']);
$SORGU->execute();
$doctors = $SORGU->fetchAll(PDO::FETCH_ASSOC);

echo"
<div class='col-6'>
<h1 class='text-danger'>Doctor</h1>
<h3>Unit: {$doctors[0]['doctorjob']}</h3>
<h6>Doctor Name: {$doctors[0]['doctorname']}</h6>
<p>Doctor About: {$doctors[0]['doctorabout']}</p>
<p>Doctor Email: {$doctors[0]['doctoremail']}</p>
<p>Doctor Phone: {$doctors[0]['doctorphone']}</p>
</div>
<div class='col-6'>
<img src='uploads/{$doctors[0]['doctorimg']}' class='img-fluid' alt='...'>
</div>
</div>
</div>
";

?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>


