<?php
@session_start();
require 'loginControl.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Request</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
    <?php require'navbar.php'; ?>
  <div class='row text-center offset-3 col-6 mt-3'>
  <h1 class='alert alert-primary'>Create Request</h1>
</div>

<div class="container">
        <div class="row text-center">
  
<form method="POST">
  <p><br>
  <textarea name='form_request' placeholder="Please write your request clearly." style="width: 650px; height:100px;"></textarea>

  <p>Priority:
    <select name="form_priority">
      <option value='0'>Normal</option>
      <option value='1'>İmmediate</option>
      <option value='2'>Critical</option>
    </select>
  </p>
  <p></p>
  <button type="submit" class="btn btn-primary">Send Request</button>
</p>
</form>

</div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>

<?php
//Session öğrenince kim giriş yaptıysa otomatik onun idsini al
if (isset($_POST['form_request'])) {

  require_once('db.php');

//Talep kaydetme işlemi
  $sql = "INSERT INTO requests 
          SET request = :form_request,
          requesting = :talepeden, 
          priority = :form_priority,
          status = 0
          ";
  $SORGU = $DB->prepare($sql);

  $SORGU->bindParam(':form_request',  $_POST['form_request']);
   $SORGU->bindParam(':talepeden', $_SESSION['id']); 
  $SORGU->bindParam(':form_priority', $_POST['form_priority']);

  $SORGU->execute();
  echo '
  <div class="container">
        <div class="row">
      <div class="alert text-center alert-success alert-dismissible fade show" role="alert">
      Your request has been saved...
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      </div>
      </div>
    ';
}
?>
