<?php
    // SQL statement constructors for CRUD operations on individual cards (transactions table)
    class card {
        public $result;
        public $mysqli;
        private $userid;
        private $cardid;

        function __construct($user, $card) {
            $this->result = null;
            require 'db.php';
            $this->mysqli = $mysql;
            $this->userid = $user;
            $this->cardid = $card;
        }

        function read() {
            $this->result = $mysqli->query("SELECT balanceDelta, date FROM transactions WHERE cardId = $cardid");
        }

        function update($delta) {
            $balance = $mysqli->query("SELECT balance FROM certificards WHERE id = $cardid");
            $newbalance = $balance - $delta;

            if ($newbalance <= 0) {
                $this->delete();
                $mysqli->close();
                header("Location: ../wallet.php?result=zeroBalance");
                exit();
            }

            if ($mysqli->query("UPDATE certificards SET balance = $newbalance WHERE id = $cardid") === true) {
                $mysqli->query("INSERT INTO transactions (cardId, balanceDelta, date) VALUES ($cardid, $delta, NOW())");
            }

            $this->read();
        }

        function delete() {
            $mysqli->query("DELETE FROM certificards WHERE id = $cardid");
            $mysqli->query("DELETE FROM transactions WHERE cardId = $cardid");

            $this->read();
        }
    }
?>
