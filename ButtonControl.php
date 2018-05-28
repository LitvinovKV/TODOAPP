<?php

    //Отловить нажатие кнопки на создание нового таска
    if (isset($_POST['CreateNewTask'])) {
        //если был введен текст для таска, тогд добавляем такс в файл
        if (empty($_POST['textTask']) == false) {
            $file = fopen("db.txt", 'a') or die("can't read open file");
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
            $arrayLine = file("db.txt"); //записать файл построчно в массив
            $arrayLine[$checks[0]] = $_POST['textTask'] . "\n"; //перезаписать элемент массива
            file_put_contents("db.txt", $arrayLine); //очистить файл и записать измененный массив
        }
    }

    //Отловить нажатие кнопки на удаление выбранных тасков
    if (isset($_POST['DeleteTasks'])) {
        //если не был выбран ни один из тасков, то выйти
        if (isset($_POST['checks']) == false) return;
        $checks = $_POST['checks'];
        $arrayLine = file("db.txt"); //записать файл построчно в массив
        for ($i = 0; $i < count($checks); $i++)
            unset($arrayLine[$checks[$i]]);
        file_put_contents("db.txt", $arrayLine); //очистить файл и записать измененный массив
    }

?>