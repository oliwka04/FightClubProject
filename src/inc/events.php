<!-- nie dotykac kodu po palce purywam i nie powiem co zrobie -->




<link href="style/calendarr.css" rel="stylesheet" type="text/css">
<?php
include("api/db_login_data.php");
include("inc/calendar.php");
//echo "oferta(dyscypliny) + kalendarz + zapisy/rezerwacje";
$servername = $_SESSION['servername'];
$username = $_SESSION['username'];
$password = $_SESSION['password'];
$dbname = $_SESSION['DBname'];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$sql = "SELECT * FROM Reservations";
$rid = mysqli_query($conn, $sql);

if (mysqli_num_rows($rid) > 0) {
  while ($rowed = mysqli_fetch_assoc($rid)) {
    $resid = $rowed["reservationID"];
  }
}
$sql = "SELECT * FROM Categories";
$categories = mysqli_query($conn, $sql);
?>
<div>
  <br>
  <h2>Nasza oferta</h2>
  <br>
  <form method="post">
  <div class="dropdownSelectBar">
    <select name="category" class="form-select" aria-label="Default select example">
      <option selected>Wybierz dyscyplinę</option>
      <?php
      if (mysqli_num_rows($categories) > 0) {
        while ($row = mysqli_fetch_assoc($categories)) {

          echo "<option>" . $row["name"] . "</option><br>";
        }
      } else {
        echo "0 results";
      }
      ?>
    </select>
    <input class="btn btn-outline-light btn-lg px-5" type="submit" name="submit">
    </div>
  </form>
  <?php
  $sql = "SELECT * FROM Categories";
  $categories = mysqli_query($conn, $sql);
  if (isset($_POST["submit"])) {
    //var_dump($_POST["category"]);
    if (mysqli_num_rows($categories) > 0) {
      while ($row = mysqli_fetch_assoc($categories)) {
        if ($row["name"] == $_POST["category"]) {
          echo $row['description'];
          $cat = $row["categoryID"];
        }
      }
    } else {
      echo "0 results";
    }
  } ?>
  <br>
  <h2>Zapisz sie na zajęcia</h2>
  <br>
  <?php
  $sql = "SELECT * FROM Events";
  $events2 = mysqli_query($conn, $sql);
  ?>
  <form method="post">
    <div class="dropdownSelectBar">
    <select name="eventt" class="form-select" aria-label="Default select example">
      <option selected>Wybierz wydarzenie</option>
      <?php
      if (mysqli_num_rows($events2) > 0) {
        while ($row = mysqli_fetch_assoc($events2)) {
          //var_dump($row["categoryID"]);
          if ($cat == $row["categoryID"]) {
            echo "<option>" . $row["title"] . "</option><br>";
          }
        }
      } else {
        echo "0 results";
      }
      ?>
    </select>
    <input class="btn btn-outline-light btn-lg px-5" type="submit" name="submitt">
    </div>
  </form>
  <?php
  $sql = "SELECT * FROM Events";
  $events3 = mysqli_query($conn, $sql);
  if (isset($_POST["submitt"])) {
    if (!isset($_COOKIE["session_token"])) {
      header("Location: ?page=login");
      //echo "Token exist now";
    }
  if (mysqli_num_rows($events3) > 0) {
    while ($rowww = mysqli_fetch_assoc($events3)) {
      // echo $rowww["title"]."</br>";
      // echo $_POST["eventt"]."</br>";
      if ($rowww["title"] == $_POST["eventt"]) {
        //echo $rowww["title"];
        $ridna = $rowww["title"];
        $ridd = $rowww["eventID"];
        $ridt = $rowww["dateTime"];
        echo $ridd;
      }
    }
  }
 
    $sql = "SELECT userID,sessionToken FROM Users";
    $cookieid = mysqli_query($conn, $sql);
    if (mysqli_num_rows($cookieid) > 0) {
      while ($roww = mysqli_fetch_assoc($cookieid)) {
        if ($roww["sessionToken"] == $_COOKIE["session_token"]) {
          //echo "no przeciez".$roww["userID"];
          $sql = "INSERT INTO Reservations (reservationID,eventID,userID,reservationDateTime,completed)
            VALUES ('" . ($resid + 1) . "','" . $ridd . "','" . $roww["userID"] . "','" . $ridt . "','0')";
          if (mysqli_query($conn, $sql)) {
          }
          echo "zapisałeś się na - ".$ridna." Dnia - ".$ridt;
        }
      }
    }
  }
  //var_dump($_COOKIE);
  $calendar = new Calendar(date("Y/m/d"));
  $sqla = "SELECT * FROM Events";
  $events = $conn->query($sqla);
  //$user_obj = $conn->query($sql);
  if (mysqli_num_rows($events) > 0) {
    while ($roww = mysqli_fetch_assoc($events)) {
      //var_dump($roww);  
      $calendar->add_event($roww["title"], $roww["dateTime"], 1, 'red');
    }
  }
  ?>
  <div>
    <?= $calendar ?>
  </div>