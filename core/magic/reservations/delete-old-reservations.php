<?   
    session_start();
    if (isset($_SESSION['login'])){
        $ref = 'http://'.$_SERVER["SERVER_NAME"]."/reservations";
        require_once($_SERVER['DOCUMENT_ROOT'] . "/config/config.php");
        require_once($_CONFIG['DATABASE']['CONNECT']);
        $str = $db->prepare("DELETE FROM reservations WHERE date < CURRENT_DATE()");
        $str->execute() or die("<div class=\"alert container alert-danger mt-5 mb-5\" role=\"alert\">Невозможно удалить бронирования! Запрос не был выполнен!</div>");   
        header("Location: ".$ref);
    }
    else{
        header('HTTP/1.0 404 Not Found');
        header('Status: 404 Not Found');
    }
?>