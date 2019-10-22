<?php
    session_start();
    $ref = (isset($_COOKIE['ref'])) ? $_COOKIE['ref'] : "index.php";
    if (!isset($_SESSION['login'])){
        require_once("magic/db-connect.php");//подключение к бд через PDO
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if (isset($_POST['login']) and isset($_POST['password'])) {
                $login = $_POST['login'];
                $password = $_POST['password'];
                $str = $db->prepare("SELECT COUNT(*) FROM users WHERE login = '$login' and password = '$password'");
                $str->execute() or die("<div class=\"alert container alert-danger mt-5 mb-5\" role=\"alert\">Не удалось проверить логин и пароль!</div>");
                $result = $str->fetchColumn();
                if ($result == 1) {
                    $_SESSION['login'] = $login;
                    date_default_timezone_set('Europe/Samara');
                    $_SESSION['login_time'] = date('H:i:s', time());
                } elseif ($result == 0) {
                    $error_msg = "Неверный логин или пароль!";
                }
                else{
                    $error_msg = "Произошла ошибка, пользователей с таким логином больше одного!";
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
        <link rel="stylesheet" href="bootstrap/bootstrap.min.css" >
        <link rel="stylesheet" href="src/css/main.css">
    </head>

    <body class="text-center d-flex justify-content-center align-items-center flex-column">

        <? if (!isset($_SESSION['login'])):?>

            <form class="form-signin" method="post" action="login.php">
                <h1 class="h3 mb-3 font-weight-normal">Войдите</h1>
                <label for="login" class="sr-only  mt-2">Логин</label>
                <input type="text" name="login" id="login" class="form-control  mt-2" placeholder="Логин" required autofocus>
                <label for="password" class="sr-only  mt-2">Пароль</label>
                <input type="password" name="password" id="password" class="form-control mt-2" placeholder="Пароль" required>
                <button class="btn btn-primary btn-block mt-2" type="submit">Войти</button>
                <? if (isset($error_msg)){?>
                    <p class="mt-3 text-danger" > <?=$error_msg; ?></p>
                <? }?>
            </form>
        <?else:
            header("Location: ".$ref);
        endif;?>

    </body>
    

</html>