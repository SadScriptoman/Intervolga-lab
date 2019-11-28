<?   
    require_once($_SERVER['DOCUMENT_ROOT'] . "/config/config.php");
    require_once($_CONFIG['AUTHORIZATION']['IS_LOGGED']);
  
    if ($logged && ($_SERVER['REQUEST_METHOD'] == "GET") && (isset($_GET["id"]))){    
        $ref = (isset($_COOKIE['ref'])) ? $_COOKIE['ref'] : "index";
        require_once($_CONFIG['DATABASE']['CONNECT']);
        $str = $db->prepare("DELETE FROM pages WHERE page_id = {$_GET["id"]}");
        if ($str->execute()){
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