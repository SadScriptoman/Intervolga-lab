<?
    session_start();
    if (isset($_SESSION['login'])){
        require_once("db-connect.php");//подключение к бд через PDO
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if (isset($_POST['name']) && isset($_POST['tel']) && isset($_POST['date']) && isset($_POST['time']) && isset($_POST['table_number'])) {
                $name = $_POST['name'];
                $tel = $_POST['tel'];
                $date = date("Y-m-d H:i:s", strtotime($_POST['date']));
                $time = date("Y-m-d H:i:s", strtotime($_POST['time']));
                $table_number = $_POST['table_number'];
                $deposit = isset($_POST['deposit']) ? $_POST['deposit']:NULL;
                $str = $db->prepare("INSERT INTO reservations (name, telephone, deposit, date, time, table_number) VALUES ('$name', '$tel', '$deposit', '$date', '$time', '$table_number')");
                $str->execute() or die("Произошла ошибка с отправкой данных в бд!");
            }
        }
        header("Location: reservations.php");
    }
    else{
        header('HTTP/1.0 404 Not Found');
        header('Status: 404 Not Found');
    }
?>