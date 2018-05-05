<?php
    class Controller {
        private $model;
        private $views;

        private $currentView;
        private $wallet = array();
        private $id;

        function __construct() {
            $this->model = new Model();
            $this->views = new View();
            $this->id = $_SESSION['userID'];
            require 'db.php';
        }

        function run() {
            
        }

        private function fetchWallet() {
            $sql = "SELECT * FROM certificards WHERE owner = '$id'";
            $result = $mysqli->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        array_push($wallet, $row);
                    }
                }
                
                $display = "<h1 class="lobster">Wallet for <?php echo $user?></h1>";
                $display .= "<table><tr><th>Location</th><th>Balance</th><th>Expiration</th><th>Serial</th><th>Update Balance</th><th>View Transactions</th></tr>";
                    foreach ($wallet as $card) {
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
