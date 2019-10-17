<!doctype html>
<?php
  session_start();
  if (isset($_SESSION['login'])){
    require_once("db-connect.php");//подключение к бд через PDO
  }
?>
<html lang="ru" >
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Ресторан</title>
  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="bootstrap/bootstrap.min.css" >
  <link rel="stylesheet" href="src/css/main.css">
</head>

<body <? if (isset($_SESSION['login'])) echo "class=\"bg-dark\""?>>
  <style>
    table a{
      color: inherit!important;
    }
  </style>
    <header>
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <a class="navbar-brand" href="main.php"><h3>Ресторан</h3></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"   aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
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
                  <li class="nav-item">
                      <a class="nav-link" href="tables.php">Забронированные столики</a>
                  </li>
                  <li class="nav-item active">
                      <a class="nav-link" href="admin.php">Аналитика</a>
                  </li>
                <? endif;?>
              </ul>

              <? if (!isset($_SESSION['login'])):?>
                <span class="mr-3 d-block mb-2 mt-2" style="color: white;">09:00 - 23:00, ПН-ВС</span>
                <button type="button" class="btn btn-outline-light mr-3" data-toggle="modal"    data-target="#exampleModal">Забронировать столик</button>
                <a class="btn btn-outline-light" href="login.php">Войти в ЛК</a>
              <? else:?>
                <span class="mr-3 d-block mb-2 mt-2" style="color: white;">Вы вошли как: <?=$_SESSION['login']?>,   в <?=$_SESSION['login_time']?> </span>
                <a class="btn btn-outline-light" href="logout.php">Выйти</a>
              <? endif;?>
            </div>
        </nav>
    </header>

    <main role="main" id="main" >

        <div class="mt-5 container">
            <? if ((!isset($_SESSION['login']) && ($db != NULL))):
                header('HTTP/1.0 404 Not Found');
                header('Status: 404 Not Found');
                ?>
                <h1>
                    Страница не найдена! 
                </h1>
            <? elseif ($db):
                $pages = $db->query("SELECT * FROM pages");
                $visitors = $db->query("SELECT * FROM analytics");
            ?>
            <table class="table table-dark">
              <thead>
                <tr>
                  <th scope="col">Страница</th>
                  <th scope="col" class="text-center">Общее число посетителей</th>
                  <th scope="col" class="text-center">Уникальные</th>
                  <th scope="col" class="text-right">Переходили из</th>
                </tr>
              </thead>
              <tbody>
                <? foreach($pages as $key => $page){
                    $page_id = $page["page_id"];?>
                    
                    <tr>
                        <th scope="row"><a href="<?=$page["page_url"]?>"><?=$page["page_title"]?></a></th>
                        <td class="text-center">
                        <?
                          $count = 0;
                          $str = $db->prepare("SELECT visited_this_page FROM analytics WHERE visited_page_id = $page_id");
                          $str->execute();
                          $result = $str->fetchAll(PDO::FETCH_ASSOC);
                          foreach ($result as $value) {
                            $count += (int)$value["visited_this_page"];
                          }
                          echo $count;
                        ?>
                        </td>
                        <td class="text-center">
                        <?
                          $str = $db->prepare("SELECT visitor_id FROM analytics WHERE visited_page_id = $page_id");
                          $str->execute();
                          $result = $str->fetchAll(PDO::FETCH_ASSOC);
                          echo count($result);
                        ?>
                        </td>
                        <td class="text-right">
                        <?
                          $str = $db->prepare("SELECT visitor_ref FROM analytics WHERE visited_page_id = $page_id");
                          $str->execute();
                          $result = $str->fetchAll(PDO::FETCH_ASSOC);
                          foreach ($result as $value) {
                            echo "<a href=\"".$value["visitor_ref"]."\">".$value["visitor_ref"]."</a>";
                          }
                        ?>
                        </td>
                    </tr>
                <?}?>
                
              </tbody>
            </table>
            <?endif;?>
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