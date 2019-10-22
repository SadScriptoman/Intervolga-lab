<?
    $db = NULL;
    try{
        $db = new PDO('mysql:host=localhost;dbname=lab;charset=utf8', "root", "", array(
            PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC,
            PDO::ATTR_ERRMODE=>TRUE
        ));
    }catch(PDOException $e){
        echo '<br><br><div class="alert container alert-danger mt-5" role="alert">
        Подключение к бд не удалось: ' . $e->getMessage(). '</div>';
     
    }
?>