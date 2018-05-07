<?php 
    require 'utilities/navbar.php';
    require 'functions/wallet.php';

    $userid = $_SESSION['userID'];
    $user = $_SESSION['user'];
?>
        <div class="container" id="wrapper">
            <div class="jumbotron">
                <?php
                    $login = empty($_SESSION['userID']) ? false : true;

                    if ($login) {
                        echo '<h2 class="lobster">Wallet for ' . $user . ' (ID #' . $userid . ')</h2></div>';

                        switch ($_SESSION['add']) {
                            case 1:
                                echo '<div class="alert alert-success alert-dismissible fade show raleway"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Success!</strong> Card added to your wallet.</div>';
                                break;
                            case 2:
                                echo '<div class="alert alert-danger alert-dismissible fade show raleway"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error!</strong> Something went wrong when adding your card.</div>';
                                break;
                            case 3:
                                echo '<div class="alert alert-success alert-dismissible fade show raleway"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Success!</strong> Card balance has been updated.</div>';
                                break;
                            case 4:
                                echo '<div class="alert alert-danger alert-dismissible fade show raleway"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error!</strong> Something went wrong when updating/deleting your card.</div>';
                                break;
                            case 5:
                                echo '<div class="alert alert-success alert-dismissible fade show raleway"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Success!</strong> That card has been deleted from your wallet.</div>';
                                break;
                        }
    
                        $_SESSION['add'] = 0;
                    }
                    else {
                        echo '<h2 class="lobster">You are NOT logged in. Please select log in or sign up from the navigation bar.</h2></div>';
                        exit;
                    }
                ?>
            <div class="table-responsive-lg table-striped">
                <table class="table">
                    <tr class="raleway">
                        <th>Card ID</th>
                        <th>Business</th>
                        <th>Balance</th>
                        <th>Expiration</th>
                        <th>Serial</th>
                        <th>Transaction History</th>
                    </tr>
                    <?php
                        $wallet = new Wallet($userid);
                        $table = $wallet->fetchWallet();

                        echo $table;
                    ?>
                </table>

        </div>
    </body>
</html>