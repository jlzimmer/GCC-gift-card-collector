<?php
    $server = "ec2-54-162-112-178.compute-1.amazonaws.com";
    $username = "ec2user";
    $password = "Mizzou_CS3380_SP18";
    $dbname = "gift_card_collector";

    $mysql = new mysqli($server, $username, $password, $dbname);

    if ($mysql->connect_error) {
        header("Location: ../index.php?result=failedSQLconnection");
        exit;
    }
?>
