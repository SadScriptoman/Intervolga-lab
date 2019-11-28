<?
  require_once($_SERVER['DOCUMENT_ROOT'] . "/config/config.php");
  $ref = isset($_COOKIE['ref']) ? preg_replace('/search=.*/','',$_COOKIE['ref']): 'reservations';
  setcookie("ref", $_SERVER['REQUEST_URI']); 

  require_once($_CONFIG['DATABASE']['CONNECT']);
  require_once($_CONFIG['TEMPLATES']['HEADER']);
  require_once($_FUNCTIONS . '/format-phone.php');

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
      $tel = preg_replace ( "/^7/" , "", $result['telephone']);
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
  $search = isset($_GET["search"]) ? preg_replace("/^\s|\s$/", '',$_GET["search"]) : NULL;
  $search_get = $search?'&search='.$search:'';
  if ($search){
    $search_query = "*".preg_replace("/\s/", '**', $search).'*';
  }