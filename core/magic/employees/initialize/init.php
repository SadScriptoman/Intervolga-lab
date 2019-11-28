<?
    require_once($_SERVER['DOCUMENT_ROOT'] . "/config/config.php");
    require_once($_CONFIG['DATABASE']['CONNECT']);
    require_once($_CONFIG['TEMPLATES']['HEADER']);
    require_once($_FUNCTIONS . '/format-phone.php');
    $id = isset($_GET["id"]) ? $_GET["id"] : NULL;
    $state = isset($_GET["state"]) ? $_GET["state"] : -1;
    $name = NULL;
    $tel = NULL;
    $post = NULL;
    $image_name = NULL;
    if (($state == 0 || $state == 1 || $state == 2) && $id){
      $str = $db->prepare("SELECT * FROM employees WHERE e_id = $id");
      $str->execute();
      $result = $str->fetch();
      if (isset($result)){
        $name = $result["e_name"];
        $tel = preg_replace ( "/^7/" , "", $result['e_tel']);
        $post = $result["e_post"];
        $image_name = $result["e_photo"];
      }
    }
    $name = isset($_GET["name"]) ? $_GET["name"] : $name;
    $tel = isset($_GET["tel"]) ? $_GET["tel"] : $tel;
    $post = isset($_GET["post"]) ? $_GET["post"] : $post;
    $image_name = isset($_GET["image_name"]) ? $_GET["image_name"] : $image_name;
    $search = isset($_GET["search"]) ? preg_replace("/\s$/", '',$_GET["search"]) : NULL;
    $search_get = $search?'&search='.$search:'';
    if ($search){
      
        if(!preg_match('/([+]?[0-9\s-\(\)]{2,25})*/', $search)){
          $search_query = "+*".preg_replace("/\s/", '*+*', $search).'*';
        }else{
          $search_unscaped = preg_replace("/[()\-\+\=]/", '', $search); 
          $search_query = '+*'.preg_replace("/\s+/", '*+*', $search_unscaped)."*"; 
        }
    }