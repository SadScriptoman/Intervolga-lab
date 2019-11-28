<?
    require_once($_SERVER['DOCUMENT_ROOT'] . "/config/config.php");
    require_once($_CONFIG['AUTHORIZATION']['IS_LOGGED']);

    if ($logged && ($_SERVER['REQUEST_METHOD'] == "GET") && (isset($_GET["id"]))){
        $ext = array('image/png'=>'.png', 'image/jpeg'=>'.jpg');
        require_once($_CONFIG['DATABASE']['CONNECT']);
        require_once($_FUNCTIONS . "/translit.php");
        require_once($_FUNCTIONS . "/image-manipulation.php");
        $str = $db->prepare("SELECT * FROM employees WHERE e_id = {$_GET["id"]}");
        $str->execute();
        $result = $str->fetch();
        $search = isset($_GET['search']) ? "?search=".$_GET['search'] : '';
        if ($result){         
            $name = $result['e_name'];
            $tel = $result['e_tel'];
            $post = $result['e_post'];
            $file_name = translit($name) . "-".rnd_chars(5) . ".jpg";
            $file_path = $_CONFIG['EMPLOYEES']["FULL_PATH_TO_PHOTOS"];
            
            copy($file_path.$result['e_photo'], $file_path.$file_name);//копируем фотку
            
            $str = $db->prepare("INSERT INTO employees (e_name, e_tel, e_post, e_photo) VALUES ('$name', '$tel', '$post', '$file_name')");
            if ($str->execute()) {
                $ref = 'http://'.$_SERVER["SERVER_NAME"]."/employees".$search;
                header("Location: ".$ref);
            }
            else{
                die("Произошла ошибка с отправкой данных в бд!");
            }
        }
        else{
            die("Сотрудника не существует!");  
        }
    }
    else{
        header('HTTP/1.0 404 Not Found');
        header('Status: 404 Not Found');
    }
?>