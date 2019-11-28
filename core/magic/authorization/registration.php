<?
    require_once($_SERVER['DOCUMENT_ROOT'] . "/config/config.php");
    require_once($_CONFIG['DATABASE']['CONNECT']);
    $login_is_fine = true;
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $check_login = (bool) preg_match('/^[a-z0-9]{4,20}$/iu', $_POST['login']);
        $check_pass = (bool) preg_match('/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[~!@#$%^&*()+\`\';:<>\/\|]).{6,20}$/', $_POST['password']);
        $check_rep_pass = (bool) $_POST['password'] == $_POST['rep-password'];
        $ref = (isset($_COOKIE['ref'])) ? $_COOKIE['ref'] : $_MAIN_PAGE;
        if ($check_login && $check_pass && $check_rep_pass) {
            $login = $_POST['login'];
            $str = $db->prepare("SELECT COUNT(*) FROM users WHERE login = '$login'");
            $str->execute();
            $result = $str->fetchColumn();
            if ($result == 0){
                $password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $str = $db->prepare("INSERT INTO users (login, password) VALUES ('$login', '$password_hash')");
                if ($str->execute()){
                    $_SESSION['login'] = $login;
                    date_default_timezone_set('Europe/Samara');
                    $_SESSION['login_time'] = date('H:i:s', time());
                    header("Location: ".$ref);
                }
                else{
                    die("<br><br><div class=\"alert container alert-danger mt-5 mb-5\" role=\"alert\">Не удалось добавить пользователя!</div>");
                }
            }else $login_is_fine = false;
        }
    }