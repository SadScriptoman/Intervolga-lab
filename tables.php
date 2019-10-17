<!doctype html>
<?php
    session_start();
    if (isset($_SESSION['login'])){
        $connect = mysqli_connect('localhost', 'root', '');
        mysqli_select_db($connect, 'lab');
        mysqli_query($connect,"SET NAMES 'utf8'"); 
        mysqli_query($connect,"SET CHARACTER SET 'utf8'");
        mysqli_query($connect,"SET SESSION collation_connection = 'utf8_general_ci'");
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
        <? if (!isset($_SESSION['login'])):
            header('HTTP/1.0 404 Not Found');
            header('Status: 404 Not Found');
            ?>
            <h1>
                Страница не найдена! 
            </h1>
        <? else:
            $query = mysqli_query($connect, 'SELECT * FROM tables');
        ?>
        <table class="w-100">
            <tr>
                <th>Номер столика</th>
                <th>ФИО</th>
                <th>Время</th>
            </tr>
            <?
                while ($result = mysqli_fetch_array($query)) {
                    echo 
                    "<tr>
                        <td>{$result['table_id']}</td>
                        <td>{$result['fio']}</td>
                        <td>{$result['date_time']}</td>
                    </tr>";
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
</script>

</body>
</html>