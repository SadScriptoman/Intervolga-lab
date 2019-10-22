<?php
    session_start();
    setcookie("ref", $_SERVER['PHP_SELF']);
    require_once("magic/analytics.php");
    $page_title = "Забронированные столики";
    $nav_active = 2;
    require_once("templates/header.php");
?>

<main role="main" id="main">

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
        <p>&copy; 2017-2018 Ресторан &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
    </footer>

</main>

</body>
</html>