<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Łódzki Klub Sztuk Walki Kuro Kanguro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="style/style.css" type="text/css">
</head>

<body>
    <!-- Header -->
    <div class="adj-header"> <!-- adj classes are custom from custom style.css -->
        <div class="adj-brand"></div>
        <ul class="nav nav-pills">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="?page=home">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Aktualności</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">O klubie</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Wydarzenia</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?page=trainers">Trenerzy</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Kontakt</a>
            </li>
        </ul>

    </div>
    <div class="container-fluid adj-bg">

        <!-- Content -->

        <div class="container-lg adj-content"> <!-- adj classes are custom from custom style.css -->
            <div class="row">
                <div class="adj-content-paper">
                    <div class="container">
                        <?php

                        if (isset($_GET['page'])) {
                            if($_GET['page'] == "trainers"){
                                include("inc/trainers.php");
                            }else if($_GET['page'] == "home"){
                                include("inc/home.php");
                            }
                        }else{
                            include("inc/home.php");
                        }


                        ?>
                    </div>

                </div>

            </div>
        </div>


    </div>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>