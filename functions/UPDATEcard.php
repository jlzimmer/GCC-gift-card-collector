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
        updateBalance();
    }

    function updateBalance() {
        $cardid = $_POST['cardID'];
        $balance = $_POST['balance'];
        $delta = empty($_POST['balanceDelta']) ? '' : $_POST['balanceDelta'];
        $addsub = empty($_POST['addsub']) ? '' : $_POST['addsub'];

        if (empty($delta) || empty($addsub))
        {
            $_SESSION['add'] = 4;
            header("Location: ../library.php?result=emptyField");
            exit;
        }
        
        require 'db.php';
        $mysqli = new mysqli($server, $DBusername, $DBpassword, $dbname);
            if ($mysqli->connect_error) {
                header("Location: ../index.php?result=failedSQLconnection");
                exit;
            }
        
        $delta = $mysqli->real_escape_string($delta);
        if ($addsub == 'sub') {
            $delta = $delta * -1;
        }

        $newBalance = $balance + $delta;
        if ($newBalance < 0) {
            $mysqli->close();
            $_SESSION['add'] = 4;
            header("Location: ../library.php?result=insufficientBalance");
            exit;
        }

        $result1 = $mysqli->query("INSERT INTO transactions (cardId, balanceDelta, date) VALUES ($cardid, $delta, NOW())");
        $result2 = $mysqli->query("UPDATE certificards SET balance = $newBalance WHERE id = $cardid");

        if ($result1 === true && $result2 === true) {
            $mysqli->close();
            $_SESSION['add'] = 3;
            $append = $_SESSION['user'];
            header("Location: ../library.php?result=loggedIn&user=$append");
            exit;
        }
        else {
            $mysqli->close();
            $_SESSION['add'] = 4;
            header("Location: ../library.php?result=SQLerrorContactAdmin");
            exit;
        }
    }
?>