<?php
    if (isset($_COOKIE['session_id'])) session_id($_COOKIE['session_id']);
    session_start();
    if (!isset($_SESSION['login'])){
        require_once($_SERVER['DOCUMENT_ROOT'] . "/config/config.php");
        require_once($_CONFIG['DATABASE']['CONNECT']);
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $ref = (isset($_COOKIE['ref'])) ? $_COOKIE['ref'] : "index";
            if (isset($_POST['login']) and isset($_POST['password'])) {
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
    }
?>
<!doctype html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>Вход</title>

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="core/src/bootstrap/bootstrap.min.css" >
        <link rel="stylesheet" href="core/src/css/main.css">
    </head>

    <body class="text-center d-flex justify-content-center align-items-center flex-column">

        <? if (!isset($_SESSION['login'])):?>

            <form class="form-signin" method="post" action="login">
                <h1 class="h3 mb-3 font-weight-normal">Войдите</h1>
                <label for="login" class="sr-only  mt-2">Логин</label>
                <input type="text" name="login" id="login" class="form-control  mt-2" placeholder="Логин" value="<?if (isset($_POST["login"])){echo $_POST["login"];}?>" required autofocus>
                <label for="password" class="sr-only  mt-2">Пароль</label>
                <input type="password" name="password" id="password" class="form-control mt-2" placeholder="Пароль" value="<?if (isset($_POST["password"])){echo $_POST["password"];}?>" required>
                <button class="btn btn-primary btn-block mt-2 mb-3" type="submit">Войти</button>
                <? if (isset($error_msg)){?>
                    <p class="mt-3 text-danger" > <?=$error_msg; ?></p>
                <? }?>
                <p>Или <a href="registration">зарегестрироваться</a></p>
            </form>
        <?else:
            header("Location: ".$ref);
        endif;?>

    </body>
    

</html>