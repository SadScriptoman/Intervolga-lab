<?php
  session_start();
  setcookie("ref", $_SERVER['PHP_SELF']);
  require_once("magic/analytics.php");
  $page_title = "Главная";
  $nav_active = 1;
  require_once("templates/header.php");
?>

<main role="main" id="main">

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
      <p>&copy; 2017-2018 Ресторан &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
    </footer>

</main>

</body>
</html>