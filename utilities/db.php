<?php
    $server = "cs3380.cn2wh08wp9zi.us-east-1.rds.amazonaws.com";
    $DBusername = "ec2user";
    $DBpassword = "Mizzou_CS3380_SP18";
    $dbname = "gift_card_collector";

    $mysqli = new mysqli($server, $DBusername, $DBpassword, $dbname);

    if ($mysqli->connect_error) {
        echo $mysqli->connect_error;
        $_SESSION['userID'] = null;
        $_SESSION['user'] = null;
//        header("Location: ../index.php?result=failedSQLconnection");
        exit;
    }
?>
