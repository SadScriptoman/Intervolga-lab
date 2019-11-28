<?
    if (isset($_COOKIE['session_id'])) {
        session_id($_COOKIE['session_id']);
    }
    session_start();
    
    if (isset($_SESSION['login'])){
        $logged = TRUE;
    }else{
        $logged = FALSE;
    }
?>