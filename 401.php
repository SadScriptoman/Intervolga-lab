<?php
  $page_title = "Доступ к ресурсу заблокирован";
  $nav_active = -1;
  $fa = true;

  $ref = (isset($_COOKIE['ref'])) ? $_COOKIE['ref'] : "index";
  require_once($_SERVER['DOCUMENT_ROOT'] . "/config/config.php");

  require_once($_CONFIG['TEMPLATES']['HEADER']);
?>

<main role="main" id="main">
    <div class="container text-center">
        <h1 class="mt-5">
            Ошибка 401!<br>
            <i class="fas fa-dizzy mt-5" style="font-size:256px"></i>
        </h1>
        <h3 class="mt-5">Нужно авторизоваться чтобы получить доступ к странице</h3>
    </div>
</main>
<?
  require_once($_CONFIG['TEMPLATES']['FOOTER_BOOTSTRAP']);
?>