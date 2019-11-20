<?
    $db = NULL;
    require_once($_SERVER['DOCUMENT_ROOT'] . "/config/config.php");
    try{
        $db = new PDO('mysql:host='.$_CONFIG['DATABASE']['HOST'].';dbname='.$_CONFIG['DATABASE']['NAME'].';charset='.$_CONFIG['DATABASE']['CHARSET'], $_CONFIG['DATABASE']['USERNAME'], $_CONFIG['DATABASE']['PASS']);
    }catch(PDOException $e){
        echo '<br><br><div class="alert container alert-danger mt-5" role="alert">
        Подключение к бд не удалось: ' . $e->getMessage(). '</div>';
    }
?>