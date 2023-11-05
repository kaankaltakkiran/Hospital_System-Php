<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
    <?php
    require_once('navbar.php');
    ?>
    <div class="container">
  <div class="row justify-content-center mt-3">
  <div class="col-6">

<form method="POST">
<h1 class="text-center text-danger">Login</h1>
  <div class="form-floating mb-3">
  <input type="email" name="form_email" class="form-control">
  <label>Email</label>
</div>
<div class="form-floating mb-3">
  <input type="password" name="form_password"class="form-control">
  <label>Password</label>
</div>

                  <button type="submit" name="submit" class="btn btn-primary">Login</button>   	
     </form>
     </div>
</div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>
<?php
$connect = mysqli_connect("localhost", "root", "root", "hospital");
$connect->set_charset("utf8mb4");

@session_start();

// Eğer zaten giriş yapmışsa, index.php'ye yönlendir
if (isset($_SESSION['isLogin'])) {
  // Oturum açmış
  header("location: index.php");
  die();
}

if (isset($_POST['form_email'])) {
  // Form gönderildi
  // 1.DB'na bağlan
  // 2.SQL hazırla ve çalıştır
  // 3.Gelen sonuç 1 satırsa GİRİŞ BAŞARILI değilse, BAŞARISIZ

  if(empty($_POST["form_email"]) || empty($_POST["form_password"]))  
  {  
       echo '
                      <div class="container">
                      
                  <div class="alert mt-3 text-center alert-info alert-dismissible fade show" role="alert">
                  Both Fields are required...
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                  </div>
                  ';    
  }  
  else  
  {  
       $useremail = mysqli_real_escape_string($connect, $_POST["form_email"]);  
       $userpassword = mysqli_real_escape_string($connect, $_POST["form_password"]);  
       $query = "SELECT * FROM users WHERE useremail = '$useremail'";  
       $result = mysqli_query($connect, $query);  
       if(mysqli_num_rows($result) > 0)  
       {  
            while($row = mysqli_fetch_array($result))  
            {  
                 if(password_verify($userpassword, $row["userpassword"]))  
                 {  
                      //return true;  
                     //echo "<h1>GİRİŞ BAŞARILI!</h1>";
                     //Session başlatma
                     @session_start();
                     $_SESSION['isLogin'] = 1; // Kullanıcı giriş yapmışsa 1 yap
                     $_SESSION['adsoyad'] = $row['username']; // Kullanıcının adını al
                     $_SESSION['id'] = $row['userid']; // Kullanıcının ID'sini al
                     $_SESSION['rol'] = $row['role']; // Kullanıcının ROL'ünü al
                    header("location: index.php");
                    die();    
                 }  
                 else  
                 {  
                      //return false;  
                      //echo $userpassword;
                      //echo $row["password"];
                      echo '
                      <div class="container">
                      
                  <div class="alert mt-3 text-center alert-danger alert-dismissible fade show" role="alert">
                  INCORRECT EMAIL or PASSWORD MATCH!...
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                  </div>
                  ';  
                 }  
            }  
       }   
       else  
       {  
        echo '
        <div class="container">
        
    <div class="alert mt-3 text-center alert-danger alert-dismissible fade show" role="alert">
    INCORRECT EMAIL or PASSWORD!...
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    </div>
    ';
       }  
  }  
  
}
?>