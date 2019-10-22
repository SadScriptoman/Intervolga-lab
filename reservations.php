<?php
  session_start();
  setcookie("ref", $_SERVER['PHP_SELF']);
  if (isset($_SESSION['login'])){
    require_once("db-connect.php");//подключение к бд через PDO
  }
?>
<!doctype html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Забронированные столики</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css" >
    <link rel="stylesheet" href="src/css/main.css?v1.1">


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
            <li class="nav-item">
                <a class="nav-link" href="map.php">Рестораны</a>
            </li>
            <? if (isset($_SESSION['login'])):?>
              <li class="nav-item active">
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
    <div class="container mt-5 mb-5">
        <? if ((!isset($_SESSION['login']) || ($db == NULL))):?>
          <h1>
            Вы должны зайти в аккаунт чтобы просмотреть содержимое!
          </h1>
        <? else:?>
        <div class="modal fade" id="oldTables" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <? 
              $result = $db->query("SELECT COUNT(*) FROM reservations WHERE date < CURRENT_DATE()")->fetchColumn();
              if ($result > 0):?>
              <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Подтверждение удаления</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <p>Вы точно хотите удалить старые бронирования? Будет удалено <?=$result?> записей.</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Отменить</button>
                    <a href="delete-old-reservations.php" class="btn btn-danger ml-3" >Удалить устаревшие бронирования</a>
                  </div>
              </div>
              <? else:?>
              <div class="modal-content">
                  <div class="modal-body">
                    <p>Сейчас нечего удалять. Все бронирования свежие!</p>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Понятно</button>
                  </div>
              </div>
              <?endif;?>
          </div>
        </div>
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
                      <form action="add-reservation.php" method="POST" class="needs-validation" novalidate>
                          <div class="form-group">
                              <label for="name">Имя</label>
                              <input type="text" class="form-control" id="name" name="name" pattern="^[А-Яа-яЁёa-zA-Z]+$" required >
                              <div class="invalid-feedback">
                                Введите имя!
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="tel">Телефон</label>
                              <input type="tel" class="form-control" id="tel" name="tel" pattern="\+7\s?[\(]{0,1}9[0-9]{2}[\)]{0,1}\s?\d{3}[-]{0,1}\d{2}[-]{0,1}\d{2}" placeholder="+7(___)___-__-__" required>
                              <div class="invalid-feedback">
                                Телефон введен неверно!
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="deposit">Депозит</label>
                              <input type="number" class="form-control" id="deposit" name="deposit" step=any pattern="\d+(\.\d{2})?" value="0" required>
                              <div class="invalid-feedback">
                                Введите корректный депозит!
                              </div>
                          </div>
                          <div class="form-group">
                            <label for="date">Дата</label>
                            <input type="date" class="form-control datepicker" id="date" name="date" pattern="[0-9]{2}\.[0-9]{2}\.[0-9]{4}" min="<?=date('Y-m-d')?>" placeholder="Дата" required>
                            <div class="invalid-feedback">
                              Дата введена неверно!
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="time">Время</label>
                            <input type="time" class="form-control" id="time" name="time" min="09:00" max="22:00" pattern="[0-9]{2}\:[0-9]{2}" required>
                            <div class="invalid-feedback">
                              Введите время с 9:00 до 22:00!
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="table_number">Номер столика</label>
                            <input type="number" class="form-control" id="table_number" name="table_number" pattern="[0-9]{,2}" required>
                            <div class="invalid-feedback">
                              Введите двузначное число!
                            </div>
                          </div>
                          <button type="submit" class="btn btn-primary mt-3" >Добавить</button>
                      </form>
                  </div>
              </div>
          </div>
        </div>
        <button type="button" class="btn btn-dark mb-3" data-toggle="modal" data-target="#addTable">Добавить новое бронирование</button>
        <button type="button" class="btn btn-dark ml-3 mb-3" data-toggle="modal" data-target="#oldTables">Удалить устаревшие бронирования</button>
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
                  $result = $db->query("SELECT * FROM reservations");
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
<script src="jquery/mask.min.js" ></script>
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
        $("#tel").mask("+7 (999) 999-99-99");
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