<?php
  session_start();
  if (!isset($_SESSION['login'])){
    header('HTTP/1.0 404 Not Found');
    header('Status: 404 Not Found');
  }
  else{
    $page_title = "Забронированные столики";
    $nav_active = 4;
    $fa = false;
    setcookie("ref", $_SERVER['REQUEST_URI']);

    require_once($_SERVER['DOCUMENT_ROOT'] . "/config/config.php");
    require_once($_CONFIG['DATABASE']['CONNECT']);
    require_once($_CONFIG['TEMPLATES']['HEADER']);
    $id = isset($_GET["id"]) ? $_GET["id"] : NULL;
    $name = isset($_GET["name"]) ? $_GET["name"] : NULL;
    $tel = isset($_GET["tel"]) ? $_GET["tel"] : NULL;
    $date = isset($_GET["date"]) ? $_GET['date'] : NULL;
    $time = isset($_GET["time"]) ? $_GET['time'] : NULL;
    $table_number = isset($_GET["table_number"]) ? $_GET["table_number"] : NULL;
    $deposit = isset($_GET["deposit"]) ? $_GET["deposit"] : 0;
    $edit = isset($_GET["edit"]) ? $_GET["edit"] : 'false';
    $confirmed = isset($_GET["confirmed"]) ? $_GET["confirmed"] : 'true';

    require_once($_SERVER['DOCUMENT_ROOT'] . "/config/config.php");
    require_once($_CONFIG['DATABASE']['CONNECT']);
    require_once($_CONFIG['TEMPLATES']['HEADER']);
    $id = isset($_GET["id"]) ? $_GET["id"] : NULL;
    $state = isset($_GET["state"]) ? $_GET["state"] : -1;
    $name = NULL;
    $tel = NULL;
    $date = NULL;
    $time = NULL;
    $table_number = NULL;
    $deposit = 0;
    if (($state == 0 || $state == 1 || $state == 2) && $id){
      $str = $db->prepare("SELECT * FROM reservations WHERE reservation_id = $id");
      $str->execute();
      $result = $str->fetch();
      if (isset($result)){
        $name = $result["name"];
        $tel = str_replace ( "+7 " , "", $result['telephone']);
        $date = $result['date'];
        $time = $result['time'];
        $table_number = $result['table_number'];
        $deposit = $result['deposit'];
      }
    }
    $name = isset($_GET["name"]) ? $_GET["name"] : $name;
    $tel = isset($_GET["tel"]) ? $_GET["tel"] : $tel;
    $date = isset($_GET["date"]) ? $_GET["date"] : $date;
    $time = isset($_GET["time"]) ? $_GET["time"] : $time;
    $table_number = isset($_GET["table_number"]) ? $_GET["table_number"] : $table_number;
    $deposit = isset($_GET["deposit"]) ? $_GET["deposit"] : $deposit;
?>

<main role="main" id="main">
    <div class="container mt-5 mb-5">
        <? if ((!isset($_SESSION['login']) || ($db == NULL))):?>
          <h1>
            Вы должны зайти в аккаунт чтобы просмотреть содержимое!
          </h1>
        <? else:?>
        <!--Модальное окно удаления брони-->
        <?if (isset($result)) :
          $tm = date("H:i", strtotime($time));
          $dt = date("d.m", strtotime($date));?>
          <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modalLabel">Подтверждение удаления</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>Вы точно хотите удалить бронь на <?=$tm?>, <?=$dt?>?</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Отменить</button>
                  <a title="Удалить" href="<?=$_CONFIG['RESERVATIONS']['DEL']?>?id=<?=$id?>&confirmed=true" class="btn btn-primary" rel="nofollow">Удалить</a>
                </div>
              </div>
            </div>
          </div>
        <?endif;?>
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
                    <a href="<?=$_CONFIG['RESERVATIONS']['OLD']?>" class="btn btn-danger" >Удалить устаревшие бронирования</a>
                  </div>
              </div>
              <? else:?>
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modalLabel">Упс...</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>Сейчас нечего удалять. Все бронирования свежие!</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary" data-dismiss="modal">Понятно</button>
                </div>
              </div>
              <?endif;?>
          </div>
        </div>
        <div class="modal fade" id="handlerModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modalLabel"><?=$id?"Редактировать сотрудника":"Добавить сотрудника"?></h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="<?=$_CONFIG['RESERVATIONS']['HANDLE']?>" method="POST" class="needs-validation" novalidate>
                  <input type="hidden" id="id" name="id" value="<?=$id?>">
                  <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Фамилия</label>
                        <input type="text" class="form-control" id="name" name="name" pattern="^[A-яёЁA-z\s]{3,25}$" minlength="3" maxlength="25" value="<?=$name?>" required >
                        <div class="invalid-feedback">
                          Вы должны ввести фамилию клиента! Максимум 25 символов
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tel">Телефон</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <div class="input-group-text">+7</div>
                          </div>
                          <input type="tel" class="form-control" id="tel" name="tel" pattern="^\s?[\(]{0,1}9[0-9]{2}[\)]{0,1}\s?\d{3}[-]{0,1}\d{2}[-]{0,1}\d{2}$" value="<?=$tel?>" required>
                        </div>
                        <div class="invalid-feedback">
                          Телефон введен неверно
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="deposit">Депозит</label>
                        <input type="number" class="form-control" id="deposit" name="deposit" step=any pattern="\d+(\.\d*)?" min="0" value="<?=$deposit?>">
                    </div>
                    <div class="form-group">
                      <label for="date">Дата</label>
                      <input type="date" class="form-control datepicker" id="date" name="date" pattern="^(0[1-9]|[12][0-9]|3[01])\.(0[1-9]|1[012])\.(19|20)\d\d$" <? if (!$id) echo "min=\"<?=date('Y-m-d')?>\""?> value="<?=$date?>" placeholder="Дата" required>
                      <div class="invalid-feedback">
                        Дата в формате дд.мм.гггг, начиная с сегодняшнего дня
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="time">Время</label>
                      <input type="time" class="form-control" id="time" name="time" min="09:00" max="22:00" pattern="^([0-1]\d|2[0-3])(:[0-5]\d)$" value="<?=$time?>" required>
                      <div class="invalid-feedback">
                        Введите время с 09:00 до 22:00
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="table_number">Номер столика</label>
                      <input type="number" class="form-control" id="table_number" name="table_number" pattern="^[1-9]$|^[1-5][0-9]$|^6[0-8]$" min="1" max="68" value="<?=$table_number?>" required>
                      <div class="invalid-feedback">
                        Введите номер столика в диапозоне от 1 до 68
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?=$id?"Отменить":"Закрыть"?></button>
                    <button type="submit" class="btn btn-primary"><?=$id?"Сохранить":"Добавить"?></button>
                  </div>
                </form>
              </div>
          </div>
        </div>
        <button type="button" class="btn btn-sm btn-success mb-3" data-toggle="modal" data-target="#handlerModal"><i class="fas fa-plus mr-2"></i>Добавить</button>
        <button type="button" class="btn btn-sm btn-secondary text-white ml-2 mb-3" data-toggle="modal" data-target="#oldTables"><i class="fas fa-sync mr-2"></i>Удалить старые</button>
        <table class="w-100 table">
          <thead>
            <tr>
                <th>Номер столика</th>
                <th class="text-center">Фамилия</th>
                <th class="text-center">Телефон</th>
                <th class="text-center">Депозит</th>
                <th class="text-center">Дата</th>
                <th class="text-center">Время</th>
                <th class="text-center">Действия</th>
            </tr>
          </thead>
          </tbody>
            <?
                if ($db):
                  $result = $db->query("SELECT * FROM reservations");
                  foreach($result as $result_value):?>
                      <tr>
                          <td><?=$result_value['table_number']?></td>
                          <td class="text-center"><?=$result_value['name']?></td>
                          <td class="text-center"><?=$result_value['telephone']?></td>
                          <td class="text-center"><?=$result_value['deposit']?></td>
                          <td class="text-center"><?=date('d.m.Y', strtotime($result_value['date']))?></td>
                          <td class="text-center"><?=$result_value['time']?></td>
                          <td class="text-center">
                            <a title="Редактировать" href="reservations?id=<?=$result_value['reservation_id']?>&state=1" class="text-muted mr-2" rel="nofollow"><i class="fas fa-edit"></i></a>
                            <a title="Дублировать" href="<?=$_CONFIG['RESERVATIONS']['CPY']?>?id=<?=$result_value['reservation_id']?>" class="text-muted mr-2" rel="nofollow"><i class="fas fa-copy"></i></a>
                            <a title="Удалить" href="reservations?id=<?=$result_value['reservation_id']?>&state=2" class="text-danger" rel="nofollow"><i class="fas fa-trash-alt"></i></a>
                          </td>
                      </tr>
                  <?endforeach;
                endif;?>
            </tbody>
        </table>
        <? endif;?>
    </div>
</main>

<?
require_once($_CONFIG['TEMPLATES']['FOOTER_CRUD']);
}
?>