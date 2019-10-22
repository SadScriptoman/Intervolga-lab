<?php
    session_start();
    $page_title = "Рестораны";
    setcookie("ref", $_SERVER['PHP_SELF']);
    require_once("analytics.php");
?>
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
            <li class="nav-item">
              <a class="nav-link" href="index.php">Главная</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="menu.php">Меню</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="map.php">Рестораны</a>
            </li>
            <? if (isset($_SESSION['login'])):?>
              <li class="nav-item">
                  <a class="nav-link" href="reservations.php">Забронированные столики</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="admin.php">Аналитика</a>
              </li>
            <? endif;?>
          </ul>
          
          <? if (!isset($_SESSION['login'])):?>
            <span class="mr-3 d-block mb-2 mt-2" style="color: white;">09:00 - 23:00, ПН-ВС</span>
            <button type="button" class="btn btn-outline-light mr-3" data-toggle="modal" data-target="#exampleModal">Забронировать столик</button>
            <a class="btn btn-outline-light" href="login.php">Войти в ЛК</a>
          <? else:?>
            <span class="mr-3 d-block mb-2 mt-2" style="color: white;">Вы вошли как: <?=$_SESSION['login']?>, в <?=$_SESSION['login_time']?> </span>
            <a class="btn btn-outline-light" href="logout.php">Выйти</a>
          <? endif;?>
        </div>
    </nav>
</header>

<main role="main" id="main">

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Бронь столика онлайн</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="name">Ваше имя</label>
                            <input type="text" class="form-control" id="name" required >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Телефон</label>
                            <input type="tel" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                            <small id="emailHelp" class="form-text text-muted">После оставления заявки наш менеджер позвонит на этот телефон</small>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Дата</label>
                          <input type="date" class="form-control" id="date" name="date" placeholder="Дата" required>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3" id="alert">Отправить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <div class="container mt-5 mb-5">
        
        <h2 class="featurette-heading mt-0 mb-5 text-center">
            Наши рестораны
        </h2>
        <div class="row mb-5">
            <div class="col-3">
                <div class="card" >
                    <img src="src/img/map.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                      <p class="card-text">г. Волгоград, проспект Университетский 100</p>
                      <hr>
                      <p class="card-text"><strong>+7 (999) 999-99-99</strong></p>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card" >
                    <img src="src/img/map.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                      <p class="card-text">г. Волгоград, проспект Университетский 100</p>
                      <hr>
                      <p class="card-text"><strong>+7 (999) 999-99-99</strong></p>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card" >
                    <img src="src/img/map.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                      <p class="card-text">г. Волгоград, проспект Университетский 100</p>
                      <hr>
                      <p class="card-text"><strong>+7 (999) 999-99-99</strong></p>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card" >
                    <img src="src/img/map.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                      <p class="card-text">г. Волгоград, проспект Университетский 100</p>
                      <hr>
                      <p class="card-text"><strong>+7 (999) 999-99-99</strong></p>
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3Aea5c4c5a93e793bff7715d22c58a9030c28fb6d123a5ac27c031d68b53bbfaa8&amp;width=100%25&amp;height=500&amp;lang=ru_RU&amp;scroll=true"></script>
        
    </div>

    <footer class="container">
        <p class="float-right"><a href="#main" class="back-to-top">Back to top</a></p>
        <p>&copy; 2017-2018 Ресторан &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
    </footer>

</main>

<script src="jquery/jquery-3.4.1.min.js" ></script>
<script src="bootstrap/bootstrap.bundle.min.js" ></script>

<script type="text/javascript">
    $(function(){
        $(".back-to-top").click(function(){
                var _href = $(this).attr("href");
                $("html, body").animate({scrollTop: $(_href).offset().top+"px"});
                return false;
        });
    });
</script>

</body>
</html>