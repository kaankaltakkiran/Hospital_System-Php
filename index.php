<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Doctors</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
  <div class="container">
  <div class="row justify-content-center mt-3">
  <div class="col-6">

<form method="POST" enctype="multipart/form-data">

    <div class="form-floating mb-3">
  <input type="text" name="form_doctorname" class="form-control">
  <label>Doctor Name</label>
</div>
<div class="form-floating mb-3">
  <input type="email" name="form_doctoremail" class="form-control">
  <label>Doctor Email</label>
</div>
<div class="form-floating mb-3">
  <input type="text" name="form_doctorphone" class="form-control">
  <label>Doctor Phone</label>
</div>
<div class="form-floating mb-3">
  <input type="text" name="form_doctorjob" class="form-control">
  <label>Doctor Job</label>
</div>
<div class="form-floating mb-3">
  <input type="text" name="form_doctorabout" class="form-control">
  <label>Doctor About</label>
</div>

           <input type="file" 
                  name="doctor_image" class="mb-5">
                  <button type="submit" name="submit" class="btn btn-primary">Add Doctor</button>   	
     </form>
     </div>
</div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>
<?php
if(isset($_POST['submit'])){

  require_once 'db.php';

  $doctorname = $_POST['form_doctorname'];
  $doctoremail = $_POST['form_doctoremail'];
  $doctorphone = $_POST['form_doctorphone'];
  $doctorjob = $_POST['form_doctorjob'];
  $doctorabout = $_POST['form_doctorabout'];

  //İmage
  $img_name = $_FILES['doctor_image']['name'];
	$img_size = $_FILES['doctor_image']['size'];
	$tmp_name = $_FILES['doctor_image']['tmp_name'];

  $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
			$img_ex_lc = strtolower($img_ex);

			$allowed_exs = array("jpg", "jpeg", "png"); 

			if (in_array($img_ex_lc, $allowed_exs)) {
				$new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
				$img_upload_path = 'uploads/'.$new_img_name;
				move_uploaded_file($tmp_name, $img_upload_path);

        
    $sql = "INSERT INTO doctors (doctorname,doctoremail,doctorphone,doctorjob,doctorabout,doctorimg) VALUES (:form_doctorname,:form_doctoremail,:form_doctorphone,:form_doctorjob,:form_doctorabout,'$new_img_name')";

    $SORGU = $DB->prepare($sql);

		$SORGU->bindParam(':form_doctorname',  $doctorname);
    $SORGU->bindParam(':form_doctoremail',  $doctoremail);
    $SORGU->bindParam(':form_doctorphone',  $doctorphone);
    $SORGU->bindParam(':form_doctorjob',  $doctorjob);
    $SORGU->bindParam(':form_doctorabout',  $doctorabout);

    $SORGU->execute();

		header("Location: index.php");
			}else {
				$em = "You can't upload files of this type";
		        header("Location: index.php?error=$em");
			}
}
?>