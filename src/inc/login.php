<?php
include("api/db_login_data.php");
//include("api/index.php");
?>
    <section class="vh-100 gradient-custom">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card text-white" style="border-radius: 1rem; background-color: rgb(137, 117, 91); opacity: 0.9;">
            <div class="card-body p-5 text-center" style="border-radius: 1rem; background-color: rgb(137, 117, 91);">

                <div class="mb-md-5 mt-md-4 pb-5">

                <h2 class="fw-bold mb-2 text-uppercase">Logowanie</h2>

                <form method="post">
                <div class="form-outline form-white mb-4">
                    <input type="text" placeholder="Email" id="email" class="form-control form-control-lg" name="email">
                    <label class="form-label" for="typeEmailX">E-mail</label>
                </div>

                <div class="form-outline form-white mb-4">
                    <input type="password" placeholder="haslo" id="password" class="form-control form-control-lg" name="password">
                    <label class="form-label" for="typePasswordX">Hasło</label>
                </div>
                <input class="btn btn-outline-light btn-lg px-5" type="submit" name="log" id="log" value="Zaloguj">
                </form>

                </div>

                <div>
                <p class="mb-0">Nie masz konta? <a href="?page=register" class="text-white-50 fw-bold"> Zarejestruj się</a>
                </p>
                </div>

            </div>
            </div>
        </div>
        </div>
    </div>
    </section>
    <?php
if(isset($_POST["log"])){
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $haslo = $_POST['password'];
}
if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
    $uri = 'https://';
    //echo "https";
} else {
    $uri = 'http://';
    //echo "http";
}
echo "</br>";
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
$sql = "SELECT * FROM Users WHERE email = \"" . $email . "\"";
$user_obj = $conn->query($sql);

if ($user_obj->num_rows > 0) {
    while ($row = $user_obj->fetch_assoc()) {
        $user = $row;
    }
    if ($user["email"] == $email && $user["password_hash"] == $haslo) {
        echo "</br></br><h1>Zalogowany " . $user["name"] . "!</h1></br>";
        // . " " . $user["nazwisko"] . " id: " . $user["id"] . " - 
        $login_expire = '2024-01-01 00:00:00';
        $session_token = uniqid();
        setcookie("session_token", $session_token, time() + (86400), "/"); // 86400 = 1 day

        $sql = "UPDATE Users SET expireDate=\"" . $login_expire . "\", sessionToken=\"" . $session_token . "\" WHERE userID=" . $user["userID"];
        $conn->query($sql);
        //echo($_COOKIE["session_token"]);
        //header("Location: dashboard.php");
     } 
    else {
        echo "Dane logowania nieprawidłowe!";
        //header("Location: ../");
    }}
 else {
    echo "0 results";
    //header("Location: ../");
}
if (isset($_COOKIE["session_token"])) {
    //header("Location: dashboard.php");
    //echo "Token exist now";
}
$conn->close();}
?>