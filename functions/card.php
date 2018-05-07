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

        function update($delta) {
            $balance = $this->mysqli->query("SELECT balance FROM certificards WHERE id = $this->cardid");
            $newbalance = $balance - $delta;

            if ($newbalance <= 0) {
                $this->delete();
                header("Location: ../library.php?result=zeroBalance");
                exit;
            }

            if ($this->mysqli->query("UPDATE certificards SET balance = $newbalance WHERE id = $this->cardid") === true) {
                $this->mysqli->query("INSERT INTO transactions (cardId, balanceDelta, date) VALUES ($this->cardid, $delta, NOW())");
            }

            $this->read();
        }

        function delete() {
            $mysqli->begin_transaction(MYSQLI_TRANS_START_READ_ONLY);
            $mysqli->query("DELETE FROM certificards WHERE id = $this->cardid");
            $mysqli->query("DELETE FROM transactions WHERE cardId = $this->cardid");
                if (!$mysqli->commit()) {
                    $_SESSION['add'] = 4;
                    $append = $_SESSION['user'];
                    header("Location: ../library.php?result=loggedIn&user=$append");
                    exit;
                }

            $_SESSION['add'] = 5;
            $append = $_SESSION['user'];
            header("Location: ../library.php?result=loggedIn&user=$append");
            exit;
        }
    }
?>
