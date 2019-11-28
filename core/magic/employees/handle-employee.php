<?
    require_once($_SERVER['DOCUMENT_ROOT'] . "/config/config.php");
    require_once($_CONFIG['AUTHORIZATION']['IS_LOGGED']);

    if ($logged && ($_SERVER['REQUEST_METHOD'] == "POST")){
 
        require_once($_CONFIG['DATABASE']['CONNECT']);
        require_once($_FUNCTIONS . "/translit.php");
        require_once($_FUNCTIONS . "/image-manipulation.php");

        $ext = array('image/png'=>'.png', 'image/jpeg'=>'.jpg');
        $id = isset($_POST['id']) ? $_POST['id'] : FALSE;
        $search = isset($_POST['search']) ? "&search=".$_POST['search'] : '';
        
        $check_name = (bool) preg_match('/^[а-яёa-z\s]{3,100}$/iu', $_POST['name']);
        $check_tel = (bool) preg_match('/^\s?[\(]{0,1}9[0-9]{2}[\)]{0,1}\s?\d{3}[-]{0,1}\d{2}[-]{0,1}\d{2}$/', $_POST['tel']);
        $check_post = (bool) preg_match('/^[а-яё\s]{3,30}$/iu', $_POST['post']);
        $check_image = (bool) array_key_exists($_FILES["image"]["type"], $ext);
                
        if ($id) {//если передан id, то в случае возврата на страницу сотрудников откроется форма редактирования потому что state=1
            $ref_w_get = 'http://'.$_SERVER["SERVER_NAME"]."/employees".'&id='.$id."&state=1".$search;
        }
        else{//если нет, то откроется форма добавления (state=0)
            $ref_w_get = 'http://'.$_SERVER["SERVER_NAME"]."/employees".'&?name='.$_POST['name'].'&tel='.$_POST['tel'].'&post='.$_POST['post'].'&state=0'.$search;
        }

        $ref = 'http://'.$_SERVER["SERVER_NAME"]."/employees".str_replace('&', '?', $search);

        if ($check_name && $check_post && $check_tel){
            $name = $_POST['name'];
            $tel = "7".preg_replace('/[()\-\+\s]/', '', $_POST['tel']);
            $post = $_POST['post'];
            if ($check_image){
                $ext = $ext[$_FILES["image"]["type"]];
                $rnd_str = "-".rnd_chars(5);//на всякий случай генирирую рандомную строку
                $file_name = translit($name) . "-original" . $rnd_str . $ext;//генерируем название для оригинальной картинки
                $file_name_prepared = translit($name) . $rnd_str . ".jpg";//и для конечной картинки
                $file_path = $_CONFIG['EMPLOYEES']["FULL_PATH_TO_PHOTOS"];//путь до папки с фотками
                move_uploaded_file($_FILES["image"]["tmp_name"], $file_path . $file_name);//сохраняю файл из отправленной формы
                $cropped = prepare_e_photo($file_path . $file_name, $file_path . $file_name_prepared, $_CONFIG["EMPLOYEES"]["IMAGE_W"], $_CONFIG["EMPLOYEES"]["IMAGE_H"], 100);//обрезаю
                if ($cropped){
                    unlink($file_path . $file_name);//удаляем оригинальную картинку
                    if ($id){//если передан id в форме то делаем UPDATE
                        $str = $db->prepare("SELECT e_photo FROM employees WHERE e_id = $id");
                        if ($str->execute()) {
                            $result = $str->fetch();
                            unlink($file_path . $result["e_photo"]);//удаляем старую картинку
                        }
                        $str = $db->prepare("UPDATE employees SET e_name = '$name', e_tel = '$tel', e_post = '$post', e_photo = '$file_name_prepared' WHERE e_id = $id");
                    }
                    else{//если не передан id то создаем новый элемент
                        $str = $db->prepare("INSERT INTO employees (e_name, e_tel, e_post, e_photo) VALUES ('$name', '$tel', '$post', '$file_name_prepared')");
                    }

                }else{
                    echo "Произошла ошибка с обрезкой картинки!<br>";
                    echo '<a href="'.$ref_w_get.'" class="btn btn-success mt-3">Вернуться</a>';      
                }
            }
            elseif ($id){//если передан id в форме то делаем UPDATE
                $str = $db->prepare("UPDATE employees SET e_name = '$name', e_tel = '$tel', e_post = '$post' WHERE e_id = $id");
            }
            else{?>
                <div class="alert container alert-danger mt-5" role="alert">
                    Картинка не выбрана!
                    <a href="<?=$ref_w_get?>" class="btn btn-success mt-3">Вернуться</a>
                </div>    
            <?}
            
            if ($str->execute()) {
                header("Location: ".$ref);
            }
            else{
                echo "Произошла ошибка с отправкой данных в бд!<br>";
                echo '<a href="'.$ref_w_get.'" class="btn btn-success mt-3">Вернуться</a>';           
            }
            
        }   
        else{?>
            <div class="alert container alert-danger mt-5" role="alert">
                Следующие данные введены неверно: 
                <ul>
                    <?
                    if (!$check_name) echo '<li>Имя сотрудника = '.$_POST['name'].'</li>';
                    if (!$check_post) echo '<li>Должность сотрудника = '.$_POST['post'].'</li>';
                    if (!$check_tel) echo '<li>Телефон сотрудника = 7'.$_POST['tel'].'</li>';
                    ?>
                </ul>
                <a href="<?=$ref_w_get?>" class="btn btn-success mt-3">Вернуться</a>
            </div>    
        <?}  
    }
    else{
        header('HTTP/1.0 404 Not Found');
        header('Status: 404 Not Found');
    }
?>