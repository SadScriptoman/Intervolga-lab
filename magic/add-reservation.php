<?
    session_start();
    if (isset($_SESSION['login'])){
        $ref = (isset($_COOKIE['ref'])) ? $_COOKIE['ref'] : "index";
        require_once("db-connect.php");//подключение к бд через PDO
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if (isset($_POST['name'])  && isset($_POST['tel']) && isset($_POST['date']) && isset($_POST['time']) && isset($_POST['table_number'])
            && (preg_match('/^[А-Яа-яЁёa-zA-Z]{0,25}/', $_POST['name'])) && (preg_match('/^\s?[\(]{0,1}9[0-9]{2}[\)]{0,1}\s?\d{3}[-]{0,1}\d{2}[-]{0,1}\d{2}$/', $_POST['tel']))
            && (preg_match('/^(19|20)\d\d\-(0[1-9]|1[012])\-(0[1-9]|[12][0-9]|3[01])$/', $_POST['date'])) && (preg_match('/^([0-1]\d|2[0-3])(:[0-5]\d)$/', $_POST['time']))
            && (preg_match('/^[0-9]$|^[1-5][0-9]$|^6[0-8]$/', $_POST['table_number']))) {
                $name = $_POST['name'];
                $tel = "+7 ".$_POST['tel'];
                $date = date("Y-m-d H:i:s", strtotime($_POST['date']));
                $time = date("Y-m-d H:i:s", strtotime($_POST['time']));
                $table_number = $_POST['table_number'];
                $deposit = isset($_POST['deposit']) ? $_POST['deposit']:NULL;
                $str = $db->prepare("INSERT INTO reservations (name, telephone, deposit, date, time, table_number) VALUES ('$name', '$tel', '$deposit', '$date', '$time', '$table_number')");
                $str->execute() or die("Произошла ошибка с отправкой данных в бд!");
            }
        }
        //echo $_POST['name']."\n".preg_match('/^[А-Яа-яЁёa-zA-Z]{0,25}/', $_POST['name']);
        header("Location: ".$ref);
        
    }
    else{
        header('HTTP/1.0 404 Not Found');
        header('Status: 404 Not Found');
    }
?>