<?
    session_start();
    if ((isset($_SESSION['login'])) && ($_SERVER['REQUEST_METHOD'] == "GET") && (isset($_GET["id"]))){
        $ext = array('image/png'=>'.png', 'image/jpeg'=>'.jpg');
        require_once($_SERVER['DOCUMENT_ROOT'] . "/config/config.php");
        require_once($_CONFIG['DATABASE']['CONNECT']);
        require_once($_CONFIG['FUNCTIONS_PATH']."translit.php");
        require_once($_CONFIG['FUNCTIONS_PATH']."image-manipulation.php");
        $str = $db->prepare("SELECT * FROM reservations WHERE reservation_id = {$_GET["id"]}");
        $str->execute();
        $result = $str->fetch();
        if ($result){     
            $name = $result['name'];
            $tel = $result['telephone'];
            $date = date("Y-m-d H:i:s", strtotime($result['date']));
            $time = date("Y-m-d H:i:s", strtotime($result['time']));
            $table_number = $result['table_number'];
            $deposit = isset($result['deposit']) ? $result['deposit']:NULL;
            
            $str = $db->prepare("INSERT INTO reservations (name, telephone, deposit, date, time, table_number) VALUES ('$name', '$tel', '$deposit', '$date', '$time', '$table_number')");
            if ($str->execute()) {
                $ref = 'http://'.$_SERVER["SERVER_NAME"]."/reservations";
                header("Location: ".$ref);
            }
            else{
                die("Произошла ошибка с отправкой данных в бд!");
            }
        }
        else{
            die("Брони не существует! Возможно, она уже удалена!");  
        }
    }
    else{
        header('HTTP/1.0 404 Not Found');
        header('Status: 404 Not Found');
    }
?>