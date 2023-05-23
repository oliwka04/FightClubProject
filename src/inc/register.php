<?php
include("api/db_login_data.php");
?>

<section class="vh-100 gradient-custom">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card text-white" style="border-radius: 1rem; background-color: rgb(137, 117, 91); opacity: 0.9;">
            <div class="card-body p-5 text-center" style="border-radius: 1rem; background-color: rgb(137, 117, 91);">

                <div class="mb-md-5 mt-md-4 pb-5">

                <h2 class="fw-bold mb-2 text-uppercase">Rejestracja</h2>

                <form method="post">
                <div class="form-outline form-white mb-4">
                    <input type="text" placeholder="Imie" id="name" name="name" class="form-control form-control-lg">
                    <label class="form-label" for="typeEmailX">Imie</label>
                </div>

                <div class="form-outline form-white mb-4">
                    <input type="text" placeholder="Nazwisko" id="surename" name="surename" class="form-control form-control-lg">
                    <label class="form-label" for="typePasswordX">Nazwisko</label>
                </div>

                <div class="form-outline form-white mb-4">
                    <input type="text" placeholder="Email" id="email" name="email" class="form-control form-control-lg">
                    <label class="form-label" for="typePasswordX">E-mail</label>
                </div>

                <div class="form-outline form-white mb-4">
                    <input type="text" placeholder="Hasło" id="password" name="password" class="form-control form-control-lg">
                    <label class="form-label" for="typePasswordX">Hasło</label>
                </div>
                <input class="btn btn-outline-light btn-lg px-5" type="submit" name="rej" id="rej" value="Zarejestruj">
                </form>

                </div>

            </div>
            </div>
        </div>
        </div>
    </div>
    </section>

    <?php
    if(isset($_POST["rej"],$_POST["name"],$_POST["surename"],$_POST["email"],$_POST["password"])){

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $imie = $_POST['name'];
            $nazwisko = $_POST['surename'];
            $email = $_POST['email'];
            $haslo = $_POST['password'];
        }
        $login_expire = '2024-01-01 00:00:00';
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
        $sql = "SELECT * FROM Users";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
            //var_dump($row);
            echo "</br>";
            if($email == $row['email']){
                echo "istnieje juz konto zarejestrowanne pod podanym adresem"."</br>";
            } else if($email == null){
                echo "podany adres email nie istnieje"."</br>";
            } else{
                $num = $row["userID"];
                $set = 1;
            }}}
            if($set == 1){
                $sql = "INSERT INTO Users (userID,name,surname,roleID,expireDate,password_hash,sessionToken,email,phone,locationID,aboutMe)
                VALUES('".($num+1)."','".$imie."','".$nazwisko."','1','".$login_expire."','".$haslo."','sesja','".$email."','111222333','1','tak')";
                echo $sql;
                
                if(mysqli_query($conn,$sql)){

                }

            
            }
        
    
         
        $conn->close();}
    
    
    
    ?>