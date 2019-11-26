<?php
    if (isset($_COOKIE['session_id'])) session_id($_COOKIE['session_id']);
    session_start();
    if (!isset($_SESSION['login'])){
        require_once($_SERVER['DOCUMENT_ROOT'] . "/config/config.php");
        require_once($_CONFIG['DATABASE']['CONNECT']);
        $login_is_fine = true;
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $check_login = (bool) preg_match('/^[a-z0-9]{4,20}$/iu', $_POST['login']);
            $check_pass = (bool) preg_match('/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[~!@#$%^&*()+\`\';:<>\/\|]).{6,20}$/', $_POST['password']);
            $check_rep_pass = (bool) $_POST['password'] == $_POST['rep-password'];
            $ref = (isset($_COOKIE['ref'])) ? $_COOKIE['ref'] : "index";
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
    }
?>
<!doctype html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>Регистрация</title>

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="core/src/bootstrap/bootstrap.min.css" >
        <link rel="stylesheet" href="core/src/css/main.css">
    </head>

    <body class="text-center d-flex justify-content-center align-items-center flex-column">

        <? if (!isset($_SESSION['login'])):?>

            <form class="form-signin needs-validation" method="post" action="registration" id="registration" novalidate>
                <h1 class="h3 mb-3 font-weight-normal">Регистрация</h1>
                
                <div class="form-group">
                    <label for="login" class="sr-only">Логин</label>
                    <input type="text" name="login" id="login" class="form-control mt-2 <?if (!$login_is_fine) echo "is-invalid"?>" pattern="^[a-zA-Z0-9]{4,20}$" maxlength="20" minlength="4" placeholder="Логин" value="<?if (isset($_POST["login"])){echo $_POST["login"];}?>" required autofocus>
                    <div class="invalid-feedback"><?=$login_is_fine ? "Логин должен быть больше 4 символов и может содержать только латинские буквы и цифры" : "Логин уже занят" ?></div>
                </div>

                <div class="form-group">
                    <label for="password" class="sr-only  mt-2">Пароль</label>
                    <input type="password" name="password" id="password" class="form-control mt-2" pattern="^(?=.*[a-zA-Z])(?=.*\d)(?=.*[~!@#$%^&*()+`';:<>\/\|]).{6,20}$" minlength="6" maxlength="20" placeholder="Пароль" value="<?if (isset($_POST["password"])){echo $_POST["password"];}?>" required>
                    <div class="invalid-feedback">Пароль должен быть больше 6 символов, содержать латинские буквы, цифры и спец символы (~!@#$%^&*()+`';:<>/\|)</div>
                </div>

                <div class="form-group">
                    <label for="password" class="sr-only  mt-2">Повторите пароль</label>
                    <input type="password" name="rep-password" id="rep-password" class="form-control mt-2" minlength="6" maxlength="20" placeholder="Повторите пароль" value="<?if (isset($_POST["rep-password"])){echo $_POST["rep-password"];}?>" required>
                    <div class="invalid-feedback">Пароли не совпадают</div>
                </div>
                
                <button class="btn btn-primary btn-block mt-2 mb-3" type="submit">Зарегестрироваться</button>
                <p>Или <a href="login">войти</a></p>
            </form>
        <?else:
            header("Location: ".$ref);
        endif;

    require_once($_CONFIG['TEMPLATES']['FOOTER_REG']);
?>