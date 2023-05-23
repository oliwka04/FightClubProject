<?php
session_start();
$servername = $_SESSION['servername'];
$username = $_SESSION['username'];
$password = $_SESSION['password'];
$dbname = $_SESSION['DBname'];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Read trainers, roleID = number of trainer's role
$sql = "SELECT userID, name, surname, roleID FROM users WHERE roleID = 1;";
$result = mysqli_query($conn, $sql);

// Read (last) messages
$sqla = "SELECT messageID FROM messages;";
$resulta = mysqli_query($conn, $sqla);

// Read conversations
$sqlb = "SELECT * FROM conversations;";
$resultb = mysqli_query($conn, $sqlb);

// Read users
$sqlc = "SELECT userID, sessionToken FROM users;";
$resultc = mysqli_query($conn, $sqlc);

?>

<div>
    <br>
    <h2>Formularz kontaktowy </h2>
    <br>
    <form method="post">
        <select name="trener" class="form-select" aria-label="Default select example"
            style="width: 90%; margin-left: 5%;">
            <option name="zlaopcja" selected>Wybierz pracownika, do którego chcesz napisać</option>
            <?php

            // Adding options from db
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    if ($row["roleID"] = 1) {
                        $trener = $row["name"] . " " . $row["surname"];
                        echo "<option>" . $trener . "</option><br>";
                    }
                }
            }
            ?>
        </select>
        <br><br><br>
        <div class="container">
            <label for="exampleFormControlTextarea1" class="form-label">Wiadomość:</label>
            <textarea name="tresc" class="form-control" id="exampleFormControlTextarea1" rows="10"></textarea><br>
            <input class="btn btn-outline-light btn-lg px-5" type="submit" name="submit" value="Wyślij wiadomość">
        </div>
    </form>
    <?php
    # $trenerr = $_POST["trener"];

    // Sending
    if (isset($_POST["submit"])) {
        if (mysqli_num_rows($result) > 0) {

            // Conversations
            while ($row = mysqli_fetch_assoc($resultb)) {
                $idtrenerawkonwersacji = $row["trainerID"];
                $idkonwersacji = $row["conversationID"];
                $sett = 1;
            }
            while ($row = mysqli_fetch_assoc($result)) {
                if ($trenerr == $row["name"] . " " . $row["surname"]) {
                    $idtrenera = $row["userID"];
                }
            }
            while ($row = mysqli_fetch_assoc($resultc)) {
                if ($row["sessionToken"] == $_COOKIE["session_token"]) {
                    $iduzytkownika = $row["userID"];
                }
            }

            // Messages
            while ($row = mysqli_fetch_assoc($resulta)) {
                $num = $row["messageID"];
                $set = 1;
            }

            // Creating conversations
            if($idtrenera!= $idtrenerawkonwersacji){
                $idistniejacejkonwersacji = $row["conversationID"];
                $sqlpushM = "INSERT INTO messages (messageID, content, dateTime, conversationID) VALUES ('" . ($num + 1) . "','" . $_POST["tresc"] . "','" . date("Y/m/d/h/i/s") . "','" . $idistniejacejkonwersacji . "')";
                $resultpushM = mysqli_query($conn, $sqlpushM);  
            }else{
                if (isset($sett)) {
                    $sqlpushC = "INSERT INTO conversations (conversationID, trainerID, userID, eventID) VALUES ('" . ($idkonwersacji + 1) . "', '" . $idtrenera . "', '" . $iduzytkownika . "', '" . 1 /*EventID*/ . "')";
                    $resultpushC = mysqli_query($conn, $sqlpushC);
                } else {
                    $sqlpushC = "INSERT INTO conversations (conversationID, trainerID, userID, eventID) VALUES ('" . (1) . "', '" . $idtrenera . "', '" . $iduzytkownika . "', '" . 1 /*EventID*/ . "')";
                    $resultpushC = mysqli_query($conn, $sqlpushC);
                }
            }

            // Creating messages
            if (isset($set)) {
                $sqlpushM = "INSERT INTO messages (messageID, content, dateTime, conversationID) VALUES ('" . ($num + 1) . "','" . $_POST["tresc"] . "','" . date("Y/m/d/h/i/s") . "','" . $idkonwersacji + 1 . "')";
                $resultpushM = mysqli_query($conn, $sqlpushM);
            } else {
                $sqlpushM = "INSERT INTO messages (messageID, content, dateTime, conversationID) VALUES ('" . 1 . "','" . $_POST["tresc"] . "','" . date("Y/m/d/h/i/s") . "','" . $idkonwersacji + 1 . "')";
                $resultpushM = mysqli_query($conn, $sqlpushM);
            }
        }
    }
    $conn->close();
    ?>
    <br>
    <h6>Telefon: 999 999 999 - Łódź, 888 888 888 - Poznań</h6>
    <br>
</div>