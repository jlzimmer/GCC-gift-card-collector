<?php
    // SQL statement constructors for CRUD operations on individual cards (transactions table)
    class Card {
        public $result;
        private $userid;
        private $cardid;

        function __construct($user, $card) {
            $this->result = null;
            $this->userid = $user;
            $this->cardid = $card;
        }

        function __destruct() {

        }

        function read() {
            $this->result = $mysqli->query("SELECT * FROM transactions WHERE cardId = $cardid");
            $data = array();

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    array_push($data, $row);
                }
            }

            return $data;
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
