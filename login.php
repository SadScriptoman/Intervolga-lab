<?php
    session_start();
    $connect = mysqli_connect('localhost', 'root', '');
    mysqli_select_db($connect, 'lab');
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (isset($_POST['login']) and isset($_POST['password'])) {
            $login = $_POST['login'];
            $password = mysqli_real_escape_string($connect, $_POST['password']);
            $ref = (isset($_COOKIE['ref'])) ? $_COOKIE['ref'] : "index.php";
            $select = mysqli_query($connect, "SELECT * FROM users WHERE login = '$login' and password = '$password'");
            if (mysqli_num_rows($select) == 1) {
                $_SESSION['login'] = $login;
                date_default_timezone_set('Europe/Samara');
                $_SESSION['login_time'] = date('H:i:s', time());
            } else {
                $error_msg = "Неверный логин или пароль!";
            }
            if (isset($_SESSION['login']) && !isset($error_msg)) {
                header("Location: ".$ref);
            }
        }
    }
?>
<!doctype html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>Ресторан</title>

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="bootstrap/bootstrap.min.css" >
        <link rel="stylesheet" href="src/css/main.css">
    </head>

    <body class="text-center d-flex justify-content-center align-items-center flex-column">

        <form class="form-signin" method="post" action="login.php">
            <h1 class="h3 mb-3 font-weight-normal">Войдите</h1>
            <label for="login" class="sr-only  mt-2">Логин</label>
            <input type="text" name="login" id="login" class="form-control  mt-2" placeholder="Логин" required autofocus>
            <label for="password" class="sr-only  mt-2">Пароль</label>
            <input type="password" name="password" id="password" class="form-control mt-2" placeholder="Пароль" required>
            <? if (isset($error_msg)){?>
                <div class = "alert alert-danger  mt-2" role = "alert"> <?=$error_msg; ?></div>
            <? }?>
            <button class="btn btn-lg btn-primary btn-block mt-2" type="submit">Войти</button>
        </form>

        <script src="jquery/jquery-3.4.1.min.js" ></script>
        <script src="bootstrap/bootstrap.bundle.min.js" ></script>

        <script type="text/javascript">
            $(function(){
                    $(".back-to-top").click(function(){
                            var _href = $(this).attr("href");
                            $("html, body").animate({scrollTop: $(_href).offset().top+"px"});
                            return false;
                    });
            });
        </script>

    </body>
    

</html>