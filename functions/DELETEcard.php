<?php
    if(!session_start()) {
        header("Location: ../index.php?result=badSession");
        exit;
    }

    $login = empty($_SESSION['userID']) ? false : $_SESSION['userID'];
    
    if ($login === false) {
        header("Location: ../index.php?result=sessionError");
        exit;
    }
    else {
        deleteCard();
    }

    function deleteCard() {
        $cardid = $_POST['cardID'];

        require '../utilities/db.php';
        $mysqli = new mysqli($server, $DBusername, $DBpassword, $dbname);
            if ($mysqli->connect_error) {
                header("Location: ../index.php?result=failedSQLconnection");
                exit;
            }

        $result1 = $mysqli->query("DELETE FROM certificards WHERE id = $cardid");
        $result2 = $mysqli->query("DELETE FROM transactions WHERE cardId = $cardid");
        
        if ($result1 === true && $result2 === true) {
            $_SESSION['add'] = 5;
            $append = $_SESSION['user'];
            header("Location: ../library.php?result=loggedIn&user=$append");
            exit;
        }
        else {
            $_SESSION['add'] = 4;
            $append = $_SESSION['user'];
            header("Location: ../library.php?result=SQLerrorContactAdmin");
            exit;
        }
    }
?>
