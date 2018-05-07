<?php
    class Wallet {
        private $userid;
        private $mysqli;

        function __construct($id) {
            $this->userid = $id;

            require 'utilities/db.php';
            $this->mysqli = new mysqli($server, $DBusername, $DBpassword, $dbname);
                if ($this->mysqli->connect_error) {
                    header("Location: ../index.php?result=failedSQLconnection");
                    exit;
                }
        }

        function fetchWallet() {

            $query = "SELECT * FROM certificards WHERE owner = '$this->userid'";
            $result = $this->mysqli->query($query);

            $data = array();
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        array_push($data, $row);
                    }
                }

            $table = '';
                foreach ($data as $card) {
                    $id = $card['id'];
                    $location = $card['location'];
                    $balance = $card['balance'];
                    $serial = $card['serial'];
                    $expiration = $card['expiration'];

                    $table .= "<tr><td>$id</td><td>$location</td><td>$balance</td><td>$expiration</td><td>$serial</td><td><form action='transactions.php' method='POST'><input type='hidden' name='cardID' value='$id'><input type='hidden' name='balance' value='$balance'><button class='btn btn-outline-warning raleway' type='submit'>View Transactions</button></form></td></tr>
                    ";
                }

            return $table;
        }
    }
?>
