<?php
  require_once($_SERVER['DOCUMENT_ROOT'] . "/config/config.php");
  require_once($_CONFIG['AUTHORIZATION']['IS_LOGGED']);

  if (!$logged){
    header("HTTP/1.1 401 Unauthorized");
    include("401.php");
    exit;
  }
  else{
    $page_title = "Забронированные столики";
    $nav_active = 4;
    $fa = false;
    
    require_once($_CONFIG['RESERVATIONS']['INIT']);
?>

<main role="main" id="main">
  <div class="container mb-5">
    <?if ($db):?>
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
                <a title="Удалить" href="<?=$_CONFIG['RESERVATIONS']['DEL']?>?id=<?=$id.$search_get?>&confirmed=true" class="btn btn-primary" rel="nofollow">Удалить</a>
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
                  <a href="<?=$_CONFIG['RESERVATIONS']['OLD'].$search_get?>" class="btn btn-danger" >Удалить устаревшие бронирования</a>
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
                <h5 class="modal-title" id="modalLabel"><?=$id?"Редактировать бронирование":"Добавить бронирование"?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form action="<?=$_CONFIG['RESERVATIONS']['HANDLE']?>" method="POST" class="needs-validation" novalidate>
                <?if ($id):?>
                  <input type="hidden" id="id" name="id" value="<?=$id?>">
                <?endif;?>
                <?if ($search):?>
                  <input type="hidden" id="search" name="search" value="<?=$search?>">
                <?endif;?>
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
                    <input type="date" class="form-control datepicker" id="date" name="date" pattern="^(0[1-9]|[12][0-9]|3[01])\.(0[1-9]|1[012])\.(19|20)\d\d$" <? if (!$id) echo "min=\"".date('Y-m-d')."\""?> value="<?=$date?>" placeholder="Дата" required>
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
      <div class="mb-3 d-flex justify-content-between">
        <div>
          <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#handlerModal"><i class="fas fa-plus mr-2"></i>Добавить</button>
          <button type="button" class="btn btn-sm btn-secondary text-white ml-2" data-toggle="modal" data-target="#oldTables"><i class="fas fa-sync mr-2"></i>Удалить старые</button>
        </div>
        <div>
          <?if($search):?>
            <a href="reservations" class="btn btn-sm btn-outline-secondary mr-2">Сбросить</a>
          <?endif;?>
          <form class="form-inline d-inline" id="search-form" action="" method="GET" novalidate>
            <input class="form-control form-control-sm mr-2" type="search" name="search" id="search" placeholder="Поиск брони" aria-label="Поиск" value="<?=$search?>" <? if(!$search) echo("required")?> >
            <button class="btn btn-sm btn-outline-success" type="submit"><i class="fas fa-search"></i></button>
          </form>
        </div>
      </div>
      <table class="w-100 table reservations-table">
        <thead>
          <tr>
              <th>Столик, №</th>
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
              if ($search){
                echo($search_query);
                $str = $db->prepare("SELECT *, MATCH (name, telephone, table_number, date_time) AGAINST ('$search_query' IN BOOLEAN MODE) as 
                relev FROM reservations WHERE MATCH (name, telephone, table_number, date_time) AGAINST ('$search_query' IN BOOLEAN MODE)>0 
                ORDER BY relev DESC");
              }else{
                $str = $db->prepare("SELECT * FROM reservations");
              }
              if ($str->execute()):
                $result = $str->fetchAll();
                if (count($result)>0):
                  foreach($result as $key => $result_value):?>
                    <tr>
                      <td><?=$result_value['table_number']?></td>
                      <td class="text-center"><?=$result_value['name']?></td>
                      <td class="text-center"><?=format_phone($result_value['telephone'])?></td>
                      <td class="text-center"><?=$result_value['deposit']?></td>
                      <td class="text-center"><?=date('d.m.Y', strtotime($result_value['date']))?></td>
                      <td class="text-center"><?=$result_value['time']?></td>
                      <td class="text-center">
                        <a title="Редактировать" href="reservations?id=<?=$result_value['reservation_id']?>&state=1<?=$search_get?>" class="text-muted mr-2" rel="nofollow"><i class="fas fa-edit"></i></a>
                        <a title="Дублировать" href="<?=$_CONFIG['RESERVATIONS']['CPY']?>?id=<?=$result_value['reservation_id'].$search_get?>" class="text-muted mr-2" rel="nofollow"><i class="fas fa-copy"></i></a>
                        <a title="Удалить" href="reservations?id=<?=$result_value['reservation_id']?>&state=2<?=$search_get?>" class="text-danger" rel="nofollow"><i class="fas fa-trash-alt"></i></a>
                      </td>
                    </tr>
                  <?endforeach;
                else:?>
                  </tbody>
                  </table>
                  <h4 class="text-center mt-5">
                    Не найдено ни одной записи!<br>
                    <i class="fas fa-dizzy mt-5" style="font-size:256px"></i>
                  </h4>
                <?endif;
              else:?>
                </tbody>
                </table>
                <h4 class="text-center mt-5">
                  SQL запрос не был выполнен!<br>
                  <i class="fas fa-dizzy mt-5" style="font-size:256px"></i>
                </h4>
              <?endif;?>
          </tbody>
      </table>
    <?endif;?>
  </div>
</main>

<?
require_once($_CONFIG['TEMPLATES']['FOOTER_CRUD']);
}
?>