<!doctype html>
<?php
    session_start();
    $page_title = "Главная";
    require_once("analytics.php");
?>
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
        <a class="navbar-brand" href="main.php"><h3>Ресторан</h3></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="main.php">Главная</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="menu.php">Меню</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="map.php">Рестораны</a>
            </li>
            <? if (isset($_SESSION['login'])):?>
              <li class="nav-item">
                  <a class="nav-link" href="tables.php">Забронированные столики</a>
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

                        <button type="submit" class="btn btn-primary mt-3" >Отправить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active" style="background-image: url('src/img/main1.jpg'); background-size: cover; background-position: 50% 50%;">
          <svg style="opacity: 0.4;" class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" ><rect fill="#777" width="100%" height="100%"/></svg>
          <div class="container">
          <div class="carousel-caption d-flex justify-content-center align-items-center flex-column">
              <h1>Спагетти болоньезе</h1>
              <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aliquid blanditiis excepturi est ipsam numquam omnis!</p>
              <p><a class="btn btn-lg btn-light" href="menu.php" role="button">Перейти в меню</a></p>
            </div>
          </div>
        </div>
        <div class="carousel-item" style="background-image: url('src/img/main2.jpg'); background-size: cover; background-position: 50% 50%;">
          <svg style="opacity: 0.4;" class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" ><rect fill="#777" width="100%" height="100%"/></svg>
          <div class="container">
            <div class="carousel-caption d-flex justify-content-center align-items-center flex-column">
              <h1>Шоколадный торт</h1>
              <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
              <p><a class="btn btn-lg btn-light" href="menu.php" role="button">Перейти в меню</a></p>
            </div>
          </div>
        </div>
        <div class="carousel-item" style="background-image: url('src/img/main3.jpg'); background-size: cover; background-position: 50% 50%;">
          <svg style="opacity: 0.4;" class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" ><rect fill="#777" width="100%" height="100%"/></svg>
          <div class="container">
          <div class="carousel-caption d-flex justify-content-center align-items-center flex-column">
              <h1>Суп минестроне</h1>
              <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Vitae qui atque mollitia cum libero!</p>
              <p><a class="btn btn-lg btn-light" href="menu.php" role="button">Перейти в меню</a></p>
            </div>
          </div>
        </div>
      </div>
      <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>



    <div class="container marketing">

    
        <h2 class="featurette-heading text-center mb-5">Вас не оставит равнодушным:</h2>


        <div class="row featurette">
          <div class="col-md-7 mt-5">
            <h2 class="featurette-heading">Замечательное место<br><small class="text-muted">В центре города!</small></h2>
            <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
          </div>
          <div class="col-md-5 mt-5" style="background-image: url('src/img/main4.jpg'); 
          background-size: cover; 
          background-position: 0% 50%; 
          width: 500px;
          height: 500px;">
          </div>
        </div>

        <hr class="featurette-divider">

        <div class="row featurette">
          <div class="col-md-7 order-md-2">
            <h2 class="featurette-heading">Уютный интерьер<br><small class="text-muted">и професиональные официанты</small></h2>
            <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
          </div>
          <div class="col-md-5" style="background-image: url('src/img/main5.jpg'); 
          background-size: cover; 
          background-position: 50% 50%; 
          width: 500px;
          height: 500px;">
          </div>
        </div>

        <hr class="featurette-divider">

        <div class="row featurette">
          <div class="col-md-7">
            <h2 class="featurette-heading">И конечно же вкуснейшие итальянские блюда!</h2>
            <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
          </div>
          <div class="col-md-5" style="background-image: url('src/img/main1.jpg'); 
          background-size: cover; 
          background-position: 50% 50%; 
          width: 500px;
          height: 500px;">
          </div>
        </div>

        <hr class="featurette-divider">


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