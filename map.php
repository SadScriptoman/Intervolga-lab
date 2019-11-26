<?php
  $page_title = "Рестораны";
  $nav_active = 3;
  $fa = false;
  if (isset($_COOKIE['session_id'])) session_id($_COOKIE['session_id']);
  session_start();
  setcookie("ref", $_SERVER['REQUEST_URI']);
  require_once($_SERVER['DOCUMENT_ROOT'] . "/config/config.php");
  require_once($_CONFIG['ANALITYCS']['FULL_PATH_TO_MODULE']);
  require_once($_CONFIG['TEMPLATES']['HEADER']);
?>

<main role="main" id="main">

    <div class="container mt-5 mb-5">
        
        <h2 class="featurette-heading mt-0 mb-5 text-center">
            Наши рестораны
        </h2>
        <div class="row mb-5">
            <div class="col-3">
                <div class="card" >
                    <img src="core/src/img/map.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                      <p class="card-text">г. Волгоград, проспект Университетский 100</p>
                      <hr>
                      <p class="card-text"><strong>+7 (999) 999-99-99</strong></p>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card" >
                    <img src="core/src/img/map.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                      <p class="card-text">г. Волгоград, проспект Университетский 100</p>
                      <hr>
                      <p class="card-text"><strong>+7 (999) 999-99-99</strong></p>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card" >
                    <img src="core/src/img/map.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                      <p class="card-text">г. Волгоград, проспект Университетский 100</p>
                      <hr>
                      <p class="card-text"><strong>+7 (999) 999-99-99</strong></p>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card" >
                    <img src="core/src/img/map.jpg" class="card-img-top" alt="...">
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
        <p>&copy; 2017-2018 Ресторан &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
    </footer>

</main>

<?
  require_once($_CONFIG['TEMPLATES']['FOOTER_BOOTSTRAP']);
?>