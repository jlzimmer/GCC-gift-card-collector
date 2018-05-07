<?php
    require 'utilities/navbar.php';
?>

        <div class="container" id="wrapper">
            <div class="jumbotron">
                <?php
                    $loggedIn = empty($_SESSION['userID']) ? false : true;

                    if ($loggedIn) {
                        echo '<h2 class="lobster">Insert card information below</h2>';
                    }
                    else {
                        echo '<h2 class="lobster">You are NOT logged in. Please select log in or sign up from the navigation bar.</h2>';
                        exit;
                    }
                ?>
            </div>
            <form class="raleway" action="utilities/addtowallet.php" method="POST">
                <div class="form-group row">
                    <label for="location" class="col-4 col-form-label text-right">Location</label> 
                    <div class="col-4">
                        <input id="location" name="location" placeholder="store, restaurant, etc." type="text" class="form-control here">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="balance" class="col-4 col-form-label text-right">Balance</label> 
                    <div class="col-4">
                        <input id="balance" name="balance" placeholder="0000.00" type="text" class="form-control here" aria-describedby="balanceHelpBlock"> 
                        <span id="balanceHelpBlock" class="form-text text-muted">Enter up to four-digit dollar values and up to two decimal places</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="serial" class="col-4 col-form-label text-right">Serial number</label> 
                    <div class="col-4">
                        <input id="serial" name="serial" placeholder="S4MPL3-1NPU7" type="text" class="form-control here">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="expiration" class="col-4 col-form-label text-right">Expiration date</label> 
                    <div class="col-4">
                        <input id="expiration" name="expiration" placeholder="YYYY-MM-DD" type="text" class="form-control here" aria-describedby="expirationHelpBlock"> 
                        <span id="expirationHelpBlock" class="form-text text-muted">Please use the YYYY-MM-DD format</span>
                    </div>
                </div> 
                <div class="form-group row">
                    <div class="offset-4 col-8">
                        <button name="submit" type="submit" class="btn btn-warning">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>