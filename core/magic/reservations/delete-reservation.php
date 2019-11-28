<?   
    require_once($_SERVER['DOCUMENT_ROOT'] . "/config/config.php");
    require_once($_CONFIG['AUTHORIZATION']['IS_LOGGED']);

    if ($logged && ($_SERVER['REQUEST_METHOD'] == "GET") && (isset($_GET["id"]))){    
        require_once($_CONFIG['DATABASE']['CONNECT']);
        $search = isset($_GET['search']) ? "?search=".$_GET['search'] : '';
        $str = $db->prepare("DELETE FROM reservations WHERE reservation_id = {$_GET["id"]}");
        if ($str->execute()){
            $ref = 'http://'.$_SERVER["SERVER_NAME"]."/reservations".$search;
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