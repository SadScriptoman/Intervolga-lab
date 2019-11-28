<?
    require_once($_SERVER['DOCUMENT_ROOT'] . "/config/config.php");
    require_once($_CONFIG['DATABASE']['CONNECT']);
    function isBot(&$botname = ''){
        /* Эта функция будет проверять, является ли посетитель роботом поисковой системы */
        $bots = array(
          'rambler','googlebot','aport','yahoo','msnbot','turtle','mail.ru','omsktele',
          'yetibot','picsearch','sape.bot','sape_context','gigabot','snapbot','alexa.com',
          'megadownload.net','askpeter.info','igde.ru','ask.com','qwartabot','yanga.co.uk',
          'scoutjet','similarpages','oozbot','shrinktheweb.com','aboutusbot','followsite.com',
          'dataparksearch','google-sitemaps','appEngine-google','feedfetcher-google',
          'liveinternet.ru','xml-sitemaps.com','agama','metadatalabs.com','h1.hrn.ru',
          'googlealert.com','seo-rus.com','yaDirectBot','yandeG','yandex',
          'yandexSomething','Copyscape.com','AdsBot-Google','domaintools.com',
          'Nigma.ru','bing.com','dotnetdotcom'
        );
        foreach($bots as $bot)
          if(stripos($_SERVER['HTTP_USER_AGENT'], $bot) !== false){
            $botname = $bot;
            return true;
          }
        return false;
    }
    if(!isBot()){
        if ($db){
            $page_url = (string)$_SERVER['REQUEST_URI'];
            $visitor_ip = (string)$_SERVER["REMOTE_ADDR"];
            $visitor_ref = isset($_POST['referer']) ? trim($_POST['referer']) : (isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : NULL);
            $str = $db->prepare("SELECT page_id FROM pages WHERE page_url = '$page_url'");
            $str->execute();
            $result = $str->fetch(PDO::FETCH_ASSOC);
            if (!$result){//проверяем есть ли страница в таблице страниц, если нет - создаем
                if($page_title)
                    $str = $db->prepare("INSERT INTO pages (page_url, page_title) VALUES ('$page_url', '$page_title')");
                else
                    $str = $db->prepare("INSERT INTO pages (page_url) VALUES ('$page_url')");                
                $str->execute() or die('<div class="alert alert-danger" role="alert">Произошла ошибка с отправкой данных в таблицу pages!</div>');

                $str = $db->prepare("SELECT page_id FROM pages WHERE page_url = '$page_url'");
                $str->execute() or die('<div class="alert alert-danger" role="alert">Произошла ошибка с отправкой данных в таблицу pages!</div>');
                $result = $str->fetch(PDO::FETCH_ASSOC);
                if (isset($_SESSION['login'])) echo '<div class="alert alert-success" role="alert">Страница добавлена в аналитику!</div>';
            }
            $page_id = (int)$result["page_id"];

            $str = $db->prepare("SELECT visited_this_page FROM analytics WHERE visitor_ip = '$visitor_ip' AND visited_page_id = '$page_id'");
            $str->execute();
            $result = $str->fetch(PDO::FETCH_ASSOC);
            if ($result){//проверяем есть ли пользователь с таким ip в базе
                $count = (int)$result["visited_this_page"] + 1;//сколько раз пользователь с таким ip зашел на эту страницу
                $db->exec("UPDATE analytics SET visited_this_page = $count WHERE visitor_ip = '$visitor_ip' AND visited_page_id = '$page_id'") or die("Произошла ошибка с обновлением данных в таблице analytics!");
            }
            else{
                $str = $db->prepare("INSERT INTO analytics (visitor_ip, visited_page_id, visitor_ref, visited_this_page) VALUES ('$visitor_ip', '$page_id', '$visitor_ref', 1)") or die("Произошла ошибка с отправкой данных в таблицу analytics!");
                $str->execute();
            }

        }
    }
?>