<?php
	if(!session_start()) {
		header("Location: ../index.php?result=badSession");
		exit;
	}
	
	$login = empty($_SESSION['userID']) ? false : $_SESSION['userID'];
	
	if ($login) {
        $append = $_SESSION['user'];
        header("Location: ../library.php?result=loggedIn&user=$append");
		exit;
	}
    else {
        handle_login();
    }
	
    function handle_login() {        
        $username = empty($_POST['username']) ? '' : $_POST['username'];
        $password = empty($_POST['password']) ? '' : $_POST['password'];

            if (empty($username) || empty($password)) {
                header("Location: ../index.php?result=emptyField");
                exit;
            }
        
        require 'db.php';
        $mysqli = new mysqli($server, $DBusername, $DBpassword, $dbname);
            if ($mysqli->connect_error) {
                header("Location: ../index.php?result=failedSQLconnection");
                exit;
            }

        $username = $mysqli->real_escape_string($username);
        $password = $mysqli->real_escape_string($password);
        
		$query = "SELECT * FROM users WHERE name = '$username'";
        $result = $mysqli->query($query);
		
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();

  		    if (password_verify($password, $row['password'])) {
                $_SESSION['userID'] = $row['id'];
                $_SESSION['user'] = $row['name'];
                $mysqli->close();
                $append = $_SESSION['user'];
                header("Location: ../library.php?result=loggedIn&user=$append");
                exit;
            }
            else {
                $mysqli->close();
                header("Location: ../index.php?result=incorrectPassword");
                exit;
            }
        }
        else {
            $mysqli->close();
            header("Location: ../index.php?result=SQLerrorContactAdmin");
            exit;
        }
    }
?>
