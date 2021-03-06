<?php
    include "Ticket.php";

    class TList {
        private $arrTickets;
        private $sizeList;

        function __construct() {
            $this->sizeList = 0;
            $this->arrTickets = [];
            
            // Если файл существует
            if (file_exists($_SESSION['UserLogin'] . ".txt")) {
                $file = fopen($_SESSION['UserLogin'] . ".txt", 'r') or die("can't read open file");    
            }
            // Иначе создать такой чистый файл
            else {
                $file = fopen($_SESSION['UserLogin'] . ".txt", 'w') or die("can't read open file");
            }
            while(!feof($file)) {
                $textTicket = fgets($file);
                if ($textTicket == "") break;
                $this->sizeList++;
                $this->addTicket($textTicket);
            }
            fclose($file);
        }

        //Добавить новый тикет в массив
        public function addTicket($text) {
            $newTicket = new Ticket($text);
            array_push($this->arrTickets, $newTicket);
        }

        //Получить кол-во тикетов
        public function getCountList() {
            return $this->sizeList;
        }

        //Получить тикет по id
        public function getTicketById($id) {
            return $this->arrTickets[$id];
        }
    };
?>