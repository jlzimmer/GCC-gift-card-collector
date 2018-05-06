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
            $sql = "SELECT * FROM certificards WHERE owner = '$this->userid'";
            $result = $this->mysqli->query($sql);
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
                    $table .= "<tr id='$id'><td>$id</td><td>$location</td><td>$balance</td><td>$expiration</td><td>$serial</td><td><button class='btn btn-outline-warning raleway' type='button'>View Transactions</button></td></tr>
                    ";
                }

            return $table;
        }

        private function cardHistory($cardID) {
            require 'functions/transactions.php';
            $card = new Card($userid, $cardID);
            $this->data = $card->read();

            $display = '<h1 class="lobster">Transaction history for <?php echo $user;?></h1>';
            $display .= "<table><tr><th>Location</th><th>Balance</th><th>Expiration</th><th>Serial</th><th>Update Balance</th><th>View Transactions</th></tr>";
                foreach ($data as $card) {
                    $id = $card['id'];
                    $location = $card['location'];
                    $balance = $card['balance'];
                    $serial = $card['serialnumber'];
                    $expiration = $card['expiration'];
                    $table .= "<tr><td>$location</td><td>$balance</td><td>$expiration</td><td>$serial</td><td><input id='update' type='button' value='Update'/></td><td><input id='view' type='button' value='View'/></td></tr>";
                }
            $display .= "</table>";
        
        return $display;
        }
    }
?>
