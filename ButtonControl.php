<?php
    require_once "User.php";
    
    //Отловить нажатие кнопки на создание нового таска
    if (isset($_POST['CreateNewTask'])) {
        //если был введен текст для таска, тогд добавляем такс в файл
        if (empty($_POST['textTask']) == false) {
            $file = fopen($_SESSION['UserLogin'] . ".txt", 'a') or die("can't read open file");
            fwrite($file, $_POST['textTask'] . "\n");
            fclose($file);
        }
    }

    //Отловить нажатие кнопки на обновление текста выбранного таска
    if (isset($_POST['UpdateCorrectTask'])) {
        //если не был выбран ни один из тасков, то выйти
        if (isset($_POST['checks']) == false) return;
        $checks = $_POST['checks'];
        //если был выбран один из тасков и было заполнено поле, тогда поменять название
        if ((count($checks) == 1) && (empty($_POST['textTask']) == false)) {
            $arrayLine = file($_SESSION['UserLogin'] . ".txt"); //записать файл построчно в массив
            $arrayLine[$checks[0]] = $_POST['textTask'] . "\n"; //перезаписать элемент массива
            file_put_contents($_SESSION['UserLogin'] . ".txt", $arrayLine); //очистить файл и записать измененный массив
        }
    }

    //Отловить нажатие кнопки на удаление выбранных тасков
    if (isset($_POST['DeleteTasks'])) {
        //если не был выбран ни один из тасков, то выйти
        if (isset($_POST['checks']) == false) return;
        $checks = $_POST['checks'];
        $arrayLine = file($_SESSION['UserLogin'] . ".txt"); //записать файл построчно в массив
        for ($i = 0; $i < count($checks); $i++)
            unset($arrayLine[$checks[$i]]);
        file_put_contents($_SESSION['UserLogin'] . ".txt", $arrayLine); //очистить файл и записать измененный массив
    }

    // Отловить нажатие кнопки на вход в систему
    if (isset($_POST['LogIn'])) {
        //Если true && true (были заполнены все text input)
        if ( (empty($_POST['UserLog']) == false) && (empty($_POST['UserPass']) == false) )
            // Если такие данные пользователя существуют в базе
            if (User::checkUser($_POST['UserLog'], $_POST['UserPass']) == true) {
                $_SESSION['UserLogin'] = $_POST['UserLog'];
                header('location:  http://' . $_SERVER['HTTP_HOST'] . '/tasks.php');
            }
        else 
            return;
    }

    // Отловить нажатие кнопки на атворизацию в систему
    if (isset($_POST['SignUp'])) {
        //Если true && true (были заполнены все text input)
        if ( (empty($_POST['UserLog']) == false) && (empty($_POST['UserPass']) == false) )
            // Если такие данные пользователя существуют в базе
            if (User::addUser($_POST['UserLog'], $_POST['UserPass']) == true) {
                $_SESSION['UserLogin'] = $_POST['UserLog'];
                header('location:  http://' . $_SERVER['HTTP_HOST'] . '/tasks.php');
            }
        else 
            return;
    }

    // Отловить нажатие кнопки "Exit". Очистить данные в сессии и перейти на окно логина 
    if (isset($_POST['ExitList'])) {
        session_unset();
        header('location:  http://' . $_SERVER['HTTP_HOST'] . '/index.php');
    }

?>