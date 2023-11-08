<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
    <?php
    require_once('navbar.php');
    ?>
    <div class="container">
  <div class="row justify-content-center mt-3">
  <div class="col-6">
  <?php 
 if (isset($_POST['form_email'])) {
  header("location: login.php");
} 
?>
<form method="POST">
<h1 class="text-center text-danger">Register</h1>
<div class="form-floating mb-3">
  <input type="text" name="form_name" class="form-control">
  <label>Name</label>
</div>
  <div class="form-floating mb-3">
  <input type="email" name="form_email" class="form-control">
  <label>Email</label>
</div>
<div class="form-floating mb-3">
  <input type="password" name="form_password"class="form-control">
  <label>Password</label>
</div>
<div class="form-floating mb-3">
  <input type="text" name="form_phone"class="form-control">
  <label>Phone Number</label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="gender" value="Male" >
  <label class="form-check-label" >
  Male
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="gender" value="Female" >
  <label class="form-check-label" >
  Female
  </label>
</div>

                  <button type="submit" name="submit" class="btn btn-primary">Register</button>   	
     </form>
     </div>
</div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>
<?php
if(isset($_POST['form_email'])){
  require_once('db.php');
  $name = $_POST['form_name'];
  $email = $_POST['form_email'];
  $phone = $_POST['form_phone'];
  $gender = $_POST['gender'];
  $password = $_POST['form_password'];
  $password = password_hash($password, PASSWORD_DEFAULT);   

  $sql = "INSERT INTO users (username,useremail,userphone,gender,userpassword) VALUES (:form_name,:form_email,:form_phone,:gender,'$password')";
  $SORGU = $DB->prepare($sql);
  $SORGU->bindParam(':form_name',  $name);
  $SORGU->bindParam(':form_email',  $email);
  $SORGU->bindParam(':form_phone',  $phone);
  $SORGU->bindParam(':gender',  $gender);

  $SORGU->execute();

}