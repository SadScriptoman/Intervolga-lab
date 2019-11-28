<?  
    require_once($_SERVER['DOCUMENT_ROOT'] . "/config/config.php");
    require_once($_CONFIG['DATABASE']['CONNECT']);
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $ref = (isset($_COOKIE['ref'])) ? $_COOKIE['ref'] : $_MAIN_PAGE;
        if (isset($_POST['login']) && isset($_POST['password'])) {
            $login = $_POST['login'];
            $password = $_POST['password'];
            $str = $db->prepare("SELECT password FROM users WHERE login = '$login'");
            $str->execute() or die("<br><br><div class=\"alert container alert-danger mt-5 mb-5\" role=\"alert\">Не удалось проверить логин и пароль!</div>");
            $result = $str->fetch();
            if ($result['password']) {
                if (password_verify($password, $result['password'])){
                    $_SESSION['login'] = $login;
                    $_COOKIE['session_id'] = session_id();
                    date_default_timezone_set('Europe/Samara');
                    $_SESSION['login_time'] = date('H:i:s', time());
                }
            } else {
                $error_msg = "Неверный логин или пароль!";
            }
            if (isset($_SESSION['login']) && !isset($error_msg)) {
                header("Location: ".$ref);
            }
        }
    }