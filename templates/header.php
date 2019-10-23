<!doctype html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title><?=$page_title?></title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css" >
    <link rel="stylesheet" href="src/css/main.css">


  </head>
  <body>


  <header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="index.php"><h3>Ресторан</h3></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item <? if ($nav_active == 1) echo "active"; ?>">
              <a class="nav-link" href="index">Главная</a>
            </li>
            <li class="nav-item <? if ($nav_active == 2) echo "active"; ?>">
              <a class="nav-link" href="menu">Меню</a>
            </li>
            <li class="nav-item <? if ($nav_active == 3) echo "active"; ?>">
                <a class="nav-link" href="map">Рестораны</a>
            </li>
            <? if (isset($_SESSION['login'])):?>
              <li class="nav-item <? if ($nav_active == 4) echo "active"; ?>">
                  <a class="nav-link" href="reservations">Забронированные столики</a>
              </li>
              <li class="nav-item <? if ($nav_active == 5) echo "active"; ?>">
                  <a class="nav-link" href="admin">Аналитика</a>
              </li>
            <? endif;?>
          </ul>
          
          <? if (!isset($_SESSION['login'])):?>
            <span class="mr-3 d-block mb-2 mt-2" style="color: white;">09:00 - 23:00, ПН-ВС</span>
            <a class="btn btn-outline-light" href="login">Войти в ЛК</a>
          <? else:?>
            <span class="mr-3 d-block mb-2 mt-2" style="color: white;">Вы вошли как: <?=$_SESSION['login']?>, в <?=$_SESSION['login_time']?> </span>
            <a class="btn btn-outline-light" href="magic/logout">Выйти</a>
          <? endif;?>
        </div>
    </nav>
</header>