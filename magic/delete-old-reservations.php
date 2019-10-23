<?   
    session_start();
    if (isset($_SESSION['login'])){
        $ref = (isset($_COOKIE['ref'])) ? $_COOKIE['ref'] : "index";
        require_once("db-connect.php");//подключение к бд через PDO
        $str = $db->prepare("DELETE FROM reservations WHERE date < CURRENT_DATE()");
        $str->execute() or die("<div class=\"alert container alert-danger mt-5 mb-5\" role=\"alert\">Невозможно удалить бронирования! Запрос не был выполнен!</div>");   
        header("Location: ".$ref);
    }
    else{
        header('HTTP/1.0 404 Not Found');
        header('Status: 404 Not Found');
    }
?>