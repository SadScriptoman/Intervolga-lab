<?   
    session_start();
    $ref = (isset($_COOKIE['ref'])) ? $_COOKIE['ref'] : "index.php";
    if (isset($_SESSION['login'])){
        require_once("db-connect.php");//подключение к бд через PDO
        $str = $db->prepare("DELETE FROM reservations WHERE date < CURRENT_DATE()");
        $str->execute() or die("Произошла ошибка с удалением данных!");   
    }
    header("Location: ".$ref);
?>