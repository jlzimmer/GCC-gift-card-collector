<?php
    require 'utilities/navbar.php';
?>
        <div class="container" id="wrapper">
            <div class="jumbotron">
                <h2 class="lobster">
                    <?php
                        $login = empty($_SESSION['userID']) ? false : $_SESSION['userID'];
	
                        if ($login) {
                            echo 'You are logged in. Please select the "Wallet" tab from the navigation bar.';
                        }
                        
                        else {
                            echo 'You are NOT logged in. Please select Log In or Sign Up from the navigation bar.';
                        }
                    ?>
                </h2>
            </div>
        </div>
    </body>
</html>