<!doctype html>
<?php
  session_start();
  if (isset($_SESSION['login'])){
    require_once("db-connect.php");//подключение к бд через PDO
  }
?>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Ресторан</title>

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
            <li class="nav-item">
              <a class="nav-link" href="main.php">Главная</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="menu.php">Меню</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="map.php">Рестораны</a>
            </li>
            <? if (isset($_SESSION['login'])):?>
              <li class="nav-item active">
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
    <div class="container mt-5 mb-5">
        <? if (!isset($_SESSION['login'])) :
            header('HTTP/1.0 404 Not Found');
            header('Status: 404 Not Found');
            ?>
            <h1>
                Страница не найдена! 
            </h1>
        <? else:?>
          <div class="modal fade" id="addTable" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="modalLabel">Добавить бронь</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                        <form action="add-table.php" method="POST" class="needs-validation" novalidate>
                            <div class="form-group">
                                <label for="name">Имя</label>
                                <input type="text" class="form-control" id="name" name="name" required >
                            </div>
                            <div class="form-group">
                                <label for="tel">Телефон</label>
                                <input type="tel" class="form-control" id="tel" name="tel"  pattern="+7[0-9]{10}" required>
                                <div class="invalid-feedback">
                                  Телефон введен неверно!
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="deposit">Депозит</label>
                                <input type="number" class="form-control" id="deposit" name="deposit" value="0">
                                <div class="invalid-feedback">
                                  Введите корректный депозит!
                                </div>
                            </div>
                            <div class="form-group">
                              <label for="date">Дата</label>
                              <input type="date" class="form-control datepicker" id="date" name="date" placeholder="Дата" required>
                              <div class="invalid-feedback">
                                Дата введена неверно!
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="time">Время</label>
                              <input type="time" class="form-control" id="time" name="time" required>
                              <div class="invalid-feedback">
                                Время введено неверно!
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="table_number">Номер столика</label>
                              <input type="number" class="form-control" id="table_number" name="table_number" required>
                              <div class="invalid-feedback">
                                Номер столика введен неверно!
                              </div>
                            </div>

                            <button type="submit" class="btn btn-primary mt-3" >Добавить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-dark mb-3" data-toggle="modal" data-target="#addTable">Добавить новое бронирование</button>
        <table class="w-100 table">
            <tr>
                <th>Номер столика</th>
                <th class="text-center">Имя</th>
                <th class="text-center">Телефон</th>
                <th class="text-center">Депозит</th>
                <th class="text-center">Дата</th>
                <th class="text-right">Время</th>
            </tr>
            <?
                if ($db){
                  $result = $db->query("SELECT * FROM tables");
                  foreach($result as $result_value){
                      echo 
                      "<tr>
                          <td>{$result_value['table_number']}</td>
                          <td class=\"text-center\">{$result_value['name']}</td>
                          <td class=\"text-center\">{$result_value['telephone']}</td>
                          <td class=\"text-center\">{$result_value['deposit']}</td>
                          <td class=\"text-center\">{$result_value['date']}</td>
                          <td class=\"text-right\">{$result_value['time']}</td>
                      </tr>";
                  }
                }
            ?>
        </table>
        <? endif;?>
    </div>
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
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
      'use strict';
      window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
          form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add('was-validated');
          }, false);
        });
      }, false);
    })();
</script>

</body>
</html>