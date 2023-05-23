<?php

if (!isset($_COOKIE["session_token"])) {
  header("Location: ?page=login");
  //echo "Token exist now";
}

include("api/db_login_data.php");
$servername = $_SESSION['servername'];
$username = $_SESSION['username'];
$password = $_SESSION['password'];
$dbname = $_SESSION['DBname'];

$conn = new mysqli($servername, $username, $password, $dbname);
$sql = "SELECT * FROM Users";
$user = mysqli_query($conn, $sql);

$sqa = "SELECT * FROM Reservations";
$res = mysqli_query($conn, $sqa);

$sqb = "SELECT * FROM Events";
$even = mysqli_query($conn, $sqb);

if (mysqli_num_rows($user) > 0) {
    while ($row = mysqli_fetch_assoc($user)) {
      if ($row["sessionToken"] == $_COOKIE["session_token"]) {
            $uid = $row["userID"];
            $email = $row['email'];
            $phone = $row['phone'];
            $name = $row['name']." ".$row['surname'];
            $decription = $row['aboutMe'];
      }
    }
  }
  
?>
<style>.gradient-custom {
/* fallback for old browsers */
background: rgb(137, 117, 91);}</style>


<section class="vh-70">
  <div class="container py-1 h-20">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col">
        <div class="card mb-4" style="border-radius: .5rem;">
          <div class="row g-0">
            <div class="col-md-4 gradient-custom text-center text-white"
              style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
              <img src="img/logo.png"
                alt="Avatar" class="img-fluid my-5" style="width: 150px;" />
              <h5><?php echo $name; ?></h5>
              <i class="far fa-edit mb-5"></i>
            </div>
            <div class="col-md-8">
              <div class="card-body p-4">
                <h6>Informacje</h6>
                <hr class="mt-0 mb-4">
                <div class="row pt-1">
                  <div class="col-6 mb-3">
                    <h6>Email</h6>
                    <p class="text-muted"><?php echo $email; ?></p>
                  </div>
                  <div class="col-6 mb-3">
                    <h6>Phone</h6>
                    <p class="text-muted"><?php echo $phone; ?></p>
                  </div>
                </div>
                <h6></h6>
                <hr class="mt-0 mb-4">
                <div class="row pt-1">
                  <div class="col-6 mb-3">
                    <p class="text-muted"><?php echo $decription; ?></p>
                  </div>
                  <div class="col-10 mb-3">
                    <h6>Moje wydażenia</h6>
                    <p class="text-muted"><?php
                      if (mysqli_num_rows($res) > 0) {
                        while ($row = mysqli_fetch_assoc($res)) {
                          if ($row["userID"] == $uid) {
                            //var_dump($res);
                            //echo "cos"."</br>";
                            if (mysqli_num_rows($even) > 0) {
                              while ($rowe = mysqli_fetch_assoc($even)) {
                                if ($rowe["eventID"] == $row["eventID"]) {
                                  //var_dump($rowe);    
                                  //echo "cos innego"."</br>";
                                  echo $rowe["title"]." Dnia ".$row['reservationDateTime']."</br>";
                                  }}}
                                  $sqb = "SELECT * FROM Events";
                                  $even = mysqli_query($conn, $sqb);
                                }}}
                    
                    ?></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>