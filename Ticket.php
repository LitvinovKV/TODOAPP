<?php
    class Ticket {
        private $text;

        function __construct($newText) {
            $this->text = $newText;
        }

        //Получить текст тикета
        public function getText() {
            return $this->text;
        }
    };
?>
