<?php
require_once('db.php');
require 'loginControl.php';
require 'authorizationControl.php';
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
  <?php
  require_once('navbar.php');
?>
<?php
if (isset($_POST['talepid_form'])) {
  // Güncelleme yapan sorgu
  $sql = "UPDATE requests 
          SET requestnot = :islemnotu_form, 
          status = :talepdurum_form 
          WHERE requestid = :talepid_form";
  $SORGU = $DB->prepare($sql);

  $SORGU->bindParam(':islemnotu_form',  $_POST['islemnotu_form']);
  $SORGU->bindParam(':talepdurum_form', $_POST['talepdurum_form']);
  $SORGU->bindParam(':talepid_form',    $_POST['talepid_form']);
  $SORGU->execute();
  echo '
  <div class="container">
        <div class="row">
      <div class="alert text-center mt-3 alert-success alert-dismissible fade show" role="alert">
      Request Updated...
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      </div>
      </div>
    ';
}
?>
  <div class="container">
<div class='row text-center'>
  <h1 class='alert alert-primary mt-3'>Request Management</h1>
</div>
<table class="table table-bordered table-striped">
  <thead>
    <tr>
      <th>ID</th>
      <th>Requests Date<br>Priority<br>Status</th>
      <th>Requesting<br>Email<br>Gender<br>Phone Number</th>
      <th>Request</th>
      <th>Process</th>
    </tr>
  </thead>
  <tbody>
  <?php
/* SELECT DISTINCT  requests.*,
users.username,
 users.useremail,
  users.gender
    FROM requests,users,doctors 
       WHERE users.doctorid = :id */
$SORGU = $DB->prepare("
SELECT DISTINCT  requests.*,
users.username,
 users.useremail,
  users.gender,
  users.username,
  users.userphone
    FROM requests,users,doctors 
       WHERE 
      requests.requesting=users.userid
");
/* $SORGU = $DB->prepare($sql); */
$SORGU->bindParam(':id',$_GET['id']);
$SORGU->execute();
$talepler = $SORGU->fetchAll(PDO::FETCH_ASSOC);
/* echo '<pre>'; print_r($talepler);
die();
 */
 
//!doctor id kontrolü
 if($_GET['id']!==$_SESSION['iddoctor']){
  echo '
  <div class="container">
  
<div class="alert mt-3 text-center alert-danger alert-dismissible fade show" role="alert">
INCORRECT DOCTOR MATCH!...
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
</div>
'; 
}else{
foreach ($talepler as $talep) {
//!doctor id ile talepteki doctor id kontrolü
  if($_GET['id']==$talep['reqdoctor']){
  $Oncelik = "";
  if ($talep['priority'] == 0) $Oncelik = "Normal";
  if ($talep['priority'] == 1) $Oncelik = "İmmediate";
  if ($talep['priority'] == 2) $Oncelik = "Critical";

  $Durum = "";
  if ($talep['status'] == 0) $Durum = "New";
  if ($talep['status'] == 1) $Durum = "In Process";
  if ($talep['status'] == 2) $Durum = "Finalize";
  $TALEBI = nl2br($talep['request']);

  echo "
<tr>
  <th>{$talep['requestid']}</th>
  <td>{$talep['requestsdate']}<br>
      {$Oncelik}<br>
      {$Durum}<br>
  </td>
  <td>{$talep['username']}<br>
      {$talep['useremail']}<br>
      {$talep['gender']}<br>
      {$talep['userphone']}<br>
      </td> 
  <td>{$TALEBI}<br><b style='color:darkred;'>{$talep['requestnot']}</b></td>
  <td>";
?>
  <form method="POST">
    <input type="hidden" name="talepid_form" value="<?php echo $talep['requestid']; ?>">
    <input type="text" size="23px" name="islemnotu_form" placeholder="Process Note...">
    <br>
    <select name="talepdurum_form" class="mt-2">
      <option value='0'>New</option>
      <option value='1'>In Process</option>
      <option value='2'>Finalize</option>
    </select>
    <input type="submit" class="btn btn-primary btn-sm" value="Save Changes...">
  </form>
<?php
  echo "      
  </td>
</tr> 
";
}
}
}
?>

</tbody>
</table>

</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>


