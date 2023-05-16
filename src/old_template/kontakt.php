<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css" type="text/CSS">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <style>
      body{
        background-image: url(back.jpg);
        background-size: cover  ;
        background-attachment: fixed;
       
      }
      #a{
        background-color: white;
        margin-left: 20%;
        width: 60%;
        text-align: center;
      }
    </style>
</head>
<body>
<nav class="navbar bg-body-tertiary" style="postion: sticky; top: 0;">
  <div class="container-fluid">
    <a class="navbar-brand" href="logowanie.php">
      <img src="kangur.png" alt="Loggo" width="75" height="75" alt="kurokanguro"class="d-inline-block align-text-top">
    </a>
    <form class="d-flex mt-3" role="search">
      <input class="form-control me-2" type="search" ceholder="Search" aria-label="Search">
      <button class="btn btn-outline-danger" type="submit">Search</button>
    </form>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Zakladki</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Strona glowna</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="aktualnosci.php">Aktualnosci</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.php">O klubie...</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Oferta
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="karate.php">Karate</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="kickboxing.php">Kickboxing</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="judo.php">Judo</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="boks.php">Boks</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Harmonogram
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="kalendarz.php">Kalendarz</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="zapisy.php">Zapisy</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="trenerzy.php">Trenerzy</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="kontakt.php">Kontakt</a>
          </li>
        </ul>

      </div>
    </div>
  </div>
</nav><br><br><br>

<div id="a">
    <br>
    <h2>Formularz kontaktowy</h2>
    <br>
    <select class="form-select" aria-label="Default select example" style="width: 90%; margin-left: 5%;">
        <option selected>Wybierz pracownika, do którego chcesz napisać</option>
        <option value="1">Tomek</option>
        <option value="2">Mariusz</option>
        <option value="3">Robert</option>
        <option value="4">Juliusz</option>
    </select>
    <br><br><br>
    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Napisz wiadomość do wybranego pracownika</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" style="width: 90%; margin-left: 5%;"></textarea>
    </div>
    <br>
    <h6>Numery telefonów: 999 999 999 - Łódź, 888 888 888 - Poznań</h6>
    <br>

</div>
</body>
</html>