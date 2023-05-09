<?php



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $haslo = $_POST['password'];
}


if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
    $uri = 'https://';
} else {
    $uri = 'http://';
}

$servername = $_SESSION['servername'];
$username = $_SESSION['username'];
$password = $_SESSION['password'];
$dbname = $_SESSION['DBname'];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT * FROM users WHERE email = \"" . $email . "\"";
$user_obj = $conn->query($sql);



if ($user_obj->num_rows > 0) {
    while ($row = $user_obj->fetch_assoc()) {
        $user = $row;
    }

    /*if ($user["email"] == $email && $user["haslo"] == $haslo) {
        echo "</br></br><h1>Witaj " . $user["imie"] . "!</h1></br>";

        // . " " . $user["nazwisko"] . " id: " . $user["id"] . " - 

        $login_expire = '2022-01-01 00:00:00';


        $session_token = uniqid();
        setcookie("session_token", $session_token, time() + (86400), "/"); // 86400 = 1 day

        $sql = "UPDATE klienci SET login_expire=\"" . $login_expire . "\", session_token=\"" . $session_token . "\" WHERE id=" . $user["id"];
        $conn->query($sql);

        header("Location: dashboard.php");
    } else {
        echo "Dane logowania nieprawidłowe!";
        header("Location: ../");
    }*/
} else {
    echo "0 results";
    header("Location: ../");
}






if (isset($_COOKIE["session_token"])) {
    //header("Location: dashboard.php");
    echo "Token exist now";
}



$conn->close();