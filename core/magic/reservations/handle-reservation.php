<?
    session_start();
    if (isset($_SESSION['login']) && ($_SERVER['REQUEST_METHOD'] == "POST")){
        require_once($_SERVER['DOCUMENT_ROOT'] . "/config/config.php");
        require_once($_CONFIG['DATABASE']['CONNECT']);

        $id = isset($_POST['id']) ? $_POST['id'] : FALSE;
        $check_name = (bool) preg_match('/^[а-яёa-z\s]{3,25}$/iu', $_POST['name']);
        $check_tel = (bool) preg_match('/^\s?[\(]{0,1}9[0-9]{2}[\)]{0,1}\s?\d{3}[-]{0,1}\d{2}[-]{0,1}\d{2}$/', $_POST['tel']);
        $check_date = (bool) preg_match('/^(19|20)\d\d\-(0[1-9]|1[012])\-(0[1-9]|[12][0-9]|3[01])$/', $_POST['date']);
        $check_time = (bool) preg_match('/^([0-1]\d|2[0-3])(:[0-5]\d)(:\d\d)?$/', $_POST['time']);
        $check_table = (bool) preg_match('/^[0-9]$|^[1-5][0-9]$|^6[0-8]$/', $_POST['table_number']);

        $ref_w_get = 'http://'.$_SERVER["SERVER_NAME"]."/reservations".'?name='.$_POST['name'].'&tel='.$_POST['tel'].'&date='.$_POST['date'].'&time='.$_POST['time'].'&table_number='.$_POST['table_number'].'&deposit='.$_POST['deposit'];
        if ($id) {
            $ref_w_get = $ref_w_get . "&state=1";
        }
        else{
            $ref_w_get = $ref_w_get . "&state=0";
        }
        $ref = 'http://'.$_SERVER["SERVER_NAME"]."/reservations";

        if ($check_name && $check_tel && $check_date && $check_time && $check_table) {
            $name = $_POST['name'];
            $tel = "+7 ".$_POST['tel'];
            $date = date("Y-m-d H:i:s", strtotime($_POST['date']));
            $time = date("Y-m-d H:i:s", strtotime($_POST['time']));
            $table_number = $_POST['table_number'];
            $deposit = isset($_POST['deposit']) ? $_POST['deposit']:NULL;
            if ($id){
                $str = $db->prepare("UPDATE reservations SET name = '$name', telephone = '$tel', deposit = '$deposit', time = '$time', table_number = '$table_number' WHERE reservation_id = $id");
            }else{
                $str = $db->prepare("INSERT INTO reservations (name, telephone, deposit, date, time, table_number) VALUES ('$name', '$tel', '$deposit', '$date', '$time', '$table_number')");
            }
            if ($str->execute()) {
                header("Location: ".$ref);
            }
            else{
                echo "Произошла ошибка с отправкой данных в бд!<br>";
                echo '<a href="'.$ref_w_get.'" class="btn btn-success mt-3">Вернуться</a>';           
            }
        }
        else{?>
            <div class="alert container alert-danger mt-5" role="alert">
                Следующие данные введены неверно: 
                <ul>
                    <?
                    if (!$check_name) echo '<li>Фамилия клиента</li>';
                    if (!$check_tel) echo '<li>Телефон клиента</li>';
                    if (!$check_date) echo '<li>Дата бронирования</li>';
                    if (!$check_time) echo '<li>Время бронирования</li>';
                    if (!$check_table) echo '<li>Номер столика</li>';
                    ?>
                </ul>
                <a href="<?=$ref_w_get?>" class="btn btn-success mt-3">Вернуться</a>
            </div>    
        <?}
        
    }
    else{
        header('HTTP/1.0 404 Not Found');
        header('Status: 404 Not Found');
    }
?>