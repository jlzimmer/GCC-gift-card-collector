<?php
    class Card {
        private $cardid;
        private $mysqli;

        function __construct($card) {
            $this->cardid = $card;

            require 'utilities/db.php';
            $this->mysqli = new mysqli($server, $DBusername, $DBpassword, $dbname);
                if ($this->mysqli->connect_error) {
                    header("Location: ../index.php?result=failedSQLconnection");
                    exit;
                }
        }

        function read() {
            $query = "SELECT * FROM transactions WHERE cardId = $this->cardid";
            $result = $this->mysqli->query($query);
            $data = array();
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        array_push($data, $row);
                    }
                }

            $table = '';
                foreach ($data as $trans) {
                    $id = $trans['id'];
                    $delta = $trans['balanceDelta'];
                    $date = $trans['date'];
                    $table .= "<tr><td>$id</td><td>$delta</td><td>$date</td></tr>
                    ";
                }

            return $table;
        }
    }
?>
