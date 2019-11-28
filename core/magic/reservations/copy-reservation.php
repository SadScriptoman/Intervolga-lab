<?
    require_once($_SERVER['DOCUMENT_ROOT'] . "/config/config.php");
    require_once($_CONFIG['AUTHORIZATION']['IS_LOGGED']);

    if ($logged && ($_SERVER['REQUEST_METHOD'] == "GET") && (isset($_GET["id"]))){
        $ext = array('image/png'=>'.png', 'image/jpeg'=>'.jpg');
        require_once($_CONFIG['DATABASE']['CONNECT']);
        $str = $db->prepare("SELECT * FROM reservations WHERE reservation_id = {$_GET["id"]}");
        $str->execute();
        $result = $str->fetch();
        $search = isset($_GET['search']) ? "?search=".$_GET['search'] : '';
        if ($result){     
            $name = $result['name'];
            $tel = $result['telephone'];
            $date = date("Y-m-d H:i:s", strtotime($result['date']));
            $time = date("Y-m-d H:i:s", strtotime($result['time']));
            $table_number = $result['table_number'];
            $deposit = isset($result['deposit']) ? $result['deposit']:NULL;
            $date_time = preg_replace('/\-/',' ',$_POST['date']) .' '.preg_replace('/\:/',' ',$_POST['time']);

            $str = $db->prepare("INSERT INTO reservations (name, telephone, deposit, date, time, table_number, date_time) 
            VALUES ('$name', '$tel', '$deposit', '$date', '$time', '$table_number', '$date_time')");
            if ($str->execute()) {
                $ref = 'http://'.$_SERVER["SERVER_NAME"]."/reservations".$search;
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