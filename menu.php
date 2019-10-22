<?php
    session_start();
    $page_title = "Меню";
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
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css?v=1.1" >
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
            <li class="nav-item active">
              <a class="nav-link" href="menu.php">Меню</a>
            </li>
            <li class="nav-item">
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



    <div class="container mt-5">
        <ul class="nav justify-content-center nav-pills">
            <li class="nav-item">
              <a class="nav-link active" href="#">Все позиции</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Салаты</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Супы</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Вторые блюда</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Пицца</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Напитки</a>
            </li>
        </ul>
        <div class="row mt-5 mb-5">
            <div class="col-md-8 col-12 align-self-center">
                <h5 class="mt-0 mb-1">Спагетти болньезе</h5>
                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.
            </div>
            <div class="col-md-2 col-sm-3 col-4 mt-3 mt-md-0 align-self-center">
                <h5 class="text-md-center text-left">300/50 г</h5>
            </div>
            <div class="col-md-2 col-6 mt-3 mt-md-0 align-self-center">
                <h5 class="text-md-right text-left">300 р.</h5>
            </div>
        </div>
        <div class="row mt-5 mb-5">
            <div class="col-md-8 col-12 align-self-center">
                <h5 class="mt-0 mb-1">Суп-крем грибной <span class="badge badge-dark">Новинка</span></h5>
                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.
            </div>
            <div class="col-md-2 col-sm-3 col-4  mt-3 mt-md-0 align-self-center">
                <h5 class="text-md-center text-left">300/50 г</h5>
            </div>
            <div class="col-md-2 col-6 mt-3 mt-md-0 align-self-center">
                <h5 class="text-md-right text-left">300 р.</h5>
            </div>
        </div>
        <div class="row mt-5 mb-5">
            <div class="col-md-8 col-12 align-self-center">
                <h5 class="mt-0 mb-1">Суп «Минестроне»</h5>
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Repellat, dolorum.
            </div>
            <div class="col-md-2 col-sm-3 col-4 mt-3 mt-md-0 align-self-center">
                <h5 class="text-md-center text-left">300/50 г</h5>
            </div>
            <div class="col-md-2 col-6 mt-3 mt-md-0 align-self-center">
                <h5 class="text-md-right text-left">300 р.</h5>
            </div>
        </div>
        <div class="row mt-5 mb-5">
            <div class="col-md-8 col-12 align-self-center">
                <h5 class="mt-0 mb-1">«Маргарита» <span class="badge badge-success">Хит сезона</span></h5>
                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.
            </div>
            <div class="col-md-2 col-sm-3 col-4 mt-3 mt-md-0 align-self-center">
                <h5 class="text-md-center text-left">300/50 г</h5>
            </div>
            <div class="col-md-2 col-6 mt-3 mt-md-0 align-self-center">
                <h5 class="text-md-right text-left">300 р.</h5>
            </div>
        </div>
        <div class="row mt-5 mb-5">
            <div class="col-md-8 col-12 align-self-center">
                <h5 class="mt-0 mb-1">Спагетти c вялеными помидорами</h5>
                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.
            </div>
            <div class="col-md-2 col-sm-3 col-4 mt-3 mt-md-0 align-self-center">
                <h5 class="text-md-center text-left">300/50 г</h5>
            </div>
            <div class="col-md-2 col-6 mt-3 mt-md-0 align-self-center">
                <h5 class="text-md-right text-left">300 р.</h5>
            </div>
        </div>
        <div class="row mt-5 mb-5">
            <div class="col-md-8 col-12 align-self-center">
                <h5 class="mt-0 mb-1">Спагетти «Дары моря» <span class="badge badge-success">Хит сезона</span></h5>
                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.
            </div>
            <div class="col-md-2 col-sm-3 col-4 mt-3 mt-md-0 align-self-center">
                <h5 class="text-md-center text-left">300/50 г</h5>
            </div>
            <div class="col-md-2 col-6 mt-3 mt-md-0 align-self-center">
                <h5 class="text-md-right text-left">300 р.</h5>
            </div>
        </div>
        <div class="row mt-5 mb-5">
            <div class="col-md-8 col-12 align-self-center">
                <h5 class="mt-0 mb-1">Спагетти болньезе</h5>
                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.
            </div>
            <div class="col-md-2 col-sm-3 col-4 mt-3 mt-md-0 align-self-center">
                <h5 class="text-md-center text-left">300/50 г</h5>
            </div>
            <div class="col-md-2 col-6 mt-3 mt-md-0 align-self-center">
                <h5 class="text-md-right text-left">300 р.</h5>
            </div>
        </div>
        <div class="row mt-5 mb-5">
            <div class="col-md-8 col-12 align-self-center">
                <h5 class="mt-0 mb-1">Суп-крем грибной <span class="badge badge-dark">Новинка</span></h5>
                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.
            </div>
            <div class="col-md-2 col-sm-3 col-4 mt-3 mt-md-0 align-self-center">
                <h5 class="text-md-center text-left">300/50 г</h5>
            </div>
            <div class="col-md-2 col-6 mt-3 mt-md-0 align-self-center">
                <h5 class="text-md-right text-left">300 р.</h5>
            </div>
        </div>
        <div class="row mt-5 mb-5">
            <div class="col-md-8 col-12 align-self-center">
                <h5 class="mt-0 mb-1">Суп «Минестроне»</h5>
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Repellat, dolorum.
            </div>
            <div class="col-md-2 col-sm-3 col-4 mt-3 mt-md-0 align-self-center">
                <h5 class="text-md-center text-left">300/50 г</h5>
            </div>
            <div class="col-md-2 col-6 mt-3 mt-md-0 align-self-center">
                <h5 class="text-md-right text-left">300 р.</h5>
            </div>
        </div>
        <div class="row mt-5 mb-5">
            <div class="col-md-8 col-12 align-self-center">
                <h5 class="mt-0 mb-1">«Маргарита» <span class="badge badge-success">Хит сезона</span></h5>
                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.
            </div>
            <div class="col-md-2 col-sm-3 col-4 mt-3 mt-md-0 align-self-center">
                <h5 class="text-md-center text-left">300/50 г</h5>
            </div>
            <div class="col-md-2 col-6 mt-3 mt-md-0 align-self-center">
                <h5 class="text-md-right text-left">300 р.</h5>
            </div>
        </div>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
              <li class="page-item active"><a class="page-link" href="#">1</a></li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
            </ul>
        </nav>
        
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