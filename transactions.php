<?php 
    require 'utilities/navbar.php';
    require 'functions/READcard.php';

    $userid = $_SESSION['userID'];
    $user = $_SESSION['user'];
    $cardid = $_POST['cardID'];
    $balance = $_POST['balance'];
?>
        <div class="container" id="wrapper">
            <div class="jumbotron">
                <?php
                    $login = empty($_SESSION['userID']) ? false : true;

                    if ($login) {
                        echo '<h2 class="lobster">Transaction history for card #' . $cardid . '</h2>
                <h4 class="raleway">$' . $balance . '</h4>
                <button class="btn btn-outline-secondary raleway" data-toggle="modal" data-target="#updateModal" type="button">Update Balance</button>
                <button class="btn btn-outline-danger raleway" data-toggle="modal" data-target="#deleteModal" type="button">Delete Card</button></div>';
                    }
                    else {
                        echo '<h2 class="lobster">You are NOT logged in. Please select log in or sign up from the navigation bar.</h2></div>';
                        exit;
                    }
                ?>
            <div class="table-responsive-lg">
                <table class="table">
                    <tr class="raleway">
                        <th>Transaction ID</th>
                        <th>Δ Balance</th>
                        <th>Date/Time</th>
                    </tr>
                    <?php
                        $card = new Card($cardid);
                        $table = $card->read();

                        echo $table;
                    ?>
                </table>
            </div>
        </div>

        <!--
            Modal fade update
        -->
        <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title lobster" id="lineModalLabel">New transaction (balance: $<?php echo $balance;?>)</h3>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    </div>
                    <div class="modal-body raleway">	
                        <form action="functions/UPDATEcard.php" method="POST">
                            <div class="form-group">
                                <label for="balanceDelta"></label>
                                <input name="balanceDelta" type="text" class="form-control" id="Username" placeholder="Δ balance">
                                <span id="balanceDeltaHelpBlock" class="form-text text-muted">Max two decimal places, do not include currency symbols</span>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="addsub" id="inlineRadio1" value="add">
                                <label class="form-check-label" for="inlineRadio1">add</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="addsub" id="inlineRadio2" value="sub" checked="checked">
                                <label class="form-check-label" for="inlineRadio2">subtract</label>
                            </div>
                            <br>
                            <input type="hidden" name="cardID" value="<?php echo $cardid?>">
                            <input type="hidden" name="balance" value="<?php echo $balance?>">
                            <br>
                            <button type="submit" class="btn btn-info">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!--
            Modal fade delete
        -->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title lobster" id="lineModalLabel">Delete card with ID #<?php echo $cardid;?>?</h3>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    </div>
                    <div class="modal-body raleway">	
                        <form action="functions/DELETEcard.php" method="POST">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="verify" id="defaultCheck1" required>
                                <label class="form-check-label" for="defaultCheck1">Please check the box to verify this action</label>
                            </div>
                            <input type="hidden" name="cardID" value="<?php echo $cardid?>">
                            <br>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
