<?   
    session_start();
    if ((isset($_SESSION['login'])) && ($_SERVER['REQUEST_METHOD'] == "GET") && (isset($_GET["id"]))){    
        require_once($_SERVER['DOCUMENT_ROOT'] . "/config/config.php");
        require_once($_CONFIG['DATABASE']['CONNECT']);
        $str = $db->prepare("DELETE FROM reservations WHERE reservation_id = {$_GET["id"]}");
        if ($str->execute()){
            $ref = 'http://'.$_SERVER["SERVER_NAME"]."/reservations";
            header("Location: ".$ref);
        } else{
            die("Запрос не выполнен! Попробуйте снова.");   
        }
    }
    else{
        header('HTTP/1.0 404 Not Found');
        header('Status: 404 Not Found');
    }
?>