<?   
    require_once($_SERVER['DOCUMENT_ROOT'] . "/config/config.php");
    require_once($_CONFIG['AUTHORIZATION']['IS_LOGGED']);

    if ($logged){
        $search = isset($_GET['search']) ? "?search=".$_GET['search'] : '';
        $ref = 'http://'.$_SERVER["SERVER_NAME"]."/reservations".$search;
        require_once($_CONFIG['DATABASE']['CONNECT']);
        $str = $db->prepare("DELETE FROM reservations WHERE date < CURRENT_DATE()");
        $str->execute() or die("Невозможно удалить бронирования! Запрос не был выполнен!");   
        header("Location: ".$ref);
    }
    else{
        header('HTTP/1.0 404 Not Found');
        header('Status: 404 Not Found');
    }
?>