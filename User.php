<?php
    class User {
        static protected $fileName = "data.txt";

        // Добавить нового пользователя в базу
        public static function addUser($Name, $Password) {
            $file = fopen(User::$fileName, 'a+') or die("can't read open file");
            while (!feof($file)) {
                $UserName = fgets($file);
                $UserPass = fgets($file);
                if ( (substr($UserName, 0, strlen($Name)) == $Name) && (strlen($Name) > 1) ) {
                    fclose($file);
                    return false;
                }
            }
            fwrite($file, "\n" . $Name . "\n");
            fwrite($file, md5($Password));
            fclose($file);
            return true;
        }

        // Проверить пользователя в базе. вернуть true, если такой пользователь есть
        // иначе вернуть false
        public static function checkUser($Name, $Password) {
            $file = fopen(User::$fileName, 'r') or die("can't read open file");
            while (!feof($file)) {
                $UserName = fgets($file);
                $UserPass = fgets($file);
                if ( (substr($UserName, 0, strlen($Name)) == $Name) && (substr($UserPass, 0, strlen(md5($Password))) == md5($Password)) ) {
                    fclose($file);
                    return true;
                }
            }
            fclose($file);
            return false;
        }
    };
?>