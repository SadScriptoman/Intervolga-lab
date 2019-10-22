<?
    session_start();
    session_destroy();
    $ref = (isset($_COOKIE['ref'])) ? $_COOKIE['ref'] : "index.php";
    header("Location: ".$ref);
?>