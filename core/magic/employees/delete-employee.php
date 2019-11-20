<?   
    session_start();
    if (isset($_SESSION['login']) && ($_SERVER['REQUEST_METHOD'] == "GET") && isset($_GET["id"])){   
        require_once($_SERVER['DOCUMENT_ROOT'] . "/config/config.php");
        require_once($_CONFIG['DATABASE']['CONNECT']);
        $str = $db->prepare("SELECT e_photo FROM employees WHERE e_id = {$_GET["id"]}");
        $str->execute();
        $result = $str->fetch();
        if ($result){
            unlink($_CONFIG["EMPLOYEES"]["FULL_PATH_TO_PHOTOS"].$result[0]);
            $str = $db->prepare("DELETE FROM employees WHERE e_id = {$_GET["id"]}");
            if ($str->execute()){
                $ref = 'http://'.$_SERVER["SERVER_NAME"]."/employees";
                header("Location: ".$ref);
            } else{
                die("Запрос не выполнен! Попробуйте снова.");   
            }
        }
        else{
            die("Не могу найти сотрудника! Возможно, он уже был удален.");
        }
    }
    else{
        header('HTTP/1.0 404 Not Found');
        header('Status: 404 Not Found');
    }
?>