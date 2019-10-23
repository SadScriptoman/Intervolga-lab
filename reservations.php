<?php
  session_start();
  setcookie("ref", $_SERVER['REQUEST_URI']);
  if (isset($_SESSION['login'])){
    require_once("magic/db-connect.php");//подключение к бд через PDO
  }
  $page_title = "Забронированные столики";
  $nav_active = 4;
  require_once("templates/header.php");
?>

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
                    <a href="magic/delete-old-reservations" class="btn btn-danger ml-3" >Удалить устаревшие бронирования</a>
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
                      <form action="magic/add-reservation" method="POST" class="needs-validation" novalidate>
                          <div class="form-group">
                              <label for="name">Фамилия</label>
                              <input type="text" class="form-control" id="name" name="name" pattern="^[А-Яа-яЁёa-zA-Z]+$" maxlength="25" required >
                              <div class="invalid-feedback">
                                Вы должны ввести фамилию клиента!
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="tel">Телефон</label>
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <div class="input-group-text">+7</div>
                                </div>
                                <input type="tel" class="form-control" id="tel" name="tel" pattern="\s?[\(]{0,1}9[0-9]{2}[\)]{0,1}\s?\d{3}[-]{0,1}\d{2}[-]{0,1}\d{2}" required>
                              </div>
                              <div class="invalid-feedback">
                                Телефон введен неверно
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="deposit">Депозит</label>
                              <input type="number" class="form-control" id="deposit" name="deposit" step=any pattern="\d+(\.\d*)?" min="0" value="0">
                          </div>
                          <div class="form-group">
                            <label for="date">Дата</label>
                            <input type="date" class="form-control datepicker" id="date" name="date" pattern="(0[1-9]|[12][0-9]|3[01])\.(0[1-9]|1[012])\.(19|20)\d\d" min="<?=date('Y-m-d')?>" placeholder="Дата" required>
                            <div class="invalid-feedback">
                              Дата в формате дд.мм.гггг
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="time">Время</label>
                            <input type="time" class="form-control" id="time" name="time" min="09:00" max="22:00" pattern="^([0-1]\d|2[0-3])(:[0-5]\d)$" required>
                            <div class="invalid-feedback">
                              Введите время с 09:00 до 22:00
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="table_number">Номер столика</label>
                            <input type="number" class="form-control" id="table_number" name="table_number" pattern="[0-9]{,2}" min="1" max="68" required>
                            <div class="invalid-feedback">
                              Введите номер столика в диапозоне от 1 до 68
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
          <thead>
            <tr>
                <th>Номер столика</th>
                <th class="text-center">Фамилия</th>
                <th class="text-center">Телефон</th>
                <th class="text-center">Депозит</th>
                <th class="text-center">Дата</th>
                <th class="text-right">Время</th>
            </tr>
          </thead>
          </tbody>
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
                          <td class=\"text-center\">".date('d.m.Y', strtotime($result_value['date']))."</td>
                          <td class=\"text-right\">{$result_value['time']}</td>
                      </tr>";
                  }
                }
            ?>
            </tbody>
        </table>
        <? endif;?>
    </div>
</main>

<?
  require_once("templates/footer.php");
?>