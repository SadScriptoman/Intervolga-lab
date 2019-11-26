<!doctype html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title><?=$page_title?></title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="core/src/bootstrap/bootstrap.min.css" >
    <link rel="stylesheet" href="core/src/css/main.css?v=1.111">
    <link rel="stylesheet" href="core/src/css/all.css"> 


  </head>
  <body>


  <header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="main"><h3>Ресторан</h3></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item <? if ($nav_active == 1) echo "active"; ?>">
              <a class="nav-link" href="/">Главная</a>
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
                  <a class="nav-link" href="employees">Сотрудники</a>
              </li>
              <li class="nav-item <? if ($nav_active == 6) echo "active"; ?>">
                  <a class="nav-link" href="admin">Аналитика</a>
              </li>
            <? endif;?>
          </ul>
          
          <? if (!isset($_SESSION['login'])):?>
            <span class="mr-3 d-block mb-2 mt-2" style="color: white;">09:00 - 23:00, ПН-ВС</span>
            <a class="btn btn-outline-light" href="login">Войти<i class="fas fa-sign-in-alt ml-2"></i></a>
          <? else:?>
            <span class="mr-3 d-block mb-2 mt-2" style="color: white;">Вы вошли как: <?=$_SESSION['login']?>, в <?=$_SESSION['login_time']?> </span>
            <button class="btn btn-outline-light" data-toggle="modal" data-target="#logoutModal">Выйти<i class="fas fa-sign-out-alt ml-2"></i></button>
          <? endif;?>
        </div>
    </nav>
</header>
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">Вы точно хотите выйти?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>После этого вам снова нужно будет войти в аккаунт!</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Отменить</button>
        <a title="Выйти" href="core/magic/logout" class="btn btn-primary" rel="nofollow">Выйти</a>
      </div>
    </div>
  </div>
</div>