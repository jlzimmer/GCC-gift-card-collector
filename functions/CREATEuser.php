<?php
    $username = empty($_POST['username']) ? '' : $_POST['username'];
    $password = empty($_POST['password']) ? '' : $_POST['password'];

        if (empty($username) || empty($password))
        {
            header("Location: ../index.php?result=emptyField");
            exit;
        }
    
    require_once '../utilities/db.php';
    $mysqli = new mysqli($server, $DBusername, $DBpassword, $dbname);
        if ($mysqli->connect_error) {
            header("Location: ../index.php?result=failedSQLconnection");
            exit;
        }

    $username = $mysqli->real_escape_string($username);
    $password = $mysqli->real_escape_string($password);
    $hashword = password_hash($password, PASSWORD_DEFAULT);
    
    $query = "INSERT INTO users (name, password) VALUES ('$username', '$hashword')";
        
        if ($mysqli->query($query) === true) {
            session_start();
            $query = "SELECT * FROM users WHERE name = '$username' AND password = '$hashword'";
            $result = $mysqli->query($query);
            $row = $result->fetch_assoc();
            $_SESSION['userID'] = $row['id'];
            $_SESSION['user'] = $row['user'];
            $result->free();
            $mysqli->close();
            $append = $_SESSION['user'];
            header("Location: ../library.php?result=loggedIn&user=$append");
            exit;
        }
        else {
            $mysqli->close();
            header("Location: ../index.php?result=createUserFailed");
            exit;
        }
?>
