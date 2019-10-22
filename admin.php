<?php
  session_start();
  setcookie("ref", $_SERVER['PHP_SELF']);
  if (isset($_SESSION['login'])){
    require_once("magic/db-connect.php");//подключение к бд через PDO
  }
  $page_title = "Админ панель";
  $nav_active = 5;
  require_once("templates/header.php");
?>

  <main role="main" id="main" style="min-height: 100vh" <? if (isset($_SESSION['login'])) echo "class=\"bg-dark\"";?>>
      <div class="mt-5 container">
          <? if ((!isset($_SESSION['login']) || ($db == NULL))):
              ?>
              <h1>
                Вы должны зайти в аккаунт чтобы просмотреть содержимое!
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
                      <td class="text-right" style="width: 25%; ">
                      <?
                        $str = $db->prepare("SELECT visitor_ref FROM analytics WHERE visited_page_id = $page_id");
                        $str->execute();
                        $result = $str->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($result as $key => $value) {
                          if ($key == 0)
                            echo "<a href=\"".$value["visitor_ref"]."\">".$value["visitor_ref"]."</a>";
                          else
                            echo ", <a href=\"".$value["visitor_ref"]."\">".$value["visitor_ref"]."</a>";
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
  </body>
</html>